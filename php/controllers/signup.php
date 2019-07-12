<?php
class signup extends controller{
    public function __construct(){
        parent::__construct();
        $this->view->js = array('signup/js/form.js','signup/js/map.js');
    }
    public function index(){
        $this->view->render("signup/index");
    }
    public function confirmation(){
        $this->view->render("signup/confirmation");
    }
    public function createUser(){
        $data['name'] = $this->escape_value($_POST['name']);
        $data['username'] = $this->escape_value($_POST['username']);
        $data['email'] = $this->escape_value($_POST['email']);
        $data['password'] = $this->escape_value($_POST['password']);
        $data['mobile'] = $this->escape_value($_POST['mobile']);
        $data['referal'] = $this->escape_value($_POST['referal']);
        $data['country'] = $this->escape_value($_POST['country']);
        $data['city'] = $this->escape_value($_POST['city']);
        $data['address'] = $this->escape_value($_POST['address']);
        $response = $this->model->createUser($data);
        echo $response;

    }
    public function searchEmail(){
        $email = (isset($_GET['search_param'])) ? $_GET['search_param'] : '';
        $response = $this->model->searchEmail($email);
        echo $response;
    }
    public function searchUsername(){
        $username = (isset($_GET['search_param'])) ? $_GET['search_param'] : '';
        $response = $this->model->searchUsername($username);
        echo $response;
    }
}