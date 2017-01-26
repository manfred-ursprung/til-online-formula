<?php
namespace MUM\TilAlumni\Controller;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;



/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Manfred Ursprung <manfred@manfred-ursprung.de>, Webapplikationen Ursprung
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
 * AlumniController
 */
class ImporterController extends AlumniBaseController {



	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {

	    $alumnis    = $this->alumniRepository->findAll();
        $domiciles  = $this->alumniRepository->getAllDomiciles();
        $zips       = $this->alumniRepository->getAllZips();
        $universities = $this->alumniRepository->getAllUniversitys();
        $courses     = $this->alumniRepository->getAllCourses();
        // @TODO public ermitteln
        $public = 1;
		$this->view->assignMultiple(
		    array(
		        'alumnis'   => $alumnis,
                'domiciles' => $domiciles,
                'zips'      => $zips,
                'universities' => $universities,
                'courses'   => $courses,
                'plugin'    => 'alumni',
                'typeNum'    => '14545',
                'public'    => $public
            )
        );
	}

	/**
	 * action show
	 * not used til now, it is a standard method
	 * @param \MUM\TilAlumni\Domain\Model\Alumni $alumni
	 * @return void
	 */
	public function importAction()
    {
        $pid = $this->objectManager->get(\TYPO3\CMS\Extbase\Configuration\BackendConfigurationManager::class)
            ->getDefaultBackendStoragePid();

        //DebuggerUtility::var_dump($pid, 'Settings');
        $alumni = $this->alumniRepository->findByUid(1);
        if(count($_FILES) > 0)
        {
            //DebuggerUtility::var_dump($_POST, 'Arguments');
            $mapArr = $this->getUploadeFileInfo($_FILES['tx_tilalumni_web_tilalumniimporter']);
            /** @var  $importer \MUM\TilAlumni\Service\Importer */
            $importer = $this->objectManager->get(\MUM\TilAlumni\Service\Importer::class);
            $importer->startImport($mapArr['tmpName']);
            //$fileContent = $this->doImport($mapArr);
            //DebuggerUtility::var_dump($_FILES, 'Files');
            $this->view->assign('success', $importer->getImportSummary());
        }

        //DebuggerUtility::var_dump($alumni, 'Alumni');
		$this->view->assign('alumni', $alumni);
		$this->view->assign('pid', $pid);
	}


	public function insertAction()
    {

    }

    public function deleteAction(\MUM\TilAlumni\Domain\Model\Alumni $alumni)
    {

    }

    /**
     * Debugs a SQL query from a QueryResult
     *
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult
     * @param boolean $explainOutput
     * @return void
     */
    public function debugQuery(\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult $queryResult, $explainOutput = FALSE){
        $GLOBALS['TYPO3_DB']->debugOutput = 2;
        if($explainOutput){
            $GLOBALS['TYPO3_DB']->explainOutput = true;
        }
        $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = true;
        $queryResult->toArray();
        //DebuggerUtility::var_dump($GLOBALS['TYPO3_DB']->debug_lastBuiltQuery);

        $GLOBALS['TYPO3_DB']->store_lastBuiltQuery = false;
        $GLOBALS['TYPO3_DB']->explainOutput = false;
        $GLOBALS['TYPO3_DB']->debugOutput = false;
    }

    /**
     * @param \array $tempArr
     * @return mixed
     */
    protected function getUploadeFileInfo($tmpArr)
    {
        $mapArr['name'] = $tmpArr['name']['alumni-import']['fileuploaded'];
        $mapArr['type'] = $tmpArr['type']['alumni-import']['fileuploaded'];
        $mapArr['tmpName'] = $tmpArr['tmp_name']['alumni-import']['fileuploaded'];
        $mapArr['error'] = $tmpArr['error']['alumni-import']['fileuploaded'];
        $mapArr['size'] = $tmpArr['size']['alumni-import']['fileuploaded'];
        return $mapArr;
    }


    protected function doImport($uploadedFile)
    {
        $fileContent = file_get_contents($uploadedFile['tmpName']);
        return $fileContent;
    }


}