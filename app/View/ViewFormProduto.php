<?php
namespace App\View;

use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldNumeric;

class ViewFormProduto extends ViewForm {

    public function __construct(){
        $this->setTitle('Produto');
        parent::__construct();
    }

    protected function getFormPath(){
        return 'formProduto';
    }

    protected function initForm(Form $oForm){
        $oPreco     = new FieldNumeric('preco',   'Preço',   true);
        $oPreco->setLength(17);
        $oEstoque   = new FieldNumeric('estoque', 'Estoque', true);
        $oEstoque->setLength(9);
        $oDescricao = new Field('text', 'descricao', 'Descrição', true);
        $oDescricao->setLength(100);
        $oForm->addField($oPreco, $oEstoque, $oDescricao);
    }

}
