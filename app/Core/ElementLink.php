<?php
namespace App\Core;

class ElementLink extends Element {

    private $type;

    public function __construct($sUrl = '#!'){
        parent::__construct('a');
        $this->setUrl($sUrl);
    }

    public function setUrl($sUrl){
        $this->getAttr()->add('href', $sUrl);
    }

}
