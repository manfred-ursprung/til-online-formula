<?php

namespace MUM\TilApplication\Tests\Unit\Domain\Model;

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
 * Test case for class \MUM\TilApplication\Domain\Model\School.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Manfred Ursprung <manfred@manfred-ursprung.de>
 */
class SchoolTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MUM\TilApplication\Domain\Model\School
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \MUM\TilApplication\Domain\Model\School();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getName()
		);
	}

	/**
	 * @test
	 */
	public function setNameForStringSetsName() {
		$this->subject->setName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'name',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getTypeOfSchoolReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTypeOfSchool()
		);
	}

	/**
	 * @test
	 */
	public function setTypeOfSchoolForStringSetsTypeOfSchool() {
		$this->subject->setTypeOfSchool('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'typeOfSchool',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSchoolYearReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSchoolYear()
		);
	}

	/**
	 * @test
	 */
	public function setSchoolYearForStringSetsSchoolYear() {
		$this->subject->setSchoolYear('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'schoolYear',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getActualReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getActual()
		);
	}

	/**
	 * @test
	 */
	public function setActualForBoolSetsActual() {
		$this->subject->setActual(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'actual',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSchoolOrderReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setSchoolOrderForIntSetsSchoolOrder() {	}

	/**
	 * @test
	 */
	public function getVisitFromReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getVisitFrom()
		);
	}

	/**
	 * @test
	 */
	public function setVisitFromForStringSetsVisitFrom() {
		$this->subject->setVisitFrom('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'visitFrom',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getVisitTilReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getVisitTil()
		);
	}

	/**
	 * @test
	 */
	public function setVisitTilForStringSetsVisitTil() {
		$this->subject->setVisitTil('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'visitTil',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPlannedGraduationSelectReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setPlannedGraduationSelectForIntSetsPlannedGraduationSelect() {	}

	/**
	 * @test
	 */
	public function getPlannedGraduationTextReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPlannedGraduationText()
		);
	}

	/**
	 * @test
	 */
	public function setPlannedGraduationTextForStringSetsPlannedGraduationText() {
		$this->subject->setPlannedGraduationText('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'plannedGraduationText',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPlannedGraduationFinishReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPlannedGraduationFinish()
		);
	}

	/**
	 * @test
	 */
	public function setPlannedGraduationFinishForStringSetsPlannedGraduationFinish() {
		$this->subject->setPlannedGraduationFinish('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'plannedGraduationFinish',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSchoolCertificatePointsReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getSchoolCertificatePoints()
		);
	}

	/**
	 * @test
	 */
	public function setSchoolCertificatePointsForFloatSetsSchoolCertificatePoints() {
		$this->subject->setSchoolCertificatePoints(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'schoolCertificatePoints',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getSchoolCertificateDateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getSchoolCertificateDate()
		);
	}

	/**
	 * @test
	 */
	public function setSchoolCertificateDateForDateTimeSetsSchoolCertificateDate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setSchoolCertificateDate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'schoolCertificateDate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAddressReturnsInitialValueForAddress() {
		$this->assertEquals(
			NULL,
			$this->subject->getAddress()
		);
	}

	/**
	 * @test
	 */
	public function setAddressForAddressSetsAddress() {
		$addressFixture = new \MUM\TilApplication\Domain\Model\Address();
		$this->subject->setAddress($addressFixture);

		$this->assertAttributeEquals(
			$addressFixture,
			'address',
			$this->subject
		);
	}
}
