<?php
class ads_model extends model{
    private $ads_table = "ads";
    private $uploadedFiles = [];
    private $extensions = ["jpg", "jpeg","png","gif"];
    public function __construct(){
        parent::__construct();
    }
    
    public function getCategories(){
        return $categories = $this->db->getAssoc("SELECT * FROM `categories`");
    }
    public function getSubCategories($id){
        $subCategories = $this->db->getAssoc("SELECT * FROM `sub_categories` WHERE category_id='$id'");
        return $subCategories;
    }
    public function getCategoryName($id) {
        $category = $this->db->getItem("SELECT * FROM `categories` WHERE category_id='$id'");
        return $category['category_name'];
    }
    public function getSubCategoryName($id){
        $subCategory = $this->db->getItem("SELECT * FROM `sub_categories` WHERE sub_category_id='$id'");
        return $subCategory['sub_category_name'];
    }
    public function getProfile($id){
        return $this->db->getItem("SELECT * FROM `users` JOIN `profiles` ON `profiles`.`user_id`=`users`.`id` WHERE `users`.`id`='$id'");
    }
    public function getAdsDetail($id){
        
        return $this->db->getItem("SELECT * FROM ads WHERE ads_id='$id'");
    }
    public function getLatestAds(){
        $query = "SELECT * FROM ads AS a 
                INNER JOIN categories AS c
                ON  a.category_id=c.category_id 
                INNER JOIN sub_categories AS s
                ON a.sub_category_id=s.sub_category_id";
        return $this->db->getAssoc($query);
    }

