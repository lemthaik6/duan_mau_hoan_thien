<?php
$act = $_GET['act'] ?? '/';

match ($act) {
    // Trang chủ
    '/'=>(new HomeController())->index(),
    'register' => (new AuthController())->Register(),
    'login' => (new AuthController())->Login(),
    'detail' => (new ProductController())->ProductDetail(),
    'addtocart'=> (new ProductController())->AddToCart(),
    'cart_page' => (new ProductController())->CartPage(),
    'edit-product' => (new ProductController())->EditProduct(),
    'delete-product' => (new ProductController())->DeleteProduct(),
    'search' => (new ProductController())->SearchProduct(),
    'remove_cart' => (new ProductController())->RemoveFromCart(),
    default => (new HomeController())->index(),
};
?>