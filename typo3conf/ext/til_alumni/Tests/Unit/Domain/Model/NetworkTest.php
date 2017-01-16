<?php

namespace MUM\TilAlumni\Tests\Unit\Domain\Model;

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
 * Test case for class \MUM\TilAlumni\Domain\Model\Network.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Manfred Ursprung <manfred@manfred-ursprung.de>
 */
class NetworkTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MUM\TilAlumni\Domain\Model\Network
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \MUM\TilAlumni\Domain\Model\Network();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getLanguageSkillsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLanguageSkills()
		);
	}

	/**
	 * @test
	 */
	public function setLanguageSkillsForStringSetsLanguageSkills() {
		$this->subject->setLanguageSkills('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'languageSkills',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSchoolCareerReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSchoolCareer()
		);
	}

	/**
	 * @test
	 */
	public function setSchoolCareerForStringSetsSchoolCareer() {
		$this->subject->setSchoolCareer('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'schoolCareer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPersonalExperiencesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPersonalExperiences()
		);
	}

	/**
	 * @test
	 */
	public function setPersonalExperiencesForStringSetsPersonalExperiences() {
		$this->subject->setPersonalExperiences('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'personalExperiences',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAdviceTopicsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAdviceTopics()
		);
	}

	/**
	 * @test
	 */
	public function setAdviceTopicsForStringSetsAdviceTopics() {
		$this->subject->setAdviceTopics('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'adviceTopics',
			$this->subject
		);
	}
}
