<?php
class account extends controller{
    public function __construct(){
        parent::__construct();
    }
    
    public function activate($email){
        $zima_user_id  = base64_decode($_GET['zima']);
        $this->model->activate($email, $zima_user_id);
        $this->view->render("account/index");
    }
}