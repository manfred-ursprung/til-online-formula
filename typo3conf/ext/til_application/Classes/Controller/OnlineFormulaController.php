<?php
namespace MUM\TilApplication\Controller;

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
use MUM\TilApplication\Domain\Model\Candidate;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use MUM\TilApplication\Domain\Model\School;

/**
 * CandidateController
 */
class OnlineFormulaController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * candidateRepository
	 *
	 * @var \MUM\TilApplication\Domain\Repository\CandidateRepository
	 * @inject
	 */
	protected $candidateRepository = NULL;

	/**
	 * FrontendUserRepository
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
	 * @inject
	 */
	protected $frontendUserRepository;

	/**
	 * @var  \MUM\TilApplication\Domain\Model\Candidate
	 */
	protected $candidate;

	/**
	 * @var \TYPO3\CMS\Core\Page\PageRenderer
	 */
	public $pageRenderer;



	public function initializeAction(){
		$result = $this->candidateRepository->findByFeUser($GLOBALS['TSFE']->fe_user->user['uid']);
		if( $result->count() > 0){
			$this->candidate = $result->getFirst();
		}else{
			/** @var  candidate MUM\TilApplication\Domain\Model\Candidate */
			$this->candidate = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\Candidate');
			//$this->candidate->setFeUser($GLOBALS['TSFE']->fe_user);
		}
		$this->pageRenderer = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Page\\PageRenderer');
		$css = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($this->request->getControllerExtensionKey())
			.'Resources/Public/Css/application.css';
		//$this->pageRenderer->addHeaderData('<link rel="stylesheet" href="/typo3temp/vhs-assets-rte-style.css?1457204026">');
		
		$this->pageRenderer->addCssLibrary($css);
	}

	/**
	 * action show
	 *
	 *
	 * @return void
	 */
	public function step0Action() {
		DebuggerUtility::var_dump($this->candidate, 'Step0');
		$this->view->assign('isNew', $this->candidate->_isNew());
		$this->view->assign('settings', $this->settings);
	}

	/**
	 * action step1
	 *
	 * @return void
	 */
	public function step1Action() {
		//DebugUtility::debug($GLOBALS['TSFE']->fe_user, 'Frontenduser');
		DebuggerUtility::var_dump($this->candidate, 'Step1');
		if($this->candidate->_isNew()){
			$feUser = $this->frontendUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
			if(is_a($feUser, '\TYPO3\CMS\Extbase\Domain\Model\FrontendUser')) {
				$this->candidate->setFeUser($feUser);
			}else{
				$this->redirect('step0');
			}
		}
		$params = array(
			'isNew' 	=> $this->candidate->_isNew(),
			'candidate'	=> $this->candidate,
			'feUser'	=> $feUser,
			'settings'	=> $this->settings,
		);
		$this->view->assignMultiple($params);

	}

	/**
	 * action step2
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $newCandidate
	 * @return void
	 */
	public function step2Action() {
		//has candidate an actual school entry?
		if($this->candidate->hasActualSchool()){
			$actualSchool = $this->candidate->getActualSchool();
		}else{
			$actualSchool = NULL;
		}
		$params = array(
			'candidate'	=> $this->candidate,
			'actualSchool'  => $actualSchool,
			'settings'	=> $this->settings,
		);
		$this->view->assignMultiple($params);
	}

	/**
	 * action step3
	 *
	 *
	 * @return void
	 */
	public function step3Action() {
		//$this->view->assign('candidate', $candidate);
	}


	/**
	 * action create
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $newCandidate
	 * @return void
	 */
	public function createAction(\MUM\TilApplication\Domain\Model\Candidate $newCandidate) {
		//$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		if($this->isUserValid()) {
			$this->candidateRepository->add($newCandidate);
			$this->redirect('step2');
		}else{
			$this->redirect('step1');
		}
	}


	/**
	 * action update
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $candidate
	 * @return void
	 */
	public function updateStep1Action(\MUM\TilApplication\Domain\Model\Candidate $candidate) {
		if($this->isUserValid()) {
			//DebuggerUtility::var_dump($candidate);

			$this->candidateRepository->update($candidate);
			$persistenceManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager');
			$persistenceManager->persistAll();
			$this->addFlashMessage('Ihre Daten wurden gespeichert.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
			$this->redirect('step2');
		}else{
			$this->redirect('step0');
		}
	}


	/**
	 * action update
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $candidate
	 * @param \MUM\TilApplication\Domain\Model\School $actualSchool
	 * @return void
	 */
	public function updateStep2Action(\MUM\TilApplication\Domain\Model\Candidate $candidate,
									  \MUM\TilApplication\Domain\Model\School $actualSchool) {
		if($this->isUserValid()) {
			$candidate->setActualSchool($actualSchool);
			$this->candidateRepository->update($candidate);
			$this->redirect('step3');
		}else{
			$this->redirect('step1');
		}
	}


	/**
	 * action update
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $candidate
	 * @return void
	 */
	public function updateStep3Action(\MUM\TilApplication\Domain\Model\Candidate $candidate) {
		if($this->isUserValid()) {
			$this->candidateRepository->update($candidate);
			$this->redirect('step2');
		}else{
			$this->redirect('step0');
		}
	}



	/**
	 * @param int $uid
	 * @return bool
	 * checks if a user is log in
	 */
	protected function isUserValid($uid = -1){
		if($uid == -1){
			$uid = $GLOBALS['TSFE']->fe_user->user['uid'];
		}
		$user = $this->frontendUserRepository->findByUid($uid);
		return !is_null($user);


	}
}