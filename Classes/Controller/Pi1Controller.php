<?php
namespace Heilmann\JhPhotoswipe\Controller;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014-2016 Jonathan Heilmann <mail@jonathan-heilmann.de>
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
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class Pi1Controller
 * @package Heilmann\JhPhotoswipe\Controller
 */
class Pi1Controller extends ActionController
{

    /**
     * PageRepository
     *
     * @var \TYPO3\CMS\Frontend\Page\PageRepository
     * @inject
     */
    protected $pageRepository = null;

    /**
     * File Repository
     *
     * @var \TYPO3\CMS\Core\Resource\FileRepository
     * @inject
     */
    protected $fileRepository = null;

    /**
     * data
     *
     * @var array
     */
    protected $data;

    /**
     * action show
     *
     * @return void
     */
    public function showAction()
    {
        // Assign multiple values
        $viewAssign = array();

        $this->cObj = $this->configurationManager->getContentObject();
        $this->data = $this->cObj->data;

        // Get localized record
        $localizedRecord = $this->pageRepository->getRecordOverlay('tt_content', $this->data, $GLOBALS['TSFE']->sys_language_uid, $GLOBALS['TSFE']->sys_language_mode);
        if ($localizedRecord !== false && isset($localizedRecord['_LOCALIZED_UID']))
            $this->data = $localizedRecord;

        $viewAssign['data'] = $this->data;

        // Get images and preview-image
        $fileObjects = $this->fileRepository->findByRelation('tt_content', 'tx_jhphotoswipe_pi1', isset($this->data['_LOCALIZED_UID']) ? $this->data['_LOCALIZED_UID'] : $this->data['uid']);
        $viewAssign['files'] = $fileObjects;
        if ($this->settings['flexform']['firstFilePreviewOnly'])
            unset($viewAssign['files'][0]);

        $viewAssign['previewImage'] = $fileObjects[0];

        // Get orientation of preview-image
        switch ($this->settings['flexform']['preview_orient']) {
            case 1:
                $viewAssign['previewOrient'] = 'right';
                break;
            case 2:
                $viewAssign['previewOrient'] = 'left';
                break;
            case 0:
            default:
                $viewAssign['previewOrient'] = 'center';
        }

        // Assign array to fluid-template
        $this->view->assignMultiple($viewAssign);
    }

    /**
     * multi thumbnail action
     *
     * @return void
     */
    public function multiThumbnailAction()
    {
        // Assign multiple values
        $viewAssign = array();

        $this->cObj = $this->configurationManager->getContentObject();
        $this->data = $this->cObj->data;

        // Get localized record
        $localizedRecord = $this->pageRepository->getRecordOverlay('tt_content', $this->data, $GLOBALS['TSFE']->sys_language_uid, $GLOBALS['TSFE']->sys_language_mode);
        if ($localizedRecord !== false && isset($localizedRecord['_LOCALIZED_UID']))
            $this->data = $localizedRecord;

        $viewAssign['data'] = $this->data;

        // Get images and preview-image
        $viewAssign['files'] = $this->fileRepository->findByRelation('tt_content', 'tx_jhphotoswipe_pi1', isset($this->data['_LOCALIZED_UID']) ? $this->data['_LOCALIZED_UID'] : $this->data['uid']);

        // CssStyledContent modifications
        if (ExtensionManagementUtility::isLoaded('css_styled_content'))
        {
            $imgList = array();
            foreach ($viewAssign['files'] as $file)
                $imgList[] = $file->getUid();

            $this->data['image'] = implode(',', $imgList);
            $this->data['imagewidth'] = $this->settings['flexform']['preview_width'];
            $this->data['imageheight'] = $this->settings['flexform']['preview_height'];
            $this->data['imagecols'] = $this->settings['flexform']['preview_columns'];
            $this->data['imageorient'] = $this->settings['flexform']['preview_orient'];
            $this->data['image_noRows'] = $this->settings['flexform']['image_noRows'];
            $this->data['imageborder'] = $this->settings['flexform']['imageborder'];
            $this->data['imagecaption_position'] = $this->settings['flexform']['imagecaption_position'];
            $viewAssign['data'] = $this->data;
        }

        // todo: Signal to modify $viewAssign

        // Assign array to fluid-template
        $this->view->assignMultiple($viewAssign);
    }
}
