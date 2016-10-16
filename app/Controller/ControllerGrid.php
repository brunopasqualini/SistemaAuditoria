<?php
namespace App\Controller;

class ControllerGrid extends Controller {

    private $Model;
    private $View;

    public function __construct(){
        parent::__construct();
        $this->Model = $this->getModel();
        $this->View  = $this->getView();
    }

    public function process(){
        $aIdentifiers = $this->getInlineActionIdentifiers();
        $this->View->getGrid()->setInlineActionIdentifiers('record');
        $this->View->getGrid()->setInlineActionIdentifiers(htmlentities("'".json_encode($aIdentifiers)."'"));
        $this->View->render();
    }

    public function getRecords(){
        echo json_encode($this->getModel()->getAll());
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
