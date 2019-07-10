<?php
class signin_model extends model{
    
    public function __construct(){
        parent::__construct();
    }
    public function authenticate($data){
        $username = $data['username'];
        $password = sha1($data['password']);
        $result = $this->db->getCount("SELECT * FROM `users` WHERE `username`='$username' AND `password`='$password' AND active=1");
        if($result == 0){
            return FALSE; 
        }else {
            Session::init();
            Session::set('user_login', TRUE);
            Session::set('user_id', $result['id']);
            Session::set('username', $result['username']);
            Session::set('user_email', $result['email']);
            Session::set('user_role', $result['role']);
            return TRUE;
        }
    }
}