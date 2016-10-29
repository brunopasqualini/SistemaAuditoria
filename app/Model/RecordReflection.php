<?php
namespace App\Model;

use App\Core\Annotation\AnnotationParam;
use App\Core\Annotation\Annotation;

class RecordReflection {

    private $Reflection;
    private $annotationInfo   = [];
    private $pkComposition    = [];
    private $childsProperties = [];

    public function __construct(ModelAbstract $oModel){
        $this->parseAnnotation($oModel);
    }

    private function parseAnnotation($oModel){
        $this->Reflection = new \ReflectionClass($oModel);
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
    
    public function getChilds(){
        return $this->childsProperties;
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
                if($oAnnotation->hasAnnotation('FK')){
                    $this->childsProperties[] = $oProp->getName();
                    $aPKComposition = $this->getFKColumns($oProp->getName(), (bool) $aColumn['pk']);
                    $aColumns       = array_merge($aColumns, $aPKComposition);
                }
                if($aColumn['pk']){
                    if(!$oAnnotation->hasAnnotation('FK')){
                        $this->pkComposition[$oProp->getName()] = $aColumn;
                    }
                    else{
                        $this->pkComposition = array_merge($this->pkComposition, $aPKComposition);
                    }
                }
            }
            $this->annotationInfo['columns'] = $aColumns;
        }
        return $this->annotationInfo['columns'];
    }

    private function getFKColumns($sName, $bPk){
        $sModelFK = '\App\Model\Model'.$sName;
        $oModelFK = new $sModelFK();
        $aPKComposition = [];
        foreach($oModelFK->getPkComposition() as $sNameModel => $aInfo){
            $aInfo['fk'] = true;
            $aInfo['pk'] = $bPk;
            $aPKComposition[$sName . '.' . $sNameModel] = $aInfo;
        }
        return $aPKComposition;
    }

}
