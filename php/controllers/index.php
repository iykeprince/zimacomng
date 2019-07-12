<?php
class index extends controller{
    function __construct() {
        parent::__construct();      
        Session::init();
        $this->view->js = array("index/js/default.js"); 
    }
    public function index(){
        require_once 'helpers/pagination.php';
        require_once 'helpers/imagecache/ImageCache.php';
        //INSTANTIATE THE IMAGE CACHE
        $this->view->imageCache =  new ImageCache();
         // INSTANTIATE THE PAGINATION OBJECT
        $current_page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
        $total_page = $this->model->getPublishedAdsCount();
        $per_page = 12;
        $this->view->pagination = new pagination($total_page, $per_page, $current_page);
        $this->view->groupedCategories = $this->model->getGroupedCategories();
        $this->view->featuredAds = $this->model->getFeaturedAds($this->view->pagination);
        $this->view->recentAds  = $this->model->getRecentAds();
        $this->view->categories = $this->model->getCategories();
        $this->view->popularAds = $this->model->getPopularAds();
        $this->view->hotAds = $this->model->getHotAds();
        $this->view->setGroupedCategories = $this->model->getSetGroupCategories();
        $this->view->render('index/index');
    }
    
}
