<?php
namespace Clickstorm\CsYoutubeData\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Andreas Kirilow <kirilow@clickstorm.de>, clickstorm GmbH
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

use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * YoutubeDataController
 */
class YoutubeDataController extends ActionController
{

    private $extConf;

    /**
     * action initialize
     *
     * @return void
     */
    public function initializeAction() {
        $this->extConf = $GLOBALS["TYPO3_CONF_VARS"]["EXTENSIONS"]["cs_youtube_data"];
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction() {
        //Max results
        $maxResults = $this->settings['maxResults'];
        //APIKey String
        $apiString = $this->extConf['apiKey'];
        //If blank are in line
        $apiArray = \TYPO3\CMS\Core\Utility\GeneralUtility::trimExplode(' ', $apiString);
        //APIKey without blank in line
        $apiKey = implode($apiArray);
        //Channel id
        $channelId = $this->settings['channelId'];
        // Order settings
        $order = $this->settings['order'];
        //Part for Video (id,snippet,contentDetails,statistics,recordingDetails,player)
        $videoUrlPart = $this->settings['videoUrlPart'];
        //API url
        $apiUrl = 'https://www.googleapis.com/youtube/v3/';

        // get all IDs from channel videos and cast them to one string
        $searchUrl = $apiUrl . 'search?';
        $searchUrl .= 'order='.$order;
        $searchUrl .= '&part=id';
        $searchUrl .= '&channelId='.$channelId;
        $searchUrl .= '&type=video';
        $searchUrl .= '&maxResults='.$maxResults;
        $searchUrl .= '&key='.$apiKey;

        // initializes the request
        $curl = curl_init();

        // sets the url
        curl_setopt($curl, CURLOPT_URL, $searchUrl);

        // enables that curl_exec() returns content instead of status code
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // allows redirects
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

        // performs the actual request
        $data = curl_exec($curl);
        // destructs the request
        curl_close($curl);

        // this line converts the json string which is returned into a php object
        $data = json_decode($data);
        if(!empty($data->error)){
            //Errorcode API
            $errorCode = $data->error->code;
            $errorCodeLanguage = LocalizationUtility::translate('tx_csyoutubedata_error_code', 'cs_youtube_data');

            //Errormessage API
            $errorMessage = $data->error->message;
            $errorMessageLanguage = LocalizationUtility::translate('tx_csyoutubedata_error_message', 'cs_youtube_data');

            //Reason API
            $reason = $data->error->errors[0]->reason;
            $errorReasonLanguage = LocalizationUtility::translate('tx_csyoutubedata_error_reason', 'cs_youtube_data');

            //Error Link
            $errorLink = 'https://developers.google.com/youtube/v3/docs/errors';

            $messageTitle = LocalizationUtility::translate('tx_csyoutubedata_error', 'cs_youtube_data');
            $messageBody = $errorCodeLanguage.$errorCode.' | '.$errorMessageLanguage.$errorMessage.' | '.$errorReasonLanguage.$reason.' | '.$errorLink;

            $this->addFlashMessage(
                $messageBody,
                $messageTitle,
                AbstractMessage::ERROR
            );
        }elseif(!empty($data->items)){
            $items = array();

            $max = sizeof($data->items);
            for($i = 0; $i < $max;$i++){
                $items[$i] = $data->items[$i]->id->videoId;
            }

            $videoIDs = implode(',',$items);

            if($videoIDs) {
                // get all data for the given videos by IDs
                $videosUrl = $apiUrl . 'videos?';
                $videosUrl .= 'part='.$videoUrlPart;
                $videosUrl .= '&id='.$videoIDs;
                $videosUrl .= '&key='.$apiKey;
                $videos = json_decode(file_get_contents($videosUrl), true);

                //Rendering
                $this->view->assign('videos', $videos['items']);
            }
        }else{
            $messageTitle = LocalizationUtility::translate('tx_csyoutubedata_channel_false_check', 'cs_youtube_data');
            $messageBody = LocalizationUtility::translate('tx_csyoutubedata_channel_false', 'cs_youtube_data').' - '.$channelId.'!';
            $this->addFlashMessage(
                $messageBody,
                $messageTitle,
                AbstractMessage::WARNING
            );
        }
    }
}
