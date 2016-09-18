<?php
namespace App\Controller;

use App\Model\Bean;

class ControllerForm extends Controller {

    protected $Model;
    protected $View;

    public function __construct(){
        parent::__construct();
        $this->View  = $this->getView();
        $this->Model = $this->getModel();
    }

    public function process(){
        if($this->isGet()){
            $this->renderView();
            return;
        }
        $this->setViewValuesFromRequest();
        $this->setModelValuesFromView();
        $this->App->DB->begin();
        $sMethod = 'process' . ucfirst($this->getAction());
        $this->$sMethod();
        $this->App->DB->commit();
    }

    protected function processInsert(){
        $this->Model->insert();
    }

    protected function processUpdate(){
        $this->setModelIdentifiersValues();
        $this->Model->update();
    }

    protected function processDelete(){
        $this->setModelIdentifiersValues();
        $this->Model->delete();
    }

    protected function renderView(){
        if(in_array($this->getAction(), [self::ACTION_UPDATE, self::ACTION_READ])){
            $oForm = $this->View->getForm();
            $this->setModelIdentifiersValues(function($sField, $sValue) use ($oForm) {
                $oForm->addParam($sField, $sValue);
            });
            $this->Model->read();
            $this->setViewValuesFromModel();
            $this->View->getForm()->setReadonly($this->getAction() === self::ACTION_READ);
        }
        else if($this->getAction() == self::ACTION_DELETE){
            $this->View->getForm()->setAction(self::ACTION_INSERT);
        }
        $this->View->render();
    }

    protected function setModelIdentifiersValues($fnCallback = null){
        $aFields = array_keys($this->Model->getPkComposition());
        foreach($aFields as $sField){
            $sValue = $this->App->getParam($sField);
            //DAR EXECEÇÃO SE TIVER EM BRANCO a chave
            Bean::set($sField, $sValue, $this->Model);
            if(is_callable($fnCallback)){
                $fnCallback($sField, $sValue);
            }
        }
    }

    protected function setViewValuesFromRequest(){
        $aFields = $this->View->getForm()->getFields();
        foreach($aFields as $oField){
            $sValue = $this->App->getParam($oField->getName());
            $oField->setValue($sValue);
        }
    }

    protected function setModelValuesFromView(){
        $aFields = $this->View->getForm()->getFields();
        foreach($aFields as $oField){
            Bean::set($oField->getName(), $oField->getValue(), $this->Model);
        }
    }

    protected function setViewValuesFromModel(){
        $aFields = $this->View->getForm()->getFields();
        foreach($aFields as $oField){
            $oField->setValue(Bean::get($oField->getName(), $this->Model));
        }
    }

    protected function getView(){
        $sView = '\App\View\View'.ucfirst($this->getPath());
        $oView = new $sView();
        $oView->getForm()->setAction($this->getAction());
        return $oView;
    }

    protected function getModel(){
        $sModel = ucfirst(preg_replace('/^form/', '', $this->getPath()));
        $sModel = '\App\Model\Model'.$sModel;
        return new $sModel();
    }

}
