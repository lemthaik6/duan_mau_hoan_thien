<?php
// có class chứa các function thực thi xử lý logic 
class CategoryController
{
    public $modelCategory;

    public function __construct()
    {
        $this->modelCategory = new CategoryModel();
    }

    public function AddControllerView()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
       $id = $this->modelCategory->AddCategory($_POST);
      echo "ID danh mục vừa thêm là: $id";
      header("Location: /duan_mau/duan_mau1/?mode=admin&act=danh-muc");
      exit();
        }
        else{
            $title = "Thêm danh mục";
        require_once './views/admin/addcategory.php';
        }
     
    }
    public function CategoryViewAll(){
        $result = $this->modelCategory->getAllCategory();
       require_once './views/admin/listcat.php';
    }
    public function EditCategory()
    {
        $id = $_GET['id'] ?? 0;
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->modelCategory->updateCategory($id, $_POST);
            header("Location: /duan_mau/duan_mau1/?mode=admin&act=danh-muc");
            exit();
        } else {
            $category = $this->modelCategory->getCategoryById($id);
            $title = "Sửa danh mục";
            require_once './views/admin/editcategory.php';
        }
    }

    public function DeleteCategory()
    {
        $id = $_GET['id'] ?? 0;
        $this->modelCategory->deleteCategory($id);
        header("Location: /duan_mau/duan_mau1/?mode=admin&act=danh-muc");
        exit();
    }
}
