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
use MUM\TilApplication\Domain\Repository\SchoolRepository;
use MUM\TilApplication\Utility\FileUploader;
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
	 * relativeRepository
	 *
	 * @var \MUM\TilApplication\Domain\Repository\RelativeRepository
	 * @inject
	 */
	protected $relativeRepository = NULL;


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

	/**
	 * @var array
	 */
	protected $tsSetup;

	/**
	 * @var  int
	 */
	protected $storagePid;

	/**
	 * @var \Dompdf\Dompdf
	 */
	protected $domPdf;



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
		
		//$this->pageRenderer->addCssLibrary($css);  wird nun in sitetemplates gemacht
		/** @var  $frontendConfigurationManager \TYPO3\CMS\Extbase\Configuration\FrontendConfigurationManager */
		$frontendConfigurationManager = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Configuration\\FrontendConfigurationManager');
		$this->tsSetup = $frontendConfigurationManager->getTypoScriptSetup();
		$this->storagePid = $this->tsSetup['plugin.']['tx_tilapplication_form.']['persistence.']['storagePid'];
	}

	/**
	 * action show
	 *
	 *
	 * @return void
	 */
	public function step0Action() {
		//DebuggerUtility::var_dump($this->candidate, 'Step0');
		if(!$this->isUserValid()) {
			$this->redirect('', null, null, null, 46);
		}
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
		if(!$this->isUserValid()) {
			$this->redirect('step0');

		}
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
		if(!$this->isUserValid()) {
			$this->redirect('step0');
		}
		//DebuggerUtility::var_dump($this->candidate, 'Step2');
		//has candidate an actual school entry?
		$actualSchool = $this->getActualSchool();
		$otherSchools = $this->candidate->getOtherSchools();

		$params = array(
			'candidate'	=> $this->candidate,
			'actualSchool'  => $actualSchool,
			'otherSchools'	=> $otherSchools,
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
	 * Upload der Documents
	 */
	public function step5Action()
	{
		if (!$this->isUserValid()) {
			$this->redirect('step0', null, null, null, $this->settings['pageStep0']);
		}
		if(is_null($documents = $this->candidate->getDocuments())){
			/** @var  $documents \MUM\TilApplication\Domain\Model\Documents */
			$documents = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\Documents');
			$documents->setCandidate($this->candidate);
		}
		$params = array(
			'candidate'	=> $this->candidate,
			'documents' => $documents,
			'settings'	=> $this->settings,
		);
		$this->view->assignMultiple($params);

	}
	
	/**
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
	 * shows the costs of the whole family
	 */
	public function step6Action() {
		if(!$this->isUserValid()) {
			$this->redirect('step0', null, null, null, $this->settings['pageStep0'] );
		}
		$family = $this->candidate->getWholeFamily();
		if(empty($family)){
			$this->addFlashMessage('Sie müssen erst Schritt 3 bearbeiten. Legen Sie bitte die Familienmitglieder an.',
				'', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
			$this->redirect('step3', null, null, null, $this->settings['pageStep3']);
		}
		$actualSchool = $this->getActualSchool();
		$otherSchools = $this->candidate->getOtherSchools();
		$params = array(
			'candidate'	=> $this->candidate,
			'family'  => $family,
			'actualSchool'	=> $actualSchool,
			'otherSchools'	=> $otherSchools,
			'settings'	=> $this->settings,
			'ts'		=> $this->storagePid,
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


	public function initializegeneratePdfAction(){
		require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('til_application') . 'Classes/Contrib/Dompdf/autoload.inc.php');
		//require_once(t3lib_extMgm::extPath('dompdf') . 'Resources/Private/Contrib/Dompdf/dompdf_config.inc.php');
		$this->domPdf = new \Dompdf\Dompdf();
		$this->domPdf->set_paper("A4", "portrait"
		//$this->arguments['papersize'],
		//$this->arguments['orientation']
		);
		//$this->tempPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('sim_domtopdf') . 'Resources/Private/Tmp';
		$this->domPdf->set_base_path("http://".\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('HTTP_HOST'));
	}


	public function generatePdfAction(){
		$forceDownload = 1;

		if(isset($_GET["exportId"])) {
			$referer = HT_PROTO."".\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('HTTP_HOST')."/index.php?id=".$_GET["exportId"]."&pdf=true";
		} else {
			$referer = \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('HTTP_REFERER');
		}
		/** @var  $candidate Candidate */
		$candidate = $this->candidateRepository->findByUid($this->request->getArgument('candidate'));

		$filename = 'bewerbung-fuer-talent-im-land_'.$candidate->getUid() . '.pdf';

/*		$curl = curl_init();
		//$url = 'http://php.net/manual/en/curl.examples-basic.php';
		//echo 'Referer: ' . $referer .'<br />';
		//exit();
		$user = 'muhittin';
		$password = 'bayern-2015';
		curl_setopt($curl, CURLOPT_URL, $referer);
		curl_setopt($curl, CURLOPT_VERBOSE, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		//curl_setopt($curl, CURLOPT_USERPWD, "\"" . $user . ":" . $password . "\"");
		//curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
		$resp = curl_exec($curl);
		curl_close($curl);
*/
		$html = $this->generateHtmlForPdf();

		$css = GeneralUtility::getFileAbsFileName('EXT:til_application/Resources/Public/Css/pdf.css', false, false);
		$cssData = file_get_contents($css);
		//$cssData = '';
		//print 'css : ' . PATH_site;
		//exit;
		$html = <<<PDFGENERATE
			<html><head>
			<style type="text/css">
				input{border:none;}
				label{width: 200px;}
			</style>
			</head><body> $html</body></html>
PDFGENERATE;
		file_put_contents('/kunden/414277_97359/webseiten/mum-webdesign/til/htdocs/fileadmin/pdf_out.html', $html);

		$this->domPdf->loadHtml($html);
		$this->domPdf->setBasePath(PATH_site);
		$this->domPdf->render();

		header("Content-Type: application/pdf");

		$this->domPdf->stream(
			$filename,
			array(
				'Attachment' => $forceDownload
			)
		);
		//$this->redirect('show', 'Vacancies', 'Stellenangebote', ['jobId' => $jobId]);
		die();
		//$this->domPdf->output(array());
		//$this->view->assign('content', $resp);


	}

	/**
	 * create HTML to produce a PDF document
	 */
	protected function generateHtmlForPdf(){
		$renderer = $this->getPlainRenderer('Pdf', 'html');
		$family = $this->candidate->getWholeFamily();
		$actualSchool = $this->getActualSchool();
		$otherSchools = $this->candidate->getOtherSchools();
		$params = array(
			'candidate'	=> $this->candidate,
			'family'  => $family,
			'actualSchool'	=> $actualSchool,
			'otherSchools'	=> $otherSchools,
			'settings'	=> $this->settings,
			'ts'		=> $this->storagePid,
		);
		$renderer->assignMultiple( $params);

		$html = $renderer->render();

		return $html;
	}

	/**
	 * This creates another stand-alone instance of the Fluid view to render a template
	 * @param string $templateName the name of the template to use
	 * @param string $format the format of the fluid template "html" or "txt"
	 * @return \TYPO3\CMS\Fluid\View\StandaloneView the Fluid instance
	 */
	protected function getPlainRenderer($templateName = 'default', $format = 'html') {
		$view = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$view->setFormat($format);

		$templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:til_application/Resources/Private/Templates/');

		$templatePathAndFilename = $templateRootPath . 'OnlineFormula/' . $templateName . '.' . $format;

		$view->setTemplatePathAndFilename($templatePathAndFilename);
		$layoutRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:til_application/Resources/Private/Layouts/');
		$view->setLayoutRootPath($layoutRootPath);
		$partialsRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName('EXT:til_application/Resources/Private/Partials/');
		$view->setPartialRootPath($partialsRootPath);

		return $view;
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

			$this->arguments['actualSchool']
				->getPropertyMappingConfiguration()
				->allowAllProperties();
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
		/*	print '<pre>';
			print_r($actualSchool);
			print '</pre>';
			exit;
		*/
			$actualSchool->setCandidate($candidate);
			$this->schoolRepository->add($actualSchool);
			$candidate->setActualSchool($actualSchool);

			//Weitere Schulen schoolCareer
		/*	print '<pre>';
			print_r($_REQUEST['tx_tilapplication_form']['otherSchool']);
			print '</pre>';
			exit;
		*/
			$otherSchools = $_REQUEST['tx_tilapplication_form']['otherSchool'];
			$this->createAndAddSchool($candidate, $otherSchools);

			$this->candidateRepository->update($candidate);
			$this->addFlashMessage('Ihre Daten wurden gespeichert.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
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
			if(is_a($candidate, 'TYPO3\CMS\Extbase\Validation\Error')){
				$this->addFlashMessage('Sie müssen den Geburtstag im Format dd.mm.YYYY eingeben. Andere Formate werden nicht unterstützt.',
					'', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
				$this->redirect('step3' , null, null, null, $this->settings['pageStep3']);
			}
			$nextStep = 'step4';
		}
		if(isset($family['grossSalary']) || isset($family['netSalary'])){
			$candidate = $this->setIncomeForFamily($candidate, $family);
			$candidate = $this->setAssetForFamily($candidate, $family);
			$candidate = $this->setCostsForFamily($candidate, $family);
			$nextStep = 'step5';
		}

		if($this->isUserValid()) {
			$this->candidateRepository->update($candidate);
			$this->addFlashMessage('Ihre Daten wurden gespeichert.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::OK);
			$this->redirect($nextStep);
		}else{
			$this->redirect('step0', null, null, null, $this->settings['pageStep0'] );
		}

	}


	/**
	 *  wichtig um das Mapping hinzubekommen von String nach Array
	 */
	public function initializeUpdateStep5Action() {
		DebuggerUtility::var_dump($_REQUEST, 'Request');
		DebuggerUtility::var_dump($_FILES, 'Files');

		if ($this->arguments->hasArgument('documents')) {
			$propertyMappingConfig = $this->arguments->getArgument('documents')->getPropertyMappingConfiguration();
			$propertyMappingConfig->setTargetTypeForSubProperty('lifeSchoolCareer', 'array');
			$propertyMappingConfig->setTargetTypeForSubProperty('curriculumVitae', 'array');
			$propertyMappingConfig->setTargetTypeForSubProperty('survey', 'array');
			$propertyMappingConfig->setTargetTypeForSubProperty('certificate1', 'array');
			$propertyMappingConfig->setTargetTypeForSubProperty('certificate2', 'array');
			$propertyMappingConfig->setTargetTypeForSubProperty('certificate3', 'array');
			$propertyMappingConfig->setTargetTypeForSubProperty('passportPhoto', 'array');
			$propertyMappingConfig->setTargetTypeForSubProperty('identityCard', 'array');
			$propertyMappingConfig->setTargetTypeForSubProperty('residencePermit', 'array');
		}
	}

	/**
	 *
	 * @param \MUM\TilApplication\Domain\Model\Documents $documents
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
	 */
	public function updateStep5Action(\MUM\TilApplication\Domain\Model\Documents $documents	){
		DebuggerUtility::var_dump($documents, 'UpdateStep5');
		$old = $_REQUEST['tx_tilapplication_form']['old'];

		//DebuggerUtility::var_dump($_REQUEST['tx_tilapplication_form']['old'], 'Request data');

		$documents = $this->doUpload( $documents, $old);
		$this->candidate->setDocuments($documents);
		/** @var  $documentsRepository \MUM\TilApplication\Domain\Repository\DocumentsRepository */
		$documentsRepository = $this->objectManager->get('MUM\\TilApplication\\Domain\\Repository\\DocumentsRepository');
		if($documents->_isNew()){
			$documentsRepository->add($documents);
		}else{
			$documentsRepository->update($documents);
		}

		$this->candidateRepository->update($this->candidate);
		$this->flashMessageContainer->add('Die Dokumente wurden hochgeladen');
		if($this->isUserValid()) {
			$this->redirect('step6');
		}else{
			$this->redirect('step0', null, null, null, $this->settings['pageStep0'] );
		}
	/*
		$params = array(
			'candidate'	=> $this->candidate,
		);
		$this->view->assignMultiple($params);
	*/
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

		/** @var  $dateTimeConverter \TYPO3\CMS\Extbase\Property\TypeConverter\DateTimeConverter */
		$dateTimeConverter = GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Property\\TypeConverter\\DateTimeConverter');
		foreach ($family['firstName'] as $key => $firstName) {
			if (!empty($firstName) ||  ($family['remove'][$key] == 1) ) {
				if(isset($family['uid'][$key])){
					$member = $relativeRepository->findByUid($family['uid'][$key]);
					if(!is_object($member)){
						/** @var  $member \MUM\TilApplication\Domain\Model\Relative */
						$member = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\Relative');
					}
				}else {
					/** @var  $member \MUM\TilApplication\Domain\Model\Relative */
					$member = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\Relative');
				}
				$member->setFirstName($firstName);
				$member->setLastName($family['lastName'][$key]);

				try {
					$birthdate = ($dateTimeConverter->convertFrom(array( 'date' => $family['birthdate'][$key],
																	'dateFormat' => 'd.m.Y'),
																	'DateTime'));

					if(is_a($birthdate, 'DateTime') || is_null($birthdate)) {
						$member->setBirthdate($birthdate);
					}else{
						return $birthdate;
						print "<pre> : Error in adding Birthdate to relative, try it again with other date format like dd.mm.yyyy";
						print_r($birthdate);
						print '</pre>';
						exit;

					}
				} catch (\TYPO3\CMS\Extbase\Error\Error $e) {
					print '<pre>' . $e->getMessage() . '</pre>';
					exit;
				}

				$member->setNationality($family['nationality'][$key]);
				$member->setEducationalQualification($family['educationalQualification'][$key]);
				$member->setJob($family['job'][$key]);
				$member->setFamilyRelation($family['familyRelation'][$key]);

				if ($family['remove'][$key] == 1) {
					$candidate->removeFamily($member);
					$relativeRepository->remove($member);
				}elseif($member->_isNew()) {
					$relativeRepository->add($member);
					$candidate->addFamily($member);
				}else{
					$relativeRepository->update($member);
				}

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
		/** @var  $relativeRepository \MUM\TilApplication\Domain\Repository\RelativeRepository */
		$relativeRepository = $this->objectManager->get('MUM\\TilApplication\\Domain\\Repository\\RelativeRepository');
		$incomeRepository = $this->objectManager->get('MUM\\TilApplication\\Domain\\Repository\\IncomeRepository');
		foreach ($family['grossSalary'] as $key => $grossSalary) {
			if (!empty($grossSalary)) {
				if(isset($family['uid'][$key])){
					$member = $relativeRepository->findByUid($family['uid'][$key]);
					$income = $member->getIncome();
					if(is_null($income)){
						/** @var  $member \MUM\TilApplication\Domain\Model\Income */
						$income = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\Income');
					}
				}else {
					/** @var  $member \MUM\TilApplication\Domain\Model\Relative */
					$member = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\Relative');
					/** @var  $member \MUM\TilApplication\Domain\Model\Income */
					$income = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\Income');
				}

				$income->setGrossSalary($grossSalary);
				$income->setNetSalary($family['netSalary'][$key]);
				$income->setSelfEmployedSalary($family['selfEmployedSalary'][$key]);

				$income->setWelfare($family['welfare'][$key]);
				$income->setUnemploymentBenefit($family['unemploymentBenefit'][$key]);
				$income->setHousingBenefit($family['housingBenefit'][$key]);
				$income->setPension($family['pension'][$key]);
				$income->setOtherIncomes($family['otherIncomes'][$key]);

				if($income->_isNew()) {
					$incomeRepository->add($income);
				}else{
					$incomeRepository->update($income);
				}
				$member->setIncome($income);
				$relativeRepository->update($member);
				$candidate->addFamily($member);
			}
		}
		return $candidate;
	}


	protected function setCostsForFamily( \MUM\TilApplication\Domain\Model\Candidate  $candidate, $family){
		/** @var  $relativeRepository \MUM\TilApplication\Domain\Repository\RelativeRepository */
		$relativeRepository = $this->objectManager->get('MUM\\TilApplication\\Domain\\Repository\\RelativeRepository');
		$costsRepository = $this->objectManager->get('MUM\\TilApplication\\Domain\\Repository\\CostsRepository');
		if(is_null($costs = $candidate->getCosts())){
			/** @var  $member \MUM\TilApplication\Domain\Model\Costs */
			$costs = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\Costs');
		}else{
//			print "<pre>Cost is set";
//			print_r($costs);
		}
		$costs->setLivingCosts($family['livingCosts']);
		$costs->setCreditCosts($family['creditCosts']);
		$costs->setOtherOutgoings($family['otherOutgoings']);

		$costs->setTravelCosts($family['travelCosts']);
		$costs->setFurtherEducationCosts($family['furtherEducationCosts']);
		$costs->setPrivateCoachingCosts($family['privateCoachingCosts']);

		$costs->setRental($family['rental']);
		$costs->setLivingCostsSingle($family['livingCostsSingle']);
		$costs->setOtherCosts($family['otherCosts']);

		if($costs->_isNew()) {
			$costsRepository->add($costs);
			$candidate->setCosts($costs);
		}else{
			$costsRepository->update($costs);
		}

		return $candidate;
	}



	/**
	 * @param Candidate $candidate
	 * @param $family
	 *  das jeweilige Einkommen den Familienmitgliedern zuweisen
	 */
	protected function setAssetForFamily( \MUM\TilApplication\Domain\Model\Candidate  $candidate, $family){
		/** @var  $relativeRepository \MUM\TilApplication\Domain\Repository\RelativeRepository */
		//$relativeRepository = $this->objectManager->get('MUM\\TilApplication\\Domain\\Repository\\RelativeRepository');
		//$incomeRepository = $this->objectManager->get('MUM\\TilApplication\\Domain\\Repository\\IncomeRepository');
		$candidate->setAssetRealEstate($family['assetRealEstate']);
		$candidate->setAssetSavings($family['assetSavings']);
		$candidate->setAssetMiscEstate($family['assetMiscEstate']);

		return $candidate;
	}


	/**
	 * @return School|null
	 */
	protected function getActualSchool()
	{
		if ($this->candidate->hasActualSchool()) {
			$actualSchool = $this->candidate->getActualSchool();
			return $actualSchool;
		} else {
			$actualSchool = NULL;
			return $actualSchool;
		}
	}

	/**
	 * @param Candidate $candidate
	 * @param $otherSchools
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
	 * create, update and remove a school from schoolCareer
	 */
	protected function createAndAddSchool(\MUM\TilApplication\Domain\Model\Candidate &$candidate, $otherSchools)
	{
	/*	print '<pre>';
		print_r($otherSchools);
		print '</pre>';
		exit;
	*/
		foreach ($otherSchools['name'] as $key => $name ) {
			if (strlen($name) > 0 || ($otherSchools['remove'][$key] == 1) ) {
				if (isset($otherSchools['uid'][$key])) {
					$tmpSchool = $this->schoolRepository->findByUid($otherSchools['uid'][$key]);
				} else {
					/** @var  $tmpSchool \MUM\TilApplication\Domain\Model\School */
					$tmpSchool = GeneralUtility::makeInstance('MUM\\TilApplication\\Domain\\Model\\School');
				}
				$tmpSchool->setName($otherSchools['name'][$key]);
				$tmpSchool->setActual(false);
				if (strlen($otherSchools['visitFrom'][$key]) > 0) {
					$tmpSchool->setVisitFrom($otherSchools['visitFrom'][$key]);
				}
				if (strlen($otherSchools['visitTil'][$key]) > 0) {
					$tmpSchool->setVisitTil($otherSchools['visitTil'][$key]);
				}
				$tmpSchool->setCandidate($candidate);
				if ($otherSchools['remove'][$key] == 1) {
					$candidate->removeSchoolCareer($tmpSchool);
					$this->schoolRepository->remove($tmpSchool);
				} elseif ($tmpSchool->_isNew()) {
					$this->schoolRepository->add($tmpSchool);
					$candidate->addSchoolCareer($tmpSchool);
				} else {
					$this->schoolRepository->update($tmpSchool);
				}

			}
		}
	}

	/**
	 * @param \MUM\TilApplication\Domain\Model\Documents $documents
	 * @param \array  $oldData
	 * @return \MUM\TilApplication\Domain\Model\Documents
	 */
	protected function doUpload(\MUM\TilApplication\Domain\Model\Documents $documents, $oldData)
	{
		$prefix = str_pad($documents->getCandidate()->getUid(), 3, '0', STR_PAD_LEFT);
		/** @var  $fileUploader FileUploader */
		$fileUploader = $this->objectManager->get('MUM\\TilApplication\\Utility\\FileUploader');

		$fileName = $fileUploader->uploadFile($documents->getLifeSchoolCareer(), 'life_school_career', $prefix);
		if($fileName !== FALSE){
			$documents->setLifeSchoolCareer($fileName);
		}elseif(strlen($oldData['lifeSchoolCareer']) > 0){
			$documents->setLifeSchoolCareer($oldData['lifeSchoolCareer']);
		}

		$fileName = $fileUploader->uploadFile($documents->getCurriculumVitae(), 'curriculum_vitae', $prefix);
		if($fileName !== FALSE){
			$documents->setCurriculumVitae($fileName);
		}elseif(strlen($oldData['curriculumVitae']) > 0){
			$documents->setCurriculumVitae($oldData['curriculumVitae']);
		}

		$fileName = $fileUploader->uploadFile($documents->getSurvey(), 'survey', $prefix);
		if($fileName !== FALSE){
			$documents->setSurvey($fileName);
		}elseif(strlen($oldData['survey']) > 0){
			$documents->setSurvey($oldData['survey']);
		}

		$fileName = $fileUploader->uploadFile($documents->getCertificate1(), 'certificate1', $prefix);
		if($fileName !== FALSE){
			$documents->setCertificate1($fileName);
		}elseif(strlen($oldData['certificate1']) > 0){
			$documents->setCertificate1($oldData['certificate1']);
		}

		$fileName = $fileUploader->uploadFile($documents->getCertificate2(), 'certificate2', $prefix);
		if($fileName !== FALSE){
			$documents->setCertificate2($fileName);
		}elseif(strlen($oldData['certificate3']) > 0){
			$documents->setCertificate1($oldData['certificate2']);
		}

		$fileName = $fileUploader->uploadFile($documents->getCertificate3(), 'certificate3', $prefix);
		if($fileName !== FALSE){
			$documents->setCertificate3($fileName);
		}elseif(strlen($oldData['certificate3']) > 0){
			$documents->setCertificate1($oldData['certificate3']);
		}

		$fileName = $fileUploader->uploadFile($documents->getPassportPhoto(), 'passport_photo', $prefix);
		if($fileName !== FALSE){
			$documents->setPassportPhoto($fileName);
		}elseif(strlen($oldData['passportPhoto']) > 0){
			$documents->setCertificate1($oldData['passportPhoto']);
		}

		$fileName = $fileUploader->uploadFile($documents->getIdentityCard(), 'identity_card', $prefix);
		if($fileName !== FALSE){
			$documents->setIdentityCard($fileName);
		}elseif(strlen($oldData['identityCard']) > 0){
			$documents->setCertificate1($oldData['identityCard']);
		}

		$fileName = $fileUploader->uploadFile($documents->getResidencePermit(), 'residence_permit', $prefix);
		if($fileName !== FALSE){
			$documents->setResidencePermit($fileName);
		}elseif(strlen($oldData['residencePermit']) > 0){
			$documents->setCertificate1($oldData['residencePermit']);
		}

		return $documents;
	}

	/**
	 * @param $html
	 * @return mixed
	 */
	protected function removeTagsForPdf($html)
	{
		//header
		$pos1 = strpos($html, '<header class');
		$pos2 = strpos($html, '</header>');
		$header = substr($html, $pos1, (($pos2 + 9) - $pos1));
		$html = str_replace($header, '', $html);

		//img in header
		$pos1 = strpos($html, '<img src');
		$pos2 = strpos($html, '>', $pos1);
		$header = substr($html, $pos1, (($pos2 + 1) - $pos1));
		$html = str_replace($header, '', $html);
		//img in vita of job agent
		$pos1 = strpos($html, '<img', $pos2);
		$pos2 = strpos($html, '>', $pos1);
		$header = substr($html, $pos1, (($pos2 + 1) - $pos1));
		$html = str_replace($header, '', $html);

		//footer
		$pos1 = strpos($html, '<footer>');
		$pos2 = strpos($html, '</footer>');
		$header = substr($html, $pos1, (($pos2 + 9) - $pos1));
		$html = str_replace($header, '', $html);

		//aside Tag
		$pos1 = strpos($html, '<aside ');
		$pos2 = strpos($html, '</aside>');
		$header = substr($html, $pos1, (($pos2 + 8) - $pos1));
		$html = str_replace($header, '', $html);

		//footer nav for job offers
		$pos1 = strpos($html, '<section class="footer');
		$pos2 = strpos($html, '</section>', $pos1);
		$header = substr($html, $pos1, (($pos2 + 10) - $pos1));
		$html = str_replace($header, '', $html);

		return $html;
	}
}