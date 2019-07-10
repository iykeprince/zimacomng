<?php
require_once 'helpers/filehandler.php';
class ads extends controller{
    public function __construct(){
        parent::__construct();
        $this->view->js = array('ad/js/default.js','ad/js/form.js','ad/js/paystack.js','ad/js/profilepicture.js');
        Session::init();
        if(Session::get('user_login') !== TRUE){
            header('location: '.URL.'signin');
        }
    }
    public function index(){
        require_once 'helpers/pagination.php';
        $this->view->active = 'archived-ads';
        $this->view->title = "Archived Ads";
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        // INSTANTIATE THE PAGINATION OBJECT
        $current_page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
        $total_page = $this->model->getAllAds(Session::get('user_id'));
        $per_page = 4;
        $this->view->pagination = new pagination($total_page, $per_page, $current_page);
        $this->view->ads = $this->model->getAds(Session::get('user_id'), $this->view->pagination);
        $this->view->myAdsCount = $this->model->getAllAds(Session::get('user_id'));
        $this->view->myFavouriteAdsCount = $this->model->getAllFavouriteAds(Session::get('user_id'));
        $this->view->freeAdsLeft = $this->model->getFreeAdsLeft(Session::get('user_id'));
        $this->view->render('ad/archived-ads');
    }
    public function newAds(){
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        $categories = $this->model->getCategories();
        $data = [
            'categories'=> $categories,
        ];
        $this->view->render("ad/ad-post", $data);
    }
    public function getSubCategories(){
        $response = $this->model->getSubCategories(base64_decode($_GET['category']));
        echo json_encode($response);
    }
    public function adPostDetail(){
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        $category_id = base64_decode($_GET['category']);
        $sub_category_id = $_GET['sub_category'];
        $category_name = $this->model->getCategoryName($category_id);
        $sub_category_name = $this->model->getSubCategoryName($sub_category_id);
        $data = [
            'category_id' => $category_id,
            'sub_category_id' => $sub_category_id,
            'category_name' => $category_name,
            'sub_category_name' => $sub_category_name
        ];
        $this->view->render("ad/ad-post-details", $data);
    }
    public function favourite(){
        require_once 'helpers/pagination.php';
        $this->view->active = 'favourite-ads';
        $this->view->title = "Favorite Ads";
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        // INSTANTIATE THE PAGINATION OBJECT
        $current_page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
        $total_page = $this->model->getAllFavouriteAds(Session::get('user_id'));
        $per_page = 4;
        $this->view->pagination = new pagination($total_page, $per_page, $current_page);
        $this->view->ads = $this->model->getFavouriteAds(Session::get('user_id'), $this->view->pagination);
        $this->view->myAdsCount = $this->model->getAllAds(Session::get('user_id'));
        $this->view->myFavouriteAdsCount = $this->model->getAllFavouriteAds(Session::get('user_id'));
        $this->view->freeAdsLeft = $this->model->getFreeAdsLeft(Session::get('user_id'));
        $this->view->render("ad/favourite-ads");
    }
    public function archived(){
        require_once 'helpers/pagination.php';
        $this->view->active = 'archived-ads';
        $this->view->title = "Archived Ads";
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
         // INSTANTIATE THE PAGINATION OBJECT
        $current_page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
        $total_page = count($this->model->getArchivedAds(Session::get('user_id')));
        $per_page = 4;
        $this->view->pagination = new pagination($total_page, $per_page, $current_page);
        $this->view->ads = $this->model->getArchivedAds(Session::get('user_id'), $this->view->pagination);//get archived later
        $this->view->myAdsCount = $this->model->getAllAds(Session::get('user_id'));
        $this->view->myFavouriteAdsCount = $this->model->getAllFavouriteAds(Session::get('user_id'));
        $this->view->freeAdsLeft = $this->model->getFreeAdsLeft(Session::get('user_id'));
        $this->view->render('ad/archived-ads');
    }
    public function pending(){
        require_once 'helpers/pagination.php';
        $this->view->active = 'pending-ads';
        $this->view->title = "Pending Ads";
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        // INSTANTIATE THE PAGINATION OBJECT
        $current_page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
        $total_page = $this->model->getAllPendingAds(Session::get('user_id'));
        $per_page = 4;
        $this->view->pagination = new pagination($total_page, $per_page, $current_page);
        $this->view->ads = $this->model->getPendingAds(Session::get('user_id'), $this->view->pagination);
        $this->view->myAdsCount = $this->model->getAllAds(Session::get('user_id'));
        $this->view->myFavouriteAdsCount = $this->model->getAllFavouriteAds(Session::get('user_id'));
        $this->view->freeAdsLeft = $this->model->getFreeAdsLeft(Session::get('user_id'));
        $this->view->render('ad/pending-ads');
    }
    public function pricing(){
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        $this->view->myAdsCount = $this->model->getAllAds(Session::get('user_id'));
        $this->view->myFavouriteAdsCount = $this->model->getAllFavouriteAds(Session::get('user_id'));
        $this->view->render('ad/pricing');
    }
    public function published(){
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        $this->view->render('ad/published');
    }
    /**
     * 
     * INSERT AND UPDATES
     */
    public function create_ads(){
        
        $data['user_id'] = Session::get('user_id');
        $data['category_id'] = $this->escape_value($_POST['category_id']);
        $data['sub_category_id'] = $this->escape_value($_POST['sub_category_id']);
        $data['item_title'] = $this->escape_value($_POST['item_title']);
        $data['item_condition'] = $this->escape_value($_POST['item_condition']);
        $data['item_price'] = $this->escape_value($_POST['item_price']);
        $data['item_is_negotiable'] = (isset($_POST['item_is_negotiable']) && $_POST['item_is_negotiable'] == "negotiable") ? 1 : 0;
        $data['item_brand_name'] = $this->escape_value($_POST['item_brand_name']);
        $data['item_brand_model'] = $this->escape_value($_POST['item_brand_model']);
        $data['item_brand_description'] = $this->escape_value($_POST['item_brand_description']);
        
        $data['item_file_uploaded'] = $this->escape_value($_POST['item_file_uploaded']);
        $data['item_file'] = $_FILES['itemFile'];

        // $userInfo = $this->model->getProfile(Session::get('user_id'));
        // if($userInfo['available_ads'] <= 0 && $userInfo['role'] !== "admin"){
        //     echo "insufficient_ads";
        // }else{
        //     $data['available_ads'] = $userInfo['available_ads'];
        //     // print_r($data);
            
        // }
       $response = $this->model->createAds($data);
            if($response){
                echo 'success';
            }else {
                echo 'failed';
            }
    }
    public function uploadAdFile(){
        
        $data['category_id'] = $this->escape_value($_POST['category_id']);
        $data['sub_category_id'] = $this->escape_value($_POST['sub_category_id']);
        $data['item_title'] = $this->escape_value($_POST['item_title']);
        $data['item_file'] = $_FILES['itemFile'];

        $response = $this->model->uploadAdFile( $data);
        echo $response;
    }
    public function edit_ads($id){
        $id = base64_decode($id);
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        $this->view->adsDetail = $this->model->getAdsDetail($id);
        
        $this->view->render("ad/ad-post-edit-details");
        
    }
    public function boostAd($id){
        $id = base64_decode($id);
        $data['id'] = $id;
        $data['user_id'] = Session::get('user_id');
        $response = $this->model->boostAd($data);
        if($response == "insufficient_fund"){
            header('location: '.URL.'user/ads?status=insufficient_fund');
        }else if($response == "boosted"){
            header('location: '.URL.'user/ads?status=boostAd');
        }
    }
    public function mark_sold($id){
        $id = base64_decode($id);
        $response  = $this->model->mark_sold($id);
        if($response){
            header('location: '.URL.'user/ads?status=sold');
        }
    }
    public function isAvailable($id){
        $id = base64_decode($id);
        $response  = $this->model->isAvailable($id);
        if($response){
            header('location: '.URL.'user/ads?status=available');
        }
    }
   public function deleteAd($id){
      $id = base64_decode($id);
      $response = $this->model->deleteAd($id);
      if($response){
          header('location: ' . URL . 'user/ads?status=deleted');
      }
   }
}