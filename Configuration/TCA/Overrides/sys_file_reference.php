<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

// Enable RTE
//$GLOBALS['TCA']['sys_file_reference']['columns']['description']['defaultExtras'] = 'richtext[]:rte_transform[mode=ts_css]';

// Enable multiline file description field
//$GLOBALS['TCA']['sys_file_reference']['columns']['description']['config']['type'] = 'text';
//$GLOBALS['TCA']['sys_file_reference']['columns']['description']['config']['cols'] = 40;
//$GLOBALS['TCA']['sys_file_reference']['columns']['description']['config']['rows'] = 15;