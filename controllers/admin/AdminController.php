<?php
class AdminController{

    public function __construct(){
        return true;
        
    }

    //hien thi trang chu admin
    public function dashboard(){
        require_once PATH_ADMIN . 'dashboard.php';
    }
}
?>