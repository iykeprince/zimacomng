<?php
class flash {
    private $message = '';
    public function __construct(){
        Session::init();
    }
    public function setMessage($message){
        $this->message = message;
        Session::set('flash_message',$this->message);
    }
    public function getMessage(){
        return Session::get('flash_message');
    }
}
