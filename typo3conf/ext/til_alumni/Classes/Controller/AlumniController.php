<?php
namespace MUM\TilAlumni\Controller;

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
		$alumnis = $this->alumniRepository->findAll();
		$this->view->assign('alumnis', $alumnis);
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
	 *
	 * @return void
	 */
	public function searchAction() {
		
	}

}