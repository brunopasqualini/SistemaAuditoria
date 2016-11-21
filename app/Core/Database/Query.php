<?php
namespace App\Core\Database;

class Query {

    private $DB;
    private $Stmt;
    private $sql;

    public function __construct($oDB = null){
        $this->DB = $oDB;
        if(is_null($oDB)){
            $this->DB = \App::getInstance()->DB;
        }
    }

    public function setSql($sSql){
        $this->sql = $sSql;
    }

    public function execute($aValues = []){
        $this->Stmt = $this->DB->prepare($this->sql);
        foreach($aValues as $iKey => $xValue){
            $this->Stmt->bindValue($iKey + 1, $xValue, $this->getDataTypeFromValue($xValue));
        }
        return $this->Stmt->execute();
    }

    private function getDataTypeFromValue(&$xValue){
        switch(true){
            case is_null($xValue):
                return \PDO::PARAM_NULL;
            case is_bool($xValue):
                $xValue = $xValue === true ? 1 : 0;
            case is_int($xValue):
                return \PDO::PARAM_INT;
            case is_double($xValue):
                $xValue = strval($xValue);
            default:
                return \PDO::PARAM_STR;
        }
    }

    public function fetch(){
        return $this->Stmt->fetch();
    }

    public static function getSelectMax($sTable, $sColumn, $fDefault = 0, $fAdition = 0){
        return "SELECT COALESCE(MAX({$sColumn}) + {$fAdition}, {$fDefault}) max FROM {$sTable}";
    }

    public static function getSelect($sTable, $aColumns){
        foreach ($aColumns as $sAlias => $sColumn) {
            if(is_string($sAlias)){
                $aColumns[$sAlias] = "{$sColumn} as \"{$sAlias}\"";
            }
        }
        $sColumns = implode(', ', $aColumns);
        return "SELECT {$sColumns} FROM {$sTable}";
    }

    public static function getInsert($sTable, $aColumns){
        $sValues  = implode(', ', array_fill(0, count($aColumns), '?'));
        $sColumns = implode(', ', $aColumns);
        return "INSERT INTO {$sTable} ({$sColumns}) VALUES ({$sValues})";
    }

    public static function getUpdate($sTable, $aColumns){
        $sSet = implode(', ', array_map(function($sColumn) {
            return "{$sColumn} = ?";
        }, $aColumns));
        return "UPDATE {$sTable} SET {$sSet}";
    }

}
