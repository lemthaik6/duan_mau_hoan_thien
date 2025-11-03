<?php
class CommentModel {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
        // Ensure comments table exists (simple migration)
        $check = $this->conn->query("SHOW TABLES LIKE 'comments'")->fetch();
        if (!$check) {
            $sql = "CREATE TABLE comments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id INT NOT NULL,
                user_id INT DEFAULT NULL,
                content TEXT NOT NULL,
                created_at DATETIME,
                INDEX (product_id),
                INDEX (user_id)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
            $this->conn->exec($sql);
        }
    }

    public function addComment($productId, $userId, $content) {
        $sql = "INSERT INTO comments (product_id, user_id, content, created_at) VALUES (:product_id, :user_id, :content, :created_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':product_id' => $productId,
            ':user_id' => $userId,
            ':content' => $content,
            ':created_at' => date('Y-m-d H:i:s')
        ]);
        return $this->conn->lastInsertId();
    }

    public function getCommentsByProduct($productId) {
        $sql = "SELECT c.*, u.fullname as user_name FROM comments c LEFT JOIN users u ON u.id = c.user_id WHERE c.product_id = :product_id ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':product_id' => $productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
