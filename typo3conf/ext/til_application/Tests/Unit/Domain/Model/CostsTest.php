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
 * Test case for class \MUM\TilApplication\Domain\Model\Costs.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Manfred Ursprung <manfred@manfred-ursprung.de>
 */
class CostsTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \MUM\TilApplication\Domain\Model\Costs
	 */
	protected $subject = NULL;

	public function setUp() {
		$this->subject = new \MUM\TilApplication\Domain\Model\Costs();
	}

	public function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getLivingCostsReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setLivingCostsForIntSetsLivingCosts() {	}

	/**
	 * @test
	 */
	public function getCreditCostsReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setCreditCostsForIntSetsCreditCosts() {	}

	/**
	 * @test
	 */
	public function getOtherOutgoingsReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setOtherOutgoingsForIntSetsOtherOutgoings() {	}

	/**
	 * @test
	 */
	public function getTravelCostsReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setTravelCostsForIntSetsTravelCosts() {	}

	/**
	 * @test
	 */
	public function getFurtherEducationCostsReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setFurtherEducationCostsForIntSetsFurtherEducationCosts() {	}

	/**
	 * @test
	 */
	public function getPrivateCoachingCostsReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setPrivateCoachingCostsForIntSetsPrivateCoachingCosts() {	}

	/**
	 * @test
	 */
	public function getRentalReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setRentalForIntSetsRental() {	}

	/**
	 * @test
	 */
	public function getLivingCostsSingleReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setLivingCostsSingleForIntSetsLivingCostsSingle() {	}

	/**
	 * @test
	 */
	public function getOtherCostsReturnsInitialValueForInt() {	}

	/**
	 * @test
	 */
	public function setOtherCostsForIntSetsOtherCosts() {	}
}
