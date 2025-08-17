<?php 
// Require toàn bộ các file khai báo môi trường, thực thi,...(không require view)
session_start(); // Bắt đầu phiên làm việc
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/ProductController.php';
require_once './controllers/DashboardController.php';
require_once './controllers/CategoryController.php';
require_once './controllers/AuthController.php';
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/ProductModel.php';
require_once './models/CategoryModel.php';
require_once './models/UserModel.php';

// Route

if(isset($_GET['mode']) && $_GET['mode']=='admin'){
    require_once('router/admin.php');
}
else{
     require_once('router/client.php');
}
