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

	public function _downloadAction(){
		$fileDir = PATH_site . 'fileadmin/tx_tilapplication/';
		$zip = new \MUM\TilApplication\Utility\Zip();
		@$handle = opendir($fileDir);
		$filePerms = \MUM\TilApplication\Utility\Zip::S_IRWXU ; //| \MUM\TilApplication\Utility\Zip::S_IRWXG | \MUM\TilApplication\Utility\Zip::S_IRWXO;
		if ($handle) {
			/* This is the correct way to loop over the directory. */
			while (false !== ($file = readdir($handle))) {
				if (strpos($file, ".pdf") !== false) {
					$pathData = pathinfo($fileDir . $file);
					$fileName = $pathData['filename'];

					$zip->addFile(file_get_contents($fileDir . $file), $file, filectime($fileDir . $file), NULL, TRUE, $filePerms);
				}
			}
			$zip->sendZip("AlleDokumente.zip", "application/zip", "AlleDokumente.zip");
		}
	}


	public function downloadAction(){
		$fileDir = PATH_site . 'fileadmin/tx_tilapplication/';
		$zip = new \ZipArchive();
		@$handle = opendir($fileDir);
		$filePerms = \MUM\TilApplication\Utility\Zip::S_IRWXU ; //| \MUM\TilApplication\Utility\Zip::S_IRWXG | \MUM\TilApplication\Utility\Zip::S_IRWXO;
		if ($handle && $zip->open($fileDir . 'test.zip') )  {
			/* This is the correct way to loop over the directory. */
			while (false !== ($file = readdir($handle))) {
				if (strpos($file, ".pdf") !== false) {
					$pathData = pathinfo($fileDir . $file);
					$fileName = $pathData['filename'];
					$zip->addFile($fileDir . $file, $file);
					//$zip->addFile(file_get_contents($fileDir . $file), $file, filectime($fileDir . $file), NULL, TRUE, $filePerms);
				}
			}
			$zip->close();
			$filestat = fstat($fileDir . 'test.zip');
			$fileSize = $filestat['size'];
			$this->sendZip("AlleDokumente.zip", "application/zip", $fileSize , "AlleDokumente.zip");
		}
	}

	function sendZip($fileName = null, $contentType = "application/zip", $filesize, $utf8FileName = null, $inline = false) {

		$headerFile = null;
		$headerLine = null;
		if(headers_sent($headerFile, $headerLine)) {
			throw new Exception("Unable to send file '$fileName'. Headers have already been sent from '$headerFile' in line $headerLine");
		}
		if(ob_get_contents() !== false && strlen(ob_get_contents())) {
			throw new Exception("Unable to send file '$fileName'. Output buffer contains the following text (typically warnings or errors):\n" . ob_get_contents());
		}
		if(@ini_get('zlib.output_compression')) {
			@ini_set('zlib.output_compression', 'Off');
		}
		header("Pragma: public");
		header("Last-Modified: " . @gmdate("D, d M Y H:i:s T"));
		header("Expires: 0");
		header("Accept-Ranges: bytes");
		header("Connection: close");
		header("Content-Type: " . $contentType);
		$cd = "Content-Disposition: ";
		if ($inline) {
			$cd .= "inline";
		} else {
			$cd .= "attached";
		}
		if ($fileName) {
			$cd .= '; filename="' . $fileName . '"';
		}
		if ($utf8FileName) {
			$cd .= "; filename*=UTF-8''" . rawurlencode($utf8FileName);
		}
		header($cd);

		header("Content-Length: ". $filesize);
		if (!is_resource($this->zipFile)) {
			echo $this->zipData;
		} else {
			rewind($this->zipFile);
			while (!feof($this->zipFile)) {
				echo fread($this->zipFile, $this->streamChunkSize);
			}
		}
		return true;
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