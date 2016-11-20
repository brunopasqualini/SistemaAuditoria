<?php

namespace App\Controller;

class ControllerFormProdutoCompra extends ControllerForm {
    
    public function process() {
        if($this->isGet()){
            parent::process();
            return;
        }
        $this->App->DB->begin();
        $this->setModelIdentifiersValues();
        $this->insereProduto();
        $this->App->DB->commit();
        echo json_encode(['status' => true, 'message' => 'Sucesso']);
    }
    
    private function insereProduto(){
        $this->Model->read();
        $oVenda = new \App\Model\ModelVenda();
        $oVenda->setCliente(ControllerUserSession::getUser()->getCliente());
        $oVenda->setProduto($this->Model);
        $oVenda->setData(now());
        $oVenda->setQuantidade(1);
        $oVenda->setDataPagamento(now());
        $oVenda->setValorPago($this->Model->getPreco() - ($this->Model->getPreco() * 0.1));
        $oVenda->insert();
    }

    protected function renderView() {
        $this->View->getForm()->setDescriptionBtn('Comprar');
        $oForm = $this->View->getForm();
        $this->setModelIdentifiersValues(function($sField, $sValue) use ($oForm) {
            $oForm->addParam($sField, $sValue);
        });
        $this->Model->read();
        $this->setViewValuesFromModel();
        $this->View->getForm()->getField('preco')->setReadonly(true);
        $this->View->getForm()->getField('estoque')->setReadonly(true);
        $this->View->getForm()->getField('descricao')->setReadonly(true);
        if(!$this->isAjax()){
            $this->View->render();
        }else{
            $this->View->renderAsModal();
        }
    }
    
    protected function getModel() {
        return new \App\Model\ModelProduto();
    }

}
