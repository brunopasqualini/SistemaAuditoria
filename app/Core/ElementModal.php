<?php
namespace App\Core;

use App\Core\Element;
use App\View\TemplateLoader;

class ElementModal implements ElementRenderer {

    private $Container;
    private $content;
    private $footer;

    public function __construct($sId){
        $this->Container = new Element('div', Element::TYPE_CONTENT);
        $this->Container->getCss()->addClass('modal');
        $this->Container->getAttr()->add('id', $sId);
    }

    public function render(){
        $this->Container->setText(TemplateLoader::load('modal_content', [
            'content'     => $this->content,
            'footer'      => $this->footer,
            'show-footer' => isEmpty($this->footer) ? 'none' : 'block'
        ]));
        $this->Container->render();
    }

    public static function renderContent($sContent, $sFooter = ''){
        TemplateLoader::flush('modal_content', [
            'content'     => $sContent,
            'footer'      => $sFooter,
            'show-footer' => isEmpty($sFooter) ? 'none' : 'block'
        ]);
    }

    public function setContent(ElementRenderer $oElement){
        ob_start();
        $oElement->render();
        $this->setContentText(ob_get_clean());
    }

    public function setContentText($sText){
        $this->content = $sText;
    }

    public function setFooter(ElementRenderer $oElement){
        ob_start();
        $oElement->render();
        $this->setFooterText(ob_get_clean());
    }

    public function setFooterText($sText){
        $this->footer = $sText;
    }

    public function setStyleFixedFooter(){
        $this->Container->getCss()->clearClass()->addClass('modal modal-fixed-footer');
    }

    public function setStyleBottomSheet(){
        $this->Container->getCss()->clearClass()->addClass('modal bottom-sheet');
    }

}
