<?php
class PostController
{
    public $model;

    public function __construct()
    {
        $this->model = new PostModel();
    }

    // Show client form to add a post
    public function createForm()
    {
        // Ensure CSRF token exists
        generateCsrfToken();
        require_once './views/client/add_post.php';
    }

    // Handle form POST
    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL);
            exit;
        }
        // CSRF check
        $token = $_POST['csrf_token'] ?? '';
        if (!verifyCsrfToken($token)) {
            $_SESSION['flash'] = 'Token không hợp lệ. Vui lòng thử lại.';
            header('Location: ' . BASE_URL . '?act=add-post');
            exit;
        }

    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
        // If user is logged in, use their name
        $author = $_SESSION['user']['fullname'] ?? trim($_POST['author'] ?? 'Khách');

        // Validation
        if ($title === '' || $content === '') {
            $_SESSION['flash'] = 'Vui lòng điền tiêu đề và nội dung.';
            header('Location: ' . BASE_URL . '?act=add-post');
            exit;
        }
        if (mb_strlen($title) > 255) {
            $_SESSION['flash'] = 'Tiêu đề không quá 255 ký tự.';
            header('Location: ' . BASE_URL . '?act=add-post');
            exit;
        }

        // Handle image upload (optional)
        $imagePath = null;
        if (!empty($_FILES['image']['name'])) {
            $uploaded = uploadFile($_FILES['image'], './uploads/imgpost/');
            if ($uploaded) {
                // normalize leading ./ to / for URL building
                if (strpos($uploaded, './') === 0) $uploaded = substr($uploaded, 1);
                $imagePath = $uploaded;
            }
        }

        // price (optional)
        $price = null;
        if (isset($_POST['price']) && $_POST['price'] !== '') {
            $price = floatval(str_replace(',', '', $_POST['price']));
        }

        // Create with pending status (0)
        $id = $this->model->createPost([
            'title' => $title,
            'content' => $content,
            'author' => $author,
            'image' => $imagePath,
            'price' => $price,
            'status' => 0
        ]);

        $_SESSION['flash'] = 'Đã gửi bài viết. Chờ admin duyệt.';
        header('Location: ' . BASE_URL);
        exit;
    }

    // Admin list view
    public function adminList()
    {
        $posts = $this->model->getAllPosts();
        require_once './views/admin/listpost.php';
    }

    // Admin delete
    public function delete()
    {
        $id = $_GET['id'] ?? 0;
        if ($id) {
            $this->model->deletePost($id);
        }
        header('Location: ' . BASE_URL . '?mode=admin&act=danh-sach-bai-viet');
        exit;
    }

    public function approve()
    {
        $id = $_GET['id'] ?? 0;
        if ($id) {
            // toggle status: if currently approved -> unapprove, else approve
            $post = $this->model->getPostById($id);
            if ($post) {
                $newStatus = $post['status'] ? 0 : 1;
                $this->model->setStatus($id, $newStatus);
            }
        }
        header('Location: ' . BASE_URL . '?mode=admin&act=danh-sach-bai-viet');
        exit;
    }

    public function editForm()
    {
        $id = $_GET['id'] ?? 0;
        $post = $this->model->getPostById($id);
        if (!$post) {
            header('Location: ' . BASE_URL . '?mode=admin&act=danh-sach-bai-viet');
            exit;
        }
        generateCsrfToken();
        require_once './views/admin/editpost.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '?mode=admin&act=danh-sach-bai-viet');
            exit;
        }
        $token = $_POST['csrf_token'] ?? '';
        if (!verifyCsrfToken($token)) {
            $_SESSION['flash'] = 'Token không hợp lệ.';
            header('Location: ' . BASE_URL . '?mode=admin&act=danh-sach-bai-viet');
            exit;
        }
        $id = $_POST['id'] ?? 0;
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');
        $author = trim($_POST['author'] ?? '');
        // handle optional image upload in edit
        $imagePath = $_POST['existing_image'] ?? null;
        if (!empty($_FILES['image']['name'])) {
            $uploaded = uploadFile($_FILES['image'], './uploads/imgpost/');
            if ($uploaded) {
                if (strpos($uploaded, './') === 0) $uploaded = substr($uploaded, 1);
                $imagePath = $uploaded;
            }
        }

        $price = null;
        if (isset($_POST['price']) && $_POST['price'] !== '') {
            $price = floatval(str_replace(',', '', $_POST['price']));
        }

        // allow admin to set status when updating
        $status = isset($_POST['status']) ? ($_POST['status'] ? 1 : 0) : null;
        $updateData = ['title' => $title, 'content' => $content, 'author' => $author, 'image' => $imagePath, 'price' => $price];
        if ($status !== null) $updateData['status'] = $status;
        if ($id && $title && $content) {
            $this->model->updatePost($id, $updateData);
            if ($status !== null) {
                $this->model->setStatus($id, $status);
            }
        }
        header('Location: ' . BASE_URL . '?mode=admin&act=danh-sach-bai-viet');
        exit;
    }
}
