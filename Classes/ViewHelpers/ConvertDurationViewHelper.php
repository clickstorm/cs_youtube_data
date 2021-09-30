<?php
namespace Clickstorm\CsYoutubeData\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * Created by PhpStorm.
 * User: akirilow
 * Date: 02.04.2015
 * Time: 09:13
 */
class ConvertDurationViewHelper extends AbstractViewHelper {

    public function initializeArguments()
    {
        $this->registerArgument('duration', 'int', 'The duration with which Youtube Video gets converted', true);
    }

    /**
     *Converts the duration of Youtube Video
     *
     * @param int $duration
     * @return string string
     * @author Andreas Kirilow <kirilow@clickstorm.de>
     */
    public function render() {
        $duration = $this->arguments['duration'];
        preg_match('#PT(.*?)H(.*?)M(.*?)S#si',$duration,$out);
        if(empty($out[1])){
            preg_match('#PT(.*?)M(.*?)S#si',$duration,$out);
            if(empty($out[1])){
                preg_match('#PT(.*?)S#si',$duration,$out);
                if(empty($out[1])){
                    return '00:00';
                }else{
                    if(strlen($out[1])==1){ $out[1]= '0'.$out[1]; }
                    return '00:'.$out[1];
                }
            }else{
                if(strlen($out[1])==1){ $out[1]= '0'.$out[1]; }
                if(strlen($out[2])==1){ $out[2]= '0'.$out[2]; }
                return $out[1].':'.$out[2];
            }
        }else{
            if(strlen($out[1])==1){ $out[1]= '0'.$out[1]; }
            if(strlen($out[2])==1){ $out[2]= '0'.$out[2]; }
            if(strlen($out[3])==1){ $out[3]= '0'.$out[3]; }
            return $out[1].':'.$out[2].':'.$out[3];
        }
    }
}
?>
