<?php
namespace MUM\TilApplication\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Manfred Ursprung <manfred@manfred-ursprung.de>, Webapplication Ursprung
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
 * Test case for class MUM\TilApplication\Controller\CandidateController.
 *
 * @author Manfred Ursprung <manfred@manfred-ursprung.de>
 */
class CandidateControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \MUM\TilApplication\Controller\CandidateController
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = $this->getMock('MUM\\TilApplication\\Controller\\CandidateController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenCandidateToView() {
		$candidate = new \MUM\TilApplication\Domain\Model\Candidate();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('candidate', $candidate);

		$this->subject->showAction($candidate);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenCandidateToView() {
		$candidate = new \MUM\TilApplication\Domain\Model\Candidate();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newCandidate', $candidate);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($candidate);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenCandidateToCandidateRepository() {
		$candidate = new \MUM\TilApplication\Domain\Model\Candidate();

		$candidateRepository = $this->getMock('MUM\\TilApplication\\Domain\\Repository\\CandidateRepository', array('add'), array(), '', FALSE);
		$candidateRepository->expects($this->once())->method('add')->with($candidate);
		$this->inject($this->subject, 'candidateRepository', $candidateRepository);

		$this->subject->createAction($candidate);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenCandidateToView() {
		$candidate = new \MUM\TilApplication\Domain\Model\Candidate();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('candidate', $candidate);

		$this->subject->editAction($candidate);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenCandidateInCandidateRepository() {
		$candidate = new \MUM\TilApplication\Domain\Model\Candidate();

		$candidateRepository = $this->getMock('MUM\\TilApplication\\Domain\\Repository\\CandidateRepository', array('update'), array(), '', FALSE);
		$candidateRepository->expects($this->once())->method('update')->with($candidate);
		$this->inject($this->subject, 'candidateRepository', $candidateRepository);

		$this->subject->updateAction($candidate);
	}
}
