<?php
class admin extends controller{
    public function __construct(){
        parent::__construct();
        Session::init();
        if(Session::get('user_login') !== TRUE){
            header('location: '.URL.'signin');
        }
    }
      /***
     * 
     * Administrators ONLY
     */
    public function allAds(){
        require_once 'helpers/pagination.php';
         $this->view->active = 'all-ads';
        $this->view->title = "All Ads";
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
         // INSTANTIATE THE PAGINATION OBJECT
        $current_page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
        $total_page = $this->model->getAllAdsCount();
        $per_page = 10;
        $this->view->pagination = new pagination($total_page, $per_page, $current_page);
        $this->view->allAds = $this->model->getAllAdminAds($this->view->pagination);
        $this->view->countAllAds = $this->model->getAllAdsCount();
        $this->view->freeAdsLeft = $this->model->getFreeAdsLeft(Session::get('user_id'));
        $this->view->render("admin/all-ads");
    }
    public function allArchives(){
        require_once 'helpers/pagination.php';
         $this->view->active = 'all-archives';
        $this->view->title = "All Archives";
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
         // INSTANTIATE THE PAGINATION OBJECT
        $current_page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
        $total_page = $this->model->getAllArchivesCount();
        $per_page = 10;
        $this->view->pagination = new pagination($total_page, $per_page, $current_page);
        $this->view->allArchivedAds = $this->model->getAllArchives($this->view->pagination);
        $this->view->countAllArchives = $this->model->getAllArchivesCount();
        $this->view->freeAdsLeft = $this->model->getFreeAdsLeft(Session::get('user_id'));
        $this->view->render("admin/all-archives");
    }
    public function allUsers(){
        require_once 'helpers/pagination.php';
         $this->view->active = 'all-users';
        $this->view->title = "All Users";
        $this->view->profile = $this->model->getProfile(Session::get('user_id'));
         // INSTANTIATE THE PAGINATION OBJECT
        $current_page = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
        $total_page = $this->model->getAllUsersCount();
        $per_page = 10;
        $this->view->pagination = new pagination($total_page, $per_page, $current_page);
        $this->view->allUsers = $this->model->getAllUsers($this->view->pagination);
        $this->view->countAllUsers = $this->model->getAllUsersCount();
        $this->view->freeAdsLeft = $this->model->getFreeAdsLeft(Session::get('user_id'));
        $this->view->render("admin/all-users");
    }
}