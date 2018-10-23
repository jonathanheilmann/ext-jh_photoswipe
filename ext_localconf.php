<?php
if (!defined('TYPO3_MODE'))
    die('Access denied.');

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

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
    'mod {
     wizards.newContentElement.wizardItems.plugins {
       elements {
         jhPhotoswipe {
           iconIdentifier = jh-photoswipe-contentelement
           title = LLL:EXT:jh_photoswipe/Resources/Private/Language/newContentElement.xlf:plugins.jhPhotoswipe.title
           description = LLL:EXT:jh_photoswipe/Resources/Private/Language/newContentElement.xlf:plugins.jhPhotoswipe.description
           tt_content_defValues {
             CType = list
             list_type = jhphotoswipe_pi1	
           }
         }
       }
       show = *
     }
   }'
);