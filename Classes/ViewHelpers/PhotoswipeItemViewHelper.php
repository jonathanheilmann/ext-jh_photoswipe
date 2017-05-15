<?php
namespace Heilmann\JhPhotoswipe\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015-2017  Jonathan Heilmann <mail@jonathan-heilmann.de>
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
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Service\ImageService;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Exception;

/**
 * Class PhotoswipeItemViewHelper
 * @package Heilmann\JhPhotoswipe\ViewHelpers
 */
class PhotoswipeItemViewHelper extends AbstractViewHelper
{

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
    }

    /**
     * Render method
     *
     * @param mixed $item PhotoSwipe item
     * @param mixed $width
     * @param int $maxWidth
     * @param int $maxHeight
     * @param boolean $renderMsrc
     * @param mixed $msrcWidth
     * @return string
     * @throws Exception
     */
    public function render($item = null, $width = null, $maxWidth = null, $maxHeight = null, $renderMsrc = false, $msrcWidth = '256m')
    {
        if (is_null($item)) {
            throw new Exception('You must either specify a string src or a File object.', 1382284106);
        }

        // Get FAL properties
        $properties = $item->getOriginalFile()->getProperties();
        ArrayUtility::mergeRecursiveWithOverrule($properties, $item->getReferenceProperties(), true, false, false);

        // Render image
        $imageService = $this->objectManager->get(ImageService::class);
        $image = $imageService->getImage('', $item, true);
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
        if ($renderMsrc === true) {
            $result .= ",\n msrc:'".$imageService->getImageUri($processedMsrc)."'";
        }
        if (!empty($properties['description'])) {
	    /** @var ContentObjectRenderer $contentObject */
            $contentObject = GeneralUtility::makeInstance(ContentObjectRenderer::class);
            $description = $contentObject->parseFunc(trim($properties['description']), [], '< lib.parseFunc_RTE');
            $parsedDescription = preg_replace("/\r|\n/", "", $description);
            $result .= ",\n title:'". str_replace("'", "\'", $parsedDescription)."'";
        }
        //if (!empty($properties['author'])) {$result .= ",\n author'".$properties['author']."'";}
        $result .= "\n}";

        return $result;
    }
}
