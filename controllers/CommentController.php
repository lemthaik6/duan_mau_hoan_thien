<?php
class CommentController {
    private $productModel;
    private $commentModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->commentModel = new CommentModel();
    }

    public function toggleCommentStatus() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            die('Không có quyền truy cập');
        }

        $productId = $_GET['id'] ?? 0;
        if ($productId) {
            $product = $this->productModel->getProductById($productId);
            if ($product) {
                // Toggle the comment status (default to 0 if not present)
                $current = isset($product['comment_status']) ? (int)$product['comment_status'] : 0;
                $newStatus = $current ? 0 : 1;
                $this->productModel->updateCommentStatus($productId, $newStatus);
                
                // Redirect back to product list
                header('Location: ' . BASE_URL . '?mode=admin&act=danh-sach-san-pham');
                exit;
            }
        }
        die('Sản phẩm không tồn tại');
    }

    // Handle adding a comment (expects POST). Returns JSON.
    public function add() {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => false, 'message' => 'Phương thức không hợp lệ']);
            exit;
        }

        $productId = $_POST['product_id'] ?? 0;
        $content = trim($_POST['content'] ?? '');
        $userId = $_SESSION['user']['id'] ?? 0;

        if ($productId == 0 || $content === '') {
            echo json_encode(['status' => false, 'message' => 'Dữ liệu không hợp lệ']);
            exit;
        }

        $product = $this->productModel->getProductById($productId);
        $locked = isset($product['comment_status']) ? (int)$product['comment_status'] : 0;
        if ($locked) {
            echo json_encode(['status' => false, 'message' => 'Bình luận cho sản phẩm này đã bị khóa']);
            exit;
        }

        // require login to comment
        if ($userId == 0) {
            echo json_encode(['status' => false, 'message' => 'Bạn cần đăng nhập để bình luận']);
            exit;
        }

        $id = $this->commentModel->addComment($productId, $userId, $content);
        if ($id) {
            $comment = [
                'id' => $id,
                'product_id' => $productId,
                'user_id' => $userId,
                'content' => htmlspecialchars($content),
                'created_at' => date('Y-m-d H:i:s'),
                'user_name' => $_SESSION['user']['fullname'] ?? ($_SESSION['user']['username'] ?? 'Người dùng')
            ];
            echo json_encode(['status' => true, 'message' => 'Bình luận đã được thêm', 'data' => $comment]);
            exit;
        }

        echo json_encode(['status' => false, 'message' => 'Không thể lưu bình luận']);
        exit;
    }
}
?>