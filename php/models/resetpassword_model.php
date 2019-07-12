<?php
class resetpassword_model extends model{
    
    public function __construct(){
        parent::__construct();
    }
    public function index($email){
        $this->view->render('resetpassword/index');
    }
    public function reset(){
        $data['email'] = $this->escape_value($_POST['email']);
        $data['newpassword'] = $this->escape_value($_POST['newpassword']);
        $data['oldpassword'] = $this->escape_value($_POST['confirmpassword']);
    }
}