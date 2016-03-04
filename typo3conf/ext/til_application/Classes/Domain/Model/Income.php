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
 * Income
 */
class Income extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * grossSalary
	 *
	 * @var int
	 */
	protected $grossSalary = 0;

	/**
	 * netSalary
	 *
	 * @var int
	 */
	protected $netSalary = 0;

	/**
	 * selfEmployedSalary
	 *
	 * @var int
	 */
	protected $selfEmployedSalary = 0;

	/**
	 * welfare
	 *
	 * @var int
	 */
	protected $welfare = 0;

	/**
	 * unemploymentBenefit
	 *
	 * @var int
	 */
	protected $unemploymentBenefit = 0;

	/**
	 * housingBenefit
	 *
	 * @var int
	 */
	protected $housingBenefit = 0;

	/**
	 * pension
	 *
	 * @var int
	 */
	protected $pension = 0;

	/**
	 * otherIncomes
	 *
	 * @var int
	 */
	protected $otherIncomes = 0;

	/**
	 * Returns the grossSalary
	 *
	 * @return int $grossSalary
	 */
	public function getGrossSalary() {
		return $this->grossSalary;
	}

	/**
	 * Sets the grossSalary
	 *
	 * @param int $grossSalary
	 * @return void
	 */
	public function setGrossSalary($grossSalary) {
		$this->grossSalary = $grossSalary;
	}

	/**
	 * Returns the netSalary
	 *
	 * @return int $netSalary
	 */
	public function getNetSalary() {
		return $this->netSalary;
	}

	/**
	 * Sets the netSalary
	 *
	 * @param int $netSalary
	 * @return void
	 */
	public function setNetSalary($netSalary) {
		$this->netSalary = $netSalary;
	}

	/**
	 * Returns the selfEmployedSalary
	 *
	 * @return int $selfEmployedSalary
	 */
	public function getSelfEmployedSalary() {
		return $this->selfEmployedSalary;
	}

	/**
	 * Sets the selfEmployedSalary
	 *
	 * @param int $selfEmployedSalary
	 * @return void
	 */
	public function setSelfEmployedSalary($selfEmployedSalary) {
		$this->selfEmployedSalary = $selfEmployedSalary;
	}

	/**
	 * Returns the welfare
	 *
	 * @return int $welfare
	 */
	public function getWelfare() {
		return $this->welfare;
	}

	/**
	 * Sets the welfare
	 *
	 * @param int $welfare
	 * @return void
	 */
	public function setWelfare($welfare) {
		$this->welfare = $welfare;
	}

	/**
	 * Returns the unemploymentBenefit
	 *
	 * @return int $unemploymentBenefit
	 */
	public function getUnemploymentBenefit() {
		return $this->unemploymentBenefit;
	}

	/**
	 * Sets the unemploymentBenefit
	 *
	 * @param int $unemploymentBenefit
	 * @return void
	 */
	public function setUnemploymentBenefit($unemploymentBenefit) {
		$this->unemploymentBenefit = $unemploymentBenefit;
	}

	/**
	 * Returns the housingBenefit
	 *
	 * @return int $housingBenefit
	 */
	public function getHousingBenefit() {
		return $this->housingBenefit;
	}

	/**
	 * Sets the housingBenefit
	 *
	 * @param int $housingBenefit
	 * @return void
	 */
	public function setHousingBenefit($housingBenefit) {
		$this->housingBenefit = $housingBenefit;
	}

	/**
	 * Returns the pension
	 *
	 * @return int $pension
	 */
	public function getPension() {
		return $this->pension;
	}

	/**
	 * Sets the pension
	 *
	 * @param int $pension
	 * @return void
	 */
	public function setPension($pension) {
		$this->pension = $pension;
	}

	/**
	 * Returns the otherIncomes
	 *
	 * @return int $otherIncomes
	 */
	public function getOtherIncomes() {
		return $this->otherIncomes;
	}

	/**
	 * Sets the otherIncomes
	 *
	 * @param int $otherIncomes
	 * @return void
	 */
	public function setOtherIncomes($otherIncomes) {
		$this->otherIncomes = $otherIncomes;
	}

}