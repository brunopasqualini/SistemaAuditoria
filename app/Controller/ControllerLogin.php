<?php
namespace App\Controller;

class ControllerLogin extends ControllerForm {

    public function process(){
        $this->setViewValuesFromRequest();
        $this->setModelValuesFromView();
        $this->Model->setAtivo(1);
        $bExists = $this->Model->exists();
        if($bExists){
            if($this->Model->getTentativaLogin() <= 2){
                $this->Model->setTentativaLogin(0);
                $this->Model->update();
                self::login($this->Model);
                $this->App->redirect('');
            }
            $this->View->setMessage('Usuário bloqueado, contate o administrador');
            $this->View->render();
        }
        else{
            self::logout();
            $this->Model->setSenha('');
            $this->Model->exists();
            $this->Model->setTentativaLogin($this->Model->getTentativaLogin() + 1);
            $this->Model->update();
            $this->View->setMessage('Usuário e/ou senha inválido');
            $this->View->render();
        }
    }
    
    protected function checkLogin(){
        return false;
    }

    protected function getView(){
        return new \App\View\ViewLogin();
    }

    protected function getModel(){
        return new \App\Model\ModelUsuario();
    }

}
