<?php
namespace App\Core\Annotation;

class AnnotationParam implements AnnotationParser {

    /**
     * Parse the annotation expression
     * @example @Example(key=value)
     *          @Example(key=value, key=value)
     *          @Example(key=value, name1, ...)
     *          @Example(name1, name2, ...)
     *          @Example(name1, name2=(key=value), ...)
     *
     * @return [key=>value]
     */
    public function parse($sAnnotationName, $sExpression){
        if(preg_match_all('/(\w+)(?:=([^,]*))?/', $sExpression, $aMatches)){
            $aParams = [];
            foreach($aMatches[1] as $iKey => $sParamName){
                $aParams[$sParamName] = $aMatches[2][$iKey];
                $sValue = preg_replace('/^\(|\)$/', '', $aMatches[2][$iKey]);
                //Verify sub expression surrounded by parentheses
                if($sValue !== $aParams[$sParamName]){
                    $aParams[$sParamName] = $this->parse($sAnnotationName, $sValue);
                }
            }
            return $aParams;
        }
        return [];
    }

}
