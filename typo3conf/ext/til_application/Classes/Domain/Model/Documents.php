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
class Documents extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * lifeschoolCareer
	 *
	 * @var \string
	 */
	protected $lifeSchoolCareer;

	/**
	 * curriculumVitae
	 *
	 * @var \string
	 */
	protected $curriculumVitae;

	/**
	 * survey
	 *
	 * @var \string
	 */
	protected $survey;

	/**
	 * certificate1
	 *
	 * @var \string
	 */
	protected $certificate1;

	/**
	 * certificate2
	 *
	 * @var \string
	 */
	protected $certificate2;

	/**
	 * certificate3
	 *
	 * @var \string
	 */
	protected $certificate3;

	/**
	 * passportPhoto
	 *
	 * @var \string
	 */
	protected $passportPhoto;

	/**
	 * identityCard
	 *
	 * @var \string
	 */
	protected $identityCard;

	/**
	 * residencePermit
	 *
	 * @var \string
	 */
	protected $residencePermit;


	/**
	 * candidate
	 *
	 * @var \MUM\TilApplication\Domain\Model\Candidate
	 */
	protected $candidate;



	/**
	 * @return string
	 */
	public function getLifeSchoolCareer()
	{
		return $this->lifeSchoolCareer;
	}

	/**
	 * @param string $lifeSchoolCareer
	 */
	public function setLifeSchoolCareer($lifeSchoolCareer)
	{
		$this->lifeSchoolCareer = $lifeSchoolCareer;
	}

	/**
	 * @return string
	 */
	public function getCurriculumVitae()
	{
		return $this->curriculumVitae;
	}

	/**
	 * @param string $curriculumVitae
	 */
	public function setCurriculumVitae($curriculumVitae)
	{
		$this->curriculumVitae = $curriculumVitae;
	}

	/**
	 * @return string
	 */
	public function getSurvey()
	{
		return $this->survey;
	}

	/**
	 * @param string $survey
	 */
	public function setSurvey($survey)
	{
		$this->survey = $survey;
	}

	/**
	 * @return string
	 */
	public function getCertificate1()
	{
		return $this->certificate1;
	}

	/**
	 * @param string $certificate1
	 */
	public function setCertificate1($certificate1)
	{
		$this->certificate1 = $certificate1;
	}

	/**
	 * @return string
	 */
	public function getCertificate2()
	{
		return $this->certificate2;
	}

	/**
	 * @param string $certificate2
	 */
	public function setCertificate2($certificate2)
	{
		$this->certificate2 = $certificate2;
	}

	/**
	 * @return string
	 */
	public function getCertificate3()
	{
		return $this->certificate3;
	}

	/**
	 * @param string $certificate3
	 */
	public function setCertificate3($certificate3)
	{
		$this->certificate3 = $certificate3;
	}

	/**
	 * @return string
	 */
	public function getPassportPhoto()
	{
		return $this->passportPhoto;
	}

	/**
	 * @param string $passportPhoto
	 */
	public function setPassportPhoto($passportPhoto)
	{
		$this->passportPhoto = $passportPhoto;
	}

	/**
	 * @return string
	 */
	public function getIdentityCard()
	{
		return $this->identityCard;
	}

	/**
	 * @param string $identityCard
	 */
	public function setIdentityCard($identityCard)
	{
		$this->identityCard = $identityCard;
	}

	/**
	 * @return string
	 */
	public function getResidencePermit()
	{
		return $this->residencePermit;
	}

	/**
	 * @param string $residencePermit
	 */
	public function setResidencePermit($residencePermit)
	{
		$this->residencePermit = $residencePermit;
	}

	/**
	 * @return Candidate
	 */
	public function getCandidate()
	{
		return $this->candidate;
	}

	/**
	 * @param Candidate $candidate
	 */
	public function setCandidate($candidate)
	{
		$this->candidate = $candidate;
	}




}