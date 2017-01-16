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
 * Alumni
 */
class Alumni extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * firstname
	 *
	 * @var string
	 */
	protected $firstname = '';

	/**
	 * lastname
	 *
	 * @var string
	 */
	protected $lastname = '';

	/**
	 * gender
	 *
	 * @var string
	 */
	protected $gender = '';

	/**
	 * birthday
	 *
	 * @var int
	 */
	protected $birthday = 0;

	/**
	 * cityOfBirth
	 *
	 * @var string
	 */
	protected $cityOfBirth = '';

	/**
	 * countryOfBirth
	 *
	 * @var string
	 */
	protected $countryOfBirth = '';

	/**
	 * hobbys
	 *
	 * @var string
	 */
	protected $hobbys = '';

	/**
	 * lifeMotto
	 *
	 * @var string
	 */
	protected $lifeMotto = '';

	/**
	 * street
	 *
	 * @var string
	 */
	protected $street = '';

	/**
	 * zip
	 *
	 * @var string
	 */
	protected $zip = '';

	/**
	 * city
	 *
	 * @var string
	 */
	protected $city = '';

	/**
	 * email
	 *
	 * @var string
	 */
	protected $email = '';

	/**
	 * mobile
	 *
	 * @var string
	 */
	protected $mobile = '';

	/**
	 * languageSkills
	 *
	 * @var string
	 */
	protected $languageSkills = '';

	/**
	 * scholarshipPeriod
	 *
	 * @var string
	 */
	protected $scholarshipPeriod = '';

	/**
	 * typeOfSchool
	 *
	 * @var string
	 */
	protected $typeOfSchool = '';

	/**
	 * universityCourse
	 *
	 * @var string
	 */
	protected $universityCourse = '';

	/**
	 * university
	 *
	 * @var string
	 */
	protected $university = '';

	/**
	 * graduation
	 *
	 * @var string
	 */
	protected $graduation = '';

	/**
	 * profession
	 *
	 * @var string
	 */
	protected $profession = '';

	/**
	 * studentCounseilling
	 *
	 * @var \MUM\TilAlumni\Domain\Model\StudentCounseilling
	 */
	protected $studentCounseilling = NULL;

	/**
	 * network
	 *
	 * @var \MUM\TilAlumni\Domain\Model\Network
	 */
	protected $network = NULL;

	/**
	 * Returns the firstname
	 *
	 * @return string $firstname
	 */
	public function getFirstname() {
		return $this->firstname;
	}

	/**
	 * Sets the firstname
	 *
	 * @param string $firstname
	 * @return void
	 */
	public function setFirstname($firstname) {
		$this->firstname = $firstname;
	}

	/**
	 * Returns the lastname
	 *
	 * @return string $lastname
	 */
	public function getLastname() {
		return $this->lastname;
	}

	/**
	 * Sets the lastname
	 *
	 * @param string $lastname
	 * @return void
	 */
	public function setLastname($lastname) {
		$this->lastname = $lastname;
	}

	/**
	 * Returns the gender
	 *
	 * @return string $gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * Sets the gender
	 *
	 * @param string $gender
	 * @return void
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}

	/**
	 * Returns the birthday
	 *
	 * @return int $birthday
	 */
	public function getBirthday() {
		return $this->birthday;
	}

	/**
	 * Sets the birthday
	 *
	 * @param int $birthday
	 * @return void
	 */
	public function setBirthday(int $birthday) {
		$this->birthday = $birthday;
	}

	/**
	 * Returns the cityOfBirth
	 *
	 * @return string $cityOfBirth
	 */
	public function getCityOfBirth() {
		return $this->cityOfBirth;
	}

	/**
	 * Sets the cityOfBirth
	 *
	 * @param string $cityOfBirth
	 * @return void
	 */
	public function setCityOfBirth($cityOfBirth) {
		$this->cityOfBirth = $cityOfBirth;
	}

	/**
	 * Returns the countryOfBirth
	 *
	 * @return string $countryOfBirth
	 */
	public function getCountryOfBirth() {
		return $this->countryOfBirth;
	}

	/**
	 * Sets the countryOfBirth
	 *
	 * @param string $countryOfBirth
	 * @return void
	 */
	public function setCountryOfBirth($countryOfBirth) {
		$this->countryOfBirth = $countryOfBirth;
	}

	/**
	 * Returns the hobbys
	 *
	 * @return string $hobbys
	 */
	public function getHobbys() {
		return $this->hobbys;
	}

	/**
	 * Sets the hobbys
	 *
	 * @param string $hobbys
	 * @return void
	 */
	public function setHobbys($hobbys) {
		$this->hobbys = $hobbys;
	}

	/**
	 * Returns the lifeMotto
	 *
	 * @return string $lifeMotto
	 */
	public function getLifeMotto() {
		return $this->lifeMotto;
	}

	/**
	 * Sets the lifeMotto
	 *
	 * @param string $lifeMotto
	 * @return void
	 */
	public function setLifeMotto($lifeMotto) {
		$this->lifeMotto = $lifeMotto;
	}

	/**
	 * Returns the street
	 *
	 * @return string $street
	 */
	public function getStreet() {
		return $this->street;
	}

	/**
	 * Sets the street
	 *
	 * @param string $street
	 * @return void
	 */
	public function setStreet($street) {
		$this->street = $street;
	}

	/**
	 * Returns the zip
	 *
	 * @return string $zip
	 */
	public function getZip() {
		return $this->zip;
	}

	/**
	 * Sets the zip
	 *
	 * @param string $zip
	 * @return void
	 */
	public function setZip($zip) {
		$this->zip = $zip;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return void
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * Returns the mobile
	 *
	 * @return string $mobile
	 */
	public function getMobile() {
		return $this->mobile;
	}

	/**
	 * Sets the mobile
	 *
	 * @param string $mobile
	 * @return void
	 */
	public function setMobile($mobile) {
		$this->mobile = $mobile;
	}

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
	 * Returns the scholarshipPeriod
	 *
	 * @return string $scholarshipPeriod
	 */
	public function getScholarshipPeriod() {
		return $this->scholarshipPeriod;
	}

	/**
	 * Sets the scholarshipPeriod
	 *
	 * @param string $scholarshipPeriod
	 * @return void
	 */
	public function setScholarshipPeriod($scholarshipPeriod) {
		$this->scholarshipPeriod = $scholarshipPeriod;
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
	 * Returns the universityCourse
	 *
	 * @return string $universityCourse
	 */
	public function getUniversityCourse() {
		return $this->universityCourse;
	}

	/**
	 * Sets the universityCourse
	 *
	 * @param string $universityCourse
	 * @return void
	 */
	public function setUniversityCourse($universityCourse) {
		$this->universityCourse = $universityCourse;
	}

	/**
	 * Returns the university
	 *
	 * @return string $university
	 */
	public function getUniversity() {
		return $this->university;
	}

	/**
	 * Sets the university
	 *
	 * @param string $university
	 * @return void
	 */
	public function setUniversity($university) {
		$this->university = $university;
	}

	/**
	 * Returns the graduation
	 *
	 * @return string $graduation
	 */
	public function getGraduation() {
		return $this->graduation;
	}

	/**
	 * Sets the graduation
	 *
	 * @param string $graduation
	 * @return void
	 */
	public function setGraduation($graduation) {
		$this->graduation = $graduation;
	}

	/**
	 * Returns the profession
	 *
	 * @return string $profession
	 */
	public function getProfession() {
		return $this->profession;
	}

	/**
	 * Sets the profession
	 *
	 * @param string $profession
	 * @return void
	 */
	public function setProfession($profession) {
		$this->profession = $profession;
	}

	/**
	 * Returns the studentCounseilling
	 *
	 * @return \MUM\TilAlumni\Domain\Model\StudentCounseilling $studentCounseilling
	 */
	public function getStudentCounseilling() {
		return $this->studentCounseilling;
	}

	/**
	 * Sets the studentCounseilling
	 *
	 * @param \MUM\TilAlumni\Domain\Model\StudentCounseilling $studentCounseilling
	 * @return void
	 */
	public function setStudentCounseilling(\MUM\TilAlumni\Domain\Model\StudentCounseilling $studentCounseilling) {
		$this->studentCounseilling = $studentCounseilling;
	}

	/**
	 * Returns the network
	 *
	 * @return \MUM\TilAlumni\Domain\Model\Network $network
	 */
	public function getNetwork() {
		return $this->network;
	}

	/**
	 * Sets the network
	 *
	 * @param \MUM\TilAlumni\Domain\Model\Network $network
	 * @return void
	 */
	public function setNetwork(\MUM\TilAlumni\Domain\Model\Network $network) {
		$this->network = $network;
	}

}