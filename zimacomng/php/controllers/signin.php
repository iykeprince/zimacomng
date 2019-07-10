<?php
class signin extends controller{
    public function __construct(){
        parent::__construct();
        Session::init();
        if(Session::get('user_login') === TRUE){
            header('location: '.URL.'user');
        }
    }
    public function index(){
        $this->view->render("auth/index");
    }
    public function authenticate(){
        $data['username'] = $this->escape_value($_POST['username']);
        $data['password'] = $this->escape_value($_POST['password']);
        $res = $this->model->authenticate($data);
        if($res){
            header('location: '.URL.'user/?status='.rand());
        }else {
            header('location: '.URL.'signin?redir=auth');
        }
    }
}