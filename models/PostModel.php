<?php
class PostModel {
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
        $this->ensureTableExists();
    }

    private function ensureTableExists()
    {
        $sql = "CREATE TABLE IF NOT EXISTS posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            author VARCHAR(100) DEFAULT 'Khách',
            image VARCHAR(255) DEFAULT NULL,
            price DECIMAL(10,2) DEFAULT NULL,
            status TINYINT(1) DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->conn->exec($sql);

        // If table existed before, ensure new columns exist
        $colsToCheck = ['image' => "VARCHAR(255) DEFAULT NULL", 'price' => "DECIMAL(10,2) DEFAULT NULL"];
        foreach ($colsToCheck as $col => $definition) {
            $checkSql = "SHOW COLUMNS FROM posts LIKE '$col'";
            $stmt = $this->conn->prepare($checkSql);
            $stmt->execute();
            $exists = $stmt->fetch();
            if (!$exists) {
                $alter = "ALTER TABLE posts ADD COLUMN $col $definition";
                $this->conn->exec($alter);
            }
        }
    }

    public function updatePost($id, $data)
    {
        $sql = "UPDATE posts SET title = :title, content = :content, author = :author, image = :image, price = :price WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':author' => $data['author'] ?? 'Khách',
            ':image' => $data['image'] ?? null,
            ':price' => isset($data['price']) ? $data['price'] : null,
            ':id' => $id
        ]);
        return $stmt->rowCount();
    }

    public function setStatus($id, $status)
    {
        $sql = "UPDATE posts SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':status' => $status ? 1 : 0, ':id' => $id]);
    }

    public function createPost($data)
    {
        // allow passing initial status (default 0)
        $sql = "INSERT INTO posts (title, content, author, image, price, status, created_at) VALUES (:title, :content, :author, :image, :price, :status, :created_at)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':author' => $data['author'] ?? 'Khách',
            ':image' => $data['image'] ?? null,
            ':price' => isset($data['price']) ? $data['price'] : null,
            ':status' => isset($data['status']) ? ($data['status'] ? 1 : 0) : 0,
            ':created_at' => date('Y-m-d H:i:s')
        ]);
        return $this->conn->lastInsertId();
    }

    public function getApprovedPosts()
    {
        $sql = "SELECT * FROM posts WHERE status = 1 ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPosts()
    {
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostById($id)
    {
        $sql = "SELECT * FROM posts WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deletePost($id)
    {
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount();
    }
}
