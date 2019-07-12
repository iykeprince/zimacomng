<?php
class boost_ads extends controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->view->render("index/boost-ads");
    }
}