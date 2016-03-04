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
 * Test case for class \MUM\TilApplication\Domain\Model\Relative.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Manfred Ursprung <manfred@manfred-ursprung.de>
 */
class RelativeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MUM\TilApplication\Domain\Model\Relative
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \MUM\TilApplication\Domain\Model\Relative();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getFirstNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFirstName()
		);
	}

	/**
	 * @test
	 */
	public function setFirstNameForStringSetsFirstName() {
		$this->subject->setFirstName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastNameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLastName()
		);
	}

	/**
	 * @test
	 */
	public function setLastNameForStringSetsLastName() {
		$this->subject->setLastName('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastName',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getBirthdateReturnsInitialValueForDateTime() {
		$this->assertEquals(
			NULL,
			$this->subject->getBirthdate()
		);
	}

	/**
	 * @test
	 */
	public function setBirthdateForDateTimeSetsBirthdate() {
		$dateTimeFixture = new \DateTime();
		$this->subject->setBirthdate($dateTimeFixture);

		$this->assertAttributeEquals(
			$dateTimeFixture,
			'birthdate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNationalityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getNationality()
		);
	}

	/**
	 * @test
	 */
	public function setNationalityForStringSetsNationality() {
		$this->subject->setNationality('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'nationality',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEducationalQualificationReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEducationalQualification()
		);
	}

	/**
	 * @test
	 */
	public function setEducationalQualificationForStringSetsEducationalQualification() {
		$this->subject->setEducationalQualification('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'educationalQualification',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getJobReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getJob()
		);
	}

	/**
	 * @test
	 */
	public function setJobForStringSetsJob() {
		$this->subject->setJob('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'job',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFamilyRelationReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setFamilyRelationForIntSetsFamilyRelation() {	}

	/**
	 * @test
	 */
	public function getIncomeReturnsInitialValueForIncome() {
		$this->assertEquals(
			NULL,
			$this->subject->getIncome()
		);
	}

	/**
	 * @test
	 */
	public function setIncomeForIncomeSetsIncome() {
		$incomeFixture = new \MUM\TilApplication\Domain\Model\Income();
		$this->subject->setIncome($incomeFixture);

		$this->assertAttributeEquals(
			$incomeFixture,
			'income',
			$this->subject
		);
	}
}
