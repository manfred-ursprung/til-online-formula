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


class FileUploader{
    /**
     * objectManager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     * Upload file
     *
     * @param \string $imageField
     * @param \string $dbFieldName
     * @param \string $prefix
     * @return mixed	false or file.png
     */
    public function uploadFile($imageField, $dbFieldName, $prefix) {
        // Check file extension
        if (empty($imageField[
            'name']) || !self::checkExtension($imageField['name'], $dbFieldName)) {
            return FALSE;
        }
        // create new filename and upload it
        /** @var  $basicFileFunctions \TYPO3\CMS\Core\Utility\File\BasicFileUtility */
        $basicFileFunctions = $this->objectManager->get('TYPO3\\CMS\\Core\\Utility\\File\\BasicFileUtility');
        $newFile = $basicFileFunctions->getUniqueName(
            $prefix .'_' . $imageField['name'],
            GeneralUtility::getFileAbsFileName( self::getUploadFolderFromTca($dbFieldName) )
        );
        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($newFile,'$newFile in uploadFile()');
        if (GeneralUtility::upload_copy_move($imageField['tmp_name'], $newFile)) {
            $fileInfo = pathinfo($newFile);
            return $fileInfo['basename'];
        }
        return FALSE;
    }

    /**
     * Check extension of given filename
     *
     * @param \string		Filename like (upload.png)
     * @return \bool		If Extension is allowed
     */
    public static function checkExtension($filename, $dbFieldName) {
        $extensionList = $GLOBALS['TCA']['tx_tilapplication_domain_model_documents']['columns'][$dbFieldName]['config']['allowed'];
        $fileInfo = pathinfo($filename);
        if (!empty($fileInfo['extension']) && GeneralUtility::inList($extensionList, strtolower($fileInfo['extension']))) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Read image uploadfolder from TCA
     *
     * @return \string path - standard "uploads/pics"
     */
    public static function getUploadFolderFromTca($dbFieldName) {
        $path = $GLOBALS['TCA']['tx_tilapplication_domain_model_documents']['columns'][$dbFieldName]['config']['uploadfolder'];
        if (empty($path)) {
            $path = 'uploads/pics';
        }
        return $path;
    }


}