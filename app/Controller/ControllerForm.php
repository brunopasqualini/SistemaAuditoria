<?php
namespace App\Controller;

use App\Model\Bean;
use App\Core\Form\FormConfirm;

class ControllerForm extends ControllerUserSession {

    const ACTION_INSERT = 'insert';
    const ACTION_UPDATE = 'update';
    const ACTION_DELETE = 'delete';
    const ACTION_READ   = 'read';

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
        if($this->isGet()){
            $this->renderView();
            return;
        }
        if($this->getAction() !== self::ACTION_DELETE){
            $this->setViewValuesFromRequest();
            $this->setModelValuesFromView();
        }
        $this->App->DB->begin();
        $sMethod = 'process' . ucfirst($this->getAction());
        $this->$sMethod();
        $this->App->DB->commit();
        echo json_encode(['status' => true, 'message' => 'Sucesso']);
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
            $this->disabledIdentifiersFields();
        }
        else if($this->getAction() == self::ACTION_DELETE){
            $oConfirm = new FormConfirm($this->getPath(), $this->getAction());
            $aFields  = array_keys($this->Model->getPkComposition());
            foreach($aFields as $sField){
                $sValue = $this->App->getParam($sField, false);
                if($sValue !== false){
                    $oConfirm->addParam($sField, $sValue);
                }
            }
            $oConfirm->render();
        }
        if(!$this->isAjax()){
            $this->View->render();
        }else{
            $this->View->renderAsModal();
        }
    }
    
    protected function disabledIdentifiersFields(){
        $aFields = array_keys($this->Model->getPkComposition());
        foreach($aFields as $sField){
            if($oField = $this->View->getForm()->getField($sField)){
                $oField->setReadonly(true);
            }
            
        }
    }

    protected function setModelIdentifiersValues($fnCallback = null){
        $aFields = array_keys($this->Model->getPkComposition());
        foreach($aFields as $sField){
            $sValue = $this->App->getParam($sField, false);
            if($sValue === false){
                throw new \App\Core\Exception\Form\EmptyValueFieldException($sField);
            }
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
        $sView = '\App\View\Form\View'.ucfirst($this->getPath());
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
