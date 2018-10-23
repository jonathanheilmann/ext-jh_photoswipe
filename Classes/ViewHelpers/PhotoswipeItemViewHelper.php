<?php
namespace Heilmann\JhPhotoswipe\ViewHelpers;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015-2018  Jonathan Heilmann <mail@jonathan-heilmann.de>
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

use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Service\ImageService;
use TYPO3\CMS\Fluid\Core\ViewHelper\Exception;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Class PhotoswipeItemViewHelper
 * @package Heilmann\JhPhotoswipe\ViewHelpers
 */
class PhotoswipeItemViewHelper extends \TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper
{

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();

        $this->registerArgument('item', 'object', 'A File object', true, null);
        $this->registerArgument('width', 'string', 'The JS content', false, null);
        $this->registerArgument('renderMsrc', 'string', 'Add to footer?', false, false);
        $this->registerArgument('msrcWidth', 'string', 'Add to footer?', false, '256m');
    }

    /**
     * Render method
     *
     * @return string
     * @throws Exception
     */
    public function render()
    {
        $args = $this->arguments;

        /** @var FileReference $item */
        $item = $args['item'];


        if (is_null($item)) {
            throw new Exception('You must specify a File object.', 1382284106);
        }

        // Get FAL properties
        $properties = $item->getOriginalFile()->getProperties();
        ArrayUtility::mergeRecursiveWithOverrule($properties, $item->getReferenceProperties(), true, false, false);

        /** @var ObjectManager $objectManager */
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);

        // Render image
        /** @var ImageService $imageService */
        $imageService = $objectManager->get(ImageService::class);
        $image = $imageService->getImage('', $item, true);
        $processingInstructions = array(
            'width' => $args['width'],
        );
        $processedImage = $imageService->applyProcessingInstructions($image, $processingInstructions);

        // Render medium image
        $processingInstructions = array(
            'width' => $args['msrcWidth'],
        );
        $processedMsrc = $imageService->applyProcessingInstructions($image, $processingInstructions);

        // Render result to return
        $result = "{\n
			src: '".$imageService->getImageUri($processedImage)."',\n
			w: ".$processedImage->getProperty('width').",\n
			h: ".$processedImage->getProperty('height');
        if ($args['renderMsrc'] === true) {
            $result .= ",\n msrc:'".$imageService->getImageUri($processedMsrc)."'";
        }
        if (!empty($properties['description'])) {
            /** @var ContentObjectRenderer $contentObject */
            $contentObject = GeneralUtility::makeInstance(ContentObjectRenderer::class);
            $description = $contentObject->parseFunc(trim($properties['description']), [], '< lib.parseFunc_RTE');
            $parsedDescription = preg_replace("/\r|\n/", "", $description);
            $result .= ",\n title:'". str_replace("'", "\'", $parsedDescription)."'";
        }
        $result .= "\n}";

        return $result;
    }
}
