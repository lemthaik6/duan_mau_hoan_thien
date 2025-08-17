<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class ProductModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Viết truy vấn danh sách danh mục
    // public function getAllCategory()
    // {
    //     $sql = "SELECT * FROM category";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }
    // Viết hàm thêm mới
    public function AddProduct($data){
        $sql = "INSERT INTO products (name, catid, image, price, description) 
                VALUES (:name, :catid, :image, :price, :description)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':catid' => $data['catid'],
            ':image' => $data['image'],
            ':price' => $data['price'],
            ':description' => $data['description']
        ]);
        return $this->conn->lastInsertId();
    }
    
    public function getAllProduct() {
        $sql = "SELECT * FROM products";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //lấy danh sách sản phẩm
     public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($id, $data) {
        $sql = "UPDATE products SET name = :name, price = :price, image = :image, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':image' => $data['image'],
            ':description' => $data['description'],
            ':id' => $id
        ]);
        return $stmt->rowCount();
    }

    public function deleteProduct($id) {
        // Xóa sản phẩm khỏi giỏ hàng trước
        $sql1 = "DELETE FROM cartdetail WHERE productid = :id";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute(['id' => $id]);

        // Sau đó xóa sản phẩm
        $sql2 = "DELETE FROM products WHERE id = :id";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->execute(['id' => $id]);
        return $stmt2->rowCount();
    }

    public function searchProduct($keyword) {
        $sql = "SELECT * FROM products WHERE name LIKE :kw OR description LIKE :kw";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['kw' => '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
