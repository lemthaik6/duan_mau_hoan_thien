<?php
class CartModel 
{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function findCartByUser($userId){
        $sql = "SELECT * FROM carts WHERE userId = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['userId'=>$userId]);
        $result = $stmt->fetch();
        return empty($result) ? 0 : $result['id'];
    }

    public function addTocart($userId, $productId, $quantity=1){
        $cartId = $this->findCartByUser($userId);
        if($cartId==0){
            $sql = "INSERT INTO carts(userId) VALUES (:userId)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['userId'=>$userId]);
            $cartId = $this->conn->lastInsertId();
        }

        $sql = "SELECT * FROM cartdetail WHERE cartId=:cartId AND productId=:productId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['cartId'=>$cartId,'productId'=>$productId]);
        $result = $stmt->fetch();

        if(empty($result)){
            $sqlinsert = "INSERT INTO cartdetail(cartId,productId,quantity) VALUES (:cartId,:productId,:quantity)";
            $stmtinsert = $this->conn->prepare($sqlinsert);
            $stmtinsert->execute(['cartId'=>$cartId,'productId'=>$productId,'quantity'=>$quantity]);
        } else {
            $sqlud = "UPDATE cartdetail SET quantity=:quantity WHERE id=:id";
            $stmtud = $this->conn->prepare($sqlud);
            $stmtud->execute(['id'=>$result['id'],'quantity'=>$result['quantity']+$quantity]);
        }
    }

    public function getAllProductInCart($userId){
        $sql = "SELECT c.cartId, c.productId, p.name, p.image, p.price, c.quantity 
                FROM cartdetail c 
                LEFT JOIN products p ON p.id=c.productId 
                LEFT JOIN carts ON carts.id = c.cartId
                WHERE carts.userId = :userId";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['userId'=>$userId]);
        return $stmt->fetchAll();
    }
    public function removeFromCart($userId, $productId) {
        $cartId = $this->findCartByUser($userId);
        if ($cartId) {
            $sql = "DELETE FROM cartdetail WHERE cartId = :cartId AND productId = :productId";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['cartId' => $cartId, 'productId' => $productId]);
            return $stmt->rowCount();
        }
        return 0;
    }
}
?>
