<?php
class index_model extends model{
    public function __construct(){
        parent::__construct();
    }
    public function getCategories(){
        return $categories = $this->db->getAssoc("SELECT * FROM `categories`");
    }
    public function getPublishedAdsCount(){
        return $this->db->getRowCounts("SELECT * FROM ads WHERE is_published=1");
    }
    public function getGroupedCategories(){
        return $this->db->getAssoc("SELECT COUNT(ads.ads_id) AS count, c.category_id, c.category_name, c.category_icon FROM `ads` 
                                    INNER JOIN categories c ON ads.category_id=c.category_id GROUP BY c.category_name, c.category_icon");
    }
    public function getSetGroupCategories(){
        $categories = $this->db->getAssoc("SELECT * FROM categories ");
        $data = array();
        foreach($categories as $key=> $value){
            $category_id = $value['category_id'];
            $category['category_id'] = $category_id;
            $category['category_name'] = $value['category_name'];
            $category['category_icon'] = $value['category_icon'];
            $category['category_fa_icon'] = $value['fa_icon'];
            $category['category_slug'] = $value['slug'];
            $category['sub_categories'] = array();
            
            $sub_categories = $this->db->getAssoc("SELECT * FROM sub_categories WHERE category_id='$category_id' LIMIT 4");
            foreach($sub_categories as $sub_key=>$sub_value){
                $sub_category['sub_category_id'] = $sub_value['sub_category_id'];
                $sub_category['sub_category_name'] = $sub_value['sub_category_name'];
                $sub_category['sub_category_icon'] = $sub_value['sub_category_icon'];
                $sub_category['sub_category_fa_icon'] = $sub_value['fa_icon'];
                $sub_category['sub_category_slug'] = $sub_value['slug'];
               
                
               $category['sub_categories'][] = $sub_category;
            }
            array_push($data, $category);   
        }
        
        return $data;
    }
    public function getCategoriesOrderBy($orderBy, $sort){
        return $this->db->getAssoc("SELECT * FROM `categories` ORDER BY {$orderBy} {$sort}");
    }
    public function getFeaturedAds($pagination){
        $offset = $pagination->offset();
        $limit = $pagination->limit();
        return $this->db->getAssoc("SELECT * FROM ads 
                                    INNER JOIN categories 
                                    ON categories.category_id=ads.category_id 
                                    INNER JOIN users ON users.id=ads.user_id
                                    INNER JOIN profiles ON users.id=profiles.user_id
                                    WHERE is_published=1 
                                    ORDER BY ads_created_at DESC 
                                    LIMIT $limit OFFSET $offset");
    }
    
    public function getRecentAds(){
        return $this->db->getAssoc("SELECT * FROM ads 
                                INNER JOIN categories 
                                ON categories.category_id=ads.category_id 
                                INNER JOIN users ON users.id=ads.user_id
                                INNER JOIN profiles ON users.id=profiles.user_id
                                WHERE is_published=1 ORDER BY `ads_created_at` DESC 
                                LIMIT 4");
    }
    public function getPopularAds(){
         return $this->db->getAssoc("SELECT * FROM ads 
                                INNER JOIN categories 
                                ON categories.category_id=ads.category_id 
                                INNER JOIN users ON users.id=ads.user_id
                                INNER JOIN profiles ON users.id=profiles.user_id
                                WHERE is_published=1 ORDER BY `views` DESC 
                                LIMIT 4");
    }
    public function getHotAds(){
        return $this->db->getAssoc("SELECT * FROM ads 
                                INNER JOIN categories 
                                ON categories.category_id=ads.category_id 
                                INNER JOIN users ON users.id=ads.user_id
                                INNER JOIN profiles ON users.id=profiles.user_id
                                WHERE is_published=1 ORDER BY `views` DESC 
                                LIMIT 4");
    }
}