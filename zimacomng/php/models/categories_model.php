<?php
class categories_model extends model{
    public function __construct(){
        parent::__construct();
    }
    public function getCategoryName($id) {
        $category = $this->db->getItem("SELECT * FROM `categories` WHERE category_id='$id'");
        return $category['category_name'];
    }
    
    public function getSubCategoryName($id) {
        $category = $this->db->getItem("SELECT * FROM `sub_categories` WHERE sub_category_id='$id'");
        return $category['sub_category_name'];
    }
    public function getGroupedCategories(){
        return $this->db->getAssoc("SELECT COUNT(ads.ads_id) AS count, c.category_id, c.fa_icon, c.category_name, c.category_icon 
                                    FROM `ads` 
                                    INNER JOIN categories c ON ads.category_id=c.category_id 
                                    GROUP BY c.category_name, c.category_icon");
    }
    public function getDetail($id){
        return $result = $this->db->getItem("SELECT * FROM `ads` 
                                    INNER JOIN categories ON ads.category_id=categories.category_id 
                                    INNER JOIN sub_categories ON ads.sub_category_id=sub_categories.sub_category_id 
                                    INNER JOIN users ON ads.user_id=users.id 
                                    INNER JOIN profiles ON users.id=profiles.user_id
                                    WHERE `ads`.`ads_id`='$id'");
    }
    public function getRecommendedAds($offset){
        return $this->db->getAssoc("SELECT * FROM `ads`  
                                    INNER JOIN categories ON ads.category_id=categories.category_id  
                                    INNER JOIN `sub_categories` ON `ads`.`sub_category_id`=`sub_categories`.`sub_category_id`
                                    INNER JOIN users ON ads.user_id=users.id 
                                    INNER JOIN profiles ON users.id=profiles.user_id
                                    ORDER BY RAND() LIMIT 10 OFFSET $offset ");
                            
    }
    public function getRecommendedAdsForDetail($id){
        return $this->db->getAssoc("SELECT * FROM `ads`  
                                    INNER JOIN categories ON ads.category_id=categories.category_id  
                                    INNER JOIN `sub_categories` ON `ads`.`sub_category_id`=`sub_categories`.`sub_category_id`
                                    INNER JOIN users ON ads.user_id=users.id 
                                    INNER JOIN profiles ON users.id=profiles.user_id WHERE categories.category_id LIKE '%$id%'
                                    ORDER BY RAND() LIMIT 3 ");
    }
    public function getAlsoRecommededAds(){
         return $this->db->getAssoc("SELECT * FROM `ads`  
                                    INNER JOIN categories ON ads.category_id=categories.category_id  
                                    INNER JOIN `sub_categories` ON `ads`.`sub_category_id`=`sub_categories`.`sub_category_id`
                                    INNER JOIN users ON ads.user_id=users.id 
                                    INNER JOIN profiles ON users.id=profiles.user_id 
                                    ORDER BY RAND() LIMIT 3 ");
    }
    public function countRecommendedAds($id){
         $result = $this->db->getRowCounts("SELECT * FROM `ads`  
                                    INNER JOIN categories ON ads.category_id=categories.category_id  
                                    INNER JOIN `sub_categories` ON `ads`.`sub_category_id`=`sub_categories`.`sub_category_id`
                                    INNER JOIN users ON ads.user_id=users.id 
                                    INNER JOIN profiles ON users.id=profiles.user_id WHERE categories.category_id LIKE '%$id%' ");
        return $result;
    }
    public function count_filter_category($data){
        if(!empty($data)){
            if($data['q'] != ''){ 
                $search_param = $data['q'];
                $result = $this->db->getRowCounts("SELECT * FROM `ads` WHERE title LIKE '%$search_param%' AND is_published=1"); 
                return $result;
            }else if($data['condition'] != '') {
                $condition  = $data['condition'];
                $result = $this->db->getRowCounts("SELECT * FROM `ads` WHERE condition='$condition' AND is_published=1 ");
                return $result;
            }else if($data['brand_name'] != ''){
                $brand_name = $data['brand_name'];
                $result = $this->db->getRowCounts("SELECT * FROM `ads` WHERE brand_name LIKE '%$brand_name%' AND is_published=1");
                return $result;
            }else if($data['posted_by'] != ''){
                $posted_by = $data['posted_by'];
                $result = $this->db->getRowCounts("SELECT * FROM `ads` WHERE merchant_type='$posted_by' AND is_published=1");
                return $result;
            }elseif ($data['category_id'] != '') {
                $category_id = $data['category_id'];
                $result = $this->db->getRowCounts("SELECT * FROM `ads` WHERE category_id='$category_id'");
                return $result;
            }
            // else if($data['price_range'] != ''){
            //     $result = $this->db->getAssoc("SELECT * FROM `ads` WHERE price BETWEEN ");
            // }
            // return $result;
        }else{
            return 0;
        }
    }
    public function filter_category($data, $pagination){
        $offset = $pagination->offset();
        $limit = $pagination->limit();
        if(!empty($data)){
            if($data['q'] != ''){ 
                $search_param = $data['q'];
                $result = $this->db->getAssoc("SELECT * FROM `ads` 
                                    INNER JOIN categories 
                                    ON  ads.category_id=categories.category_id 
                                    INNER JOIN sub_categories ON ads.sub_category_id=sub_categories.sub_category_id 
                                    WHERE title LIKE '%$search_param%' AND is_published=1 
                                    LIMIT {$limit} OFFSET {$offset}"); 
                return $result;
            }else if($data['q'] != '' && $data['search_category'] != ""){
                $search_param = $data['q'];
                $search_category = $data['search_category'];
                $result = $this->db->getAssoc("SELECT * FROM `ads` 
                                    INNER JOIN categories 
                                    ON  ads.category_id=categories.category_id 
                                    INNER JOIN sub_categories ON ads.sub_category_id=sub_categories.sub_category_id 
                                    WHERE title LIKE '%$search_param%' AND category_id='$search_category' 
                                    AND is_published=1 LIMIT {$limit} OFFSET {$offset}"); 
                return $result;
            }else if($data['condition'] != '') {
                $condition  = $data['condition'];
                $result = $this->db->getAssoc("SELECT * FROM `ads` INNER JOIN categories 
                                    ON  ads.category_id=categories.category_id 
                                    INNER JOIN sub_categories ON ads.sub_category_id=sub_categories.sub_category_id 
                                    WHERE condition='$condition' AND is_published=1 LIMIT $limit OFFSET $offset");
                return $result;
            }else if($data['brand_name'] != ''){
                $brand_name = $data['brand_name'];
                $result = $this->db->getAssoc("SELECT * FROM `ads` INNER JOIN categories 
                                    ON  ads.category_id=categories.category_id 
                                    INNER JOIN sub_categories ON ads.sub_category_id=sub_categories.sub_category_id 
                                    WHERE brand_name LIKE '%$brand_name%' AND is_published=1 LIMIT $limit OFFSET $offset");
                return $result;
            }else if($data['posted_by'] != ''){
                $posted_by = $data['posted_by'];
                $result = $this->db->getAssoc("SELECT * FROM `ads` INNER JOIN categories 
                                    ON  ads.category_id=categories.category_id 
                                    INNER JOIN sub_categories ON ads.sub_category_id=sub_categories.sub_category_id 
                                    WHERE merchant_type='$posted_by' AND is_published=1 LIMIT $limit OFFSET $offset");
                return $result;
            }elseif ($data['category_id'] != '') {
                $category_id = $data['category_id'];
                $result = $this->db->getAssoc("SELECT * FROM `ads` INNER JOIN categories 
                                    ON  ads.category_id=categories.category_id 
                                    INNER JOIN sub_categories ON ads.sub_category_id=sub_categories.sub_category_id 
                                    WHERE ads.category_id='$category_id' AND is_published=1 LIMIT $limit OFFSET $offset");
                return $result;
            }elseif($data['load_sub_category']){
                $category_id = $data['category_id'];
                $result = $this->db->getAssoc("SELECT * FROM `ads` INNER JOIN categories 
                                    ON  ads.category_id=categories.category_id 
                                    INNER JOIN sub_categories ON ads.sub_category_id=sub_categories.sub_category_id 
                                    WHERE ads.category_id='$category_id' AND is_published=1 LIMIT $limit OFFSET $offset");
                return $result;
            }elseif($data['load_sub_category_item'] != ''){
                $sub_category_id = $data['load_sub_category_item'];
                $result = $this->db->getAssoc("SELECT * FROM `ads` INNER JOIN categories 
                                    ON  ads.category_id=categories.category_id 
                                    INNER JOIN sub_categories ON ads.sub_category_id=sub_categories.sub_category_id 
                                    WHERE ads.sub_category_id='$sub_category_id' AND is_published=1 LIMIT $limit OFFSET $offset");
                return $result;
            }
            // else if($data['price_range'] != ''){
            //     $result = $this->db->getAssoc("SELECT * FROM `ads` WHERE price BETWEEN ");
            // }
            // return $result;
        }else{
            $result = $this->db->getAssoc("SELECT * FROM `ads` INNER JOIN categories 
                                    ON  ads.category_id=categories.category_id 
                                    INNER JOIN sub_categories ON ads.sub_category_id=sub_categories.sub_category_id 
                                    WHERE is_published=1 LIMIT $limit OFFSET $offset");
            return $result;
        }
    }

    public function getSubCategories($data){
        if($data['load_sub_category'] != ''){
            $category_id = $data['category_id'];
            $result = $this->db->getAssoc("SELECT * FROM sub_categories INNER JOIN categories ON categories.category_id=sub_categories.category_id WHERE sub_categories.category_id='$category_id'");
            return $result;
        }
    }
    public function getBrand($data){
        $brand_name = $data['brand_name'];
        $result = $this->db->getAssoc("SELECT * FROM ads WHERE brand_name LIKE '%$brand_name%'");
        return $result;
    }
}