<?php
namespace App\Core\Database;

class ConnectionMySql extends Connection {

    protected function getDsn() {
        return "mysql:host={$this->host};port={$this->port};dbname={$this->database}";
    }

    protected function getOptions() {
        return [\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
    }

}
