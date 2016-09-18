<?php
namespace App\Controller;

class ControllerLogin extends ControllerForm {

    public function process(){
        $this->setViewValuesFromRequest();
        $this->setModelValuesFromView();
        $bExists = $this->Model->exists();
        if($bExists){
            //SETAR NA SESSAO O USUARIO
            //LOGOU E REDIRECIONA PARA O INDEX
            $this->App->redirect('');
        }
        else{
            $this->View->setMessage('Usuário e/ou senha inválido');
            $this->View->render();
        }
    }

    protected function getView(){
        return new \App\View\ViewLogin();
    }

    protected function getModel(){
        return new \App\Model\ModelUsuario();
    }

}
