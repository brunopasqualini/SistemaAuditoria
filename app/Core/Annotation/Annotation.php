<?php
namespace App\Core\Annotation;

class Annotation {

    private $Parser;
    private $annotations = [];

    public function __construct($sDocComment, AnnotationParser $oParser){
        $this->parse($sDocComment);
        $this->Parser = $oParser;
    }

    private function parse($sDocComment){
        if(preg_match_all('/\* (@.*)/', $sDocComment, $aMatches)){
            foreach($aMatches[1] as $sAnnotation){
                preg_match_all('/@(\w*)(?:\((.*)\))?/', $sAnnotation, $aAnnotationInfo);
                list($sName, $sParam) = [$aAnnotationInfo[1][0], $aAnnotationInfo[2][0]];
                $this->annotations[$sName] = $sParam;
            }
        }
    }

    public function hasAnnotation($sName){
        return isset($this->annotations[$sName]);
    }

    public function getAnnotation($sName){
        if(!$this->hasAnnotation($sName)){
            return null;
        }
        return $this->Parser->parse($sName, $this->annotations[$sName]);
    }

}
