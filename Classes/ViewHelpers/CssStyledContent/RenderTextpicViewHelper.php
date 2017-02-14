<?php
namespace Heilmann\JhPhotoswipe\ViewHelpers\CssStyledContent;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016-2017 Jonathan Heilmann <mail@jonathan-heilmann.de>
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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\CssStyledContent\Controller\CssStyledContentController;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

/**
 * Class RenderTextpicViewHelperViewHelper
 * @package Heilmann\JhPhotoswipe\ViewHelpers\CssStyledContent
 */
class RenderTextpicViewHelper extends AbstractViewHelper
{

    /**
     * Render method
     *
     * @param string $typoscriptObjectPath
     * @param array $data
     * @return string
     */
    public function render($typoscriptObjectPath, array $data)
    {
        $typoscriptObjectPath = GeneralUtility::trimExplode('.', $typoscriptObjectPath, true);
        $setup = $GLOBALS['TSFE']->tmpl->setup;
        foreach ($typoscriptObjectPath as $pathSegment)
            $setup = isset($setup[$pathSegment . '.']) ? $setup[$pathSegment . '.'] : null;
        if ($setup === null)
            return '';


        /** @var CssStyledContentController $cssStyledContentController */
        $cssStyledContentController = $this->objectManager->get(CssStyledContentController::class);
        /** @var ContentObjectRenderer cObj */
        $cssStyledContentController->cObj = $this->objectManager->get(ContentObjectRenderer::class);
        $cssStyledContentController->cObj->start($data, 'tt_content');

        return $cssStyledContentController->render_textpic('', $setup);
    }
}
