<?php
class admin_model extends model{
    public function __construct(){
        parent::__construct();
    }
    /**
     * ADMINISTRATOR
     */
    public function getAllAdsCount(){
        return $this->db->getRowCounts("SELECT * FROM ads ");
    }
    public function getAllArchivesCount(){
        return $this->db->getRowCounts("SELECT * FROM ads WHERE is_archived=1");
    }
    public function getAllUsersCount(){
        return $this->db->getRowCounts("SELECT * FROM users");
    }
     public function getFreeAdsLeft($id){
          return $this->db->getAssoc("SELECT `available_ads` FROM `users` WHERE id='$id' ");
    }
    public function getAllAdminAds($pagination){
        $offset = $pagination->offset();
        $limit = $pagination->limit();
        return $this->db->getAssoc("SELECT * FROM ads AS a INNER JOIN categories AS c
            ON  a.category_id=c.category_id 
            INNER JOIN sub_categories AS s
            ON a.sub_category_id=s.sub_category_id  LIMIT $limit OFFSET $offset");
    }
    public function getAllArchives($pagination){
        $offset = $pagination->offset();
        $limit = $pagination->limit();
        return $this->db->getAssoc("SELECT * FROM ads AS a INNER JOIN categories AS c
            ON  a.category_id=c.category_id 
            INNER JOIN sub_categories AS s
            ON a.sub_category_id=s.sub_category_id WHERE is_archived=1 LIMIT $limit OFFSET $offset ");
    }
    public function getAllUsers($pagination){
        $offset = $pagination->offset();
        $limit = $pagination->limit();
        return $this->db->getAssoc("SELECT * FROM users INNER JOIN profiles ON users.id=`profiles`.user_id LIMIT $limit OFFSET $offset"); 
    }
    public function getProfile($id){
        return $this->db->getItem("SELECT * FROM `users` JOIN `profiles` ON `profiles`.`user_id`=`users`.`id` WHERE `users`.`id`='$id'");
    }
     /**
      * END ADMINISTRATOR
      */
}