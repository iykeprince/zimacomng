<?php
class user extends controller{
    public function __construct(){
        parent::__construct();
        $this->view->js = array('users/js/default.js', 'users/js/profilepicture.js');
        Session::init();
        if(Session::get('user_login') !== TRUE){
            header('location: '.URL.'signin');
        }
    }
    public function index(){
        require_once 'helpers/pagination.php';
        $this->view->active = 'my-ads';
        $this->view->title = "My Ads";
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        // INSTANTIATE THE PAGINATION OBJECT
        $current_page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
        $total_page = count($this->model->getAllAds(Session::get('user_id')));
        $per_page = 4;
        $this->view->pagination = new pagination($total_page, $per_page, $current_page);
        $this->view->ads = $this->model->getAds(Session::get('user_id'), $this->view->pagination);
        $this->view->myAdsCount = $this->model->getAllAds(Session::get('user_id'));
        $this->view->myFavouriteAdsCount = $this->model->getAllFavouriteAds(Session::get('user_id'));
        $this->view->freeAdsLeft = $this->model->getFreeAdsLeft(Session::get('user_id'));
        $this->view->render('users/my-ads');
    }
    public function profile(){
        $this->view->active = 'profile';
        $this->view->title = "My Profile";
        $this->view->myAdsCount = $this->model->getAllAds(Session::get('user_id'));
        $this->view->myFavouriteAdsCount = $this->model->getAllFavouriteAds(Session::get('user_id'));
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        $this->view->freeAdsLeft = $this->model->getFreeAdsLeft(Session::get('user_id'));
        $this->view->render("users/my-profile");
    }
    public function ads(){
        require_once 'helpers/pagination.php';
        $this->view->active = 'my-ads';
        $this->view->title = "My Ads";
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        // INSTANTIATE THE PAGINATION OBJECT
        $current_page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
        $total_page = count($this->model->getAllAds(Session::get('user_id')));
        $per_page = 4;
        $this->view->pagination = new pagination($total_page, $per_page, $current_page);
        $this->view->ads = $this->model->getAds(Session::get('user_id'), $this->view->pagination);
        $this->view->myAdsCount = $this->model->getAllAds(Session::get('user_id'));
        $this->view->myFavouriteAdsCount = $this->model->getAllFavouriteAds(Session::get('user_id'));
        $this->view->freeAdsLeft = $this->model->getFreeAdsLeft(Session::get('user_id'));
        $this->view->render('users/my-ads');
    }
    
    public function delete_account(){
        $this->view->active = 'delete-account';
        $this->view->title = "Delete Account";
        $this->view->myAdsCount = $this->model->getAllAds(Session::get('user_id'));
        $this->view->myFavouriteAdsCount = $this->model->getAllFavouriteAds(Session::get('user_id'));
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
        $this->view->freeAdsLeft = $this->model->getFreeAdsLeft(Session::get('user_id'));
        $this->view->render('users/delete-account');
    }
    public function signout(){
        if($this->model->updateLastLogin(Session::get('user_id')) ){
            Session::destroy();
            header('location: '.URL.'signin');
        }
    }
    /**
     * 
     * UPDATE PROFILE
     */
    public function updateProfile($email){
        $response = $this->model->updateProfile($email);
        echo $response;
    }
    public function updateProfilePicture($email){
        $response = $this->model->updateProfilePicture($email);
        echo $response;
    }
}