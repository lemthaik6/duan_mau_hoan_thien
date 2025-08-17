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
}
?>