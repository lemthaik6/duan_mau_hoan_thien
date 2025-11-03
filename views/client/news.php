<?php require_once 'header.php'; ?>
<style>
  .news-container{max-width:1000px;margin:28px auto;background:#fff;padding:20px;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,0.05)}
  .news-list{display:grid;grid-template-columns:repeat(2,1fr);gap:18px}
  .news-item{padding:14px;border-radius:8px;border:1px solid #f0f0f0;background:#fafafa}
  .news-item h3{margin-bottom:8px;color:#1565c0}
  .news-item p{color:#444}
  @media (max-width:800px){.news-list{grid-template-columns:1fr}}
</style>
<main>
  <div class="container">
    <div class="news-container">
      <h1>Tin tức & Bài đăng từ người dùng</h1>
      <p style="color:#666;margin-bottom:16px">Các bài viết được người dùng gửi và đã được admin duyệt sẽ xuất hiện ở đây.</p>

      <?php if(!empty($posts)): ?>
        <div class="news-list">
          <?php foreach($posts as $post): ?>
            <article class="news-item">
              <?php if(!empty($post['image'])): ?>
                <img src="<?= BASE_URL . $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>">
              <?php endif; ?>
              <h3><?= htmlspecialchars($post['title']) ?></h3>
              <small style="color:#888"><?= date('d/m/Y', strtotime($post['created_at'])) ?></small>
              <?php if(!empty($post['price'])): ?>
                <div style="color:#2e7d32;font-weight:700;margin-top:6px">Giá: <?= number_format($post['price']) ?> VNĐ</div>
              <?php endif; ?>
              <p><?= nl2br(htmlspecialchars(mb_substr($post['content'],0,240))) ?><?php if(mb_strlen($post['content'])>240) echo '...'; ?></p>
            </article>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p>Hiện chưa có bài viết được duyệt. Bạn có thể gửi bài <a href="<?= BASE_URL ?>?act=add-post">tại đây</a>.</p>
      <?php endif; ?>

    </div>
  </div>
  
</main>

<?php require_once 'footer.php'; ?>
