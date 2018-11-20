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
 * Class AddJsFileViewHelper
 * @package Heilmann\JhPhotoswipe\ViewHelpers\PageRenderer
 */
class AddJsFileViewHelper extends AbstractPageRenderViewHelper
{

    public function initializeArguments()
    {
        $this->registerArgument('file', 'string', 'The name of the file', true, null);
        $this->registerArgument('type', 'string', 'Type', false, 'text/javascript');
        $this->registerArgument('compress', 'boolean', 'Compress output?', false, true);
        $this->registerArgument('forceOnTop', 'boolean', 'Force to top?', false, false);
        $this->registerArgument('allWrap', 'string', 'Wrap', false, '');
        $this->registerArgument('excludeFromConcatenation', 'boolean', 'Exclude from concatenation', false, false);
        $this->registerArgument('splitChar', 'string', 'Split character', false, '|');
        $this->registerArgument('async', 'boolean', 'Async', false, false);
        $this->registerArgument('integrity', 'string', 'Integrity', false, '');
        $this->registerArgument('addToFooter', 'string', 'Add to footer?', false, false);
    }

    /**
     * @see PageRenderer::addJsFile
     * @see PageRenderer::addJsFooterFile
     */
    public function render()
    {
        $file = $GLOBALS['TSFE']->tmpl->getFileName($this->arguments['file']);
        if ($this->arguments['addToFooter'] === false) {
            $this->pageRenderer->addJsFile($file, $this->arguments['type'], $this->arguments['compress'],
                $this->arguments['forceOnTop'], $this->arguments['allWrap'],
                $this->arguments['excludeFromConcatenation'], $this->arguments['splitChar'], $this->arguments['async'],
                $this->arguments['integrity']);
        } else {
            $this->pageRenderer->addJsFooterFile($file, $this->arguments['type'], $this->arguments['compress'], $this->arguments['forceOnTop'], $this->arguments['allWrap'], $this->arguments['excludeFromConcatenation'], $this->arguments['splitChar'], $this->arguments['async'], $this->arguments['integrity']);
        }
    }

}