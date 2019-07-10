<?php
class forgotpassword extends controller{
    public function __construct(){
        parent::__construct();
        $this->view->js = array('forgot-password/js/default.js');
    }
    public function index(){
        $this->view->render("forgot-password/index");
    }
    public function verifyEmail(){
        $data['email'] = $this->escape_value($_POST['email']);
        $response = $this->model->verifyEmail($data);
        echo $response;
    }
}