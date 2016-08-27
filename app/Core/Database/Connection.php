<?php
namespace App\Core\Database;

abstract class Connection {

    const TYPE_MYSQL = 1;
    const TYPE_PGSQL = 2;

    protected $host;
    protected $port;
    protected $user;
    protected $pass;
    protected $database;

    private $PDO;

    private function __construct($host, $port, $user, $pass, $database){
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;
    }

    public static function get(){
        $aConfig = \App::getInstance()->Config->getConfig('database');
        $iType   = (int) $aConfig['type'];
        if($iType == self::TYPE_MYSQL){
            $oCon = new ConnectionMySql($aConfig['host'], $aConfig['port'], $aConfig['user'], $aConfig['pass'], $aConfig['database']);
        }
        else if($iType == self::TYPE_PGSQL){
            $oCon = new ConnectionPgSql($aConfig['host'], $aConfig['port'], $aConfig['user'], $aConfig['pass'], $aConfig['database']);
        }
        $oCon->connect();
    }

    public function connect(){
        try {
            $this->PDO = new \PDO($this->getDsn(), $this->user, $this->pass, $this->getDefaultOptions());
            $this->PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->PDO->setAttribute(\PDO::ATTR_AUTOCOMMIT, false);
            $this->PDO->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        catch(\Exception $exc){
            echo $exc->getMessage();
        }

    }

    abstract protected function getDsn();

    private function getDefaultOptions(){
        return $this->getOptions() + [
            \PDO::ATTR_PERSISTENT => false
        ];
    }

    protected function getOptions() {
        return [];
    }

    public function disconnect(){
        $this->PDO = null;
    }

    public function __destruct(){
        $this->disconnect();
    }

}
