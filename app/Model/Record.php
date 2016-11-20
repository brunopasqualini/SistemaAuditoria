<?php
namespace App\Model;

use App\Core\Database\Query;
use App\Model\Bean;

class Record {

    private $Reflection;
    private $Model;
    private $Query;

    public function __construct(ModelAbstract $oModel){
        $this->Model      = $oModel;
        $this->Reflection = new RecordReflection($oModel);
        $this->Query      = new Query();
    }

    public function getAll($iChildLevel){
        if($iChildLevel < 0){
            return;
        }
        $aRecord = [];
        $this->Query->setSql($this->getSelect());
        $this->Query->execute();
        while($aFetch = $this->Query->fetch()){
            $sNewModel = get_class($this->Model);
            $aRecord[] = new $sNewModel();
            self::setFromFetch($aFetch, $aRecord[count($aRecord) - 1]);
            $this->readChilds($iChildLevel - 1, $aRecord[count($aRecord) - 1]);
        }
        return $aRecord;
    }

    public function read($iChildLevel){
        if($iChildLevel < 0){
            return;
        }
        $aColumns = $this->Reflection->getColumns();
        $aWhere   = [];
        foreach($aColumns as $sNameModel => $aColumn){
            if($aColumn['pk'] == true){
                $aWhere['columns'][] = $aColumn['name'] . ' = ?';
                $aWhere['values'][]  = Bean::get($sNameModel, $this->Model);
            }
        }
        $sSql  = $this->getSelect();
        $sSql .= ' WHERE ' . implode(' AND ', $aWhere['columns']);
        $this->Query->setSql($sSql);
        $this->Query->execute($aWhere['values']);
        if($aFetch = $this->Query->fetch()){
            self::setFromFetch($aFetch, $this->Model);
            $this->readChilds($iChildLevel - 1);
            return true;
        }
        return false;
    }
    
    private function readChilds($iChildLevel, $oModel = null){
        $oModel = is_null($oModel) ? $this->Model : $oModel;
        foreach($this->Reflection->getChilds() as $sProperty){
            Bean::get($sProperty, $oModel)->read($iChildLevel);
        }
    }

    public function insert(){
        list($aColumns, $aValues) = [[], []];
        foreach($this->Reflection->getColumns() as $sNameModel => $aColumn){
            $aColumns[] = $aColumn['name'];
            if($aColumn['serial'] == true && !isset($aColumn['fk'])){
                Bean::set($sNameModel, $this->getNextSequence($aColumn['name']), $this->Model);
            }
            $aValues[] = Bean::get($sNameModel, $this->Model);
        }
        $sSql = Query::getInsert($this->Reflection->getTable(), $aColumns);
        $this->Query->setSql($sSql);
        return $this->Query->execute($aValues);
    }

    public function update(){
        list($aColumns, $aWhere) = [[], []];
        foreach($this->Reflection->getColumns() as $sNameModel => $aColumn){
            $sColumnValue = Bean::get($sNameModel, $this->Model);
            if($aColumn['pk'] == true){
                $aWhere['columns'][] =  $aColumn['name'] . ' = ?';
                $aWhere['values'][]  = $sColumnValue;
            }else{
                $aColumns['columns'][] = $aColumn['name'];
                $aColumns['values'][]  = $sColumnValue;
            }
        }
        $sSql  = Query::getUpdate($this->Reflection->getTable(), $aColumns['columns']);
        $sSql .= ' WHERE ' . implode(' AND ', $aWhere['columns']);
        $this->Query->setSql($sSql);
        $aValues = array_merge($aColumns['values'], $aWhere['values']);
        return $this->Query->execute($aValues);
    }

    public function delete(){
        list($aColumns, $aValues) = [[], []];
        foreach($this->Reflection->getColumns() as $sNameModel => $aColumn){
            if($aColumn['pk'] == true){
                $aColumns[] = $aColumn['name'] . ' = ?';
                $aValues[]  = Bean::get($sNameModel, $this->Model);
            }
        }
        $sSql  = "DELETE FROM {$this->Reflection->getTable()} WHERE ";
        $sSql .= implode(' AND ', $aColumns);
        $this->Query->setSql($sSql);
        return $this->Query->execute($aValues);
    }

    public function exists(){
        $aWhere = $this->getWhereWhenNotEmpty();
        $sSql   = $this->getSelect() . ' WHERE ' . implode(' AND ', $aWhere['where']);
        $this->Query->setSql($sSql);
        $this->Query->execute($aWhere['values']);
        if($aFetch = $this->Query->fetch()){
            self::setFromFetch($aFetch, $this->Model);
            return true;
        }
        return false;
    }

    public function getPkComposition(){
        return $this->Reflection->getPkComposition();
    }

    public static function setFromFetch($aFetch, $oModel){
        foreach($aFetch as $sProperty => $sValue){
            Bean::set($sProperty, $sValue, $oModel);
        }
    }

    private function getSelect(){
        $aColumns = [];
        foreach($this->Reflection->getColumns() as $sNameModel => $aColumn){
            $sColumn = $this->Reflection->getTable() . '.' . $aColumn['name'];
            $aColumns[$sNameModel] = $sColumn;
        }
        return Query::getSelect($this->Reflection->getTable(), $aColumns);
    }

    private function getWhereWhenNotEmpty(){
        $aConditions = [];
        foreach($this->Reflection->getColumns() as $sNameModel => $aColumn){
            $sValue = Bean::get($sNameModel, $this->Model);
            if(!isEmpty($sValue)){
                $aConditions['where'][]  = "{$aColumn['name']} = ?";
                $aConditions['values'][] = $sValue;
            }
        }
        return $aConditions;
    }

    private function getNextSequence($sColumn){
        $sSql = Query::getSelectMax($this->Reflection->getTable(), $sColumn, 1, 1);
        $this->Query->setSql($sSql);
        $this->Query->execute();
        $aFetch = $this->Query->fetch();
        return (int) $aFetch['max'];
    }

}
