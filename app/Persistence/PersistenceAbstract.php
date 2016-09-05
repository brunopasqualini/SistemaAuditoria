<?php
namespace App\Persistence;

use App\Core\Annotation\AnnotationParam;
use App\Core\Annotation\Annotation;
use App\Core\Database\Query;
use App\Model\Bean;

abstract class PersistenceAbstract {

    protected $Query;
    protected $Model;
    private $annotationInfo = [];

    public function __construct(){
        $this->Query = new Query();
    }

    public function setModel($oModel){
        $this->Model = $oModel;
        $this->annotationInfo = [];
        $this->parseAnnotationModel();
    }

    public static function setFromFetch($aFetch, $oModel){
        foreach($aFetch as $sProperty => $sValue){
            Bean::set($sProperty, $sValue, $oModel);
        }
    }

    private function parseAnnotationModel(){
        $oModelReflection = new \ReflectionClass($this->Model);
        $this->getTable($oModelReflection);
        $this->getColumns($oModelReflection);
    }

    final public function getTable($oReflection = null){
        if(!isset($this->annotationInfo['tbname'])){
            $oAnnotation = new Annotation($oReflection->getDocComment(), new AnnotationParam());
            $aColumn     = $oAnnotation->getAnnotation('Table');
            $this->annotationInfo['tbname'] = $aColumn['name'];
        }
        return $this->annotationInfo['tbname'];
    }

    final public function getColumns($oReflection = null){
        if(!isset($this->annotationInfo['columns'])){
            $aProps   = $oReflection->getProperties();
            $aColumns = [];
            foreach($aProps as $oProp){
                $oAnnotation = new Annotation($oProp->getDocComment(), new AnnotationParam());
                $aColumn     = $oAnnotation->getAnnotation('Column');
                $aColumn['pk']     = $oAnnotation->hasAnnotation('PK');
                $aColumn['serial'] = $oAnnotation->hasAnnotation('Serial');
                $aColumns[$oProp->getName()] = $aColumn;
            }
            $this->annotationInfo['columns'] = $aColumns;
        }
        return $this->annotationInfo['columns'];
    }

}
