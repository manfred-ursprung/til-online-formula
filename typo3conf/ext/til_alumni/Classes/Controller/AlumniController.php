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
class AlumniController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * alumniRepository
	 *
	 * @var \MUM\TilAlumni\Domain\Repository\AlumniRepository
	 * @inject
	 */
	protected $alumniRepository = NULL;

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
		$this->view->assignMultiple(
		    array(
		        'alumnis' => $alumnis,
                'domiciles' => $domiciles,
                'zips' => $zips,
                'universities' => $universities,
                'courses' => $courses,

            )
        );
	}

	/**
	 * action show
	 *
	 * @param \MUM\TilAlumni\Domain\Model\Alumni $alumni
	 * @return void
	 */
	public function showAction(\MUM\TilAlumni\Domain\Model\Alumni $alumni) {
		$this->view->assign('alumni', $alumni);
	}

	/**
	 * action search
	 * Respons after submitting search form
	 * @return void
	 */
	public function searchAction() {
        //DebuggerUtility::var_dump($this->request->getArguments());
        //exit;
        
        if($this->request->hasArgument('alumni-search')) {
            $formArgs = $this->request->getArgument('alumni-search');
            //DebuggerUtility::var_dump($formArgs);
            $data = $this->alumniRepository->findByFormArgs($formArgs);
            //return $this->debugQuery($data);

            $this->view->assignMultiple(array(
                'alumnis'  => $data,
                'settings' => $this->settings,
            ));
        }
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

}