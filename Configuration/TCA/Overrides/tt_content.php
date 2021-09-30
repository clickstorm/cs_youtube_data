<?php

defined('TYPO3_MODE') or die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Clickstorm.' . 'cs_youtube_data',
    'Pi1',
    'Youtube Data V3 Plugin'
);

//FlexForm add
$pluginSignature = str_replace('_', '', 'cs_youtube_data') . '_pi1';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature]='code,layout,select_key,pages,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    $pluginSignature,
    'FILE:EXT:cs_youtube_data/Configuration/FlexForms/flexform_pi1.xml'
);

