<?php
namespace App\View\Form;

use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldNumeric;
use App\Core\Form\FieldCombo;
use App\Model\ModelVenda;

class ViewFormVenda extends ViewForm {

    public function __construct(){
        $this->setTitle('Venda');
        parent::__construct('formVenda');
    }

    protected function initForm(Form $oForm){
        $oCliente       = new FieldCombo('cliente', 'Cliente',   true);
        $oCliente->setLength(150);
        $oProduto       = new FieldCombo('produto', 'Produto', true);
        $oProduto->setLength(150);
        $oData          = new Field('date', 'data', 'Data', true);
        $oData->setLength(150);
        $oQuantidade    = new FieldNumeric('quantidade', 'Quantidade', true);
        $oQuantidade->setLength(150);
        $oDataPagamento = new Field('date', 'datapagamento', 'Data Pagamento', true);
        $oDataPagamento->setLength(150);
        $oValorPago     = new FieldNumeric('valorpago', 'Valor Pago', true);
        $oValorPago->setLength(150);
        
        
        
        $oForm->addField($oCliente,  $oProduto, $oData, $oQuantidade, $oDataPagamento, $oValorPago);
    }

}
