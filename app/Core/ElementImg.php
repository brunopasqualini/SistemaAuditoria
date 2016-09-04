<?php
namespace App\Core;

class ElementImg extends Element {

    public function __construct($sSrc){
        parent::__construct('img', Element::TYPE_OPENED);
        $this->setUrl($sSrc);
    }

    public function setUrl($sSrc){
        $this->getAttr()->add('src', \App::getPath('img') . $sSrc);
    }

}
