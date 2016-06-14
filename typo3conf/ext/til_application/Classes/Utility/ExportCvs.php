<?php
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

class ExportCvs{

    /**
     * candidateRepository
     *
     * @var \MUM\TilApplication\Domain\Repository\CandidateRepository
     * @inject
     */
    protected $candidateRepository = NULL;


    protected $data;


    public function __construct(){

    }

    public function export(){
        //get all candidates
        $candidates = $this->candidateRepository->findAllApproved();
    }
}