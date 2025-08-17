<?php
require_once 'header.php';
?>
<div class="main">
    <aside>
        <?php  
require_once 'sidebar.php';
?>
    </aside>
    <main>
        <h1>Sửa danh mục</h1>
        <form method="post" class="edit-form">
            <label for="name">Tên danh mục:</label>
            <input type="text" name="name" id="name" value="<?= htmlspecialchars($category['name']) ?>" required>
            <br>
            <label for="type">Loại danh mục:</label>
            <select name="type" id="type" required>
                <option value="0" <?= $category['type']==0 ? 'selected' : '' ?>>Tin tức</option>
                <option value="1" <?= $category['type']==1 ? 'selected' : '' ?>>Sản phẩm</option>
            </select>
            <br>
            <button type="submit" class="action-btn">Cập nhật</button>
            <a href="?mode=admin&act=danh-muc" class="action-btn" style="margin-left:8px;">Quay lại</a>
        </form>
    </main>
</div>
<style>
.main {
    display: flex;
    gap: 20px;
    padding: 20px;
    background-color: #f4f6f8;
    min-height: calc(100vh - 60px);
    font-family: Arial, sans-serif;
}
aside {
    background: #2c3e50;
    color: white;
    width: 220px;
    padding: 20px;
    border-radius: 8px;
}
main {
    flex: 1;
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}
main h1 {
    font-size: 20px;
    margin-bottom: 15px;
    color: #333;
}
.edit-form {
    max-width: 400px;
    margin-top: 20px;
}
.edit-form label {
    font-weight: 500;
    color: #1565c0;
    margin-bottom: 8px;
    display: block;
}
.edit-form input[type="text"],
.edit-form select {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #cfd8dc;
    margin-bottom: 18px;
    font-size: 16px;
}
.action-btn {
    color: #2980b9;
    font-weight: bold;
    text-decoration: none;
    padding: 8px 18px;
    border-radius: 4px;
    border: none;
    background: #d6eaf8;
    cursor: pointer;
    transition: background 0.2s;
    font-size: 15px;
    display: inline-block;
}
.action-btn:hover {
    background: #3498db;
    color: #fff;
    text-decoration: underline;
}
@media (max-width: 900px) {
    .main {
        flex-direction: column;
        gap: 18px;
    }
    aside {
        width: 100%;
    }
    main {
        padding: 12px;
    }
    .edit-form {
        max-width: 100%;
    }
}
</style>
<?php require_once 'footer.php'; ?>