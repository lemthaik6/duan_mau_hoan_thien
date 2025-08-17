<?php
$act = $_GET['act'] ?? '/';


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/'=>(new DashboardController())->Dashboard(),
    'them-danh-muc'=>(new CategoryController())->AddControllerView(),
    'danh-muc'=>(new CategoryController())->CategoryViewAll(),

};
?>