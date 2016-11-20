<?php
namespace App\View\Grid;

use App\Core\Grid\Grid;
use App\Core\Grid\GridField;

class ViewGridLogsAcesso extends ViewGrid {

    public function __construct(){
        parent::__construct();
        $this->setTitle('LogsAcesso');
    }

    protected function initGrid(Grid $oGrid){
        $oGrid->setPath('gridLogsAcesso');
        $oGrid->addField(new GridField('usuario',   'Usuário'));
        $oGrid->addField(new GridField('sequencia', 'Código'));
        $oGrid->addField(new GridField('datahora',  'Data/Hora'));
        $oGrid->addField(new GridField('ip',        'IP'));
        $oGrid->addField(new GridField('descricao', 'Descricao'));
      
    }

}
