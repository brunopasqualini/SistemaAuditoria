<?php
namespace App\Core;

class Element implements ElementRenderer{

    const TYPE_OPENED  = 1;
    const TYPE_CLOSED  = 2;
    const TYPE_CONTENT = 3;

    private $Css;
    private $Attr;
    private $tag;
    private $type;
    private $content;

    protected $childs = [];

    public function __construct($sTag, $iType = self::TYPE_CLOSED){
        $this->Css  = new ComponentCSS();
        $this->Attr = new ComponentAttr();
        $this->tag  = $sTag;
        $this->type = $iType;
    }

    public function render(){
        echo " <{$this->tag} {$this->Attr} {$this->Css}>";
        if($this->type == self::TYPE_CONTENT){
            echo $this->content;
        }
        else{
            foreach($this->childs as $oChild){
                $oChild->render();
            }
        }
        if(in_array($this->type, Array(self::TYPE_CLOSED, self::TYPE_CONTENT))){
            echo "</$this->tag>";
        }
    }

    private function verifyChild(ElementRenderer $oChild){
        $this->childs[] = $oChild;
    }

    public function addChild(){
        $aParams = func_get_args();
        foreach ($aParams as $oChild) {
            $this->verifyChild($oChild);
        }
        return $this;
    }

    public function setText($sText){
        $this->content = $sText;
        return $this;
    }

    public function getCSS(){
        return $this->Css;
    }

    public function getAttr(){
        return $this->Attr;
    }

}
