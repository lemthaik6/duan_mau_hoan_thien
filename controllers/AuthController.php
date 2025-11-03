<?php
// có class chứa các function thực thi xử lý logic 
class AuthController
{
    public $modelUser;

    public function __construct()
    {
        $this->modelUser = new UserModel();
    }

    public function Register()
    {
        // Kiểm tra phương thức url
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $id = $this->modelUser->Register($_POST);
            if($id > 0){
                header('Location: ' . BASE_URL . '?act=login');
                exit;
            } else {
                echo "Đăng ký không thành công!";
            }
        } else {
            require_once './views/client/register.php';
        }
     
    }
    public function Login()
    {
        // Kiểm tra phương thức url
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $result = $this->modelUser->Login($_POST);
        if(!empty($result)){
            $_SESSION['user'] = $result; 
            header('Location: ' . BASE_URL); 
            exit;
        } else {
            echo "Đăng nhập thất bại!";
        }
        
    } else {
        require_once './views/client/login.php';
        }
     
    }
}
