<?php
class contact extends controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->view->render("contact/index");
    }
}