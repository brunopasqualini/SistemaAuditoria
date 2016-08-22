<?php
class ViewFormulario extends ViewDefault {

    //http://demo.geekslabs.com/materialize/v3.1/form-validation.html

    private $Form;

    protected function init(){
        $this->Form = new Formulario('teste');
    }

    protected function criaConteudo(Elemento $oContainer){

    }

}
