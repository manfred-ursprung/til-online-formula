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
 * Test case for class \MUM\TilApplication\Domain\Model\Income.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Manfred Ursprung <manfred@manfred-ursprung.de>
 */
class IncomeTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MUM\TilApplication\Domain\Model\Income
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \MUM\TilApplication\Domain\Model\Income();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getGrossSalaryReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setGrossSalaryForIntSetsGrossSalary() {	}

	/**
	 * @test
	 */
	public function getNetSalaryReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setNetSalaryForIntSetsNetSalary() {	}

	/**
	 * @test
	 */
	public function getSelfEmployedSalaryReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setSelfEmployedSalaryForIntSetsSelfEmployedSalary() {	}

	/**
	 * @test
	 */
	public function getWelfareReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setWelfareForIntSetsWelfare() {	}

	/**
	 * @test
	 */
	public function getUnemploymentBenefitReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setUnemploymentBenefitForIntSetsUnemploymentBenefit() {	}

	/**
	 * @test
	 */
	public function getHousingBenefitReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setHousingBenefitForIntSetsHousingBenefit() {	}

	/**
	 * @test
	 */
	public function getPensionReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setPensionForIntSetsPension() {	}

	/**
	 * @test
	 */
	public function getOtherIncomesReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setOtherIncomesForIntSetsOtherIncomes() {	}
}
