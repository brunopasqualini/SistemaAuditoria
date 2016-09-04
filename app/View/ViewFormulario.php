<?php
namespace App\View;

use App\Core\Elemento;
use App\Core\Form\Form;

class ViewFormulario extends ViewDefault {

    //http://demo.geekslabs.com/materialize/v3.1/form-validation.html

    private $Form;

    protected function init(){
        $this->Form = new Form('teste');
    }

    protected function createContent(Element $oContainer){

    }

}
