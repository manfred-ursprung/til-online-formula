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
 * Relative
 */
class Relative extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	const RELATION_MOTHER = 1;
	const RELATION_FATHER = 0;
	const RELATION_SIBLING = 2;

	/**
	 * firstName
	 *
	 * @var string
	 */
	protected $firstName = '';

	/**
	 * lastName
	 *
	 * @var string
	 */
	protected $lastName = '';

	/**
	 * birthdate
	 *
	 * @var \DateTime
	 */
	protected $birthdate = NULL;

	/**
	 * nationality
	 *
	 * @var string
	 */
	protected $nationality = '';

	/**
	 * educationalQualification
	 *
	 * @var string
	 */
	protected $educationalQualification = '';

	/**
	 * job
	 *
	 * @var string
	 */
	protected $job = '';

	/**
	 * familyRelation
	 *
	 * @var int
	 */
	protected $familyRelation = 0;

	/**
	 * income
	 *
	 * @var \MUM\TilApplication\Domain\Model\Income
	 */
	protected $income = NULL;

	/**
	 * Returns the firstName
	 *
	 * @return string $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Sets the firstName
	 *
	 * @param string $firstName
	 * @return void
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * Returns the lastName
	 *
	 * @return string $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Sets the lastName
	 *
	 * @param string $lastName
	 * @return void
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * Returns the birthdate
	 *
	 * @return \DateTime $birthdate
	 */
	public function getBirthdate() {
		return $this->birthdate;
	}

	/**
	 * Sets the birthdate
	 *
	 * @param \DateTime $birthdate
	 * @return void
	 */
	public function setBirthdate(\DateTime $birthdate) {
		$this->birthdate = $birthdate;
	}

	/**
	 * Returns the nationality
	 *
	 * @return string $nationality
	 */
	public function getNationality() {
		return $this->nationality;
	}

	/**
	 * Sets the nationality
	 *
	 * @param string $nationality
	 * @return void
	 */
	public function setNationality($nationality) {
		$this->nationality = $nationality;
	}

	/**
	 * Returns the educationalQualification
	 *
	 * @return string $educationalQualification
	 */
	public function getEducationalQualification() {
		return $this->educationalQualification;
	}

	/**
	 * Sets the educationalQualification
	 *
	 * @param string $educationalQualification
	 * @return void
	 */
	public function setEducationalQualification($educationalQualification) {
		$this->educationalQualification = $educationalQualification;
	}

	/**
	 * Returns the job
	 *
	 * @return string $job
	 */
	public function getJob() {
		return $this->job;
	}

	/**
	 * Sets the job
	 *
	 * @param string $job
	 * @return void
	 */
	public function setJob($job) {
		$this->job = $job;
	}

	/**
	 * Returns the familyRelation
	 *
	 * @return int $familyRelation
	 */
	public function getFamilyRelation() {
		return $this->familyRelation;
	}

	/**
	 * Sets the familyRelation
	 *
	 * @param int $familyRelation
	 * @return void
	 */
	public function setFamilyRelation($familyRelation) {
		$this->familyRelation = $familyRelation;
	}

	/**
	 * Returns the income
	 *
	 * @return \MUM\TilApplication\Domain\Model\Income $income
	 */
	public function getIncome() {
		return $this->income;
	}

	/**
	 * Sets the income
	 *
	 * @param \MUM\TilApplication\Domain\Model\Income $income
	 * @return void
	 */
	public function setIncome(\MUM\TilApplication\Domain\Model\Income $income) {
		$this->income = $income;
	}

}