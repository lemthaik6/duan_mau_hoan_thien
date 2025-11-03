<?php
$act = $_GET['act'] ?? '/';

if(isset($_SESSION['user'])){
    if($_SESSION['user']['role'] == 'admin'){
    } else {
        echo "<h1>Bạn không có quyền truy cập</h1>";
        $act = 'home';
    }
} else {
    $act = 'login';
}

// Thêm router cho sửa/xóa danh mục
match ($act) {
    '/' => (new DashboardController())->Dashboard(),
    'them-danh-muc' => (new CategoryController())->AddControllerView(),
    'danh-muc' => (new CategoryController())->CategoryViewAll(),
    'sua-danh-muc' => (new CategoryController())->EditCategory(),      // Thêm dòng này
    'xoa-danh-muc' => (new CategoryController())->DeleteCategory(),    // Thêm dòng này
    'them-san-pham' => (new ProductController())->AddProduct(),
    'danh-sach-san-pham' => (new ProductController())->ProductViewAll(),
    'danh-sach-bai-viet' => (new PostController())->adminList(),
    'xoa-bai-viet' => (new PostController())->delete(),
    'duyet-bai-viet' => (new PostController())->approve(),
    'sua-bai-viet' => (new PostController())->editForm(),
    'cap-nhat-bai-viet' => (new PostController())->update(),
    'toggle-comment' => (new CommentController())->toggleCommentStatus(),
    'edit-product' => (new ProductController())->EditProduct(),
    'delete-product' => (new ProductController())->DeleteProduct(),
    default => (new DashboardController())->Dashboard(),
};
?>