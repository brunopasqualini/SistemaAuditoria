<?php
namespace App\Core;

class ElementoLink extends Elemento {

    private $type;

    public function __construct($url = '#!'){
        parent::__construct('a');
        $this->setUrl($url);
    }

    public function setUrl($url){
        $this->getAttr()->addAttr('href', $url);
    }

}
