<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'Clickstorm.' . $_EXTKEY,
	'Pi1',
	array(
		'YoutubeData' => 'list',
		
	),
	// non-cacheable actions
	array(
		'YoutubeData' => '',
		
	)
);

if (TYPO3_MODE === 'BE'){
    $iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
    $iconRegistry->registerIcon(
        'cs_youtube_data-plugin-pi1',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        ['source' => 'EXT:cs_youtube_data/Resources/Public/Icons/wizard_icon.svg']
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi1 {
                        iconIdentifier = cs_youtube_data-plugin-pi1
                        title = LLL:EXT:cs_youtube_data/Resources/Private/Language/locallang.xlf:plugin_label
                        description = LLL:EXT:cs_youtube_data/Resources/Private/Language/locallang.xlf:plugin_value
                        tt_content_defValues {
                            CType = list
                            list_type = csyoutubedata_pi1
                        }
                    }
                }
                show = *
            }
       }'
    );

}
