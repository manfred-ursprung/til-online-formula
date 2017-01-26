<?php
namespace MUM\TilAlumni\Service;

use MUM\TilAlumni\Domain\Model\Alumni;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use TYPO3\CMS\Extbase\Property\PropertyMapper;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use MUM\TilAlumni\Exception;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * This class provides import functionality for the backend module.
 * It is called from the Backend controller ImporterController
 *
 * @author Manfred Ursprung <manfred@manfred-ursprung.de>
 *
 */

class Importer {

    /**
     * @var \string
     */
    protected $filePath;

    /** @var  \array */
    protected $fields;


    /**
     * @var \TYPO3\CMS\Extbase\Property\PropertyMapper
     * @inject
     */
    protected $propertyMapper;

    /**
     * alumniRepository
     *
     * @var \MUM\TilAlumni\Domain\Repository\AlumniRepository
     * @inject
     */
    protected $alumniRepository = NULL;

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     * @inject
     */
    protected $objectManager;

    /**
     * @var \array
     */
    protected $importResult;


    const NUMBER_FIELDS = 39;


    public function __construct() {

    }

    public function startImport($importFile) {
        $this->filePath = $importFile;
        $handle = fopen($importFile, "r");
        $data = '';

        while (!feof($handle)) {
            $data .= fread($handle, 8192);
        }
        fclose($handle);

        $data=explode(chr(10),$data);
        $this->fields = $this->parseHeader($data);

        try {
            $number = $this->doImport($data);
        } catch(Exception $e){
            $this->importResult =  array('error' => true,
                        'message' => $e->getMessage() );
            return $this->importResult;
        }
        $this->importResult =  array('error' => false,
                    'message' => sprintf('Es wurden %d Alumnis importiert', $number) );
        return $this->importResult;

    }

    public function getImportSummary() {
        return $this->importResult;
    }

    /**
     * @param \array $data is changed after method call
     * @return mixed
     * @throws Exception
     */
    protected function parseHeader(&$data ){
        $header = explode(";", $data[0]);
        unset($data[0]);
        if (count($header) != self::NUMBER_FIELDS){
            throw new Exception('Anzahl der Felder stimmt nicht', 1485182853 );
        }
        $fields['tx_tilalumni_domain_model_alumni'] = array(
            'firstname',
            'lastname',
            'gender',
            'birthday',
            'street',
            'zip',
            'city',
            'cityOfBirth',
            'countryOfBirth',
            'languageSkills',
            'scholarshipPeriod',
            'typeOfSchool',
            'universityCourse',
            'university',
            'graduation',
            'profession',
            'hobbys',
            'email',
            'mobile',
            'lifeMotto',
            'studentCounseilling',
            'network',
            //'tstamp',
            'pid'
        );
        $fields['tx_tilalumni_domain_model_network'] = array(
            'languageSkills',
            'schoolCareer',
            'personalExperiences',
            'adviceTopics',
            'pid'
        );
        $fields['tx_tilalumni_domain_model_studentcounseilling'] = array(
            'qualification1',
            'qualification2',
            'opportunitiesAfterStudy',
            'universityInformations',
            'localInformations',
            'priorUniversityExperiences',
            'activities',
            'scholarships',
            'semesterAbroad',
            'tip1',
            'tip2',
            'tip3',
            'tip4',
            'tip5',
            'studySlogan',
            'pid'
        );
        return $fields;
    }

    protected function doImport($data){
        $importCounter = 0;
        foreach($data as $row){
            /** @var $alumni Alumni */
            list($alumni, $i) = $this->importAlumni($row);
            if (is_object($alumni)) {

                list($studentCounseilling, $i) = $this->importStudentCounseilling($row, $i);
                list($network, $i) = $this->importNetwork($row, $i);
                if (is_object($studentCounseilling)) {
                    $alumni->setStudentCounseilling($studentCounseilling);
                }
                if (is_object($network)) {
                    $alumni->setNetwork($network);
                }
                $this->alumniRepository->add($alumni);
                $importCounter++;
            }

        }
        $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class)->persistAll();
        return $importCounter;
    }

    /**
     * @param $row
     * @return array
     */
    protected function importAlumni($row)
    {
        $i = 0;
        $alumni = false;
        $row = explode(";", $row);
        $pData = [];
        if (count($row) > 1) {
            foreach ($this->fields['tx_tilalumni_domain_model_alumni'] as $key => $field) {
                switch ($field) {
                    case 'pid':
                        $pData[$field] = $_POST['pid'];
                        break;
                    case 'tstamp':
                        $pData[$field] = time();
                        break;
                    case 'studentCounseilling':
                    case 'network' :
                        break;
                    case 'birthday':
                        //Sonderbehandlung
                        if (strtotime($row[$i]) !== false) {
                            $pData[$field] = strtotime($row[$i]);
                        }
                        $i++;
                        break;
                    case 'gender':
                        $pData[$field] = $row[$i] == 'Weiblich' ? 'female' : 'male';
                        $i++;
                        break;
                    default:
                        $pData[$field] = $row[$i];
                        $i++;
                        break;
                }
            }
            $alumni = $this->propertyMapper->convert($pData, \MUM\TilAlumni\Domain\Model\Alumni::class);
            //DebuggerUtility::var_dump($alumni, 'Importer');
        }
        return array($alumni, $i);
    }


    /**
     * @param $row
     * @return array
     */
    protected function importStudentCounseilling($row, $i)
    {
        //$i = 0;
        $studentCounseilling = false;
        $row = explode(";", $row);
        $pData = [];
        foreach ($this->fields['tx_tilalumni_domain_model_studentcounseilling'] as $key => $field) {
            switch ($field) {
                case 'pid':
                    $pData[$field] = $_POST['pid'];
                    break;
                default:
                    if(!empty($row[$i])) {
                        $pData[$field] = $row[$i];
                    }
                    $i++;
                    break;
            }
        }
        if (count($pData) > 1) {
            $studentCounseilling = $this->propertyMapper->convert($pData, \MUM\TilAlumni\Domain\Model\StudentCounseilling::class);
            //DebuggerUtility::var_dump($studentCounseilling, 'Importer');
        }

        return array($studentCounseilling, $i);
    }


    /**
     * @param $row
     * @return array
     */
    protected function importNetwork($row, $i)
    {
        //$i = 0;
        $network = false;
        $row = explode(";", $row);
        $pData = [];

        foreach ($this->fields['tx_tilalumni_domain_model_network'] as $key => $field) {
            switch ($field) {
                case 'pid':
                    $pData[$field] = $_POST['pid'];
                    break;
                default:
                    if(!empty($row[$i])) {
                        $pData[$field] = $row[$i];
                    }
                    $i++;
                    break;
            }
        }
        if (count($pData) > 1) {
            $network = $this->propertyMapper->convert($pData, \MUM\TilAlumni\Domain\Model\Network::class);
            //DebuggerUtility::var_dump($studentCounseilling, 'Importer');
        }

        //DebuggerUtility::var_dump($i, 'in importNetwork Ende');
        return array($network, $i);
    }

}