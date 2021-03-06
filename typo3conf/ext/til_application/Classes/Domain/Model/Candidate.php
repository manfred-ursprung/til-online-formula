<?php
namespace MUM\TilApplication\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Manfred Ursprung <manfred@manfred-ursprung.de>, Webapplication Ursprung
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
use TYPO3\CMS\Frontend\Authentication\FrontendUserAuthentication;
use MUM\TilApplication\Domain\Model\School;
use MUM\TilApplication\Domain\Model\Relative;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Is the root of all. Al data are here collected.
 */
class Candidate extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var \string
	 */
	protected $gender;

	/**
	 * familyStatus
	 *
	 * @var \string
	 *
	 */
	protected $familyStatus = '';

	/**
	 * @var  \DateTime
	 *
	 */
	protected $birthdate;

	/**
	 * @var  \string
	 *
	 */
	protected $countryOfBirth;

	/**
	 * migrationBackground
	 *
	 * @var bool
	 */
	protected $migrationBackground = FALSE;

	/**
	 * nationality
	 *
	 * @var string
	 *
	 */
	protected $nationality = '';

	/**
	 * residentSince
	 *
	 * @var string
	 */
	protected $residentSince = '';

	/**
	 * residenceStatus
	 *
	 * @var int
	 */
	protected $residenceStatus = 0;

	/**
	 * residenceMisc
	 *
	 * @var string
	 */
	protected $residenceMisc = '';

	/**
	 * familyAddon
	 *
	 * @var string
	 */
	protected $familyAddon = '';

	/**
	 * assetRealEstate
	 *
	 * @var string
	 */
	protected $assetRealEstate = '';

	/**
	 * assetSavings
	 *
	 * @var string
	 */
	protected $assetSavings = '';

	/**
	 * assetMiscEstate
	 *
	 * @var string
	 */
	protected $assetMiscEstate = '';

	/**
	 * feUser
	 *
	 * @var   \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 */
	protected $feUser = NULL;

	/**
	 * address
	 *
	 * @var \MUM\TilApplication\Domain\Model\Address
	 * @validate NotEmpty
	 */
	protected $address = NULL;

	/**
	 * schoolCareer
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MUM\TilApplication\Domain\Model\School>
	 * @cascade remove
	 */
	protected $schoolCareer = NULL;

	/**
	 * @var  \MUM\TilApplication\Domain\Model\School
	 * @transient
	 */
	protected $actualSchool;

	/**
	 * family
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MUM\TilApplication\Domain\Model\Relative>
	 * @cascade remove
	 */
	protected $family = NULL;

	/**
	 * costs
	 *
	 * @var \MUM\TilApplication\Domain\Model\Costs
	 *
	 */
	protected $costs = NULL;

	/**
	 * integrity
	 *
	 * @var bool
	 */
	protected $integrity = FALSE;

	/**
	 * income
	 *
	 * @var \MUM\TilApplication\Domain\Model\Income
	 */
	protected $income = NULL;


	/**
	 * @var \MUM\TilApplication\Domain\Model\Documents
	 */
	protected $documents;

	/**
	 * @var \int
	 */
	protected $tstamp;


	/**
	 * approval
	 *
	 * @var bool
	 */
	protected $approval = FALSE;


	 public static function residenceStatus(){
		 return array(
			 1	=> 'Niederlassungserlaubnis',
			 2  => 'Aufenthaltserlaubnis',
			 3	=> ' Sonstiges',
		 );
	 }

	/**
	 * Returns the familyStatus
	 *
	 * @return \string $familyStatus
	 */
	public function getFamilyStatus() {
		return $this->familyStatus;
	}

	/**
	 * Sets the familyStatus
	 *
	 * @param \string $familyStatus
	 * @return void
	 */
	public function setFamilyStatus($familyStatus) {
		$this->familyStatus = $familyStatus;
	}

	/**
	 * Returns the migrationBackground
	 *
	 * @return bool $migrationBackground
	 */
	public function getMigrationBackground() {
		return $this->migrationBackground;
	}

	/**
	 * Sets the migrationBackground
	 *
	 * @param bool $migrationBackground
	 * @return void
	 */
	public function setMigrationBackground($migrationBackground) {
		$this->migrationBackground = $migrationBackground;
	}

	/**
	 * Returns the boolean state of migrationBackground
	 *
	 * @return bool
	 */
	public function isMigrationBackground() {
		return $this->migrationBackground;
	}

	/**
	 * Returns the feUser
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser
	 */
	public function getFeUser() {
		return $this->feUser;
	}

	/**
	 * Sets the feUser
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser
	 * @return void
	 */
	public function setFeUser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser) {
		$this->feUser = $feUser;
	}

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->schoolCareer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->family = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the nationality
	 *
	 * @return string $nationality
	 */
	public function getNationality() {
		return $this->nationality;
	}

	/**
	 * Sets the nationality
	 *
	 * @param string $nationality
	 * @return void
	 */
	public function setNationality($nationality) {
		$this->nationality = $nationality;
	}

	/**
	 * Returns the residentSince
	 *
	 * @return string $residentSince
	 */
	public function getResidentSince() {
		return $this->residentSince;
	}

	/**
	 * Sets the residentSince
	 *
	 * @param string $residentSince
	 * @return void
	 */
	public function setResidentSince($residentSince) {
		$this->residentSince = $residentSince;
	}

	/**
	 * Returns the residenceStatus
	 *
	 * @return int $residenceStatus
	 */
	public function getResidenceStatus() {
		return $this->residenceStatus;
	}

	/**
	 * Sets the residenceStatus
	 *
	 * @param int $residenceStatus
	 * @return void
	 */
	public function setResidenceStatus($residenceStatus) {
		$this->residenceStatus = $residenceStatus;
	}

	/**
	 * Returns the residenceMisc
	 *
	 * @return string $residenceMisc
	 */
	public function getResidenceMisc() {
		return $this->residenceMisc;
	}

	/**
	 * Sets the residenceMisc
	 *
	 * @param string $residenceMisc
	 * @return void
	 */
	public function setResidenceMisc($residenceMisc) {
		$this->residenceMisc = $residenceMisc;
	}

	/**
	 * Returns the familyAddon
	 *
	 * @return string $familyAddon
	 */
	public function getFamilyAddon() {
		return $this->familyAddon;
	}

	/**
	 * Sets the familyAddon
	 *
	 * @param string $familyAddon
	 * @return void
	 */
	public function setFamilyAddon($familyAddon) {
		$this->familyAddon = $familyAddon;
	}

	/**
	 * Returns the address
	 *
	 * @return \MUM\TilApplication\Domain\Model\Address $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param \MUM\TilApplication\Domain\Model\Address $address
	 * @return void
	 */
	public function setAddress(\MUM\TilApplication\Domain\Model\Address $address) {
		$this->address = $address;
	}

	/**
	 * Adds a School
	 *
	 * @param \MUM\TilApplication\Domain\Model\School $schoolCareer
	 * @return void
	 */
	public function addSchoolCareer(\MUM\TilApplication\Domain\Model\School $schoolCareer) {
		$this->schoolCareer->attach($schoolCareer);
	}

	/**
	 * Removes a School
	 *
	 * @param \MUM\TilApplication\Domain\Model\School $schoolCareerToRemove The School to be removed
	 * @return void
	 */
	public function removeSchoolCareer(\MUM\TilApplication\Domain\Model\School $schoolCareerToRemove) {
		$this->schoolCareer->detach($schoolCareerToRemove);
	}

	/**
	 * Returns the schoolCareer
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MUM\TilApplication\Domain\Model\School> $schoolCareer
	 */
	public function getSchoolCareer() {
		return $this->schoolCareer;
	}

	/**
	 * Sets the schoolCareer
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MUM\TilApplication\Domain\Model\School> $schoolCareer
	 * @return void
	 */
	public function setSchoolCareer(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $schoolCareer) {
		$this->schoolCareer = $schoolCareer;
	}

	public function hasActualSchool(){
		$founded = false;
		if($this->schoolCareer->count() > 0){
			$founded = is_object($this->getActualSchool());

		}
		return !is_null($founded);
	}

	/**
	 * Returns the assetRealEstate
	 *
	 * @return string $assetRealEstate
	 */
	public function getAssetRealEstate() {
		return $this->assetRealEstate;
	}

	/**
	 * Sets the assetRealEstate
	 *
	 * @param string $assetRealEstate
	 * @return void
	 */
	public function setAssetRealEstate($assetRealEstate) {
		$this->assetRealEstate = $assetRealEstate;
	}

	/**
	 * Returns the assetSavings
	 *
	 * @return string $assetSavings
	 */
	public function getAssetSavings() {
		return $this->assetSavings;
	}

	/**
	 * Sets the assetSavings
	 *
	 * @param string $assetSavings
	 * @return void
	 */
	public function setAssetSavings($assetSavings) {
		$this->assetSavings = $assetSavings;
	}

	/**
	 * Returns the assetMiscEstate
	 *
	 * @return string $assetMiscEstate
	 */
	public function getAssetMiscEstate() {
		return $this->assetMiscEstate;
	}

	/**
	 * Sets the assetMiscEstate
	 *
	 * @param string $assetMiscEstate
	 * @return void
	 */
	public function setAssetMiscEstate($assetMiscEstate) {
		$this->assetMiscEstate = $assetMiscEstate;
	}

	/**
	 * Returns the costs
	 *
	 * @return \MUM\TilApplication\Domain\Model\Costs $costs
	 */
	public function getCosts() {
		return $this->costs;
	}

	/**
	 * Sets the costs
	 *
	 * @param \MUM\TilApplication\Domain\Model\Costs $costs
	 * @return void
	 */
	public function setCosts(\MUM\TilApplication\Domain\Model\Costs $costs) {
		$this->costs = $costs;
	}

	/**
	 * Adds a Relative
	 *
	 * @param \MUM\TilApplication\Domain\Model\Relative $family
	 * @return void
	 */
	public function addFamily(\MUM\TilApplication\Domain\Model\Relative $family) {
		$this->family->attach($family);
	}

	/**
	 * Removes a Relative
	 *
	 * @param \MUM\TilApplication\Domain\Model\Relative $familyToRemove The Relative to be removed
	 * @return void
	 */
	public function removeFamily(\MUM\TilApplication\Domain\Model\Relative $familyToRemove) {
		$this->family->detach($familyToRemove);
	}

	/**
	 * Returns the family
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MUM\TilApplication\Domain\Model\Relative> family
	 */
	public function getFamily() {
		return $this->family;
	}

	/**
	 * Sets the family
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\MUM\TilApplication\Domain\Model\Relative> $family
	 * @return void
	 */
	public function setFamily(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $family) {
		$this->family = $family;
	}

	/**
	 * Returns the integrity
	 *
	 * @return bool $integrity
	 */
	public function getIntegrity() {
		return $this->integrity;
	}

	/**
	 * Sets the integrity
	 *
	 * @param bool $integrity
	 * @return void
	 */
	public function setIntegrity($integrity) {
		$this->integrity = $integrity;
	}

	/**
	 * Returns the boolean state of integrity
	 *
	 * @return bool
	 */
	public function isIntegrity() {
		return $this->integrity;
	}

	/**
	 * Returns the income
	 *
	 * @return \MUM\TilApplication\Domain\Model\Income $income
	 */
	public function getIncome() {
		return $this->income;
	}

	/**
	 * Sets the income
	 *
	 * @param \MUM\TilApplication\Domain\Model\Income $income
	 * @return void
	 */
	public function setIncome(\MUM\TilApplication\Domain\Model\Income $income) {
		$this->income = $income;
	}

	/**
	 * @return \DateTime
	 */
	public function getBirthdate()
	{
		return $this->birthdate;
	}

	/**
	 * @param \DateTime $birthdate
	 */
	public function setBirthdate($birthdate = null)
	{
		$this->birthdate = $birthdate;
	}

	/**
	 * @return string
	 */
	public function getCountryOfBirth()
	{
		return $this->countryOfBirth;
	}

	/**
	 * @param string $countryOfBirth
	 */
	public function setCountryOfBirth($countryOfBirth)
	{
		$this->countryOfBirth = $countryOfBirth;
	}

	/**
	 * @return string
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * @param string $gender
	 */
	public function setGender($gender)
	{
		$this->gender = $gender;
	}

	/**
	 * @return Documents
	 */
	public function getDocuments()
	{
		return $this->documents;
	}

	/**
	 * @param Documents $documents
	 */
	public function setDocuments($documents)
	{
		$this->documents = $documents;
	}


	/**
	 * @return boolean
	 */
	public function isApproval()
	{
		return $this->approval;
	}

	/**
	 * @param boolean $approval
	 */
	public function setApproval($approval)
	{
		$this->approval = $approval;
	}

	/**
	 * @return int
	 */
	public function getTstamp()
	{
		return $this->tstamp;
	}




	/**
	 * @return \MUM\TilApplication\Domain\Model\School
	 */
	public function getActualSchool()
	{
		if(isset($this->actualSchool)){
			return $this->actualSchool;
		}else {
			/** @var  $school School */
			foreach ($this->schoolCareer as $school) {
				if ($school->isActual()) {
					$this->actualSchool = $school;
					return $this->actualSchool;
					break;
				}
			}
		}
		return null;
	}

	/**
	 * @return \array
	 */
	public function getOtherSchools()
	{
		$otherSchools = array();
		/** @var  $school School */
		foreach ($this->schoolCareer as $school) {
			if (!$school->isActual()) {
				$otherSchools[] = $school;
			}
		}

		return $otherSchools;
	}


	/**
	 * @param \MUM\TilApplication\Domain\Model\School $school
	 */
	public function setActualSchool(\MUM\TilApplication\Domain\Model\School $school){
		$school->setActual(true);
		if($this->hasActualSchool()){

			if(is_object($this->actualSchool) && ($this->actualSchool->getUid() != $school->getUid())){
				$this->removeSchoolCareer($this->actualSchool);

				$this->addSchoolCareer($school);
			}
		}else{
			$this->addSchoolCareer($school);
		}
	}

	/**
	 * @param bool $withBlankRelative
	 * @return array
	 * returns current family in a special order. If paramete is set, mother or father is set as blank object.
	 * Sibling can be created in forms
	 */
	public function getWholeFamily($withBlankRelative = false){
		//@TODO ein  Array mit allen Relatives in der Reihenfolge Mutter, vater, Geschwister, Geeschwister
		$wholeFamily = array();
		if($this->family->count() > 0){
			$temp = array(
				'mother' => array(),
				'father' => array(),
				'sibling'=> array()
				);
			/** @var  $member \MUM\TilApplication\Domain\Model\Relative */
			foreach($this->family as $member){
				switch($member->getFamilyRelation()){
					case 0:
					$temp['father'] = $member;
						break;
					case 1:
						$temp['mother'] = $member;
						break;
					case 2:
						$temp['sibling'][] = $member;
						break;
				}
			}
			if(is_object($temp['mother'])){
				$wholeFamily[] = $temp['mother'];
			}elseif($withBlankRelative){
				$relative = $this->createBlankRelative(Relative::RELATION_MOTHER);
				$wholeFamily[] = $relative;
			}
			if(is_object($temp['father'])){
				$wholeFamily[] = $temp['father'];
			}elseif($withBlankRelative){
				$relative = $this->createBlankRelative(Relative::RELATION_FATHER);
				$wholeFamily[] = $relative;
			}

			$wholeFamily = array_merge($wholeFamily, $temp['sibling']);
		}
		return $wholeFamily;
	}

	/**
	 * @return array
	 * returns blank family, only family relation is set
	 */
	public function createEmptyFamily(){
		$family = array();
		foreach(array(Relative::RELATION_MOTHER, Relative::RELATION_FATHER, Relative::RELATION_SIBLING) as $relation){
			$relative = $this->createBlankRelative($relation);
			$family[] = $relative;
		}

		return $family;
	}

	/**
	 * @return \MUM\TilApplication\Domain\Model\Relative
	 */
	protected function createBlankRelative($relation)
	{
		/** @var  $relative \MUM\TilApplication\Domain\Model\Relative */
		$relative = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\Relative');
		$relative->setFamilyRelation($relation);
		return $relative;
	}

}