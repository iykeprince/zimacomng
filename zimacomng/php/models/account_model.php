<?php
class account_model extends model{
    public function __construct(){
        parent::__construct();
        Session::init();
       
    }
    public function activate($email, $zima_user_id){
       try{
            $db_data = [
                "active" => 1
            ];
            $where = "id='$zima_user_id'";
            $this->db->update('users', $db_data, $where);
            return true;
       }catch(PDOException $e){
           return $e->getMessage();
       }
    }
}