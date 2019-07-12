<?php
class user_model extends model{
    public function __construct(){
        parent::__construct();
    }
    public function getProfile($id){
        return $this->db->getItem("SELECT * FROM `users` INNER JOIN `profiles` ON `users`.`id`=`profiles`.`user_id` WHERE `users`.`id`='$id'");
    }
    public function getAds($id, $pagination){
        $offset = $pagination->offset();
        $limit = $pagination->limit();
        return $this->db->getAssoc("SELECT * FROM ads AS a 
                                    INNER JOIN categories AS c
                                    ON  a.category_id=c.category_id 
                                    INNER JOIN sub_categories AS s ON a.sub_category_id=s.sub_category_id
                                    WHERE user_id='$id' LIMIT $limit OFFSET $offset");
    }
    public function getAllAds($id){
        return $this->db->getRowCounts(
            "SELECT * FROM ads AS a 
            JOIN categories AS c
            ON  a.category_id=c.category_id 
            JOIN sub_categories AS s  
            ON a.sub_category_id=s.sub_category_id
            WHERE user_id='$id'");
    }
     public function getFreeAdsLeft($id){
         return $this->db->getAssoc("SELECT `available_ads` FROM `users` WHERE id='$id' ");
    }
    public function getAllFavouriteAds($id){
        return $this->db->getRowCounts("SELECT * FROM `ads` WHERE user_id='$id' AND `is_favourite`=1");
    }
    public function updateProfile($data){
        
    }
    public function updateProfilePicture($email){
        require_once "helpers/filehandler.php";
        $allowExt = array("jpg", "jpeg", "png", "gif");
        $filehandler = new filehandler($_FILES['profile_image'], 1);
        $filehandler->setDirectory("views/users/profileUploads/$email/");
        $filehandler->setMinFileSize(500);
        $filehandler->setCustomName(trim($email));
        $validateImageFiles = $filehandler->validateImageWithAllowedExt($allowExt);
        if(!$validateImageFiles ){
            return "File is not an image, please upload an image file";
        }else{
            $response = $filehandler->uploadFile();
            
            if($response == "success"){
                echo "success";
            }else{
               echo $response;
            }
        }
       //save to database
        try{
            $thumbnail = $filehandler->getFilenames()[0];
            $userInfo = $this->db->getItem("SELECT id FROM users WHERE email='$email'");
            $user_id = $userInfo['id'];

            $table = "profiles";
            $data = ['thumbnail'=>$thumbnail];
            $where = "user_id='$user_id'";
            $this->db->update($table, $data, $where);
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
    public function updateLastLogin($user_id){
        try{
            $data = ['updated_at' => (new DateTime())->format('Y-m-d h:i:s') ];
            $where = "id = $user_id";
            $this->db->update("users", $data, $where);
            return true;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}