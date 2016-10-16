<?php
namespace App\Model;

use App\Core\Database\Query;
use App\Model\Bean;

abstract class Record {

    protected $Reflection;
    protected $Query;

    public function __construct(){
        $this->Reflection = new RecordReflection($this);
        $this->Query      = new Query();
    }

    public function getAll($iChildLevel = false){
        $aRecord = [];
        $this->Query->setSql($this->getSelect());
        $this->Query->execute();
        while($aFetch = $this->Query->fetch()){
            $sNewModel = get_class($this);
            $aRecord[] = new $sNewModel();
            self::setFromFetch($aFetch, $aRecord[count($aRecord) - 1]);
        }
        return $aRecord;
    }

    public function read($iChildLevel = false){
        $aColumns = $this->Reflection->getColumns();
        $aWhere   = [];
        foreach($aColumns as $sNameModel => $aColumn){
            if($aColumn['pk'] == true){
                $aWhere['columns'][] = $aColumn['name'] . ' =  ?';
                $aWhere['values'][]  = Bean::get($sNameModel, $this);
            }
        }
        $sSql  = $this->getSelect();
        $sSql .= ' WHERE ' . implode(' AND ', $aWhere['columns']);
        $this->Query->setSql($sSql);
        $this->Query->execute($aWhere['values']);
        if($aFetch = $this->Query->fetch()){
            self::setFromFetch($aFetch, $this);
            return true;
        }
        return false;
    }

    public function insert(){
        list($aColumns, $aValues) = [[], []];
        foreach($this->Reflection->getColumns() as $sNameModel => $aColumn){
            $aColumns[] = $aColumn['name'];
            if($aColumn['serial'] == true){
                Bean::set($sNameModel, $this->getNextSequence($aColumn['name']), $this);
            }
            $aValues[] = Bean::get($sNameModel, $this);
        }
        $sSql = Query::getInsert($this->Reflection->getTable(), $aColumns);
        $this->Query->setSql($sSql);
        return $this->Query->execute($aValues);
    }

    public function update(){
        list($aColumns, $aWhere) = [[], []];
        foreach($this->Reflection->getColumns() as $sNameModel => $aColumn){
            $sColumnValue = Bean::get($sNameModel, $this);
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
                $aValues[]  = Bean::get($sNameModel, $this);
            }
        }
        $sSql  = "DELETE FROM {$this->Reflection->getTable()} WHERE ";
        $sSql .= implode(' AND ', $aColumns);
        $this->Query->setSql($sSql);
        return $this->Query->execute($aValues);
    }

    public static function setFromFetch($aFetch, $oModel){
        foreach($aFetch as $sProperty => $sValue){
            Bean::set($sProperty, $sValue, $oModel);
        }
    }

    public function getPkComposition(){
        return $this->Reflection->getPkComposition();
    }

    protected function getSelect(){
        $aColumns = [];
        foreach($this->Reflection->getColumns() as $sNameModel => $aColumn){
            $sColumn = $this->Reflection->getTable() . '.' . $aColumn['name'];
            $aColumns[$sNameModel] = $sColumn;
        }
        return Query::getSelect($this->Reflection->getTable(), $aColumns);
    }

    protected function getWhereWhenNotEmpty(){
        $aConditions = [];
        foreach($this->Reflection->getColumns() as $sNameModel => $aColumn){
            $sValue = Bean::get($sNameModel, $this);
            if(!isEmpty($sValue)){
                $aConditions['where'][]  = "{$aColumn['name']} = ?";
                $aConditions['values'][] = $sValue;
            }
        }
        return $aConditions;
    }

    public function exists(){
        $aWhere = $this->getWhereWhenNotEmpty();
        $sSql   = $this->getSelect() . ' WHERE ' . implode(' AND ', $aWhere['where']);
        $oQuery = new Query();
        $oQuery->setSql($sSql);
        $oQuery->execute($aWhere['values']);
        if($aUser = $oQuery->fetch()){
            self::setFromFetch($aUser, $this);
            return true;
        }
        return false;
    }

    private function getNextSequence($sColumn){
        $sSql = Query::getSelectMax($this->Reflection->getTable(), $sColumn, 1, 1);
        $this->Query->setSql($sSql);
        $this->Query->execute();
        $aFetch = $this->Query->fetch();
        return (int) $aFetch['max'];
    }

}
