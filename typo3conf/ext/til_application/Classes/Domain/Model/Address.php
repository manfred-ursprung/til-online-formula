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
 * Address
 */
class Address extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * street
	 *
	 * @var string
	 */
	protected $street = '';

	/**
	 * housenumber
	 *
	 * @var string
	 */
	protected $housenumber = '';

	/**
	 * city
	 *
	 * @var string
	 */
	protected $city = '';

	/**
	 * zip
	 *
	 * @var string
	 */
	protected $zip = '';

	/**
	 * phone
	 *
	 * @var string
	 */
	protected $phone = '';

	/**
	 * mobile
	 *
	 * @var string
	 */
	protected $mobile = '';

	/**
	 * email
	 *
	 * @var string
	 */
	protected $email = '';

	/**
	 * atParent
	 *
	 * @var bool
	 */
	protected $atParent = FALSE;

	/**
	 * ownRoom
	 *
	 * @var bool
	 */
	protected $ownRoom = FALSE;

	/**
	 * siblingRoom
	 *
	 * @var bool
	 */
	protected $siblingRoom = FALSE;

	/**
	 * @var \int
	 */
	protected $siblingRoomNumber;
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
	 * Returns the phone
	 *
	 * @return string $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the phone
	 *
	 * @param string $phone
	 * @return void
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
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
	 * Returns the atParent
	 *
	 * @return bool $atParent
	 */
	public function getAtParent() {
		return $this->atParent;
	}

	/**
	 * Sets the atParent
	 *
	 * @param bool $atParent
	 * @return void
	 */
	public function setAtParent($atParent) {
		$this->atParent = $atParent;
	}

	/**
	 * Returns the boolean state of atParent
	 *
	 * @return bool
	 */
	public function isAtParent() {
		return $this->atParent;
	}

	/**
	 * Returns the ownRoom
	 *
	 * @return bool $ownRoom
	 */
	public function getOwnRoom() {
		return $this->ownRoom;
	}

	/**
	 * Sets the ownRoom
	 *
	 * @param bool $ownRoom
	 * @return void
	 */
	public function setOwnRoom($ownRoom) {
		$this->ownRoom = $ownRoom;
	}

	/**
	 * Returns the boolean state of ownRoom
	 *
	 * @return bool
	 */
	public function isOwnRoom() {
		return $this->ownRoom;
	}

	/**
	 * Returns the siblingRoom
	 *
	 * @return bool $siblingRoom
	 */
	public function getSiblingRoom() {
		return $this->siblingRoom;
	}

	/**
	 * Sets the siblingRoom
	 *
	 * @param bool $siblingRoom
	 * @return void
	 */
	public function setSiblingRoom($siblingRoom) {
		$this->siblingRoom = $siblingRoom;
	}

	/**
	 * Returns the boolean state of siblingRoom
	 *
	 * @return bool
	 */
	public function isSiblingRoom() {
		return $this->siblingRoom;
	}

	/**
	 * Returns the housenumber
	 *
	 * @return string housenumber
	 */
	public function getHousenumber() {
		return $this->housenumber;
	}

	/**
	 * Sets the housenumber
	 *
	 * @param string $housenumber
	 * @return void
	 */
	public function setHousenumber($housenumber) {
		$this->housenumber = $housenumber;
	}

	/**
	 * @return int
	 */
	public function getSiblingRoomNumber()
	{
		return $this->siblingRoomNumber;
	}

	/**
	 * @param int $siblingRoomNumber
	 */
	public function setSiblingRoomNumber($siblingRoomNumber)
	{
		$this->siblingRoomNumber = $siblingRoomNumber;
	}



}