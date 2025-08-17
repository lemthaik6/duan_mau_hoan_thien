<?php
require_once 'header.php';
?>

<style>
.cart-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 24px;
  background: #fff;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 2px 12px rgba(21,101,192,0.07);
}
.cart-table th, .cart-table td {
  padding: 14px 10px;
  text-align: center;
  border-bottom: 1px solid #e0e7ef;
}
.cart-table th {
  background: #f0f4fa;
  color: #1565c0;
  font-size: 16px;
  font-weight: 600;
}
.cart-table tr:last-child td {
  border-bottom: none;
}
.cart-table img {
  border-radius: 8px;
  background: #f0f4fa;
}
.cart-actions {
  margin-top: 24px;
  display: flex;
  gap: 16px;
}
.cart-back, .cart-checkout {
  display: inline-block;
  padding: 10px 22px;
  border-radius: 6px;
  text-decoration: none;
  font-weight: 500;
  transition: background 0.2s;
}
.cart-back {
  background: #1565c0;
  color: #fff;
}
.cart-back:hover {
  background: #0d47a1;
}
.cart-checkout {
  background: #43a047;
  color: #fff;
}
.cart-checkout:hover {
  background: #2e7d32;
}
.cart-empty {
  text-align: center;
  margin: 48px 0;
  color: #1565c0;
  font-size: 18px;
}
@media (max-width: 700px) {
  .cart-table th, .cart-table td {
    padding: 8px 4px;
    font-size: 14px;
  }
  .cart-table img {
    width: 50px;
  }
  .cart-actions {
    flex-direction: column;
    gap: 10px;
    align-items: center;
  }
}
</style>

<main>
    <div class="container">
        <h2>Giỏ hàng của bạn</h2>
        <?php if(empty($cartItems)): ?>
            <div class="cart-empty">
                
                <p>Giỏ hàng của bạn đang trống.</p>
                <a class="cart-back" href="?act=home">Tiếp tục mua hàng</a>
            </div>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <!-- Bỏ cột Ảnh -->
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total = 0;
                    foreach ($cartItems as $item):
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    ?>
                    <tr>
                        <!-- Bỏ cột ảnh -->
                        <td><?= htmlspecialchars($item['name']) ?></td>
                        <td><?= number_format($item['price']) ?> VNĐ</td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($subtotal) ?> VNĐ</td>
                        <td>
                            <a href="?act=remove_cart&productId=<?= $item['productId'] ?>" onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?');" class="action-btn">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" style="text-align:right"><b>Tổng tiền:</b></td>
                        <td><b><?= number_format($total) ?> VNĐ</b></td>
                    </tr>
                </tbody>
            </table>
            <div class="cart-actions">
                <a class="cart-back" href="?act=home">Tiếp tục mua hàng</a>
                <button class="cart-checkout" id="checkoutBtn" type="button">Thanh toán</button>
            </div>
        <?php endif; ?>
    </div>
</main>
<script>
document.getElementById('checkoutBtn').onclick = function() {
    alert('Thanh toán thành công!');
    window.location.href = 'http://localhost/duan_mau/duan_mau1/';
};
</script>
