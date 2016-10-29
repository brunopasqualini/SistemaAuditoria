<?php
namespace App\Controller;

class ControllerIndex extends Controller {

    public function process(){
        if(!ControllerUserSession::isAuth()){
            $oIndex = new \App\View\ViewLogin();
            $oIndex->render();
        }else{
            $this->App->redirect('?path=gridProduto');
        }
    }

}
