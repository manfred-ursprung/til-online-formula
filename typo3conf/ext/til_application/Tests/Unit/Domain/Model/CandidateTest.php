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
 * Test case for class \MUM\TilApplication\Domain\Model\Candidate.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Manfred Ursprung <manfred@manfred-ursprung.de>
 */
class CandidateTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MUM\TilApplication\Domain\Model\Candidate
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \MUM\TilApplication\Domain\Model\Candidate();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getFamilyStatusReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setFamilyStatusForIntSetsFamilyStatus() {	}

	/**
	 * @test
	 */
	public function getMigrationBackgroundReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getMigrationBackground()
		);
	}

	/**
	 * @test
	 */
	public function setMigrationBackgroundForBoolSetsMigrationBackground() {
		$this->subject->setMigrationBackground(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'migrationBackground',
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
	public function getResidentSinceReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getResidentSince()
		);
	}

	/**
	 * @test
	 */
	public function setResidentSinceForStringSetsResidentSince() {
		$this->subject->setResidentSince('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'residentSince',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getResidenceStatusReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setResidenceStatusForIntSetsResidenceStatus() {	}

	/**
	 * @test
	 */
	public function getResidenceMiscReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getResidenceMisc()
		);
	}

	/**
	 * @test
	 */
	public function setResidenceMiscForStringSetsResidenceMisc() {
		$this->subject->setResidenceMisc('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'residenceMisc',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFamilyAddonReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getFamilyAddon()
		);
	}

	/**
	 * @test
	 */
	public function setFamilyAddonForStringSetsFamilyAddon() {
		$this->subject->setFamilyAddon('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'familyAddon',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAssetRealEstateReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAssetRealEstate()
		);
	}

	/**
	 * @test
	 */
	public function setAssetRealEstateForStringSetsAssetRealEstate() {
		$this->subject->setAssetRealEstate('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'assetRealEstate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAssetSavingsReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAssetSavings()
		);
	}

	/**
	 * @test
	 */
	public function setAssetSavingsForStringSetsAssetSavings() {
		$this->subject->setAssetSavings('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'assetSavings',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAssetMiscEstateReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getAssetMiscEstate()
		);
	}

	/**
	 * @test
	 */
	public function setAssetMiscEstateForStringSetsAssetMiscEstate() {
		$this->subject->setAssetMiscEstate('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'assetMiscEstate',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIntegrityReturnsInitialValueForBool() {
		$this->assertSame(
			FALSE,
			$this->subject->getIntegrity()
		);
	}

	/**
	 * @test
	 */
	public function setIntegrityForBoolSetsIntegrity() {
		$this->subject->setIntegrity(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'integrity',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFeUserReturnsInitialValueFor() {	}

	/**
	 * @test
	 */
	public function setFeUserForSetsFeUser() {	}

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

	/**
	 * @test
	 */
	public function getSchoolCareerReturnsInitialValueForSchool() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getSchoolCareer()
		);
	}

	/**
	 * @test
	 */
	public function setSchoolCareerForObjectStorageContainingSchoolSetsSchoolCareer() {
		$schoolCareer = new \MUM\TilApplication\Domain\Model\School();
		$objectStorageHoldingExactlyOneSchoolCareer = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneSchoolCareer->attach($schoolCareer);
		$this->subject->setSchoolCareer($objectStorageHoldingExactlyOneSchoolCareer);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneSchoolCareer,
			'schoolCareer',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addSchoolCareerToObjectStorageHoldingSchoolCareer() {
		$schoolCareer = new \MUM\TilApplication\Domain\Model\School();
		$schoolCareerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$schoolCareerObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($schoolCareer));
		$this->inject($this->subject, 'schoolCareer', $schoolCareerObjectStorageMock);

		$this->subject->addSchoolCareer($schoolCareer);
	}

	/**
	 * @test
	 */
	public function removeSchoolCareerFromObjectStorageHoldingSchoolCareer() {
		$schoolCareer = new \MUM\TilApplication\Domain\Model\School();
		$schoolCareerObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$schoolCareerObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($schoolCareer));
		$this->inject($this->subject, 'schoolCareer', $schoolCareerObjectStorageMock);

		$this->subject->removeSchoolCareer($schoolCareer);

	}

	/**
	 * @test
	 */
	public function getFamilyReturnsInitialValueForRelative() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getFamily()
		);
	}

	/**
	 * @test
	 */
	public function setFamilyForObjectStorageContainingRelativeSetsFamily() {
		$family = new \MUM\TilApplication\Domain\Model\Relative();
		$objectStorageHoldingExactlyOneFamily = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneFamily->attach($family);
		$this->subject->setFamily($objectStorageHoldingExactlyOneFamily);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneFamily,
			'family',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addFamilyToObjectStorageHoldingFamily() {
		$family = new \MUM\TilApplication\Domain\Model\Relative();
		$familyObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$familyObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($family));
		$this->inject($this->subject, 'family', $familyObjectStorageMock);

		$this->subject->addFamily($family);
	}

	/**
	 * @test
	 */
	public function removeFamilyFromObjectStorageHoldingFamily() {
		$family = new \MUM\TilApplication\Domain\Model\Relative();
		$familyObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$familyObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($family));
		$this->inject($this->subject, 'family', $familyObjectStorageMock);

		$this->subject->removeFamily($family);

	}

	/**
	 * @test
	 */
	public function getCostsReturnsInitialValueForCosts() {
		$this->assertEquals(
			NULL,
			$this->subject->getCosts()
		);
	}

	/**
	 * @test
	 */
	public function setCostsForCostsSetsCosts() {
		$costsFixture = new \MUM\TilApplication\Domain\Model\Costs();
		$this->subject->setCosts($costsFixture);

		$this->assertAttributeEquals(
			$costsFixture,
			'costs',
			$this->subject
		);
	}

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
