<?php
if (!defined('TYPO3_MODE'))
    die('Access denied.');

## EXTENSION BUILDER DEFAULTS END TOKEN - Everything BEFORE this line is overwritten with the defaults of the extension builder
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Heilmann.' . $_EXTKEY,
    'Pi1',
    array(
        'Pi1' => 'show, multiThumbnail',

    ),
    // non-cacheable actions
    array(
    )
);
