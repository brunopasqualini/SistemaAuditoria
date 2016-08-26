<?php
namespace App\Core;

class Elemento implements ElementoRenderer{

    const TYPE_OPENED  = 1;
    const TYPE_CLOSED  = 2;
    const TYPE_CONTENT = 3;

    private $Css;
    private $Attr;
    private $tag;
    private $type;
    private $content;

    protected $filhos = [];

    public function __construct($tag, $type = self::TYPE_CLOSED){
        $this->Css  = new ComponenteCSS();
        $this->Attr = new ComponenteAttr();
        $this->tag  = $tag;
        $this->type = $type;
    }

    public function render(){
        echo " <{$this->tag} {$this->Attr} {$this->Css}>";
        if($this->type == self::TYPE_CONTENT){
            echo $this->content;
        }
        else{
            foreach($this->filhos as $filho){
                $filho->render();
            }
        }
        if(in_array($this->type, Array(self::TYPE_CLOSED, self::TYPE_CONTENT))){
            echo "</$this->tag>";
        }
    }

    private function addFilho(ElementoRenderer $oFilho){
        $this->filhos[] = $oFilho;
    }

    public function addFilhos(){
        $aFilhos = func_get_args();
        foreach ($aFilhos as $oFilho) {
            $this->addFilho($oFilho);
        }
        return $this;
    }

    public function setTexto($text){
        $this->content = $text;
        return $this;
    }

    public function getCSS(){
        return $this->Css;
    }

    public function getAttr(){
        return $this->Attr;
    }

}
