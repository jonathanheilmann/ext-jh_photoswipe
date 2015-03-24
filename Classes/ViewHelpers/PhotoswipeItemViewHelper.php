<?php
namespace Heilmann\JhPhotoswipe\ViewHelpers;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Jonathan Heilmann <mail@jonathan-heilmann.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *
 *
 * @author Jonathan Heilmann <mail@jonathan-heilmann.de>
 * @package JhPhotoswipe
 * @subpackage ViewHelpers
 */
class PhotoswipeItemViewHelper extends AbstractViewHelper {

	/**
	 * Initialize arguments
	 */
	public function initializeArguments() {
		parent::initializeArguments();
	}

	/**
	 * Render method
	 *
	 * @param mixed item PhotoSwipe item
	 * @param mixed width
	 * @param int maxWidth
	 * @param int maxHeight
	 * @param boolean renderMsrc
	 * @param mixed msrcWidth
	 * @return string
	 */
	public function render($item = NULL, $width = NULL, $maxWidth = NULL, $maxHeight = NULL, $renderMsrc = FALSE, $msrcWidth = '256m') {
		$result = '';
		if (is_null($item)) {
			throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('You must either specify a string src or a File object.', 1382284106);
		}

		// Get FAL properties
		$properties = $item->getOriginalFile()->getProperties();
		\TYPO3\CMS\Core\Utility\ArrayUtility::mergeRecursiveWithOverrule($properties, $item->getReferenceProperties(), TRUE, FALSE, FALSE);

		// Render image
		$imageService = GeneralUtility::makeInstance('\TYPO3\CMS\Extbase\Service\ImageService');
		$image = $imageService->getImage('', $item, TRUE);
		$processingInstructions = array(
			'width' => $width,
			/*'maxWidth' => $maxWidth,
			'maxHeight' => $maxHeight,*/
		);
		$processedImage = $imageService->applyProcessingInstructions($image, $processingInstructions);

		// Render medium image
		$processingInstructions = array(
			'width' => $msrcWidth,
		);
		$processedMsrc = $imageService->applyProcessingInstructions($image, $processingInstructions);

		// Render result to return
		$result = "{\n
			src: '".$imageService->getImageUri($processedImage)."',\n
			w: ".$processedImage->getProperty('width').",\n
			h: ".$processedImage->getProperty('height');
		if ($renderMsrc === TRUE) {$result .= ",\n msrc:'".$imageService->getImageUri($processedMsrc)."'";}
		if (!empty($properties['description'])) {$result .= ",\n title:'".$properties['description']."'";}
		//if (!empty($properties['author'])) {$result .= ",\n author'".$properties['author']."'";}
		$result .= "\n}";

		return $result;
	}

}