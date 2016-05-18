<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Clickstorm.' . $_EXTKEY,
	'Pi1',
	'Youtube Data V3 Plugin'
);

// add wizard icon to the "add new record" in backend
if (TYPO3_MODE == "BE") {
    $TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["CsYoutubeDataWizicon"] =
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/Helper/CsYoutubeDataWizicon.php';
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Youtube Data');

//FlexForm add

$pluginSignature = str_replace('_', '', $_EXTKEY) . '_pi1';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature]='code,layout,select_key,pages,recursive';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform_pi1.xml');


