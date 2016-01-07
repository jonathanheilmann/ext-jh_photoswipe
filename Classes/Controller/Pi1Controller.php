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
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class Pi1Controller
 * @package Heilmann\JhPhotoswipe\Controller
 */
class Pi1Controller extends ActionController {

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
	public function showAction() {
		// Assign multiple values
		$viewAssign = array();

		$this->cObj = $this->configurationManager->getContentObject();
		$this->data = $this->cObj->data;
		$viewAssign['data'] = $this->data;

		// Get images and preview-image
		$fileRepository = GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
		$fileObjects = $fileRepository->findByRelation('tt_content', 'tx_jhphotoswipe_pi1', $this->data['uid']);
		$viewAssign['files'] = $fileObjects;
		if ($this->settings['flexform']['firstFilePreviewOnly']) unset($viewAssign['files'][0]);
		$previewImage = $fileObjects[0];
		$viewAssign['previewImage'] = $previewImage;
		$viewAssign['previewImageCaption'] = $previewImage->getProperty('description');

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

}