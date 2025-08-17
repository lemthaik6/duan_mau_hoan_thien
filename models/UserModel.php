<?php 
// Có class chứa các function thực thi tương tác với cơ sở dữ liệu 
class UserModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function Register($data){
        $sql = "INSERT INTO users (username,password,fullname,birth) VALUES (:username, :password, :fullname, :birth)";
        $stmt = $this->conn->prepare($sql);
        $stmt ->execute(
            [
                ':username' => $data['username'],
                ':password' => md5($data['password']),
                ':fullname' => $data['fullname'],
                ':birth' => $data['birth']
            ]
            );
        return $this->conn->lastInsertId();
    }
    public function Login($data){
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password limit 1";
        $stmt = $this->conn->prepare($sql);
        $stmt ->execute(
            [
                ':username' => $data['username'],
                ':password' => md5($data['password'])
            ]
            );
        return $stmt->fetch();
    }
}
