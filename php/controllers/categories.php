<?php
class categories extends controller{
    public function __construct(){
        parent::__construct();
        $this->view->js = array('categories/js/default.js');
    }
    public function index(){
        require_once 'helpers/pagination.php';
        $data['q'] = (isset($_GET['q'])) ? $_GET['q'] : '';
        $data['search_category'] = (isset($_GET['search_category'])) ? base64_decode($_GET['search_category']) :  '';
        $data['category_id'] = (isset($_GET['category'])) ? base64_decode($_GET['category']) : '';
        $data['load_sub_category'] = (isset($_GET['action']) && $_GET['action'] = 'load-sub-category' && isset($_GET['category'])) ? base64_decode($_GET['category']) : '';
        $data['load_sub_category_item'] = ( isset($_GET['action']) && $_GET['action'] = 'load-sub-category-item' && isset($_GET['sub_category'])) ? base64_decode($_GET['sub_category']) : '';
        $data['condition'] = (isset($_GET['cond'])) ? $_GET['cond'] : '';
        $data['price_range'] = (isset($_GET['price_range'])) ? $_GET['price_range'] : '';
        $data['posted_by'] = (isset($_GET['merchant'])) ? $_GET['merchant'] : '';
        $data['brand_name'] = (isset($_GET['brand_name'])) ? $_GET['brand_name'] : '';
        // $data['sub_category_id'] = (isset($_GET['sub_category'])) ? base64_decode($_GET['sub_category']) : '';
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $total_page = $this->model->count_filter_category($data);
        $per_page = 4;
        $this->view->pagination = new pagination($total_page, $per_page, $current_page);
        $this->view->count_search_results = $this->model->count_filter_category($data);
        $this->view->filteredResponse = $this->model->filter_category($data, $this->view->pagination);
        $this->view->getSubCategories = $this->model->getSubCategories($data);
        $this->view->groupedCategories = $this->model->getGroupedCategories();
        $this->view->categoryName = (isset($_GET['category'])) ?  $this->model->getCategoryName(base64_decode($_GET['category'])) :  '';
        $this->view->subCategoryName = (isset($_GET['sub_category'])) ?  $this->model->getSubCategoryName(base64_decode($_GET['sub_category'])) :  '';
        $this->view->recommendedAdsSectionOne = $this->model->getRecommendedAds(0);
         $this->view->recommendedAdsSectionTwo = $this->model->getRecommendedAds(10);
        $this->view->render("categories/categories-main");
    }
    public function details($id){
        require_once 'helpers/pagination.php';
        $id = base64_decode($id);
        $this->view->detail = $this->model->getDetail($id);
    
        $this->view->recommendedAds = $this->model->getRecommendedAdsForDetail($id);
        $this->view->alsoRecommendedAds = $this->model->getAlsoRecommededAds();
        $this->view->render("categories/details");
    }

    public function load_brand(){
        $data['brand_name'] = (isset($_GET['brand_name'])) ? $_GET['brand_name'] : '';
        $result = $this->model->getBrand($data);
        echo json_encode($result);
    }
}