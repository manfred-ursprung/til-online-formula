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
 * School
 */
class School extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * name
	 *
	 * @var string
	 */
	protected $name = '';

	/**
	 * typeOfSchool
	 *
	 * @var string
	 */
	protected $typeOfSchool = '';

	/**
	 * schoolYear
	 *
	 * @var string
	 */
	protected $schoolYear = '';

	/**
	 * actual
	 *
	 * @var bool
	 */
	protected $actual = FALSE;

	/**
	 * schoolOrder
	 *
	 * @var int
	 */
	protected $schoolOrder = 0;

	/**
	 * visitFrom
	 *
	 * @var string
	 */
	protected $visitFrom = '';

	/**
	 * visitTil
	 *
	 * @var string
	 */
	protected $visitTil = '';

	/**
	 * plannedGraduationSelect
	 *
	 * @var \string
	 */
	protected $plannedGraduationSelect = 0;

	/**
	 * plannedGraduationText
	 *
	 * @var string
	 */
	protected $plannedGraduationText = '';

	/**
	 * plannedGraduationFinish
	 *
	 * @var string
	 */
	protected $plannedGraduationFinish = '';

	/**
	 * schoolCertificatePoints
	 *
	 * @var float
	 */
	protected $schoolCertificatePoints = 0.0;

	/**
	 * schoolCertificateDate
	 *
	 * @var \DateTime
	 */
	protected $schoolCertificateDate = NULL;

	/**
	 * address
	 *
	 * @var \MUM\TilApplication\Domain\Model\Address
	 */
	protected $address = NULL;

	/**
	 * candidate
	 *
	 * @var \MUM\TilApplication\Domain\Model\Candidate
	 */
	protected $candidate;


	/**
	 * Returns the name
	 *
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets the name
	 *
	 * @param string $name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Returns the typeOfSchool
	 *
	 * @return string $typeOfSchool
	 */
	public function getTypeOfSchool() {
		return $this->typeOfSchool;
	}

	/**
	 * Sets the typeOfSchool
	 *
	 * @param string $typeOfSchool
	 * @return void
	 */
	public function setTypeOfSchool($typeOfSchool) {
		$this->typeOfSchool = $typeOfSchool;
	}

	/**
	 * Returns the schoolYear
	 *
	 * @return string $schoolYear
	 */
	public function getSchoolYear() {
		return $this->schoolYear;
	}

	/**
	 * Sets the schoolYear
	 *
	 * @param string $schoolYear
	 * @return void
	 */
	public function setSchoolYear($schoolYear) {
		$this->schoolYear = $schoolYear;
	}

	/**
	 * Returns the actual
	 *
	 * @return bool $actual
	 */
	public function getActual() {
		return $this->actual;
	}

	/**
	 * Sets the actual
	 *
	 * @param bool $actual
	 * @return void
	 */
	public function setActual($actual) {
		$this->actual = $actual;
	}

	/**
	 * Returns the boolean state of actual
	 *
	 * @return bool
	 */
	public function isActual() {
		return $this->actual;
	}

	/**
	 * Returns the schoolOrder
	 *
	 * @return int $schoolOrder
	 */
	public function getSchoolOrder() {
		return $this->schoolOrder;
	}

	/**
	 * Sets the schoolOrder
	 *
	 * @param int $schoolOrder
	 * @return void
	 */
	public function setSchoolOrder($schoolOrder) {
		$this->schoolOrder = $schoolOrder;
	}

	/**
	 * Returns the visitFrom
	 *
	 * @return string $visitFrom
	 */
	public function getVisitFrom() {
		return $this->visitFrom;
	}

	/**
	 * Sets the visitFrom
	 *
	 * @param string $visitFrom
	 * @return void
	 */
	public function setVisitFrom($visitFrom) {
		$this->visitFrom = $visitFrom;
	}

	/**
	 * Returns the visitTil
	 *
	 * @return string $visitTil
	 */
	public function getVisitTil() {
		return $this->visitTil;
	}

	/**
	 * Sets the visitTil
	 *
	 * @param string $visitTil
	 * @return void
	 */
	public function setVisitTil($visitTil) {
		$this->visitTil = $visitTil;
	}

	/**
	 * Returns the plannedGraduationSelect
	 *
	 * @return \string $plannedGraduationSelect
	 */
	public function getPlannedGraduationSelect() {
		return $this->plannedGraduationSelect;
	}

	/**
	 * Sets the plannedGraduationSelect
	 *
	 * @param \string $plannedGraduationSelect
	 * @return void
	 */
	public function setPlannedGraduationSelect($plannedGraduationSelect) {
		$this->plannedGraduationSelect = $plannedGraduationSelect;
	}

	/**
	 * Returns the plannedGraduationText
	 *
	 * @return string $plannedGraduationText
	 */
	public function getPlannedGraduationText() {
		return $this->plannedGraduationText;
	}

	/**
	 * Sets the plannedGraduationText
	 *
	 * @param string $plannedGraduationText
	 * @return void
	 */
	public function setPlannedGraduationText($plannedGraduationText) {
		$this->plannedGraduationText = $plannedGraduationText;
	}

	/**
	 * Returns the plannedGraduationFinish
	 *
	 * @return string $plannedGraduationFinish
	 */
	public function getPlannedGraduationFinish() {
		return $this->plannedGraduationFinish;
	}

	/**
	 * Sets the plannedGraduationFinish
	 *
	 * @param string $plannedGraduationFinish
	 * @return void
	 */
	public function setPlannedGraduationFinish($plannedGraduationFinish) {
		$this->plannedGraduationFinish = $plannedGraduationFinish;
	}

	/**
	 * Returns the schoolCertificatePoints
	 *
	 * @return float $schoolCertificatePoints
	 */
	public function getSchoolCertificatePoints() {
		return $this->schoolCertificatePoints;
	}

	/**
	 * Sets the schoolCertificatePoints
	 *
	 * @param float $schoolCertificatePoints
	 * @return void
	 */
	public function setSchoolCertificatePoints($schoolCertificatePoints) {
		$this->schoolCertificatePoints = $schoolCertificatePoints;
	}

	/**
	 * Returns the schoolCertificateDate
	 *
	 * @return \DateTime $schoolCertificateDate
	 */
	public function getSchoolCertificateDate() {
		return $this->schoolCertificateDate;
	}

	/**
	 * Sets the schoolCertificateDate
	 *
	 * @param \DateTime $schoolCertificateDate | null
	 * @return void
	 */
	public function setSchoolCertificateDate(\DateTime $schoolCertificateDate = null) {
		$this->schoolCertificateDate = $schoolCertificateDate;
	}

	/**
	 * Returns the address
	 *
	 * @return \MUM\TilApplication\Domain\Model\Address $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param \MUM\TilApplication\Domain\Model\Address $address
	 * @return void
	 */
	public function setAddress(\MUM\TilApplication\Domain\Model\Address $address) {
		$this->address = $address;
	}

	/**
	 * @return \MUM\TilApplication\Domain\Model\Candidate
	 */
	public function getCandidate()
	{
		return $this->candidate;
	}

	/**
	 * @param \MUM\TilApplication\Domain\Model\Candidate $candidate
	 */
	public function setCandidate($candidate)
	{
		$this->candidate = $candidate;
	}


}