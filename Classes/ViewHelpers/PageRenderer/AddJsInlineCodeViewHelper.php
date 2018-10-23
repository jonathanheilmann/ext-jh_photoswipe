<?php
namespace Heilmann\JhPhotoswipe\ViewHelpers\PageRenderer;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2016-2018 Jonathan Heilmann <mail@jonathan-heilmann.de>
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
 * Class AddJsInlineCodeViewHelper
 * @package Heilmann\JhPhotoswipe\ViewHelpers\PageRenderer
 */
class AddJsInlineCodeViewHelper extends AbstractViewHelper
{

    /**
     * @param string $name
     * @param string|null $block
     * @param bool $compress
     * @param bool $forceOnTop
     * @param bool $addToFooter
     */
    public function render($name, $block = null, $compress = true, $forceOnTop = false, $addToFooter = false)
    {
        if ($block === null) $block = $this->renderChildren();

        if ($addToFooter === false)
        {
            $this->pageRenderer->addJsInlineCode($name, $block, $compress, $forceOnTop);
        } else{
            $this->pageRenderer->addJsFooterInlineCode($name, $block, $compress, $forceOnTop);
        }
    }

}