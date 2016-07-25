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
        $this->candidateRepository = GeneralUtility::makeInstance('MUM\TilApplication\Domain\Repository\CandidateRepository');
        //$this->candidates = $this->candidateRepository->findAllApproved();
        $this->candidates = $this->candidateRepository->findAll();
        $this->init();

    }

    public function export(){
        $i = 1;
        foreach($this->candidates as $candidate){
            $row = array_fill(1 , count($this->fieldIndex), '');
            $this->exportPersonalData($candidate, $row);
            $this->exportSchoolCareer($candidate, $row);
            $this->exportFamilyData($candidate, $row);

            $this->exportIncome($candidate, $row);
            $this->exportCosts($candidate, $row);
            $this->exportDocument($candidate, $row);
            $this->data[$i++] = $row;
        }

        return $this->data;
        
    }

    public function writeCsv(){
        // create a file pointer connected to the output stream
        $output = fopen('php://output', 'w');

        // output the column headings
        fputcsv($output, $this->getHeaderRow(), ';');

        foreach($this->data as $row){
            fputcsv($output, $row, ';');
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
            'personalAtParent'      => 13,
            'personalOwnRoom'       => 14,
            'personalRoomWithSiblings'  => 15,
            'personalNumberOfSiblings'  => 16,
            'personalMigrationBackground'   => 17,
            'personalNationality'       => 18,
            'personalResidentGerman'    => 19,
            'personalResidenceStatus'   => 20,
            'personalResidenceMisc'     => 21,
            'school1Name'               => 22,
            'school1Type'               => 23,
            'school1SchoolYear'         => 24,
            'school1Street'             => 25,
            'school1Housenumber'        => 26,
            'school1Zip'                => 27,
            'school1City'               => 28,
            'school1Phone'              => 29,
            'school1Mobile'             => 30,
            'school1Email'              => 31,
            'schoolPlannedGraduationSelect' => 32,
            'schoolPlannedGraduationText' => 33,
            'schoolPlannedGraduationFinish' => 34,
            'schoolCertificateDate'        => 35,
            'schoolCertificatePoints'      => 36,
        );
        $index = 37;
        for($i = 1; $i <= $this->maxField['schools']; $i++){
            $this->fieldIndex['school'.($i + 1).'Name'] = $index++;
            $this->fieldIndex['school'.($i + 1).'From'] = $index++;
            $this->fieldIndex['school'.($i + 1).'To'] = $index++;
        }
        //family data
        $this->fieldIndex['familyMotherFirstname'] = $index++;
        $this->fieldIndex['familyMotherLastname'] = $index++;
        $this->fieldIndex['familyMotherBirthdate'] = $index++;
        $this->fieldIndex['familyMotherNationality'] = $index++;
        $this->fieldIndex['familyMotherEducationalQualification'] = $index++;
        $this->fieldIndex['familyMotherJob'] = $index++;

        $this->fieldIndex['familyFatherFirstname'] = $index++;
        $this->fieldIndex['familyFatherLastname'] = $index++;
        $this->fieldIndex['familyFatherBirthdate'] = $index++;
        $this->fieldIndex['familyFatherNationality'] = $index++;
        $this->fieldIndex['familyFatherEducationalQualification'] = $index++;
        $this->fieldIndex['familyFatherJob'] = $index++;

        for($i = 0; $i < $this->maxField['siblings']; $i++){
            $this->fieldIndex['familySibling' .($i +1) .'Firstname'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'Lastname'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'Birthdate'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'Nationality'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'EducationalQualification'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'Job'] = $index++;
        }
        //Income
        foreach(array('familyMother', 'familyFather') as $prefix) {
            $this->fieldIndex[$prefix . 'GrossSalary'] = $index++;
            $this->fieldIndex[$prefix . 'NetSalary'] = $index++;
            $this->fieldIndex[$prefix . 'SelfEmployedSalary'] = $index++;
            $this->fieldIndex[$prefix . 'Welfare'] = $index++;
            $this->fieldIndex[$prefix . 'UnemploymentBenefit'] = $index++;
            $this->fieldIndex[$prefix . 'HousingBenefit'] = $index++;
            $this->fieldIndex[$prefix . 'Pension'] = $index++;
            $this->fieldIndex[$prefix . 'OtherIncomes'] = $index++;
        }
        for($i = 0; $i < $this->maxField['siblings']; $i++){
            $this->fieldIndex['familySibling' .($i +1) .'GrossSalary'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'NetSalary'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'SelfEmployedSalary'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'Welfare'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'UnemploymentBenefit'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'HousingBenefit'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'Pension'] = $index++;
            $this->fieldIndex['familySibling' .($i +1) .'OtherIncomes'] = $index++;
        }
        $this->fieldIndex['familyAssetRealEstate'] = $index++;
        $this->fieldIndex['familyAssetSavings'] = $index++;
        $this->fieldIndex['familyAssetMiscEstate'] = $index++;

        //costs
        $this->fieldIndex['familyLivingCosts'] = $index++;
        $this->fieldIndex['familyCreditCosts'] = $index++;
        $this->fieldIndex['familyOtherOutgoings'] = $index++;
        $this->fieldIndex['personalTravelCosts'] = $index++;
        $this->fieldIndex['personalFurtherEducationCosts'] = $index++;
        $this->fieldIndex['personalPrivateCoachingCosts'] = $index++;
        $this->fieldIndex['personalRental'] = $index++;
        $this->fieldIndex['personalLivingCostsSingle'] = $index++;
        $this->fieldIndex['personalOtherCosts'] = $index++;

        $this->fieldIndex['documentsLiveSchoolCareer'] = $index++;
        $this->fieldIndex['documentsLiveCurriculumVitae'] = $index++;
        $this->fieldIndex['documentsSurvey'] = $index++;
        $this->fieldIndex['documentsCertificate1'] = $index++;
        $this->fieldIndex['documentsCertificate2'] = $index++;
        $this->fieldIndex['documentsCertificate3'] = $index++;
        $this->fieldIndex['documentsPassportPhoto'] = $index++;

        $this->data = range(1, count($this->candidates));
    }

    /**
     * @param Candidate $candidate
     * @param \array  $row
     */
    protected function exportPersonalData(\MUM\TilApplication\Domain\Model\Candidate $candidate, &$row){
        if(is_object($candidate->getFeUser())) {
            $row[$this->fieldIndex['personalFirstname']] = $candidate->getFeUser()->getFirstName();
            $row[$this->fieldIndex['personalLastname']] = $candidate->getFeUser()->getLastName();
            $row[$this->fieldIndex['personalFamilystatus']] = $candidate->getFamilyStatus();
            $row[$this->fieldIndex['personalGender']] = $this->translate($candidate->getGender());
            if(is_object($candidate->getBirthdate())){
                $row[$this->fieldIndex['personalBirthday']] = $candidate->getBirthdate()->format('d.m.Y');
            }else{
                $row[$this->fieldIndex['personalBirthday']] = 'Keine Angabe';
            }
            $row[$this->fieldIndex['personalBirthCountry']] = $candidate->getCountryOfBirth();
            $row[$this->fieldIndex['personalStreet']] = $candidate->getAddress()->getStreet();
            $row[$this->fieldIndex['personalZip']] = $candidate->getAddress()->getZip();
            $row[$this->fieldIndex['personalCity']] = $candidate->getAddress()->getCity();
            $row[$this->fieldIndex['personalPhone']] = $this->asCsvString($candidate->getAddress()->getPhone());
            $row[$this->fieldIndex['personalMobile']] = $this->asCsvString($candidate->getAddress()->getMobile());
            $row[$this->fieldIndex['personalEmail']] = $candidate->getAddress()->getEmail();
            $row[$this->fieldIndex['personalAtParent']] = $this->translate($candidate->getAddress()->getAtParent());
            $row[$this->fieldIndex['personalOwnRoom']] = $this->translate($candidate->getAddress()->getOwnRoom());
            $row[$this->fieldIndex['personalRoomWithSiblings']] = $this->translate($candidate->getAddress()->getSiblingRoom());
            $row[$this->fieldIndex['personalNumberOfSiblings']] = $candidate->getAddress()->getSiblingRoomNumber();
            $row[$this->fieldIndex['personalMigrationBackground']] = $this->translate($candidate->getMigrationBackground());
            $row[$this->fieldIndex['personalNationality']] = $candidate->getNationality();
            $row[$this->fieldIndex['personalResidentGerman']] = $candidate->getResidentSince();
            $row[$this->fieldIndex['personalResidenceStatus']] = Candidate::residenceStatus()[$candidate->getResidenceStatus()];
            $row[$this->fieldIndex['personalResidenceMisc']] = $candidate->getResidenceMisc();
        }
    }

    protected function exportFamilyData(\MUM\TilApplication\Domain\Model\Candidate $candidate, &$row){
        $actualFamily = $candidate->getWholeFamily(false);
        $siblingCounter = 0;
        /** @var  $relative \MUM\TilApplication\Domain\Model\Relative */
        foreach($actualFamily as $relative){
            $prefix = '';
            if($relative->isMother()){
                $prefix = 'familyMother';
            }elseif($relative->isFather()){
                $prefix = 'familyFather';
            }elseif($relative->isSibling()){
                $siblingCounter++;
                $prefix = 'familySibling' . $siblingCounter;
            }
            if(!empty($prefix)){
                $row = $this->_exportRelativeData($relative, $prefix, $row);
            }
        } 
    }

    protected function exportSchoolCareer(\MUM\TilApplication\Domain\Model\Candidate $candidate, &$row){
        $actualSchool = $candidate->getActualSchool();
        if(is_object($actualSchool)) {
            $row[$this->fieldIndex['school1Name']] = $actualSchool->getName();
            $row[$this->fieldIndex['school1Type']] = $actualSchool->getTypeOfSchool();
            $row[$this->fieldIndex['school1SchoolYear']] = $actualSchool->getSchoolYear();
            $row[$this->fieldIndex['school1Street']] = $actualSchool->getAddress()->getStreet();
            $row[$this->fieldIndex['school1Housenumber']] = $actualSchool->getAddress()->getHousenumber();
            $row[$this->fieldIndex['school1Zip']] = $actualSchool->getAddress()->getZip();
            $row[$this->fieldIndex['school1City']] = $actualSchool->getAddress()->getCity();
            $row[$this->fieldIndex['school1Phone']] = $this->asCsvString($actualSchool->getAddress()->getPhone());
            $row[$this->fieldIndex['school1Mobile']] = $this->asCsvString($actualSchool->getAddress()->getMobile());
            $row[$this->fieldIndex['school1Email']] = $actualSchool->getAddress()->getEmail();
            $row[$this->fieldIndex['schoolPlannedGraduationSelect']] = $actualSchool->getPlannedGraduationSelect();
            $row[$this->fieldIndex['schoolPlannedGraduationText']] = $actualSchool->getPlannedGraduationText();
            $row[$this->fieldIndex['schoolPlannedGraduationFinish']] = $actualSchool->getPlannedGraduationFinish();
            if(is_object($actualSchool->getSchoolCertificateDate())){
                $row[$this->fieldIndex['schoolCertificateDate']] = $actualSchool->getSchoolCertificateDate()->format('d.m.Y');
            }else{
                $row[$this->fieldIndex['schoolCertificateDate']] = 'Keine Angabe';
            }
            $row[$this->fieldIndex['schoolCertificatePoints']] = $actualSchool->getSchoolCertificatePoints();
        }else{
            $row[$this->fieldIndex['school1Name']] = 'Keinen Eintrag für eine aktuelle Schule gefunden.';
        }
        $otherSchools = $candidate->getOtherSchools();
        if(count($otherSchools) > 0){
            $i = 2;
            /** @var  $school \MUM\TilApplication\Domain\Model\School */
            foreach($otherSchools as $school){
                if(is_object($school)) {
                    $row[$this->fieldIndex['school' . $i . 'Name']] = $school->getName();
                    $row[$this->fieldIndex['school' . $i . 'From']] = $school->getVisitFrom();
                    $row[$this->fieldIndex['school' . $i . 'To']] = $school->getVisitTil();
                    $i++;
                }
            }
        }

    }

    protected function exportIncome(\MUM\TilApplication\Domain\Model\Candidate $candidate, &$row){
        $actualFamily = $candidate->getWholeFamily(false);
        $siblingCounter = 0;
        /** @var  $relative \MUM\TilApplication\Domain\Model\Relative */
        foreach($actualFamily as $relative){
            $prefix = '';
            if($relative->isMother()){
                $prefix = 'familyMother';
            }elseif($relative->isFather()){
                $prefix = 'familyFather';
            }elseif($relative->isSibling()){
                $siblingCounter++;
                $prefix = 'familySibling' . $siblingCounter;
            }
            if(!empty($prefix)){
                $row = $this->_exportRelativeIncome($relative, $prefix, $row);
            }
        }
        $row[$this->fieldIndex['familyAssetRealEstate']] = $candidate->getAssetRealEstate();
        $row[$this->fieldIndex['familyAssetSavings']] = $candidate->getAssetSavings();
        $row[$this->fieldIndex['familyAssetMiscEstate']] = $candidate->getAssetMiscEstate();

    }

    protected function exportCosts(\MUM\TilApplication\Domain\Model\Candidate $candidate, &$row){
        if(is_object($candidate->getCosts())) {
            $row[$this->fieldIndex['familyLivingCosts']] = $candidate->getCosts()->getLivingCosts();
            $row[$this->fieldIndex['familyCreditCosts']] = $candidate->getCosts()->getCreditCosts();
            $row[$this->fieldIndex['familyOtherOutgoings']] = $candidate->getCosts()->getOtherOutgoings();
            $row[$this->fieldIndex['personalTravelCosts']] = $candidate->getCosts()->getTravelCosts();
            $row[$this->fieldIndex['personalFurtherEducationCosts']] = $candidate->getCosts()->getFurtherEducationCosts();
            $row[$this->fieldIndex['personalPrivateCoachingCosts']] = $candidate->getCosts()->getPrivateCoachingCosts();
            $row[$this->fieldIndex['personalRental']] = $candidate->getCosts()->getRental();
            $row[$this->fieldIndex['personalLivingCostsSingle']] = $candidate->getCosts()->getLivingCostsSingle();
            $row[$this->fieldIndex['personalOtherCosts']] = $candidate->getCosts()->getOtherCosts();
        }else{
            $row[$this->fieldIndex['familyLivingCosts']] = 0;
            $row[$this->fieldIndex['familyCreditCosts']] = 0;
            $row[$this->fieldIndex['familyOtherOutgoings']] = 0;
            $row[$this->fieldIndex['personalTravelCosts']] = 0;
            $row[$this->fieldIndex['personalFurtherEducationCosts']] = 0;
            $row[$this->fieldIndex['personalPrivateCoachingCosts']] = 0;
            $row[$this->fieldIndex['personalRental']] = 0;
            $row[$this->fieldIndex['personalLivingCostsSingle']] = 0;
            $row[$this->fieldIndex['personalOtherCosts']] = 0;
        }
    }

    protected function exportDocument(\MUM\TilApplication\Domain\Model\Candidate $candidate, &$row){
        if(is_object($candidate->getDocuments())) {
            $row[$this->fieldIndex['documentsLiveSchoolCareer']] = $candidate->getDocuments()->getLifeSchoolCareer();
            $row[$this->fieldIndex['documentsLiveCurriculumVitae']] = $candidate->getDocuments()->getCurriculumVitae();
            $row[$this->fieldIndex['documentsSurvey']] = $candidate->getDocuments()->getSurvey();
            $row[$this->fieldIndex['documentsCertificate1']] = $candidate->getDocuments()->getCertificate1();
            $row[$this->fieldIndex['documentsCertificate2']] = $candidate->getDocuments()->getCertificate2();
            $row[$this->fieldIndex['documentsCertificate3']] = $candidate->getDocuments()->getCertificate3();
            $row[$this->fieldIndex['documentsPassportPhoto']] = $candidate->getDocuments()->getPassportPhoto();
        }else{
            $row[$this->fieldIndex['documentsLiveSchoolCareer']] = 'Kein Dokument hochgeladen';
            $row[$this->fieldIndex['documentsLiveCurriculumVitae']] = 'Kein Dokument hochgeladen';
            $row[$this->fieldIndex['documentsSurvey']] = 'Kein Dokument hochgeladen';
            $row[$this->fieldIndex['documentsCertificate1']] = 'Kein Dokument hochgeladen';
            $row[$this->fieldIndex['documentsCertificate2']] = 'Kein Dokument hochgeladen';
            $row[$this->fieldIndex['documentsCertificate3']] = 'Kein Dokument hochgeladen';
            $row[$this->fieldIndex['documentsPassportPhoto']] = 'Kein Dokument hochgeladen';

        }
    }

    /**
     * @param $value
     * @return string
     * translate $value in a human readable message
     */
    protected function translate($value){
        $translation = '';
        if(is_bool($value)){
            $translation = $value ? 'ja' : 'nein';
        }else {
            switch ($value) {
                case 'male':
                    $translation = 'männlich';
                    break;
                case 'female':
                    $translation = 'weiblich';
                    break;
            }
        }

        return $translation;
    }

    protected function asCsvString($value){
        return "'" . $value ."'";
    }

    /**
     * @param $relative \MUM\TilApplication\Domain\Model\Relative
     * @param $row
     */
    protected function _exportRelativeData($relative, $prefix, $row)
    {
        $row[$this->fieldIndex[$prefix . 'Firstname']] = $relative->getFirstName();
        $row[$this->fieldIndex[$prefix . 'Lastname']] = $relative->getLastName();
        if(is_object($relative->getBirthdate())){
            $row[$this->fieldIndex[$prefix . 'Birthdate']] = $relative->getBirthdate()->format('d.m.Y');
        }else{
            $row[$this->fieldIndex[$prefix . 'Birthdate']] = 'Keine Angabe';
        }
        $row[$this->fieldIndex[$prefix . 'Nationality']] = $relative->getNationality();
        $row[$this->fieldIndex[$prefix . 'EducationalQualification']] = $relative->getEducationalQualification();
        $row[$this->fieldIndex[$prefix . 'Job']] = $relative->getJob();

        return $row;
    }


    /**
     * @param $relative \MUM\TilApplication\Domain\Model\Relative
     * @param $prefix  \string
     * @param $row    \array
     */
    protected function _exportRelativeIncome($relative, $prefix, $row)
    {
        if(is_object($relative->getIncome())){

            $row[$this->fieldIndex[$prefix . 'GrossSalary']] = $relative->getIncome()->getGrossSalary();
            $row[$this->fieldIndex[$prefix . 'NetSalary']] = $relative->getIncome()->getNetSalary();
            $row[$this->fieldIndex[$prefix . 'SelfEmployedSalary']] = $relative->getIncome()->getSelfEmployedSalary();
            $row[$this->fieldIndex[$prefix . 'Welfare']] = $relative->getIncome()->getWelfare();
            $row[$this->fieldIndex[$prefix . 'UnemploymentBenefit']] = $relative->getIncome()->getUnemploymentBenefit();
            $row[$this->fieldIndex[$prefix . 'HousingBenefit']] = $relative->getIncome()->getHousingBenefit();
            $row[$this->fieldIndex[$prefix . 'Pension']] = $relative->getIncome()->getPension();
            $row[$this->fieldIndex[$prefix . 'OtherIncomes']] = $relative->getIncome()->getOtherIncomes();
        }else{
            //DebuggerUtility::var_dump($relative, "Fehler bei Einkommen auslesen");
            $row[$this->fieldIndex[$prefix . 'GrossSalary']] = 0;
            $row[$this->fieldIndex[$prefix . 'NetSalary']] = 0;

            $row[$this->fieldIndex[$prefix . 'SelfEmployedSalary']] = 0;
            $row[$this->fieldIndex[$prefix . 'Welfare']] = 0;
            $row[$this->fieldIndex[$prefix . 'UnemploymentBenefit']] = 0;
            $row[$this->fieldIndex[$prefix . 'HousingBenefit']] = 0;
            $row[$this->fieldIndex[$prefix . 'Pension']] = 0;
            $row[$this->fieldIndex[$prefix . 'OtherIncomes']] = 0;

        }

        return $row;
    }


    /**
     * @return array
     */
    public function getFieldIndex()
    {
        return $this->fieldIndex;
    }


    protected function getHeaderRow(){
        $headerRow = [
            'Vorname',
            'Nachname',
            'Familienstand',
            'Geschlecht',
            'Geburtsdatum',
            'Geburtsland',
            'Straße',
            'PLZ',
            'Wohnort',
            'Telefonnummer',
            'Mobilnr.',
            'E-Mail',
            'Wohnung bei den Eltern',
            'Eigenes Zimmer',
            'Zimmer mit Geschwister',
            'Anzahl der Geschwister im Zimmer',
            'Migrationshintergrund',
            'Staatsangehörigkeit',
            'Wohnhaft in Deutschland seit',
            'Aufenthaltsstatus',
            'Sonstiges',
            'Name der derzeitigen Schule',
            'Schulart',
            'Jahrgangsstufe',
            'Straße',
            'Hausnummer',
            'PLZ',
            'Ort',
            'Telefonnummer',
            'Mobilnr.',
            'E-Mail',
            'Bezeichnung des Schulabschluss',
            'Schulabschluss (freier Text)',
            'Geplanter Schulabschluss',
            'Datum des letzten Zeugnisses',
            'Notendurchschnitt',
        ];
        for($i = 1; $i <= $this->maxField['schools']; $i++){
            $headerRow[] = 'Schulname ' . $i;
            $headerRow[] = 'Schulbesuch von ';
            $headerRow[] = 'Schulbesuch bis ';
        }
        $headerRow[] = 'Vorname der Mutter';
        $headerRow[] = 'Nachname der Mutter';
        $headerRow[] = 'Geburtstag der Mutter';
        $headerRow[] = 'Nationalität der Mutter';
        $headerRow[] = 'Bildungsabschluss der Mutter';
        $headerRow[] = 'Beruf der Mutter';

        $headerRow[] = 'Vorname des Vaters';
        $headerRow[] = 'Nachname des Vaters';
        $headerRow[] = 'Geburtstag des Vaters';
        $headerRow[] = 'Nationalität des Vaters';
        $headerRow[] = 'Bildungsabschluss des Vaters';
        $headerRow[] = 'Beruf des Vaters';

        for($i = 0; $i < $this->maxField['siblings']; $i++){
            $sibling = $i + 1;
            $headerRow[] = "Vorname des $sibling. Geschwister";
            $headerRow[] = "Nachname des $sibling. Geschwister";
            $headerRow[] = "Geburtstag des $sibling. Geschwister";
            $headerRow[] = "Nationalität des $sibling. Geschwister";
            $headerRow[] = "Bildungsabschluss des $sibling. Geschwister";
            $headerRow[] = "Beruf des $sibling. Geschwister";
        }
        $headerRow[] = 'Bruttoeinkommen der Mutter';
        $headerRow[] = 'Nettoeinkommen der Mutter';
        $headerRow[] = 'Nettoeinkommen aus Selbstständigkeit der Mutter';
        $headerRow[] = 'Sozialhilfe der Mutter';
        $headerRow[] = 'Arbeitslosengeld der Mutter';
        $headerRow[] = 'Wohngeld der Mutter';
        $headerRow[] = 'Rente, Bafög der Mutter';
        $headerRow[] = 'Sonstige Einnahmen der Mutter';

        $headerRow[] = 'Bruttoeinkommen des Vaters';
        $headerRow[] = 'Nettoeinkommen des Vaters';
        $headerRow[] = 'Nettoeinkommen aus Selbstständigkeit des Vaters';
        $headerRow[] = 'Sozialhilfe des Vaters';
        $headerRow[] = 'Arbeitslosengeld des Vaters';
        $headerRow[] = 'Wohngeld des Vaters';
        $headerRow[] = 'Rente, Bafög des Vaters';
        $headerRow[] = 'Sonstige Einnahmen des Vaters';

        for($i = 0; $i < $this->maxField['siblings']; $i++){
            $sibling = $i + 1;
            $headerRow[] = "Bruttoeinkommen des $sibling. Geschwister";
            $headerRow[] = "Nettoeinkommen des $sibling. Geschwister";
            $headerRow[] = "Nettoeinkommen aus Selbstständigkeit des $sibling. Geschwister";
            $headerRow[] = "Sozialhilfe des $sibling. Geschwister";
            $headerRow[] = "Arbeitslosengeld des $sibling. Geschwister";
            $headerRow[] = "Wohngeld des $sibling. Geschwister";
            $headerRow[] = "Rente, Bafög des $sibling. Geschwister";
            $headerRow[] = "Sonstige Einnahmen des $sibling. Geschwister";
        }

        $headerRow[] = 'Haus- und Grundbesitz';
        $headerRow[] = 'Sparguthaben, Wertpapiere';
        $headerRow[] = 'Sonstiges Vermögen';

        $headerRow[] = 'Lebenshaltungskosten';
        $headerRow[] = 'Kredittilgung / Zinsen';
        $headerRow[] = 'Sonstiges';
        $headerRow[] = 'Fahrtkosten mtl.';
        $headerRow[] = 'Kurse mtl.';
        $headerRow[] = 'Nachhilfe mtl.';
        $headerRow[] = 'Miete mtl.';
        $headerRow[] = 'Lebenshaltungskosten f. Bewerber';
        $headerRow[] = 'Sonstige Kosten';

        $headerRow[] = 'Lebens-und Bildungsweg';
        $headerRow[] = 'Lebenslauf';
        $headerRow[] = 'Gutachten';
        $headerRow[] = '1.Zeugnis';
        $headerRow[] = '2.Zeugnis';
        $headerRow[] = '3.Zeugnis';
        $headerRow[] = 'Passfoto';

        return $headerRow;
    }


}