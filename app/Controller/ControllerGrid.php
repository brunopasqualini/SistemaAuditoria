<?php
namespace App\Controller;

use App\Model\ModelAbstract;

class ControllerGrid extends ControllerUserSession {

    protected $Model;
    protected $View;

    public function __construct(){
        parent::__construct();
        $this->View  = $this->getView();
        $this->Model = $this->getModel();
    }
    
    protected function getDescriptionLog() {
        return $this->getView()->getTitle();
    }

    public function process(){
        $aIdentifiers = $this->getInlineActionIdentifiers();
        $this->View->getGrid()->setInlineActionIdentifiers('record');
        $this->View->getGrid()->setInlineActionIdentifiers(htmlentities("'".json_encode($aIdentifiers)."'"));
        $this->View->render();
    }

    public function getRecords(){
        echo json_encode(ModelAbstract::getAll($this->Model, 2));
    }

    protected function getView(){
        $sView = '\App\View\Grid\View'.ucfirst($this->getPath());
        return new $sView();
    }

    protected function getModel(){
        $sModel = ucfirst(preg_replace('/^grid/', '', $this->getPath()));
        $sModel = '\App\Model\Model'.$sModel;
        return new $sModel();
    }

    protected function getInlineActionIdentifiers(){
        $aIdentifiers = array_keys($this->Model->getPkComposition());
        foreach($aIdentifiers as $iKey => $sIdentifier){
            $aIdentifiers[$iKey] = strtolower($sIdentifier);
        }
        return $aIdentifiers;
    }

}
