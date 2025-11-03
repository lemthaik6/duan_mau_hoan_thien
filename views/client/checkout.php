<?php require_once 'header.php'; ?>
<main>
    <div class="container">
        <h2>Thanh toán</h2>

        <?php if(empty($cartItems)): ?>
            <p>Giỏ hàng của bạn trống.</p>
            <a class="cart-back" href="<?= BASE_URL ?>?act=home">Tiếp tục mua sắm</a>
        <?php else: ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cartItems as $it): ?>
                        <tr>
                            <td><?= htmlspecialchars($it['name']) ?></td>
                            <td><?= number_format($it['price']) ?> VNĐ</td>
                            <td><?= $it['quantity'] ?></td>
                            <td><?= number_format($it['price'] * $it['quantity']) ?> VNĐ</td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3" class="cart-total-cell">Tổng:</td>
                        <td><b><?= number_format($total) ?> VNĐ</b></td>
                    </tr>
                </tbody>
            </table>

            <form method="post" action="<?= BASE_URL ?>?act=checkout">
                <button class="cart-checkout" type="submit">Xác nhận thanh toán</button>
                <a class="cart-back" href="<?= BASE_URL ?>?act=cart_page">Quay lại giỏ hàng</a>
            </form>
        <?php endif; ?>
    </div>
</main>
<?php require_once 'footer.php'; ?>
