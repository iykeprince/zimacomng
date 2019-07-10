<?php
class Controller{
	public function __construct(){
		$this->view = new View();
	}

	public function loadModel($name){
		$path = 'models/'.$name.'_model.php';
		if(file_exists($path)){
            require 'models/'.$name.'_model.php';
            $modelName = $name.'_model';
            $this->model = new $modelName();
        }
	}
	public function escape_value($value){
    	$value = trim($value);
    	$value = htmlspecialchars($value);
    	$value = stripslashes($value);
    	return $value;
    }
}