     public function getAds($id, $pagination){
        $offset = $pagination->offset();
        $limit = $pagination->limit();
        return $this->db->getAssoc(
            "SELECT * FROM ads AS a 
            INNER JOIN categories AS c
            ON  a.category_id=c.category_id 
            INNER JOIN sub_categories AS s
            ON a.sub_category_id=s.sub_category_id
            WHERE user_id='$id' LIMIT $limit OFFSET $offset");
    }
    public function getFavouriteAds($id, $pagination){
        $offset = $pagination->offset();
        $limit = $pagination->limit();
        return $this->db->getAssoc("SELECT * FROM `ads`  
                                    INNER JOIN categories ON ads.category_id=categories.category_id  
                                    INNER JOIN `sub_categories` ON `ads`.`sub_category_id`=`sub_categories`.`sub_category_id`  WHERE user_id='$id' AND `is_favourite`=1 LIMIT $limit OFFSET $offset ");
    }
    public function getPendingAds($id, $pagination){
        $offset = $pagination->offset();
        $limit = $pagination->limit();
        return $this->db->getAssoc("SELECT * FROM `ads` INNER JOIN categories ON ads.category_id=categories.category_id  INNER JOIN `sub_categories` ON `ads`.`sub_category_id`=`sub_categories`.`sub_category_id` WHERE user_id='$id' AND `is_pending`=1 LIMIT $limit OFFSET $offset ");
    }
    public function getArchivedAds($id, $pagination){
        $offset = $pagination->offset();
        $limit = $pagination->limit();
        return $this->db->getAssoc("SELECT * FROM `ads` INNER JOIN categories ON ads.category_id=categories.category_id  INNER JOIN `sub_categories` ON `ads`.`sub_category_id`=`sub_categories`.`sub_category_id` WHERE user_id='$id' AND `is_archived`=1 LIMIT $limit OFFSET $offset ");
    }
    public function getAllAds($id){
        return $this->db->getRowCounts(
            "SELECT * FROM `ads` 
            INNER JOIN `categories` 
            ON  `ads`.`category_id`=`categories`.`category_id` 
            INNER JOIN `sub_categories` ON `ads`.`sub_category_id`=`sub_categories`.`sub_category_id` 
            WHERE user_id='$id'");
    }
    public function getFreeAdsLeft($id){
         return $this->db->getAssoc("SELECT `available_ads` FROM `users` WHERE id='$id' ");
    }
    public function getAllFavouriteAds($id){
        return $this->db->getRowCounts("SELECT * FROM `ads` WHERE user_id='$id' AND `is_favourite`=1");
    }
    public function getAllPendingAds($id){
        return $this->db->getRowCounts("SELECT * FROM `ads` WHERE user_id='$id' AND `is_pending`=1 ");
    }
    /**
     * 
     * INSERT AND UPDATES
     */
   public function createAds($data){
        // $available_ads = $data['available_ads'];
        $user_id = $data['user_id'];
        $category_id = $data['category_id'];
        $sub_category_id = $data['sub_category_id'];
        $item_title = $data['item_title'];
        $item_condition = $data['item_condition'];
        $item_price = $data['item_price'];
        $item_is_negotiable = $data['item_is_negotiable'];
        $item_brand_name = $data['item_brand_name'];
        $item_brand_model = $data['item_brand_model'];
        $item_brand_description = $data['item_brand_description'];
        // $item_files = $data['item_file_uploaded'];
        
        // print_r($data);
       $item_files = $this->uploadAdFile($data);
        
        //  // INSERT TO DATABASE
                $sth = $this->db->prepare(
                    "INSERT INTO `ads`(`user_id`,`category_id`,`sub_category_id`,`title`, `photos`, `condition`, `price`, `brand_name`, additional_information, model, `description`, is_negotiable, is_published, is_verified, slug) 
                    VALUES('$user_id','$category_id', '$sub_category_id', '$item_title', '$item_files', '$item_condition','$item_price','$item_brand_name', '', '$item_brand_model','$item_brand_description', '$item_is_negotiable', '1', '1','') ");
                $sth->execute();
        //         // // UPDATE THE AVAILABLE ADS OF THE USER
        //         // $new_available_ads = $available_ads - 1;
        //         // $update_ads_sth = $this->db->prepare("UPDATE users SET available_ads='$new_available_ads' WHERE id='$user_id'");
        //         // $update_ads_sth->execute();
                return true;
       
    }
    public function uploadAdFile($data){
        require_once "helpers/filehandler.php";
        print_r($data['item_file']);
        $category_id = $data['category_id'];
        $sub_category_id = $data['sub_category_id'];
        $categoryName = str_replace([' ','&'], '_', $this->getCategoryName($category_id));
        $subCategoryName = str_replace([' ','&'], '_', $this->getSubCategoryName($sub_category_id));
        $upload_title_folder = str_replace([' ','&'], '_', $data['item_title']); 
        //SET THE UPLOAD PATH
        $uploadPath = "views/ad/uploads/$categoryName/$subCategoryName/$upload_title_folder/";
      
        $fileInput = $data['item_file'];
        $numFiles = count($data['item_file']['name']);

        try{
            $filehandler = new filehandler($fileInput, $numFiles);
            $filehandler->setDirectory("views/ad/uploads/$categoryName/$subCategoryName/$upload_title_folder/");
            $filehandler->uploadMultipleFile();
            return $filehandler->getFilenames();
        }catch(Exception $e){
          return $e->getMessage();
        }

        
    }
    public function boostAd($data){
        $id = $data['id'];
        $user_id = $data['user_id'];
        $ads_info = $this->getAdsDetail($id);
        $price = $ads_info['price'];
        $zc_charge = 1;
        if($price <= 1000){
            $zc_charge = 1;
        }else if($price > 1000 && $price < 99999){
            $zc_charge = 2;
        }else if($price > 100000 && $price < 999999){
            $zc_charge = 4;
        }else if($price > 1000000 && $price < 9999999){
            $zc_charge = 10;
        }else if($price > 10000000 && $price < 999999999){
            $zc_charge = 20;
        }
        
        $userInfo = $this->getProfile($user_id);
        $wallet_balance = $userInfo['wallet_balance'];

        if($wallet_balance < $zc_charge){
            return "insufficient_fund";
        }else{
            $balance = $wallet_balance - $zc_charge;
            //UPDATE DATABASE
            try{
                $data = [
                    'is_boosted' => 1,
                ];
                $where = "ads_id=$id";
                $this->db->update('ads', $data, $where);
                $this->db->update('users', array('wallet_balance' => $balance ), "id=$user_id");
                return "boosted";
            }catch(PDOException $ex){
                return $ex->getMessage();
            }
        }
        
    }
    public function mark_sold($id){
        try{
            $data = [ 
                'is_archived' => 1, 
                'is_published' => 0 
            ];
            $where = "ads_id=$id";
            $this->db->update('ads', $data, $where);
            return true;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
    public function isAvailable($id){
        try{
            $data = [
                'is_archived' => 0,
                'is_published' => 1
            ];
            $where = "ads_id=$id";
            $this->db->update('ads', $data, $where);
            return true;
        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
    public function deleteAd($id){
        try{
            
            $where = "ads_id='$id'";
            $this->db->delete('ads',$where);
            $ads_info = $this->getAdsDetail($id);
            $files = rtrim($ads_info['photos'], ',');
            $files = explode(",", $files);
            foreach($files as $file){
                unlink(URL.$file);
            }
            return true;
        }catch(PDOException $ex){
            return $ex->getMessage();
        }
    }
   
}