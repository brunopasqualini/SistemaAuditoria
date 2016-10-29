<?php
namespace App\Controller;

class ControllerLogout extends Controller {
    
    public function process(){
        ControllerUserSession::logout();
        $this->App->redirect('');
    }
    
}