<?php
namespace App\Core;

class Formulario implements ElementoRenderer {

    private $Form;

    private $campos = [];
    private $path;
    private $process;
    private $descBtn;

    public function __construct($path, $process = 'processa'){
        $this->setPath($path);
        $this->setProcess($process);
        $this->Form = new Elemento('form');
        $this->Form->getAttr()->addAttr('method', 'post');
    }

    private function addCampo(Campo $oCampo){
        $this->campos[] = $oCampo;
    }

    public function addField(){
        $aFilhos = func_get_args();
        foreach ($aFilhos as $oFilho) {
            $this->addCampo($oFilho);
        }
        return $this;
    }

    public function setPath($path){
        $this->path = $path;
    }

    public function setProcess($process){
        $this->process = $process;
    }

    public function setDescriptionBtn($description){
        $this->descBtn = $description;
    }

    public function render(){
        $sUrl = "?path={$this->path}&process={$this->process}";
        $this->Form->getAttr()->addAttr('action', $sUrl);
        foreach($this->campos as $campo){
            $oContainer = new Elemento('div');
            $oContainer->getCss()->addClass('input-field');
            $oLabel = new Elemento('label', Elemento::TYPE_CONTENT);
            $oLabel->getAttr()->addAttr('for', $campo->getName());
            $oLabel->setTexto($campo->getLabel());
            if(!isEmpty($campo->getIcon())){
                $oIcon = new Elemento('i', Elemento::TYPE_CONTENT);
                $oIcon->getCss()->addClass('material-icons prefix');
                $oIcon->setTexto($campo->getIcon());
                $oContainer->addFilhos($oIcon);
            }
            $oContainer->addFilhos($campo, $oLabel);
            $this->Form->addFilhos($oContainer);
        }
        $oSubmit = new Elemento('button', Elemento::TYPE_CONTENT);
        $oSubmit->setTexto($this->descBtn);
        $oSubmit->getCss()
                ->addClass('btn cor-tema waves-effect')
                ->addProp('width', '100%');
        $oSubmit->getAttr()
                ->addAttr('type', 'submit')
                ->addAttr('name', 'enviar');

        $this->Form->addFilhos($oSubmit);
        $this->Form->render();
    }

}
