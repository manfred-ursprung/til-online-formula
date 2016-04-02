<?php
namespace MUM\TilApplication\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Manfred Ursprung <manfred@manfred-ursprung.de>, Webapplikationen Ursprung
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
 *
 *
 * @package til_application
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {




    /**
     * @return array
     */
    protected function getFullTypoScript()
    {
        return $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);

    }

    /**
     * @param $message
     * @param string $title
     * @param int $severity
     */
    protected function setFlashMessage($message, $title = '', $severity = \TYPO3\CMS\Core\Messaging\FlashMessage::OK)
    {
        //Flashmessage
        // eigene Message setzten, "OK" setzt hier den grauen Ausgabekasten im BE
        $this->controllerContext->getFlashMessageQueue()->enqueue(
            $this->objectManager->get(
                'TYPO3\\CMS\\Core\\Messaging\\FlashMessage',
                $message,
                $title,
                $severity,
                false
            )
        );
    }


    /**
     * A template method for displaying custom error flash messages, or to
     * display no flash message at all on errors. Override this to customize
     * the flash message in your action controller.
     *
     * @return string The flash message or FALSE if no flash message should be set
     * @api
     */
    protected function getErrorFlashMessage() {
        return 'Ein Fehler ist aufgetreten bei der Überprüfung der Daten. <br />Bitte korrigieren Sie das rot hervorgehobene Feld.';
    }


    /**
     * This creates another stand-alone instance of the Fluid view to render a template
     * @param string $templateName the name of the template to use
     * @param string $format the format of the fluid template "html" or "txt"
     * @return  \TYPO3\CMS\Fluid\View\StandaloneView the Fluid instance
     */
    protected function getPlainRenderer($templateName = 'default', $format = 'html') {
        $view = $this->objectManager->create('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
        $view->setFormat($format);

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']);
        //echo 'TemplateRootPath: ' . $templateRootPath;
        $templatePathAndFilename = $templateRootPath . $this->request->getControllerName().'/' . $templateName . '.' . $format;
        //echo 'TemplatePathAndFilename: ' . $templatePathAndFilename;
        $view->setTemplatePathAndFilename($templatePathAndFilename);
        $layoutRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['layoutRootPath']);
        $view->setLayoutRootPath($layoutRootPath);
        $partialsRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['partialRootPath']);
        $view->setPartialRootPath($partialsRootPath);
        $view->assign('settings', $this->settings);
        return $view;
    }


    protected function errorAction() {

        $this->clearCacheOnError();
        if ($this->configurationManager->isFeatureEnabled('rewrittenPropertyMapper')) {
            $errorFlashMessage = $this->getErrorFlashMessage();
            if ($errorFlashMessage !== FALSE) {
                $errorFlashMessageObject = new \TYPO3\CMS\Core\Messaging\FlashMessage(
                    $errorFlashMessage,
                    '',
                    \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR
                );
                $this->controllerContext->getFlashMessageQueue()->enqueue($errorFlashMessageObject);
            }
            $referringRequest = $this->request->getReferringRequest();
            if ($referringRequest !== NULL) {

                $originalRequest = clone $this->request;
                $this->request->setOriginalRequest($originalRequest);
                $this->request->setOriginalRequestMappingResults($this->arguments->getValidationResults());
                $this->forward($referringRequest->getControllerActionName(), $referringRequest->getControllerName(), $referringRequest->getControllerExtensionName(), $referringRequest->getArguments());
            }
            $message = 'Ein Fehler ist aufgetreten bei der Überprüfung der Daten. ' . PHP_EOL;
            return $message;
        } else {
            // @deprecated since Extbase 1.4.0, will be removed two versions after Extbase 6.1
            $this->request->setErrors($this->argumentsMappingResults->getErrors());
            $errorFlashMessage = $this->getErrorFlashMessage();
            if ($errorFlashMessage !== FALSE) {
                $errorFlashMessageObject = new \TYPO3\CMS\Core\Messaging\FlashMessage(
                    $errorFlashMessage,
                    '',
                    \TYPO3\CMS\Core\Messaging\FlashMessage::ERROR
                );
                $this->controllerContext->getFlashMessageQueue()->enqueue($errorFlashMessageObject);
            }
            $referrer = $this->request->getInternalArgument('__referrer');
            if ($referrer !== NULL) {
                $this->forward($referrer['actionName'], $referrer['controllerName'], $referrer['extensionName'], $this->request->getArguments());
            }
            $message = 'Ein Fehler ist aufgetreten bei der Überprüfung der Daten von mirrrr. ' . PHP_EOL;
            return $message;
        }
    }
}
