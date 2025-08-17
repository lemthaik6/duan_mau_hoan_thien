<?php require_once 'header.php'; ?>
<main>
    <div class="container">
        <h2>Kết quả tìm kiếm</h2>
        <?php if(empty($products)): ?>
            <p>Không tìm thấy sản phẩm phù hợp.</p>
        <?php else: ?>
            <div class="product-list">
                <?php foreach($products as $product): ?>
                    <?php extract($product); ?>
                    <?php include './views/client/paths/product_item.php'; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php require_once 'footer.php'; ?>