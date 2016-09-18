<?php
namespace App\View;

class TemplateLoader {

    private static function parseParam($sTemplate, $sParam, $xValue){
        return preg_replace('/'. "{{{$sParam}}}" .'/', $xValue, $sTemplate);
    }

    private static function parseParamArray($sTemplate, $sParam, $aValues){
        $sPattern = "[^\n]*{{for {$sParam}}}(.*){{endfor}}";
        preg_match_all("/{$sPattern}/s", $sTemplate, $aMatches);
        $aMatches = explode(ENTER, $aMatches[1][0]);
        $aMatches = array_values(array_filter($aMatches, function(&$sExpression) use (&$sPadding){
            if(!isEmpty(rtrim($sExpression))){
                if(strlen($sPadding) === 0){
                    preg_match('/^\s+/', $sExpression, $aPadding);
                    $sPadding = $aPadding[0];
                }
                $sExpression = $sPadding . trim($sExpression);
                return true;
            }
        }));
        $sExpression = implode(ENTER, $aMatches);
        $aReplace    = [];
        foreach($aValues as $aValue){
            $sCurrentExpression = $sExpression;
            foreach($aValue as $sParam => $sValue){
                $sCurrentExpression = self::parseParam($sCurrentExpression, $sParam, $sValue);
            }
            $aReplace[] = $sCurrentExpression;
        }
        return preg_replace("/{$sPattern}/s", implode(ENTER, $aReplace), $sTemplate);
    }

    public static function load($sName, $aParams = []){
        ob_start();
        require_once getPathFull('app' . DIRSEP . 'View' . DIRSEP . 'template') . $sName . '.php';
        $sTemplate = ob_get_clean();
        foreach($aParams as $sParam => $xValue){
            if(!is_array($xValue)){
                $sTemplate = self::parseParam($sTemplate, $sParam, $xValue);
            }
            else{
                $sTemplate = self::parseParamArray($sTemplate, $sParam, $xValue);
            }
        }
        return $sTemplate;
    }

    public static function flush($sName, $aParams = []){
        echo self::load($sName, $aParams);
    }

}
