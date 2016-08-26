<?php
namespace App\Core;

class ElementoImg extends Elemento {

    public function __construct($src){
        parent::__construct('img', Elemento::TYPE_OPENED);
        $this->setUrl($src);
    }

    public function setUrl($src){
        $this->getAttr()->addAttr('src', \App::getPath('img') . $src);
    }

}
