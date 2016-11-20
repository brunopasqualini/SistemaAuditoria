<?php
namespace App\Controller;

class ControllerIndex extends Controller {

    public function process(){
        if(!ControllerUserSession::isAuth()){
            $oIndex = new \App\View\ViewLogin();
            $oIndex->render();
        }else{
            if(ControllerUserSession::getUser()->getTipo() == \App\Model\ModelUsuario::TIPO_NORMAL){
                $this->App->redirect('?path=gridProdutoCompra');
            }else{
                $this->App->redirect('?path=gridProduto');
            }
        }
    }

}
