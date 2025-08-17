<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class CategoryModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy tất cả danh mục (có thể lọc theo type)
    public function getAllCategory($type = null)
    {
        $sql = "SELECT * FROM category"; 
        if ($type !== null) {
            $sql .= " WHERE type = :type";
        }
        $stmt = $this->conn->prepare($sql);
        if ($type !== null){
            $stmt->execute(["type" => $type]);
        } else {
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm mới danh mục
    public function AddCategory($data){
        $sql = "INSERT INTO category (name, type) VALUES (:name, :type)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "name" => $data['name'],
            "type" => $data['type'],
        ]);
        return $this->conn->lastInsertId();
    }

    // Lấy danh mục theo id
    public function getCategoryById($id){
        $sql = "SELECT * FROM category WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Sửa danh mục
    public function updateCategory($id, $data){
        $sql = "UPDATE category SET name = :name, type = :type WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            "name" => $data['name'],
            "type" => $data['type'],
            "id"   => $id
        ]);
        return $stmt->rowCount();
    }

    // Xóa danh mục
    public function deleteCategory($id){
        $sql = "DELETE FROM category WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["id" => $id]);
        return $stmt->rowCount();
    }
}
