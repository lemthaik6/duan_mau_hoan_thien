<?php require_once 'header.php'; ?>
<main>
    <div class="container">
        <h2>Chỉnh sửa bài viết</h2>
        <?php if(!empty($_SESSION['flash'])): ?>
            <div style="padding:10px;background:#fff3e0;border:1px solid #ffe0b2;margin-bottom:12px"><?= htmlspecialchars($_SESSION['flash']) ?></div>
            <?php unset($_SESSION['flash']); endif; ?>
        <form action="<?= BASE_URL ?>?mode=admin&act=cap-nhat-bai-viet" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()) ?>">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <input type="hidden" name="existing_image" value="<?= htmlspecialchars($post['image'] ?? '') ?>">
            <div style="margin-bottom:8px">
                <label>Tiêu đề</label><br>
                <input type="text" name="title" style="width:100%;padding:8px" required value="<?= htmlspecialchars($post['title']) ?>">
            </div>
            <div style="margin-bottom:8px">
                <label>Hình ảnh hiện có</label><br>
                <?php if(!empty($post['image'])): ?>
                    <img src="<?= BASE_URL . $post['image'] ?>" style="width:200px;height:120px;object-fit:cover;border-radius:6px;margin-bottom:8px" />
                <?php else: ?>
                    <div style="color:#888">(Chưa có)</div>
                <?php endif; ?>
            </div>
            <div style="margin-bottom:8px">
                <label>Thay đổi ảnh (tùy chọn)</label><br>
                <input type="file" name="image" accept="image/*">
            </div>
            <div style="margin-bottom:8px">
                <label>Giá (tùy chọn)</label><br>
                <input type="text" name="price" style="width:100%;padding:8px" value="<?= htmlspecialchars($post['price'] ?? '') ?>">
            </div>
            <div style="margin-bottom:8px">
                <label>Nội dung</label><br>
                <textarea name="content" rows="8" style="width:100%;padding:8px" required><?= htmlspecialchars($post['content']) ?></textarea>
            </div>
            <div style="margin-bottom:8px">
                <label>Tên (hiển thị)</label><br>
                <input type="text" name="author" style="width:100%;padding:8px" value="<?= htmlspecialchars($post['author']) ?>">
            </div>
            <div style="margin-bottom:8px">
                <label>Trạng thái</label><br>
                <select name="status" style="padding:8px;border-radius:6px">
                    <option value="0" <?= !$post['status'] ? 'selected' : '' ?>>Chờ duyệt</option>
                    <option value="1" <?= $post['status'] ? 'selected' : '' ?>>Đã duyệt</option>
                </select>
            </div>
            <button type="submit" style="background:#1565c0;color:#fff;border:none;padding:10px 16px;border-radius:6px">Lưu</button>
        </form>
    </div>
</main>
<?php require_once 'footer.php'; ?>
