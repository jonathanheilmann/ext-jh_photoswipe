<?php
namespace Heilmann\JhPhotoswipe\ViewHelpers;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015-2016 Jonathan Heilmann <mail@jonathan-heilmann.de>
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
class AddJsFooterInlineCodeViewHelper extends AbstractViewHelper {

	/**
	 * Initialize arguments
	 */
	public function initializeArguments() {
		$this->registerArgument('name', 'string', 'Name argument - see PageRenderer documentation', TRUE);
		$this->registerArgument('compress', 'boolean', 'Compress argument - see PageRenderer documentation', FALSE, TRUE);
		$this->registerArgument('forceOnTop', 'boolean', 'ForceOnTop argument - see PageRenderer documentation', FALSE, FALSE);
	}

	/**
	 *
	 *
	 * @param string block
	 * @return void
	 */
	public function render($block = '') {
		if (empty($this->arguments['name'])) {
			throw new \TYPO3\CMS\Fluid\Core\ViewHelper\Exception('You must specify a name.', 1382284106);
		}
		if (!$block) {
			$block = $this->renderChildren();
		}
		$GLOBALS['TSFE']->getPageRenderer()->addJsFooterInlineCode($this->arguments['name'], $block, $this->arguments['compress'], $this->arguments['forceOnTop']);
		return;
	}

}