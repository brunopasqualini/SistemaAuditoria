<?php
namespace App\Controller;

use App\Core\Email\Email;

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
            $this->View->setMessage('Usuário bloqueado. Foi enviada uma mensagem ao administrador, contate-o');
            $this->View->render();
        }
        else{
            self::logout();
            $this->Model->setSenha('');
            $this->Model->exists();
            $iTentativaLogin = $this->Model->getTentativaLogin();
            $iTentativaLogin++;
            $this->Model->setTentativaLogin($iTentativaLogin);
            $this->Model->update();
            $this->View->setMessage('Usuário e/ou senha inválido');
            $this->View->render();
            if($iTentativaLogin == 3){
                $this->Model->getCliente()->read();
                $oEmail = new Email();
                $oEmail->enviaEmail($this->Model->getCliente()->getNome());
            }
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
