<?php
namespace MUM\TilApplication\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Manfred Ursprung <manfred@manfred-ursprung.de>, Webapplication Ursprung
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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
 * Costs
 */
class Costs extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * livingCosts
	 *
	 * @var int
	 */
	protected $livingCosts = 0;

	/**
	 * creditCosts
	 *
	 * @var int
	 */
	protected $creditCosts = 0;

	/**
	 * otherOutgoings
	 *
	 * @var int
	 */
	protected $otherOutgoings = 0;

	/**
	 * travelCosts
	 *
	 * @var int
	 */
	protected $travelCosts = 0;

	/**
	 * furtherEducationCosts
	 *
	 * @var int
	 */
	protected $furtherEducationCosts = 0;

	/**
	 * privateCoachingCosts
	 *
	 * @var int
	 */
	protected $privateCoachingCosts = 0;

	/**
	 * rental
	 *
	 * @var int
	 */
	protected $rental = 0;

	/**
	 * livingCostsSingle
	 *
	 * @var int
	 */
	protected $livingCostsSingle = 0;

	/**
	 * otherCosts
	 *
	 * @var int
	 */
	protected $otherCosts = 0;

	/**
	 * Returns the livingCosts
	 *
	 * @return int $livingCosts
	 */
	public function getLivingCosts() {
		return $this->livingCosts;
	}

	/**
	 * Sets the livingCosts
	 *
	 * @param int $livingCosts
	 * @return void
	 */
	public function setLivingCosts($livingCosts) {
		$this->livingCosts = $livingCosts;
	}

	/**
	 * Returns the creditCosts
	 *
	 * @return int $creditCosts
	 */
	public function getCreditCosts() {
		return $this->creditCosts;
	}

	/**
	 * Sets the creditCosts
	 *
	 * @param int $creditCosts
	 * @return void
	 */
	public function setCreditCosts($creditCosts) {
		$this->creditCosts = $creditCosts;
	}

	/**
	 * Returns the otherOutgoings
	 *
	 * @return int $otherOutgoings
	 */
	public function getOtherOutgoings() {
		return $this->otherOutgoings;
	}

	/**
	 * Sets the otherOutgoings
	 *
	 * @param int $otherOutgoings
	 * @return void
	 */
	public function setOtherOutgoings($otherOutgoings) {
		$this->otherOutgoings = $otherOutgoings;
	}

	/**
	 * Returns the travelCosts
	 *
	 * @return int $travelCosts
	 */
	public function getTravelCosts() {
		return $this->travelCosts;
	}

	/**
	 * Sets the travelCosts
	 *
	 * @param int $travelCosts
	 * @return void
	 */
	public function setTravelCosts($travelCosts) {
		$this->travelCosts = $travelCosts;
	}

	/**
	 * Returns the furtherEducationCosts
	 *
	 * @return int $furtherEducationCosts
	 */
	public function getFurtherEducationCosts() {
		return $this->furtherEducationCosts;
	}

	/**
	 * Sets the furtherEducationCosts
	 *
	 * @param int $furtherEducationCosts
	 * @return void
	 */
	public function setFurtherEducationCosts($furtherEducationCosts) {
		$this->furtherEducationCosts = $furtherEducationCosts;
	}

	/**
	 * Returns the privateCoachingCosts
	 *
	 * @return int $privateCoachingCosts
	 */
	public function getPrivateCoachingCosts() {
		return $this->privateCoachingCosts;
	}

	/**
	 * Sets the privateCoachingCosts
	 *
	 * @param int $privateCoachingCosts
	 * @return void
	 */
	public function setPrivateCoachingCosts($privateCoachingCosts) {
		$this->privateCoachingCosts = $privateCoachingCosts;
	}

	/**
	 * Returns the rental
	 *
	 * @return int $rental
	 */
	public function getRental() {
		return $this->rental;
	}

	/**
	 * Sets the rental
	 *
	 * @param int $rental
	 * @return void
	 */
	public function setRental($rental) {
		$this->rental = $rental;
	}

	/**
	 * Returns the livingCostsSingle
	 *
	 * @return int $livingCostsSingle
	 */
	public function getLivingCostsSingle() {
		return $this->livingCostsSingle;
	}

	/**
	 * Sets the livingCostsSingle
	 *
	 * @param int $livingCostsSingle
	 * @return void
	 */
	public function setLivingCostsSingle($livingCostsSingle) {
		$this->livingCostsSingle = $livingCostsSingle;
	}

	/**
	 * Returns the otherCosts
	 *
	 * @return int $otherCosts
	 */
	public function getOtherCosts() {
		return $this->otherCosts;
	}

	/**
	 * Sets the otherCosts
	 *
	 * @param int $otherCosts
	 * @return void
	 */
	public function setOtherCosts($otherCosts) {
		$this->otherCosts = $otherCosts;
	}

}