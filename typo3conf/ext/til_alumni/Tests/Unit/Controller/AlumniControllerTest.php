<?php
namespace MUM\TilAlumni\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Manfred Ursprung <manfred@manfred-ursprung.de>, Webapplikationen Ursprung
 *  			
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class MUM\TilAlumni\Controller\AlumniController.
 *
 * @author Manfred Ursprung <manfred@manfred-ursprung.de>
 */
class AlumniControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \MUM\TilAlumni\Controller\AlumniController
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = $this->getMock('MUM\\TilAlumni\\Controller\\AlumniController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllAlumnisFromRepositoryAndAssignsThemToView() {

		$allAlumnis = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$alumniRepository = $this->getMock('MUM\\TilAlumni\\Domain\\Repository\\AlumniRepository', array('findAll'), array(), '', FALSE);
		$alumniRepository->expects($this->once())->method('findAll')->will($this->returnValue($allAlumnis));
		$this->inject($this->subject, 'alumniRepository', $alumniRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('alumnis', $allAlumnis);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenAlumniToView() {
		$alumni = new \MUM\TilAlumni\Domain\Model\Alumni();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('alumni', $alumni);

		$this->subject->showAction($alumni);
	}
}
