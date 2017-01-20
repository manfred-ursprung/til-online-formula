<?php
namespace MUM\TilAlumni\Controller;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use MUM\TilAlumni\Service\AjaxSearch;

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
 * AlumniController
 */
class AlumniBaseController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

    /**
     * alumniRepository
     *
     * @var \MUM\TilAlumni\Domain\Repository\AlumniRepository
     * @inject
     */
    protected $alumniRepository = NULL;

    /**
     *
     * @var \TYPO3\CMS\Core\Page\PageRenderer
     * @inject
     */
    protected $pageRenderer;

    /**
     * @var boolean
     */
    protected $activeSession;


    public function initializeListAction(){
        $this->addJsToPage();
        $this->addCssToPage();
        $this->activeSession = $GLOBALS['TSFE']->loginUser;
    }

    /**
     * action search
     * Respons after submitting search form, ajax driven
     * @return void
     */
    public function searchAction() {

        if($this->request->hasArgument('alumni-search')) {
            $formArgs = $this->request->getArgument('alumni-search');
            //DebuggerUtility::var_dump($formArgs);
            /** @var AjaxSearch $ajaxSearch */
            $ajaxSearch = $this->objectManager->get(AjaxSearch::class);
            $data = $ajaxSearch->search($formArgs);
            //$data = $this->alumniRepository->findByFormArgs($formArgs);
            //return $this->debugQuery($data);
//return serialize($data);
            $this->view->assignMultiple(array(
                'alumnis'  => $data,
                'public'    => !$this->activeSession,
            ));

        }else{
            return "no Argument found";
        }

    }

    /**
     * add javascript file to page
     */
    protected function addJsToPage()
    {
        $jsScripts = $this->settings['javascript'];
        //DebuggerUtility::var_dump($this->settings, 'before Loading');
        foreach ($jsScripts as $js) {
            if (strpos($js, 'EXT:') === 0) {
                list($extKey, $local) = explode('/', substr($js, 4), 2);
                $jsPath = '';
                if ((string)$extKey !== '' && ExtensionManagementUtility::isLoaded($extKey) && (string)$local !== '') {
                    $jsPath = ExtensionManagementUtility::extRelPath($extKey) . $local;
                }
            }
            //DebuggerUtility::var_dump($jsPath, "jedes einzelne file");
            //DebuggerUtility::var_dump($js, "jedes einzelne file");
            if (strlen($jsPath) > 0) {
                $this->pageRenderer->addJsFooterFile($jsPath, 'text/javascript', false, false);
            }
        }
    }

    /**
     * Stylesheet file includen
     */
    protected function addCssToPage()
    {
        $cssScripts = $this->settings['css'];
        //DebuggerUtility::var_dump($this->settings, 'before Loading');
        foreach ($cssScripts as $key => $css) {
            if (strpos($css, 'EXT:') === 0) {
                list($extKey, $local) = explode('/', substr($css, 4), 2);
                $cssPath = '';
                if ((string)$extKey !== '' && ExtensionManagementUtility::isLoaded($extKey) && (string)$local !== '') {
                    $cssPath = ExtensionManagementUtility::extRelPath($extKey) . $local;
                }
            }
            //DebuggerUtility::var_dump($cssPath, "jedes einzelne file");
            //DebuggerUtility::var_dump($css, "jedes einzelne file");
            if (strlen($cssPath) > 0) {
                if($key == 'tabulous'){
                    $forceOnTop = true;
                }else{
                    $forceOnTop = false;
                }
                $this->pageRenderer->addCssFile($cssPath, 'stylesheet', 'all', $key, true, $forceOnTop);
            }
        }
    }
}