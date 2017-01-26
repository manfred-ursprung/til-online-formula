<?php
namespace MUM\TilAlumni\Controller;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

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
 * Counseilling Controller
 */
class CounseillingController extends AlumniBaseController
{

    /**
     * action list
     *
     * @return void
     */
    public function listAction() {

        $alumnis    = $this->alumniRepository->findAllStudentCounseilling();
        $domiciles  = $this->alumniRepository->getAllDomiciles();
        $zips       = $this->alumniRepository->getAllZips();
        $universities = $this->alumniRepository->getAllUniversitys();
        $courses     = $this->alumniRepository->getAllCourses();
        //DebuggerUtility::var_dump($GLOBALS['TSFE']->fe_user);
        //DebuggerUtility::var_dump($GLOBALS['TSFE']->loginUser);
        $this->view->assignMultiple(
            array(
                'alumnis'   => $alumnis,
                'domiciles' => $domiciles,
                'zips'      => $zips,
                'universities' => $universities,
                'courses'   => $courses,
                'plugin'    => 'studentCounseilling',
                'typeNum'    => '14546',
                'public'    => !$this->activeSession,
            )
        );
  
    }

}