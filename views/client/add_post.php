<?php require_once 'header.php'; ?>
<main>
    <div class="container">
        <div class="post-form">
            <h2>Gửi bài viết</h2>
            <?php if(!empty($_SESSION['flash'])): ?>
                <div class="muted" style="padding:10px;background:#e8f5e9;border:1px solid #c8e6c9;margin-bottom:12px"><?= htmlspecialchars($_SESSION['flash']) ?></div>
                <?php unset($_SESSION['flash']); endif; ?>
            <form action="<?= BASE_URL ?>?act=submit-post" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()) ?>">
                <div class="form-row">
                    <label>Tiêu đề</label>
                    <input type="text" name="title" required>
                </div>
                <div class="form-row">
                    <label>Hình ảnh (tùy chọn)</label>
                    <input type="file" name="image" accept="image/*">
                </div>
                <div class="form-row">
                    <label>Giá (tùy chọn)</label>
                    <input type="text" name="price" placeholder="vd: 1990000">
                </div>
                <div class="form-row">
                    <label>Nội dung</label>
                    <textarea name="content" required></textarea>
                </div>
                <div class="form-row">
                    <label>Tên (hiển thị)</label>
                    <input type="text" name="author" value="<?= htmlspecialchars($_SESSION['user']['fullname'] ?? '') ?>">
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-btn">Gửi bài</button>
                </div>
            </form>
        </div>
    </div>
</main>
<?php require_once 'footer.php'; ?>
