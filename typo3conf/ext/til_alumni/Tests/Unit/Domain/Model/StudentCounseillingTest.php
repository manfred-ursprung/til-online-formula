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
 * Test case for class \MUM\TilAlumni\Domain\Model\StudentCounseilling.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Manfred Ursprung <manfred@manfred-ursprung.de>
 */
class StudentCounseillingTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MUM\TilAlumni\Domain\Model\StudentCounseilling
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \MUM\TilAlumni\Domain\Model\StudentCounseilling();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getQualification1ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getQualification1()
		);
	}

	/**
	 * @test
	 */
	public function setQualification1ForStringSetsQualification1() {
		$this->subject->setQualification1('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'qualification1',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getQualification2ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getQualification2()
		);
	}

	/**
	 * @test
	 */
	public function setQualification2ForStringSetsQualification2() {
		$this->subject->setQualification2('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'qualification2',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getOpportunitiesAfterStudyReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getOpportunitiesAfterStudy()
		);
	}

	/**
	 * @test
	 */
	public function setOpportunitiesAfterStudyForStringSetsOpportunitiesAfterStudy() {
		$this->subject->setOpportunitiesAfterStudy('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'opportunitiesAfterStudy',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getUniversityInformationsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getUniversityInformations()
		);
	}

	/**
	 * @test
	 */
	public function setUniversityInformationsForStringSetsUniversityInformations() {
		$this->subject->setUniversityInformations('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'universityInformations',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLocalInformationsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLocalInformations()
		);
	}

	/**
	 * @test
	 */
	public function setLocalInformationsForStringSetsLocalInformations() {
		$this->subject->setLocalInformations('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'localInformations',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPriorUniversityExperiencesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPriorUniversityExperiences()
		);
	}

	/**
	 * @test
	 */
	public function setPriorUniversityExperiencesForStringSetsPriorUniversityExperiences() {
		$this->subject->setPriorUniversityExperiences('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'priorUniversityExperiences',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getActivitiesReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getActivities()
		);
	}

	/**
	 * @test
	 */
	public function setActivitiesForStringSetsActivities() {
		$this->subject->setActivities('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'activities',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getScholarshipsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getScholarships()
		);
	}

	/**
	 * @test
	 */
	public function setScholarshipsForStringSetsScholarships() {
		$this->subject->setScholarships('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'scholarships',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSemesterAbroadReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSemesterAbroad()
		);
	}

	/**
	 * @test
	 */
	public function setSemesterAbroadForStringSetsSemesterAbroad() {
		$this->subject->setSemesterAbroad('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'semesterAbroad',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStudySloganReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getStudySlogan()
		);
	}

	/**
	 * @test
	 */
	public function setStudySloganForStringSetsStudySlogan() {
		$this->subject->setStudySlogan('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'studySlogan',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTip1ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTip1()
		);
	}

	/**
	 * @test
	 */
	public function setTip1ForStringSetsTip1() {
		$this->subject->setTip1('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'tip1',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTip2ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTip2()
		);
	}

	/**
	 * @test
	 */
	public function setTip2ForStringSetsTip2() {
		$this->subject->setTip2('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'tip2',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTip3ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTip3()
		);
	}

	/**
	 * @test
	 */
	public function setTip3ForStringSetsTip3() {
		$this->subject->setTip3('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'tip3',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTip4ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTip4()
		);
	}

	/**
	 * @test
	 */
	public function setTip4ForStringSetsTip4() {
		$this->subject->setTip4('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'tip4',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTip5ReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTip5()
		);
	}

	/**
	 * @test
	 */
	public function setTip5ForStringSetsTip5() {
		$this->subject->setTip5('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'tip5',
			$this->subject
		);
	}
}
