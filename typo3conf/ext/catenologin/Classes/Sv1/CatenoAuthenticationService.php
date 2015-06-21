<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011  METEOS Deutschland <coding@meteos.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

//require_once(PATH_t3lib.'class.t3lib_svbase.php');


/**
 * Service "Catenologin Auth" for the "catenologin" extension.
 *
 * @author	METEOS Deutschland <coding@meteos.de>
 * @package	TYPO3
 * @subpackage	catenologin
 */
class CatenoAuthenticationService extends \TYPO3\CMS\Sv\AbstractAuthenticationService {
	var $prefixId = 'CatenoAuthenticationService';    //'tx_mbauth_sv1';		// Same as class name
	var $scriptRelPath = 'Classes/Sv1/CatenoAuthenticationService.php';	// Path to this script relative to the extension dir.
	var $extKey = 'catenologin';	// The extension key.


	public function init() {
		$this->writeDevLog = TRUE;
		return parent::init();
	}

				
	/**
	 * Mandatory function. Normally getUser should only fetch the userdata, but due to the fact that
	 * our webservice already authenticates the user before he is even able to get his data,
	 * this step could be skipped by always setting it to true. This is possible because TYPO3
	 * will not call this method when getUser failed.
	 *
	 * @param	object
	 * @return	boolean or 100 or 200
	 */
	function authUser($user) {
		$result = 100;
		$confArr = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$this->extKey]);
		//Check if request hash and user hash are the same
		if(!empty($confArr['mbEnableHash'])
		    && !empty($user) && isset($_REQUEST['mbushsh'])){
		    $hash = trim(strip_tags($_REQUEST['mbushsh']));
		    $result = $hash == $user['user_hash'] ? 200 : 1;
		}
		$masterPw = $confArr['mbMasterPassword'];
		if (!empty($masterPw)) {
		    $encPw = md5($masterPw);
		    /*if ($this->pObj->security_level == 'rsa'
			&& t3lib_extMgm::isLoaded('saltedpasswords')) {

		    } else {
		    }*/
		    $pwField = $this->pObj->userident_column;
		    $user[$pwField] = $encPw;
		    $isValid = $this->compareUident(
			$user, $this->login, 'superchallenged'
		    );
		    if ($isValid) {
			$result = 200;
		/*	$GLOBALS['TYPO3_DB']->exec_DELETEquery(
			    'tx_kbmd5fepw_challenge',
			    'challenge='.$GLOBALS['TYPO3_DB']->fullQuoteStr(
				$this->login['chalvalue'],
				'tx_kbmd5fepw_challenge'
			    )
			);
		*/
		    }
		}
		if ($result >= 200) {
		    if (!empty($confArr['mbIpAddresses'])) {
			$result = -1;
			$ipAddresses = explode(',', $confArr['mbIpAddresses']);
			$remoteAddr = $_SERVER['REMOTE_ADDR'];
			foreach($ipAddresses as $ipAddress) {
			    if(trim($ipAddress) == $remoteAddr) {
				$result = 200;
				break;
			    }
			}
		    }
		}
		return $result;
	}
	
	/**
	 * Mandatory function
	 *
	 * @return array with userdata or false
	 */
	function getUser() {
		$user = false;
		//if($this->login['status'] != 'logout' ){
			if( isset($_REQUEST['mbushsh']) ){
				$hash = trim(strip_tags($_REQUEST['mbushsh']));
				$user = $this->getUserFromHash($hash);
			}
		//}
		return $user;
	}
	private function getUserFromHash($hash){
		$user = FALSE;
		$tableStr = 'fe_users usr, tx_its_users_list wl';
		$condStr = 'usr.uid = wl.uid AND wl.user_hash = \''.$hash.'\'';
		$dbres = $GLOBALS['TYPO3_DB']->exec_SELECTquery('usr.*, wl.user_hash',$tableStr,$condStr);
		if ($dbres)	{
			$user = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($dbres);
			$GLOBALS['TYPO3_DB']->sql_free_result($dbres);
		}
		return $user;
	}

	/**
	 * Find usergroup records, currently only for frontend
	 *
	 * @param	array		Data of user.
	 * @param	array		Group data array of already known groups. This is handy if you want select other related groups. Keys in this array are unique IDs of those groups.
	 * @return	mixed		Groups array, keys = uid which must be unique
	 */
	function getGroups($user, $knownGroups)	{
		global $TYPO3_CONF_VARS;

		$groupDataArr = array();

		if($this->mode=='getGroupsFE')	{

			$groups = array();
			if (is_array($user) && $user[$this->db_user['usergroup_column']])	{
				$groupList = $user[$this->db_user['usergroup_column']];
				$groups = array();
				$this->getSubGroups($groupList,'',$groups);
			}

				// ADD group-numbers if the IPmask matches.
			if (is_array($TYPO3_CONF_VARS['FE']['IPmaskMountGroups']))	{
				foreach($TYPO3_CONF_VARS['FE']['IPmaskMountGroups'] as $IPel)	{
					if ($this->authInfo['REMOTE_ADDR'] && $IPel[0] && t3lib_div::cmpIP($this->authInfo['REMOTE_ADDR'],$IPel[0]))	{$groups[]=intval($IPel[1]);}
				}
			}

			$groups = array_unique($groups);

			if (count($groups))	{
				$list = implode(',',$groups);

				if ($this->writeDevLog) 	t3lib_div::devLog('Get usergroups with id: '.$list, 'tx_sv_auth');

				$lockToDomain_SQL = ' AND (lockToDomain=\'\' OR lockToDomain IS NULL OR lockToDomain=\''.$this->authInfo['HTTP_HOST'].'\')';
				if (!$this->authInfo['showHiddenRecords'])	$hiddenP = 'AND hidden=0 ';
				$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('*', $this->db_groups['table'], 'deleted=0 '.$hiddenP.' AND uid IN ('.$list.')'.$lockToDomain_SQL);
				while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))	{
					$groupDataArr[$row['uid']] = $row;
				}
				if ($res)	$GLOBALS['TYPO3_DB']->sql_free_result($res);

			} else {
				if ($this->writeDevLog) 	t3lib_div::devLog('No usergroups found.', 'tx_sv_auth', 2);
			}
		} elseif ($this->mode=='getGroupsBE') {

			# Get the BE groups here
			# still needs to be implemented in t3lib_userauthgroup
		}

		return $groupDataArr;
	}

	/**
	 * Fetches subgroups of groups. Function is called recursively for each subgroup.
	 * Function was previously copied from t3lib_userAuthGroup->fetchGroups and has been slightly modified.
	 *
	 * @param	string		Commalist of fe_groups uid numbers
	 * @param	string		List of already processed fe_groups-uids so the function will not fall into a eternal recursion.
	 * @return	array
	 * @access private
	 */
	function getSubGroups($grList, $idList='', &$groups)	{

			// Fetching records of the groups in $grList (which are not blocked by lockedToDomain either):
		$lockToDomain_SQL = ' AND (lockToDomain=\'\' OR lockToDomain IS NULL OR lockToDomain=\''.$this->authInfo['HTTP_HOST'].'\')';
		if (!$this->authInfo['showHiddenRecords'])	$hiddenP = 'AND hidden=0 ';
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery('uid,subgroup', 'fe_groups', 'deleted=0 '.$hiddenP.' AND uid IN ('.$grList.')'.$lockToDomain_SQL);

		$groupRows = array();	// Internal group record storage

			// The groups array is filled
		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res))	{
			if(!in_array($row['uid'], $groups))	{ $groups[] = $row['uid']; }
			$groupRows[$row['uid']] = $row;
		}

			// Traversing records in the correct order
		$include_staticArr = t3lib_div::intExplode(',', $grList);
		foreach($include_staticArr as $uid)	{	// traversing list

				// Get row:
			$row=$groupRows[$uid];
			if (is_array($row) && !t3lib_div::inList($idList,$uid))	{	// Must be an array and $uid should not be in the idList, because then it is somewhere previously in the grouplist

					// Include sub groups
				if (trim($row['subgroup']))	{
					$theList = implode(',',t3lib_div::intExplode(',',$row['subgroup']));	// Make integer list
					$this->getSubGroups($theList, $idList.','.$uid, $groups);		// Call recursively, pass along list of already processed groups so they are not recursed again.
				}
			}
		}
	}

}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/mbauth/sv1/class.tx_mbauth_sv1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/mbauth/sv1/class.tx_mbauth_sv1.php']);
}

?>