<?php
namespace MUM\TilAlumni\Service;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * Created by PhpStorm.
 * User: manfred
 * Date: 19.01.17
 * Time: 08:58
 */

class AjaxSearch
{

    /**
     * alumniRepository
     *
     * @var \MUM\TilAlumni\Domain\Repository\AlumniRepository
     * @inject
     */
    protected $alumniRepository = NULL;






    /**
     * @param $formArgs
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     * return search result
     */
    public function search($formArgs){
        if(isset($formArgs['plugin'])){
            switch($formArgs['plugin']){
                case 'network':
                case 'studentCounseilling':
                    $formArgs[$formArgs['plugin']] = 1;
                    break;
            }
            unset($formArgs['plugin']);
        }
        //return serialize($formArgs);
        return $this->alumniRepository->findByFormArgs($formArgs);
    }


}