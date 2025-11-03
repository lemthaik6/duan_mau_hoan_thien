<?php require_once 'header.php'; ?>
<main>
    <div class="container">
        <h2>Danh sách bài viết</h2>
        <?php if(!empty(
            
            $_SESSION['flash']
        )): ?>
            <div style="padding:10px;background:#e8f5e9;border:1px solid #c8e6c9;margin-bottom:12px"><?= htmlspecialchars($_SESSION['flash']) ?></div>
            <?php unset($_SESSION['flash']); endif; ?>
        <table style="width:100%;border-collapse:collapse">
            <thead>
                <tr style="background:#f0f4fa;color:#1565c0;text-align:left">
                    <th style="padding:8px">ID</th>
                    <th style="padding:8px">Ảnh</th>
                    <th style="padding:8px">Tiêu đề</th>
                    <th style="padding:8px">Tác giả</th>
                    <th style="padding:8px">Trạng thái</th>
                    <th style="padding:8px">Ngày</th>
                    <th style="padding:8px">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($posts as $p): ?>
        <style>
            .btn-approve{background:#43a047;color:#fff;padding:6px 10px;border-radius:6px;text-decoration:none}
            .btn-unapprove{background:#f57c00;color:#fff;padding:6px 10px;border-radius:6px;text-decoration:none}
            .btn-edit{background:#1565c0;color:#fff;padding:6px 10px;border-radius:6px;text-decoration:none}
            .btn-delete{background:#e53935;color:#fff;padding:6px 10px;border-radius:6px;text-decoration:none}
            .btn-approve:hover,.btn-edit:hover,.btn-delete:hover,.btn-unapprove:hover{opacity:0.9}
        </style>
                <tr>
                    <td style="padding:8px;border-top:1px solid #eee"><?= $p['id'] ?></td>
                    <td style="padding:8px;border-top:1px solid #eee">
                        <?php if(!empty($p['image'])): ?>
                            <img src="<?= BASE_URL . $p['image'] ?>" style="width:80px;height:50px;object-fit:cover;border-radius:6px" />
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td style="padding:8px;border-top:1px solid #eee"><?= htmlspecialchars($p['title']) ?></td>
                    <td style="padding:8px;border-top:1px solid #eee"><?= htmlspecialchars($p['author']) ?></td>
                    <td style="padding:8px;border-top:1px solid #eee">
                        <?= ($p['status'] ? '<strong style="color:green">Đã duyệt</strong>' : '<em>Chờ duyệt</em>') ?>
                    </td>
                    <td style="padding:8px;border-top:1px solid #eee"><?= $p['created_at'] ?></td>
                    <td style="padding:8px;border-top:1px solid #eee">
                        <?php if(!$p['status']): ?>
                            <a class="btn-approve" href="<?= BASE_URL ?>?mode=admin&act=duyet-bai-viet&id=<?= $p['id'] ?>">Duyệt</a>
                        <?php else: ?>
                            <a class="btn-unapprove" href="<?= BASE_URL ?>?mode=admin&act=duyet-bai-viet&id=<?= $p['id'] ?>">Bỏ duyệt</a>
                        <?php endif; ?>
                        &nbsp; <a class="btn-edit" href="<?= BASE_URL ?>?mode=admin&act=sua-bai-viet&id=<?= $p['id'] ?>">Sửa</a>
                        &nbsp; <a class="btn-delete" href="<?= BASE_URL ?>?mode=admin&act=xoa-bai-viet&id=<?= $p['id'] ?>" onclick="return confirm('Xóa bài viết này?')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
