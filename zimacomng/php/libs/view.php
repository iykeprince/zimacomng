<?php
class View {
	public function render($name, $data =""){
		require 'views/' . $name . '.php';
	}
}