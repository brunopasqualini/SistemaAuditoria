<?php
namespace App\Controller;

class ControllerIndex extends Controller{

    public function process(){
        // verificar se já está logado, caso não tiver jogar pra view de login
        $oIndex = new \App\View\ViewLogin();
        $oIndex->render();
    }

}
