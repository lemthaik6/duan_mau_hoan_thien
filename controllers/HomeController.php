<?php
class HomeController{
    private $productModel;
    public function __construct()
    {
        $this->productModel = new ProductModel();
    }
    public function index(){
        $products = $this->productModel->getAllProduct();
        require_once './views/client/home.php';
    }
    public function news(){
        // Load approved posts to show as user posts
        if (file_exists(__DIR__ . '/../models/PostModel.php')) {
            require_once __DIR__ . '/../models/PostModel.php';
            $pm = new PostModel();
            $posts = $pm->getApprovedPosts();
        } else {
            $posts = [];
        }
        require_once './views/client/news.php';
    }
    public function contact(){
        require_once './views/client/contact.php';
    }
}
?>