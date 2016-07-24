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

/**
 * CandidateController
 */
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

class CandidateController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * candidateRepository
	 *
	 * @var \MUM\TilApplication\Domain\Repository\CandidateRepository
	 * @inject
	 */
	protected $candidateRepository = NULL;


	/**
	 * action show
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $candidate
	 * @return void
	 */
	public function listAction() {
		//$candidates = $this->candidateRepository->findAll();
		$candidates = $this->candidateRepository->findAllApproved();
		//DebuggerUtility::var_dump($candidates, 'Step0');
		//$family = $this->candidate->getWholeFamily(true);
		$this->view->assign('candidates', $candidates);
		//$this->view->assign('detailPage', $this->settings['detailPage']);

	}

	/**
	 * action show
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $candidate
	 * @return void
	 */
	public function showAction(\MUM\TilApplication\Domain\Model\Candidate $candidate) {
		$family = $candidate->getWholeFamily();
		$actualSchool = $this->getActualSchool($candidate);
		$otherSchools = $candidate->getOtherSchools();
		$params = array(
			'candidate'	=> $candidate,
			'family'  => $family,
			'actualSchool'	=> $actualSchool,
			'otherSchools'	=> $otherSchools,
			'settings'	=> $this->settings,
			'ts'		=> $this->storagePid,
		);
		$this->view->assignMultiple( $params);

	}
	
	public function excelAction(){
		/** @var  $export \MUM\TilApplication\Utility\ExportCvs */
		$export = $this->objectManager->get('MUM\TilApplication\Utility\ExportCvs');
		$result = $export->export();
		//DebuggerUtility::var_dump($result, "Export Daten");
		//exit;
		$debug = false;
		if($debug) {
			$this->view->assign('result', $result);
			$this->view->assign('fieldIndex', $export->getFieldIndex());
		}else {
			$csvFilename = 'Auswertung-' .date('Ymd_hi') . '.csv';
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=' .$csvFilename);
			$export->writeCsv();
			die();
		}
	}



	/**
	 * @throws Exception
	 * packen und download über ZipArchive - Standardklasse PHP
	 */
	public function downloadAction(){
		$fileDir = PATH_site . 'fileadmin/tx_tilapplication/';
		//DebuggerUtility::var_dump($this->request->getArgument('file'), "Argumente");
		//exit;

		$zipFileName = $fileDir . 'AlleDokumente.zip';
		$zipFileName = $fileDir . $this->request->getArgument('file');
		/*
		$zip = new \ZipArchive();
		@$handle = opendir($fileDir);

		if ($handle && $zip->open($zipFileName, \ZipArchive::CREATE) )  {
			// This is the correct way to loop over the directory.
			while (false !== ($file = readdir($handle))) {
				$extension = pathinfo($file, PATHINFO_EXTENSION);
				if (in_array(strtolower($extension), array('pdf', 'jpg', 'png', 'jpeg' ))) {
					$pathData = pathinfo($fileDir . $file);
					$fileName = $pathData['filename'];
					$zip->addFile($fileDir . $file, $file);
				}
			}
			$zip->close();
		*/
			// send $filename to browser
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			$mimeType = finfo_file($finfo, $zipFileName);
			$name = basename($zipFileName);

			if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
				// cache settings for IE6 on HTTPS
				header('Cache-Control: max-age=120');
				header('Pragma: public');
			} else {
				header('Cache-Control: private, max-age=120, must-revalidate');
				header("Pragma: no-cache");
			}
			header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // long ago
			header("Content-Type: $mimeType");
			header('Content-Disposition: attachment; filename="' . $name . '";');
			header("Accept-Ranges: bytes");
			header('Content-Length: ' . filesize($zipFileName));

			print readfile($zipFileName);
			exit;
		//}
	}



	/**
	 * action new
	 *
	 * @return void
	 */
	public function newAction() {
		
	}

	/**
	 * action create
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $newCandidate
	 * @return void
	 */
	public function createAction(\MUM\TilApplication\Domain\Model\Candidate $newCandidate) {
		$this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->candidateRepository->add($newCandidate);
		$this->redirect('list');
	}

	/**
	 * action edit
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $candidate
	 * @ignorevalidation $candidate
	 * @return void
	 */
	public function editAction(\MUM\TilApplication\Domain\Model\Candidate $candidate) {
		$this->view->assign('candidate', $candidate);
	}

	/**
	 * action update
	 *
	 * @param \MUM\TilApplication\Domain\Model\Candidate $candidate
	 * @return void
	 */
	public function updateAction(\MUM\TilApplication\Domain\Model\Candidate $candidate) {
		$this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->candidateRepository->update($candidate);
		$this->redirect('list');
	}


	/**
	 * @param \MUM\TilApplication\Domain\Model\Candidate $candidate
	 * @return \MUM\TilApplication\Domain\Model\School | null
	 */
	protected function getActualSchool(\MUM\TilApplication\Domain\Model\Candidate $candidate)
	{
		$actualSchool = NULL;
		if ($candidate->hasActualSchool()) {
			$actualSchool = $candidate->getActualSchool();
		}
		return $actualSchool;

	}

}