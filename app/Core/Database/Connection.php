<?php
namespace App\Core\Database;

use App\Core\Exception\Database\ConnectionException;

abstract class Connection {

    const TYPE_MYSQL  = 1;
    const TYPE_PGSQL  = 2;

    protected $host;
    protected $port;
    protected $user;
    protected $pass;
    protected $database;

    private $PDO;

    private function __construct(){}

    private function setConfig($sHost, $iPort, $sUser, $sPass, $sDatabase){
        $this->host     = $sHost;
        $this->port     = $iPort;
        $this->user     = $sUser;
        $this->pass     = $sPass;
        $this->database = $sDatabase;
    }

    public static function get(){
        $aConfig = \App::getInstance()->Config->getConfig('database');
        $oCon    = self::create($aConfig['type']);
        $oCon->setConfig($aConfig['host'], $aConfig['port'], $aConfig['user'], $aConfig['pass'], $aConfig['database']);
        $oCon->connect();
        return $oCon;
    }

    private static function create($iType){
        switch ($iType) {
            case self::TYPE_MYSQL:
                return new ConnectionMySql();
            case self::TYPE_PGSQL:
                return new ConnectionPgSql();
        }
    }

    public function connect(){
        try {
            $this->PDO = new \PDO($this->getDsn(), $this->user, $this->pass, $this->getDefaultOptions());
            $this->PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->PDO->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        catch(\Exception $exc){
            throw new ConnectionException();
        }
    }

    public function prepare($sQuery, $aOptions = []){
        return $this->PDO->prepare($sQuery, $aOptions);
    }

    public function begin(){
        $this->PDO->beginTransaction();
    }

    public function commit(){
        $this->PDO->commit();
    }

    public function rollback(){
        $this->PDO->rollBack();
    }

    abstract protected function getDsn();

    protected function getOptions() {
        return [];
    }

    private function getDefaultOptions(){
        return $this->getOptions() + [
            \PDO::ATTR_PERSISTENT => false
        ];
    }

    public function disconnect(){
        $this->PDO = null;
    }

    public function __destruct(){
        $this->disconnect();
    }

}
