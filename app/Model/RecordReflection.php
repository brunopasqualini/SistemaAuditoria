<?php
namespace App\Model;

use App\Core\Annotation\AnnotationParam;
use App\Core\Annotation\Annotation;

class RecordReflection {

    private $Reflection;
    private $annotationInfo = [];
    private $pkComposition  = [];

    public function __construct(Record $oRecord){
        $this->parseAnnotation($oRecord);
    }

    private function parseAnnotation($oRecord){
        $this->Reflection = new \ReflectionClass($oRecord);
        $this->getTable();
        $this->getColumns();
    }

    public function getTable(){
        if(!isset($this->annotationInfo['tbname'])){
            $oAnnotation = new Annotation($this->Reflection->getDocComment(), new AnnotationParam());
            $aColumn     = $oAnnotation->getAnnotation('Table');
            $this->annotationInfo['tbname'] = $aColumn['name'];
        }
        return $this->annotationInfo['tbname'];
    }

    public function getPkComposition(){
        return $this->pkComposition;
    }

    public function getColumns(){
        if(!isset($this->annotationInfo['columns'])){
            $aProps   = $this->Reflection->getProperties();
            $aColumns = [];
            foreach($aProps as $oProp){
                $oAnnotation = new Annotation($oProp->getDocComment(), new AnnotationParam());
                $aColumn     = $oAnnotation->getAnnotation('Column');
                $aColumn['pk']     = $oAnnotation->hasAnnotation('PK');
                $aColumn['serial'] = $oAnnotation->hasAnnotation('Serial');
                if(isset($aColumn['name'])){
                    $aColumns[$oProp->getName()] = $aColumn;
                }
                if($aColumn['pk']){
                    if($oAnnotation->hasAnnotation('FK')){
                        $aPKComposition      = $this->getPKFromFK($oProp->getName());
                        $this->pkComposition = array_merge($this->pkComposition, $aPKComposition);
                        $aColumns = array_merge($aColumns, $aPKComposition);
                    }else{
                        $this->pkComposition[$oProp->getName()] = $aColumn;
                    }
                }
            }
            $this->annotationInfo['columns'] = $aColumns;
        }
        return $this->annotationInfo['columns'];
    }

    private function getPKFromFK($sName){
        $sModelFK = '\App\Model\Model'.$sName;
        $oModelFK = new $sModelFK();
        $aPKComposition = [];
        foreach($oModelFK->getPkComposition() as $sNameModel => $aInfo){
            $aPKComposition[$sName . '.' . $sNameModel] = $aInfo;
        }
        return $aPKComposition;
    }

}
