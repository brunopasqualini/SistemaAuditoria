<?php
namespace App\Core\Database;

class ConnectionPgSql extends Connection {

    protected function getDsn() {
        return "pgsql:host={$this->host};port={$this->port};dbname={$this->database};options='{$this->getOptionsCLI()}'";
    }

    /**
     * This options will be used as parameters on command line when invoked by the server
     */
    private function getOptionsCLI(){
        $aOptions = [
            'client_encoding' => 'UTF8',
            'datestyle'       => 'SQL,DMY',
            'timezone'        => 'America/Sao_Paulo'
        ];
        $sOptions = implode(';', array_filter($aOptions, function(&$sValue, $sOption) {
            $sValue = "--{$sOption}={$sValue}";
            return true;
        }, ARRAY_FILTER_USE_BOTH));
        return $sOptions;
    }

}
