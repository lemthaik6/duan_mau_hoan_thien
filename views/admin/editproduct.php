<?php
require_once 'header.php';
?>
<form method="post" enctype="multipart/form-data">
    <label>Tên sản phẩm:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>">
    <label>Giá:</label>
    <input type="text" name="price" value="<?= htmlspecialchars($product['price']) ?>">
    <label>Ảnh:</label>
    <input type="file" name="image">
    <img src="/duan_mau1/<?= $product['image'] ?>" width="100">
    <label>Mô tả:</label>
    <textarea name="description"><?= htmlspecialchars($product['description']) ?></textarea>
    <button type="submit">Cập nhật</button>
</form>

<style>
form {
    max-width: 420px;
    margin: 32px auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 2px 12px rgba(21,101,192,0.07);
    padding: 32px 28px;
    display: flex;
    flex-direction: column;
    gap: 18px;
}

form label {
    font-weight: 500;
    color: #1565c0;
    margin-bottom: 6px;
}

form input[type="text"],
form textarea {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #cfd8dc;
    font-size: 16px;
    margin-bottom: 8px;
    background: #f8fafc;
}

form input[type="file"] {
    margin-bottom: 8px;
}

form img {
    border-radius: 8px;
    margin-bottom: 8px;
    background: #f0f4fa;
    box-shadow: 0 2px 8px rgba(21,101,192,0.08);
    max-width: 120px;
}

form textarea {
    min-height: 80px;
    resize: vertical;
}

form button {
    background: #1565c0;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 10px 22px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
    margin-top: 12px;
}

form button:hover {
    background: #0d47a1;
}

@media (max-width: 600px) {
    form {
        padding: 16px 8px;
        max-width: 100%;
    }
}
</style>