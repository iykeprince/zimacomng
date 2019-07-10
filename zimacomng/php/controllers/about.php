<?php
class about extends controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->view->render("about/index");
    }
}