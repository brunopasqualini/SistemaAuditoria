<?php
namespace App\Core\Database;

class ConnectionPgSql extends Connection {

    protected function getDsn() {
        return "pgsql:host={$this->host};port={$this->port};dbname={$this->database}";
    }

}
