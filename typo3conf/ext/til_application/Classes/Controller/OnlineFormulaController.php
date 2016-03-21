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
use MUM\TilApplication\Domain\Repository\RelativeRepository;
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
	 * schoolRepository
	 *
	 * @var \MUM\TilApplication\Domain\Repository\SchoolRepository
	 * @inject
	 */
	protected $schoolRepository = NULL;


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
		//DebuggerUtility::var_dump($this->candidate, 'Step0');
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
		//DebuggerUtility::var_dump($this->candidate, 'Step1');
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
	 * shows all schools of candidate
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $newCandidate
	 * @return void
	 */
	public function step2Action() {
		//DebuggerUtility::var_dump($this->candidate, 'Step2');
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
	 * shows the family of candidate
	 *
	 * @return void
	 */
	public function step3Action() {
		if(!$this->isUserValid()) {
			$this->redirect('step0');
		}
		$family = $this->candidate->getWholeFamily();
		if(empty($family)){
			$family = $this->candidate->createEmptyFamily();
		}

		$params = array(
			'candidate'	=> $this->candidate,
			'family'  => $family,
			'settings'	=> $this->settings,
		);
		$this->view->assignMultiple($params);

	}

	/**
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
	 *
	 * Einkommen und Vermögen
	 */
	public function step4Action() {
		if(!$this->isUserValid()) {
			$this->redirect('step0');
		}
		$family = $this->candidate->getWholeFamily();
		if(empty($family)){
			$this->addFlashMessage('Sie müssen erst Schritt 3 bearbeiten. Legen Sie bitte die Familienmitglieder an.',
				'', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
			$this->redirect('step3', null, null, null, $this->settings['pageStep3']);
		}

		$params = array(
			'candidate'	=> $this->candidate,
			'family'  => $family,
			'settings'	=> $this->settings,
		);
		$this->view->assignMultiple($params);

	}

	/**
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
	 * shows the costs of the whole family
	 */
	public function step5Action() {
		if(!$this->isUserValid()) {
			$this->redirect('step0');
		}
		$family = $this->candidate->getWholeFamily();
		if(empty($family)){
			$this->addFlashMessage('Sie müssen erst Schritt 3 bearbeiten. Legen Sie bitte die Familienmitglieder an.',
				'', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
			$this->redirect('step3', null, null, null, $this->settings['pageStep3']);
		}

		$params = array(
			'candidate'	=> $this->candidate,
			'family'  => $family,
			'settings'	=> $this->settings,
		);
		$this->view->assignMultiple($params);

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
			$this->addFlashMessage('Ihre Daten wurden gespeichert.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);

			$this->redirect('step2');
		}else{
			$this->redirect('step1');
		}
	}


	public function initializeUpdateStep1Action() {
		if ($this->arguments->hasArgument('candidate')) {
			$this->arguments['candidate']
				->getPropertyMappingConfiguration()
				->forProperty('birthdate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
					\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			//	->setTargetTypeForSubProperty('schoolCertificateDate', '\DateTime');

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


	public function initializeUpdateStep2Action() {
		if ($this->arguments->hasArgument('actualSchool')) {
			$this->arguments['actualSchool']
				->getPropertyMappingConfiguration()
				->forProperty('schoolCertificateDate')
				->setTypeConverterOption('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter',
					\TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter::CONFIGURATION_DATE_FORMAT, 'd.m.Y');
			//	->setTargetTypeForSubProperty('schoolCertificateDate', '\DateTime');
			$this->arguments['actualSchool']
				->getPropertyMappingConfiguration()
				->forProperty('schoolCertificatePoints')
				->setTypeConverter( $this->objectManager->get( 'MUM\\TilApplication\\TypeConverter\\FloatConverter' ) );
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
			$actualSchool->setCandidate($candidate);
			$this->schoolRepository->add($actualSchool);
			$candidate->setActualSchool($actualSchool);

			//Weitere Schulen schoolCareer
			$otherSchools = $_REQUEST['tx_tilapplication_form']['otherSchool'];
			foreach($otherSchools as $oSchool){
				if(strlen($oSchool['name']) > 0){
					/** @var  $tmpSchool \MUM\TilApplication\Domain\Model\School */
					$tmpSchool = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\School');
					$tmpSchool->setName($oSchool['name']);
					$tmpSchool->setActual(false);
					$tmpSchool->setCandidate($candidate);
					if(strlen($oSchool['duration']) > 0){
						$tmpSchool->setVisitFrom($oSchool['duration']);
					}
					$this->schoolRepository->add($tmpSchool);
					$candidate->addSchoolCareer($tmpSchool);
				}
			}

			$this->candidateRepository->update($candidate);

			$this->redirect('step3');
		}else{
			$this->redirect('step0');
		}
	}


	/**
	 * action update
	 * sowohl für das Anlegen der Familie wie für das Einkommen
	 * SPEICHERN und WEITER zum nächsten Step
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $candidate
	 * @param \array  $family
	 * @return void
	 */
	public function updateStep3Action(\MUM\TilApplication\Domain\Model\Candidate $candidate,
									  array $family = array()) {
		//DebuggerUtility::var_dump($family, 'UpdateStep3');
		//alle Angaben für die Familienmitglieder aus dem Array in Objekte transferieren
		//speichern in candidate
		if(isset($family['firstName'])){
			$candidate = $this->createAndAddFamily($candidate, $family);
			$nextStep = 'step4';
		}
		if(isset($family['grossSalary']) || isset($family['netSalary'])){
			$candidate = $this->setIncomeForFamily($candidate, $family);
			$nextStep = 'step5';
		}



		if($this->isUserValid()) {
			$this->candidateRepository->update($candidate);
			$this->redirect($nextStep);
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

	/**
	 * @param \MUM\TilApplication\Domain\Model\Candidate $candidate
	 * @param \array $family
	 */
	protected function createAndAddFamily( \MUM\TilApplication\Domain\Model\Candidate  $candidate, $family){
		/** @var  $relativeRepository \MUM\TilApplication\Domain\Repository\RelativeRepository */
		$relativeRepository = $this->objectManager->get('MUM\\TilApplication\\Domain\\Repository\\RelativeRepository');
		foreach ($family['firstName'] as $key => $firstName) {
			if (!empty($firstName)) {
				if(isset($family['uid'][$key])){
					$member = $relativeRepository->findByUid($family['uid'][$key]);
				}else {
					/** @var  $member \MUM\TilApplication\Domain\Model\Relative */
					$member = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\Relative');
				}
				$member->setFirstName($firstName);
				$member->setLastName($family['lastName'][$key]);
				//$member->setBirthdate($family['birthdate'][$key]);

				$member->setNationality($family['nationality'][$key]);
				$member->setEducationalQualification($family['educationalQualification'][$key]);
				$member->setJob($family['job'][$key]);
				$member->setFamilyRelation($family['familyRelation'][$key]);

				if($member->_isNew()) {
					$relativeRepository->add($member);
				}else{
					$relativeRepository->update($member);
				}
				$candidate->addFamily($member);
			}
		}
		return $candidate;
	}

	/**
	 * @param Candidate $candidate
	 * @param $family
	 *  das jeweilige Einkommen den Familienmitgliedern zuweisen
	 */
	protected function setIncomeForFamily( \MUM\TilApplication\Domain\Model\Candidate  $candidate, $family){

		return $candidate;
	}
}