<?php
class err extends controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->view->render('errors/404-page');
	}
}