<?php
require_once __DIR__ . '/../models/CartModel.php';

class ProductController
{
    public $modelCategory;
    public $modelProduct;
    public $cartModel;

    public function __construct()
    {
        $this->modelCategory = new CategoryModel();
        $this->modelProduct  = new ProductModel();
        $this->cartModel     = new CartModel();
        // lazy-load comment model when product detail is shown
    }

    public function AddProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $path = uploadFile($_FILES['image'], './uploads/imgproduct');
            $data = $_POST;
            $data['image'] = $path;

            $id = $this->modelProduct->AddProduct($data);

            if ($id) {
                header('Location: ' . BASE_URL . '?mode=admin&act=danh-sach-san-pham');
                exit;
            } else {
                echo "Thêm sản phẩm thất bại!";
            }
        } else {
            $title    = "Thêm sản phẩm";
            $category = $this->modelCategory->getAllCategory(1);
            require_once './views/admin/product/add.php';
        }
    }

    public function CategoryViewAll()
    {
        $result = $this->modelCategory->getAllCategory();
        require_once './views/admin/listcat.php';
    }

    public function ProductDetail()
    {
        $id = $_GET['id'] ?? 0;
        if ($id > 0) {
            $result = $this->modelProduct->GetProductById($id);
            if (empty($result)) {
                header('Location: ' . BASE_URL);
            } else {
                // load comments for this product (if comments table exists)
                $comments = [];
                if (file_exists(__DIR__ . '/../models/CommentModel.php')) {
                    require_once __DIR__ . '/../models/CommentModel.php';
                    $cm = new CommentModel();
                    $comments = $cm->getCommentsByProduct($id);
                }

                extract($result);
                require_once './views/client/productDetail.php';
            }
        } else {
            header('Location: ' . BASE_URL);
        }
    }

    public function AddToCart()
    {
        $userId = $_SESSION['user']['id'] ?? 0;
        header('Content-type:application/json');

        if ($userId == 0) {
            echo json_encode([
                "status" => false,
                "message" => "Bạn cần đăng nhập"
            ]);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productid = $_POST['productid'] ?? 0;
            $quantity = $_POST['quantity'] ?? 1;

            if ($productid == 0 || $quantity < 1) {
                echo json_encode([
                    "status" => false,
                    "message" => "Dữ liệu không hợp lệ"
                ]);
                exit;
            }

            $this->cartModel->addTocart($userId, $productid, $quantity);
            $data = $this->cartModel->getAllProductInCart($userId);

            echo json_encode([
                "status" => true,
                "message" => "Thêm giỏ hàng thành công",
                "data" => $data
            ]);
            exit;
        } else {
            echo json_encode([
                "status" => false,
                "message" => "Phương thức không hợp lệ"
            ]);
            exit;
        }
    }

    public function CartPage()
    {
        $userId = $_SESSION['user']['id'] ?? 0;
        $cartItems = $this->cartModel->getAllProductInCart($userId);
        require_once './views/client/cart_page.php';
    }

    // Checkout page + action
    public function Checkout()
    {
        $userId = $_SESSION['user']['id'] ?? 0;
        if ($userId == 0) {
            $_SESSION['flash'] = 'Bạn cần đăng nhập để thanh toán.';
            header('Location: ' . BASE_URL . '?act=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // perform checkout - for now just clear the cart and show success
            $this->cartModel->clearCart($userId);
            $_SESSION['flash'] = 'Thanh toán thành công. Cảm ơn bạn!';
            header('Location: ' . BASE_URL);
            exit;
        }

        // GET: show summary
        $cartItems = $this->cartModel->getAllProductInCart($userId);
        // compute total
        $total = 0;
        foreach ($cartItems as $it) {
            $total += ($it['price'] * $it['quantity']);
        }
        // render view
        require_once './views/client/checkout.php';
    }

    public function EditProduct() {
        $id = $_GET['id'] ?? 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST;
            // Lấy sản phẩm cũ
            $oldProduct = $this->modelProduct->getProductById($id);

            // Nếu upload ảnh mới thì dùng ảnh mới, nếu không thì giữ ảnh cũ
            if (!empty($_FILES['image']['name'])) {
                $data['image'] = uploadFile($_FILES['image'], './uploads/imgproduct');
            } else {
                $data['image'] = $oldProduct['image'];
            }

            $this->modelProduct->updateProduct($id, $data);
            header('Location: ' . BASE_URL . '?mode=admin&act=danh-sach-san-pham');
            exit;
        } else {
            $product = $this->modelProduct->getProductById($id);
            require_once './views/admin/editproduct.php';
        }
    }

    public function DeleteProduct() {
        $id = $_GET['id'] ?? 0;
        $this->modelProduct->deleteProduct($id);
        header('Location: ?mode=admin&act=danh-sach-san-pham');
        exit;
    }
    public function SearchProduct() {
        $keyword = $_GET['keyword'] ?? '';
        $products = [];
        if ($keyword !== '') {
            $products = $this->modelProduct->searchProduct($keyword);
        }
        require_once './views/client/search_product.php';
    }
    public function RemoveFromCart() {
        $userId = $_SESSION['user']['id'] ?? 0;
        $productId = $_GET['productId'] ?? 0;
        if ($userId && $productId) {
            $this->cartModel->removeFromCart($userId, $productId);
        }
        header('Location: ?act=cart_page');
        exit;
    }
    public function ProductViewAll() {
        $result = $this->modelProduct->getAllProduct();
        require_once './views/admin/listproduct.php';
    }
}
