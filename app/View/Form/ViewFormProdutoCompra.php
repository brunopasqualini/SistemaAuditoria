<?php
namespace App\View\Form;

class ViewFormProdutoCompra extends ViewFormProduto {

    public function __construct(){
        $this->setTitle('Comprar Produto');
        parent::__construct('formProdutoCompra');
    }

}
