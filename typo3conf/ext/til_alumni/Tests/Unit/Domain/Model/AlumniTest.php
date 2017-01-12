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
 * Test case for class \MUM\TilAlumni\Domain\Model\Alumni.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Manfred Ursprung <manfred@manfred-ursprung.de>
 */
class AlumniTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MUM\TilAlumni\Domain\Model\Alumni
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \MUM\TilAlumni\Domain\Model\Alumni();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getFirstnameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFirstname()
		);
	}

	/**
	 * @test
	 */
	public function setFirstnameForStringSetsFirstname() {
		$this->subject->setFirstname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'firstname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLastnameReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLastname()
		);
	}

	/**
	 * @test
	 */
	public function setLastnameForStringSetsLastname() {
		$this->subject->setLastname('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lastname',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGenderReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setGenderForIntSetsGender() {	}

	/**
	 * @test
	 */
	public function getBirthdayReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setBirthdayForIntSetsBirthday() {	}

	/**
	 * @test
	 */
	public function getCityOfBirthReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCityOfBirth()
		);
	}

	/**
	 * @test
	 */
	public function setCityOfBirthForStringSetsCityOfBirth() {
		$this->subject->setCityOfBirth('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'cityOfBirth',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCountryOfBirthReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCountryOfBirth()
		);
	}

	/**
	 * @test
	 */
	public function setCountryOfBirthForStringSetsCountryOfBirth() {
		$this->subject->setCountryOfBirth('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'countryOfBirth',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHobbysReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getHobbys()
		);
	}

	/**
	 * @test
	 */
	public function setHobbysForStringSetsHobbys() {
		$this->subject->setHobbys('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'hobbys',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLifeMottoReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLifeMotto()
		);
	}

	/**
	 * @test
	 */
	public function setLifeMottoForStringSetsLifeMotto() {
		$this->subject->setLifeMotto('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'lifeMotto',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStrreetReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getStrreet()
		);
	}

	/**
	 * @test
	 */
	public function setStrreetForStringSetsStrreet() {
		$this->subject->setStrreet('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'strreet',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getZipReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getZip()
		);
	}

	/**
	 * @test
	 */
	public function setZipForStringSetsZip() {
		$this->subject->setZip('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'zip',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCity()
		);
	}

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() {
		$this->subject->setCity('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'city',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getEmailReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getEmail()
		);
	}

	/**
	 * @test
	 */
	public function setEmailForStringSetsEmail() {
		$this->subject->setEmail('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'email',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getMobileReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getMobile()
		);
	}

	/**
	 * @test
	 */
	public function setMobileForStringSetsMobile() {
		$this->subject->setMobile('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'mobile',
			$this->subject
		);
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
	public function getScholarshipPeriodReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getScholarshipPeriod()
		);
	}

	/**
	 * @test
	 */
	public function setScholarshipPeriodForStringSetsScholarshipPeriod() {
		$this->subject->setScholarshipPeriod('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'scholarshipPeriod',
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
	public function getUniversityCourseReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getUniversityCourse()
		);
	}

	/**
	 * @test
	 */
	public function setUniversityCourseForStringSetsUniversityCourse() {
		$this->subject->setUniversityCourse('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'universityCourse',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getUniversityReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getUniversity()
		);
	}

	/**
	 * @test
	 */
	public function setUniversityForStringSetsUniversity() {
		$this->subject->setUniversity('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'university',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getGraduationReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getGraduation()
		);
	}

	/**
	 * @test
	 */
	public function setGraduationForStringSetsGraduation() {
		$this->subject->setGraduation('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'graduation',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getProfessionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getProfession()
		);
	}

	/**
	 * @test
	 */
	public function setProfessionForStringSetsProfession() {
		$this->subject->setProfession('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'profession',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStudentCounseillingReturnsInitialValueForStudentCounseilling() {
		$this->assertEquals(
			NULL,
			$this->subject->getStudentCounseilling()
		);
	}

	/**
	 * @test
	 */
	public function setStudentCounseillingForStudentCounseillingSetsStudentCounseilling() {
		$studentCounseillingFixture = new \MUM\TilAlumni\Domain\Model\StudentCounseilling();
		$this->subject->setStudentCounseilling($studentCounseillingFixture);

		$this->assertAttributeEquals(
			$studentCounseillingFixture,
			'studentCounseilling',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getNetworkReturnsInitialValueForNetwork() {
		$this->assertEquals(
			NULL,
			$this->subject->getNetwork()
		);
	}

	/**
	 * @test
	 */
	public function setNetworkForNetworkSetsNetwork() {
		$networkFixture = new \MUM\TilAlumni\Domain\Model\Network();
		$this->subject->setNetwork($networkFixture);

		$this->assertAttributeEquals(
			$networkFixture,
			'network',
			$this->subject
		);
	}
}
