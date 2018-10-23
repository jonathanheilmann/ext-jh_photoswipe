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
class AddJsInlineCodeViewHelper extends AbstractPageRenderViewHelper
{

    public function initializeArguments()
    {
        $this->registerArgument('name', 'string', 'The name of the file', true, null);
        $this->registerArgument('block', 'string', 'The JS content', false, null);
        $this->registerArgument('compress', 'boolean', 'Compress output', false, false);
        $this->registerArgument('forceOnTop', 'boolean', 'Force to top?', false, false);
        $this->registerArgument('addToFooter', 'boolean', 'Add to footer?', false, false);
    }

    public function render()
    {
        if ($this->arguments['block'] === null) $this->arguments['block'] = $this->renderChildren();

        if ($this->arguments['addToFooter'] === false) {
            $this->pageRenderer->addJsInlineCode($this->arguments['name'], $this->arguments['block'], $this->arguments['compress'], $this->arguments['forceOnTop']);
        } else {
            $this->pageRenderer->addJsFooterInlineCode($this->arguments['name'], $this->arguments['block'], $this->arguments['compress'], $this->arguments['forceOnTop']);
        }
        return '';
    }
}