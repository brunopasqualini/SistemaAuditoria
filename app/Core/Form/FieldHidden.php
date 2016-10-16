<?php
namespace App\Core\Form;

use App\Core\Element;

class FieldHidden extends Field {

    public function __construct($sName){
        parent::__construct('hidden', $sName, '', false, Element::TYPE_OPENED);
    }

}
