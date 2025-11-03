<?php
$act = $_GET['act'] ?? '/';

match ($act) {
    // Trang chủ
    '/'=>(new HomeController())->index(),
    'register' => (new AuthController())->Register(),
    'login' => (new AuthController())->Login(),
    'detail' => (new ProductController())->ProductDetail(),
    'news' => (new HomeController())->news(),
    'contact' => (new HomeController())->contact(),
    'chat' => (new ChatController())->ChatPage(),
    'chat-send' => (new ChatController())->send(),
    'add-post' => (new PostController())->createForm(),
    'submit-post' => (new PostController())->submit(),
    'add-comment' => (new CommentController())->add(),
    'addtocart'=> (new ProductController())->AddToCart(),
    'cart_page' => (new ProductController())->CartPage(),
    'checkout' => (new ProductController())->Checkout(),
    'edit-product' => (new ProductController())->EditProduct(),
    'delete-product' => (new ProductController())->DeleteProduct(),
    'search' => (new ProductController())->SearchProduct(),
    'remove_cart' => (new ProductController())->RemoveFromCart(),
    default => (new HomeController())->index(),
};
?>