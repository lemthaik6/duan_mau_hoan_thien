<?php
require_once 'header.php';
?>

<!-- Cart styles are in views/client/css/style.css -->

<main>
    <div class="container">
        <h2>Giỏ hàng của bạn</h2>
    <?php if(empty($cartItems)): ?>
      <div class="cart-empty">
        <p>Giỏ hàng của bạn đang trống.</p>
        <a class="cart-back" href="<?= BASE_URL ?>?act=home">Tiếp tục mua hàng</a>
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
              <a href="<?= BASE_URL ?>?act=remove_cart&productId=<?= $item['productId'] ?>" onclick="return confirm('Xóa sản phẩm này khỏi giỏ hàng?');" class="cart-remove">Xóa</a>
            </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" class="cart-total-cell"><b>Tổng tiền:</b></td>
                        <td><b><?= number_format($total) ?> VNĐ</b></td>
                    </tr>
                </tbody>
            </table>
      <div class="cart-actions">
        <a class="cart-back" href="<?= BASE_URL ?>?act=home">Tiếp tục mua hàng</a>
        <button class="cart-checkout" id="checkoutBtn" type="button">Thanh toán</button>
      </div>
        <?php endif; ?>
    </div>
</main>
<script>
document.getElementById('checkoutBtn').onclick = function() {
  // Open real checkout page
  window.location.href = '<?= BASE_URL ?>?act=checkout';
};
</script>
