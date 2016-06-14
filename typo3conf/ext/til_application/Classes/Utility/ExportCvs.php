<?php

namespace MUM\TilApplication\Utility;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016 Manfred Ursprung <manfred@manfred-ursprung.de>, Webapplication Ursprung
 *
 *  All rights reserved
 *
 *  Helper class for uploading images over the frontend
 *
 ***************************************************************/

use MUM\TilApplication\Domain\Model\Candidate;
use TYPO3\CMS\Core\Utility\DebugUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use MUM\TilApplication\Domain\Model\Relative;

class ExportCvs{

    /**
     * candidateRepository
     *
     * @var \MUM\TilApplication\Domain\Repository\CandidateRepository
     * @inject
     */
    protected $candidateRepository = NULL;

    /**
     * @var \array of Candidate
     */
    protected $candidates;

    protected $data;

    /**
     * @var \array
     */
    protected $maxField;

    /**
     * @var \array  Mapping from property to field number in csv file
     */
    protected $fieldIndex;


    public function __construct(){
        //get all candidates
        $this->candidates = $this->candidateRepository->findAllApproved();
        $this->init();
    }

    public function export(){
        foreach($this->candidates as $candidate){
            $this->exportPersonalData($candidate);
            $this->exportFamilyData($candidate);
            $this->exportSchoolCareer($candidate);
            $this->exportIncome($candidate);
            $this->exportCosts($candidate);
        }


        
    }

    /**
     * set maxFields
     */
    protected function init()
    {
        $this->maxField = array('schools' => 1,
            'siblings' => 1,
        );
        /** @var  $candidate \MUM\TilApplication\Domain\Model\Candidate */
        foreach ($this->candidates as $candidate) {
            /** @var  $familyMember \MUM\TilApplication\Domain\Model\Relative */
            $temp = 0;
            foreach ($candidate->getFamily() as $familyMember) {
                if ($familyMember->getFamilyRelation() == Relative::RELATION_SIBLING) {
                    $temp++;
                }
            }
            $this->maxField['siblings'] = max($this->maxField['siblings'], $temp);
            $this->maxField['schools'] = $candidate->getSchoolCareer()->count();
        }
        //define field index
        $this->fieldIndex = array(
            'personalFirstname'     => 1,
            'personalLastname'      => 2,
            'personalFamilystatus'  => 3,
            'personalGender'        => 4,
            'personalBirthday'      => 5,
            'personalBirthCountry'  => 6,
            'personalStreet'        => 7,
            'personalZip'           => 8,
            'personalCity'          => 9,
            'personalPhone'         => 10,
            'personalMobile'        => 11,
            'personalEmail'         => 12,
            'personalResidentAtParent'  => 13,
            'personalOwnRoom'       => 14,
            'personalRoomWithSiblings'  => 15,
            'personalNumberOfSiblings'  => 16,
            'personalMigrationBackground'   => 17,
            'personalNationality'   => 18,
            'personalResidentGerman'    => 19,
            'personalResidenceStatus'   => 20,
        );
    }

    /**
     * @param Candidate $candidate
     */
    protected function exportPersonalData(\MUM\TilApplication\Domain\Model\Candidate $candidate){

    }

    protected function exportFamilyData(\MUM\TilApplication\Domain\Model\Candidate $candidate){

    }

    protected function exportSchoolCareer(\MUM\TilApplication\Domain\Model\Candidate $candidate){

    }

    protected function exportIncome(\MUM\TilApplication\Domain\Model\Candidate $candidate){

    }

    protected function exportCosts(\MUM\TilApplication\Domain\Model\Candidate $candidate){

    }


}