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
 * Network
 */
class Network extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * languageSkills
	 *
	 * @var string
	 */
	protected $languageSkills = '';

	/**
	 * schoolCareer
	 *
	 * @var string
	 */
	protected $schoolCareer = '';

	/**
	 * personalExperiences
	 *
	 * @var string
	 */
	protected $personalExperiences = '';

	/**
	 * adviceTopics
	 *
	 * @var string
	 */
	protected $adviceTopics = '';

	/**
	 * Returns the languageSkills
	 *
	 * @return string $languageSkills
	 */
	public function getLanguageSkills() {
		return $this->languageSkills;
	}

	/**
	 * Sets the languageSkills
	 *
	 * @param string $languageSkills
	 * @return void
	 */
	public function setLanguageSkills($languageSkills) {
		$this->languageSkills = $languageSkills;
	}

	/**
	 * Returns the schoolCareer
	 *
	 * @return string $schoolCareer
	 */
	public function getSchoolCareer() {
		return $this->schoolCareer;
	}

	/**
	 * Sets the schoolCareer
	 *
	 * @param string $schoolCareer
	 * @return void
	 */
	public function setSchoolCareer($schoolCareer) {
		$this->schoolCareer = $schoolCareer;
	}

	/**
	 * Returns the adviceTopics
	 *
	 * @return string $adviceTopics
	 */
	public function getAdviceTopics() {
		return $this->adviceTopics;
	}

	/**
	 * Sets the adviceTopics
	 *
	 * @param string $adviceTopics
	 * @return void
	 */
	public function setAdviceTopics($adviceTopics) {
		$this->adviceTopics = $adviceTopics;
	}

	/**
	 * Returns the personalExperiences
	 *
	 * @return string personalExperiences
	 */
	public function getPersonalExperiences() {
		return $this->personalExperiences;
	}

	/**
	 * Sets the personalExperiences
	 *
	 * @param string $personalExperiences
	 * @return void
	 */
	public function setPersonalExperiences($personalExperiences) {
		$this->personalExperiences = $personalExperiences;
	}

}