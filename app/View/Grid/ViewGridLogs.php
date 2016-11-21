<?php
namespace App\View\Grid;

use App\Core\Grid\Grid;
use App\Core\Grid\GridField;

class ViewGridLogs extends ViewGrid {

    public function __construct(){
        parent::__construct();
        $this->setTitle('Logs de Banco de Dados');
    }

    protected function initGrid(Grid $oGrid){
        $oGrid->setPath('gridLogs');
        $oGrid->addField(new GridField('usuario.cliente.nome',   'Usuário'));
        $oGrid->addField(new GridField('tabela',       'Tabela'));
        $oGrid->addField(new GridField('dadoatual',    'Dado atual'));
        $oGrid->addField(new GridField('dadoanterior', 'Dado anterior'));
        $oGrid->addField(new GridField('datahora',     'Data/Hora'));
        $oGrid->addField(new GridField('ip',           'IP'));
        $oGrid->addField(new GridField('descricao',    'Descrição'));
        
    }

}
