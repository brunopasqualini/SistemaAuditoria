<?php
namespace App\Persistence;

use App\Core\Database\Query;
use App\Model\Bean;

class Persistence extends PersistenceAbstract {

    public function read($iChildLevel = false){
        list($aColumns, $aWhere) = [[], []];
        foreach($this->getColumns() as $sNameModel => $aColumn){
            $sColumn = $this->getTable() . '.' . $aColumn['name'];
            $aColumns[$sNameModel] = $sColumn;
            if($aColumn['pk'] == true){
                $aWhere['columns'][] = $sColumn . ' =  ?';
                $aWhere['values'][]  = Bean::get($sNameModel, $this->Model);
            }
        }
        $sSql  = Query::getSelect($this->getTable(), $aColumns);
        $sSql .= ' WHERE ' . implode(' AND ', $aWhere['columns']);
        $this->Query->setSql($sSql);
        $this->Query->execute($aWhere['values']);
        if($aFetch = $this->Query->fetch()){
            self::setFromFetch($aFetch, $this->Model);
            return true;
        }
        return false;
    }

    public function insert(){
        list($aColumns, $aValues) = [[], []];
        foreach($this->getColumns() as $sNameModel => $aColumn){
            $aColumns[] = $aColumn['name'];
            if($aColumn['serial'] == true){
                Bean::set($sNameModel, $this->getNextSequence($aColumn['name']), $this->Model);
            }
            $aValues[] = Bean::get($sNameModel, $this->Model);
        }
        $sSql = Query::getInsert($this->getTable(), $aColumns);
        $this->Query->setSql($sSql);
        return $this->Query->execute($aValues);
    }

    public function update(){
        list($aColumns, $aWhere) = [[], []];
        foreach($this->getColumns() as $sNameModel => $aColumn){
            $sColumnValue = Bean::get($sNameModel, $this->Model);
            if($aColumn['pk'] == true){
                $aWhere['columns'][] =  $aColumn['name'] . ' = ?';
                $aWhere['values'][]  = $sColumnValue;
            }else{
                $aColumns['columns'][] = $aColumn['name'];
                $aColumns['values'][]  = $sColumnValue;
            }
        }
        $sSql    = Query::getUpdate($this->getTable(), $aColumns['columns']);
        $sSql   .= ' WHERE ' . implode(' AND ', $aWhere['columns']);
        $this->Query->setSql($sSql);
        $aValues = array_merge($aColumns['values'], $aWhere['values']);
        return $this->Query->execute($aValues);
    }

    public function delete(){
        list($aColumns, $aValues) = [[], []];
        foreach($this->getColumns() as $sNameModel => $aColumn){
            if($aColumn['pk'] == true){
                $aColumns[] = $aColumn['name'] . ' = ?';
                $aValues[]  = Bean::get($sNameModel, $this->Model);
            }
        }
        $sSql  = "DELETE FROM {$this->getTable()} WHERE ";
        $sSql .= implode(' AND ', $aColumns);
        $this->Query->setSql($sSql);
        return $this->Query->execute($aValues);
    }

    private function getNextSequence($sColumn){
        $sSql = Query::getSelectMax($this->getTable(), $sColumn, 1, 1);
        $this->Query->setSql($sSql);
        $this->Query->execute();
        $aFetch = $this->Query->fetch();
        return (int) $aFetch['max'];
    }

}
