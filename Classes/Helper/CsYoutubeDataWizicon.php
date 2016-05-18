<?php
/**
 * Created by PhpStorm.
 * User: akirilow
 * Date: 02.04.2015
 * Time: 14:25
 */
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class that adds the wizard icon.
 */
class CsYoutubeDataWizicon {

    /**
     * Processing the wizard items array
     *
     * @param array $wizardItems : The wizard items
     * @return Modified array with wizard items
     */
    function proc( $wizardItems ) {

        $wizardItems['plugins_tx_csyoutubedata_pi1'] = array(
            'icon' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('cs_youtube_data') . 'Resources/Public/Icons/wizard_icon.png',
            'title' => LocalizationUtility::translate('plugin_label', 'cs_youtube_data'),
            'description' => LocalizationUtility::translate('plugin_value', 'cs_youtube_data'),
            'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=csyoutubedata_pi1'
        );

        return $wizardItems;
    }

}