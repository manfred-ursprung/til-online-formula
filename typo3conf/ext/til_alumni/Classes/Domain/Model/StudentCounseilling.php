<?php
namespace MUM\TilAlumni\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Manfred Ursprung <manfred@manfred-ursprung.de>, Webapplikationen Ursprung
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
 * StudentCounseilling
 */
class StudentCounseilling extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * qualification1
	 *
	 * @var string
	 */
	protected $qualification1 = '';

	/**
	 * qualification2
	 *
	 * @var string
	 */
	protected $qualification2 = '';

	/**
	 * opportunitiesAfterStudy
	 *
	 * @var string
	 */
	protected $opportunitiesAfterStudy = '';

	/**
	 * universityInformations
	 *
	 * @var string
	 */
	protected $universityInformations = '';

	/**
	 * localInformations
	 *
	 * @var string
	 */
	protected $localInformations = '';

	/**
	 * priorUniversityExperiences
	 *
	 * @var string
	 */
	protected $priorUniversityExperiences = '';

	/**
	 * activities
	 *
	 * @var string
	 */
	protected $activities = '';

	/**
	 * scholarships
	 *
	 * @var string
	 */
	protected $scholarships = '';

	/**
	 * semesterAbroad
	 *
	 * @var string
	 */
	protected $semesterAbroad = '';

	/**
	 * studySlogan
	 *
	 * @var string
	 */
	protected $studySlogan = '';

	/**
	 * tip1
	 *
	 * @var string
	 */
	protected $tip1 = '';

	/**
	 * tip2
	 *
	 * @var string
	 */
	protected $tip2 = '';

	/**
	 * tip3
	 *
	 * @var string
	 */
	protected $tip3 = '';

	/**
	 * tip4
	 *
	 * @var string
	 */
	protected $tip4 = '';

	/**
	 * tip5
	 *
	 * @var string
	 */
	protected $tip5 = '';

	/**
	 * Returns the qualification1
	 *
	 * @return string $qualification1
	 */
	public function getQualification1() {
		return $this->qualification1;
	}

	/**
	 * Sets the qualification1
	 *
	 * @param string $qualification1
	 * @return void
	 */
	public function setQualification1($qualification1) {
		$this->qualification1 = $qualification1;
	}

	/**
	 * Returns the qualification2
	 *
	 * @return string $qualification2
	 */
	public function getQualification2() {
		return $this->qualification2;
	}

	/**
	 * Sets the qualification2
	 *
	 * @param string $qualification2
	 * @return void
	 */
	public function setQualification2($qualification2) {
		$this->qualification2 = $qualification2;
	}

	/**
	 * Returns the opportunitiesAfterStudy
	 *
	 * @return string $opportunitiesAfterStudy
	 */
	public function getOpportunitiesAfterStudy() {
		return $this->opportunitiesAfterStudy;
	}

	/**
	 * Sets the opportunitiesAfterStudy
	 *
	 * @param string $opportunitiesAfterStudy
	 * @return void
	 */
	public function setOpportunitiesAfterStudy($opportunitiesAfterStudy) {
		$this->opportunitiesAfterStudy = $opportunitiesAfterStudy;
	}

	/**
	 * Returns the universityInformations
	 *
	 * @return string $universityInformations
	 */
	public function getUniversityInformations() {
		return $this->universityInformations;
	}

	/**
	 * Sets the universityInformations
	 *
	 * @param string $universityInformations
	 * @return void
	 */
	public function setUniversityInformations($universityInformations) {
		$this->universityInformations = $universityInformations;
	}

	/**
	 * Returns the localInformations
	 *
	 * @return string $localInformations
	 */
	public function getLocalInformations() {
		return $this->localInformations;
	}

	/**
	 * Sets the localInformations
	 *
	 * @param string $localInformations
	 * @return void
	 */
	public function setLocalInformations($localInformations) {
		$this->localInformations = $localInformations;
	}

	/**
	 * Returns the priorUniversityExperiences
	 *
	 * @return string $priorUniversityExperiences
	 */
	public function getPriorUniversityExperiences() {
		return $this->priorUniversityExperiences;
	}

	/**
	 * Sets the priorUniversityExperiences
	 *
	 * @param string $priorUniversityExperiences
	 * @return void
	 */
	public function setPriorUniversityExperiences($priorUniversityExperiences) {
		$this->priorUniversityExperiences = $priorUniversityExperiences;
	}

	/**
	 * Returns the activities
	 *
	 * @return string $activities
	 */
	public function getActivities() {
		return $this->activities;
	}

	/**
	 * Sets the activities
	 *
	 * @param string $activities
	 * @return void
	 */
	public function setActivities($activities) {
		$this->activities = $activities;
	}

	/**
	 * Returns the scholarships
	 *
	 * @return string $scholarships
	 */
	public function getScholarships() {
		return $this->scholarships;
	}

	/**
	 * Sets the scholarships
	 *
	 * @param string $scholarships
	 * @return void
	 */
	public function setScholarships($scholarships) {
		$this->scholarships = $scholarships;
	}

	/**
	 * Returns the semesterAbroad
	 *
	 * @return string $semesterAbroad
	 */
	public function getSemesterAbroad() {
		return $this->semesterAbroad;
	}

	/**
	 * Sets the semesterAbroad
	 *
	 * @param string $semesterAbroad
	 * @return void
	 */
	public function setSemesterAbroad($semesterAbroad) {
		$this->semesterAbroad = $semesterAbroad;
	}

	/**
	 * Returns the studySlogan
	 *
	 * @return string $studySlogan
	 */
	public function getStudySlogan() {
		return $this->studySlogan;
	}

	/**
	 * Sets the studySlogan
	 *
	 * @param string $studySlogan
	 * @return void
	 */
	public function setStudySlogan($studySlogan) {
		$this->studySlogan = $studySlogan;
	}

	/**
	 * Returns the tip1
	 *
	 * @return string $tip1
	 */
	public function getTip1() {
		return $this->tip1;
	}

	/**
	 * Sets the tip1
	 *
	 * @param string $tip1
	 * @return void
	 */
	public function setTip1($tip1) {
		$this->tip1 = $tip1;
	}

	/**
	 * Returns the tip2
	 *
	 * @return string $tip2
	 */
	public function getTip2() {
		return $this->tip2;
	}

	/**
	 * Sets the tip2
	 *
	 * @param string $tip2
	 * @return void
	 */
	public function setTip2($tip2) {
		$this->tip2 = $tip2;
	}

	/**
	 * Returns the tip3
	 *
	 * @return string $tip3
	 */
	public function getTip3() {
		return $this->tip3;
	}

	/**
	 * Sets the tip3
	 *
	 * @param string $tip3
	 * @return void
	 */
	public function setTip3($tip3) {
		$this->tip3 = $tip3;
	}

	/**
	 * Returns the tip4
	 *
	 * @return string $tip4
	 */
	public function getTip4() {
		return $this->tip4;
	}

	/**
	 * Sets the tip4
	 *
	 * @param string $tip4
	 * @return void
	 */
	public function setTip4($tip4) {
		$this->tip4 = $tip4;
	}

	/**
	 * Returns the tip5
	 *
	 * @return string $tip5
	 */
	public function getTip5() {
		return $this->tip5;
	}

	/**
	 * Sets the tip5
	 *
	 * @param string $tip5
	 * @return void
	 */
	public function setTip5($tip5) {
		$this->tip5 = $tip5;
	}

}