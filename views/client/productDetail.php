<?php  
require_once 'header.php';
?>

<style>
.productdetail {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 12px rgba(21, 101, 192, 0.07);
  padding: 32px 24px;
  margin-top: 32px;
}
.grid {
  display: flex;
  gap: 32px;
  align-items: flex-start;
}
.image {
  flex: 0 0 340px;
}
.image img {
  width: 100%;
  height: 320px;
  object-fit: cover;
  border-radius: 10px;
  background: #f0f4fa;
  box-shadow: 0 2px 8px rgba(21,101,192,0.08);
}
.info {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 18px;
}
.info h1 {
  font-size: 2rem;
  color: #1565c0;
  margin-bottom: 8px;
}
.info p {
  font-size: 18px;
  color: #444;
  margin-bottom: 0;
}
.info form {
  margin-top: 8px;
  display: flex;
  gap: 12px;
  align-items: center;
}
.info input[type="number"] {
  width: 70px;
  padding: 8px;
  border-radius: 6px;
  border: 1px solid #c0bcbcff;
  font-size: 16px;
}
.info button {
  background: #1565c0;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 10px 18px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}
.info button:hover {
  background: #0d47a1;
}
.description {
  margin-top: 32px;
  font-size: 16px;
  color: #333;
  background: #ffffffff;
  border-radius: 8px;
  padding: 18px;
}
@media (max-width: 900px) {
  .grid {
    flex-direction: column;
    gap: 18px;
  }
  .image img {
    height: 200px;
  }
}
</style>

<main>
    <div class="container">
        <section class="productdetail">
            <div class="grid">
                <div class="image">
                    <img src="<?=$image?>" alt="<?=$name?>" />
                </div>
                <div class="info">
                    <h1><?=$name?></h1>
                    <form id="addToCartForm">
                        <input type="number" name="quantity" value="1" min="1">
                        <input type="hidden" name="productid" value="<?=$id?>">
                        <button type="submit">Thêm giỏ hàng</button>
                    </form>
          <p>Giá sản phẩm: <?=number_format($price)?> VNĐ</p>
          <div class="description">
            <?= nl2br(htmlspecialchars($description)) ?>
          </div>
          <!-- Comments section -->
          <div class="comments" style="margin-top:24px;">
            <h3>Bình luận</h3>
            <?php $isLocked = isset($comment_status) ? (int)$comment_status : 0; ?>
            <?php if($isLocked): ?>
              <p style="color:#ef4444;">Bình luận cho sản phẩm này đã bị khóa.</p>
            <?php endif; ?>

            <div id="commentsList">
              <?php if(!empty($comments)): ?>
                <?php foreach($comments as $c): ?>
                  <div class="comment-item" style="padding:8px;border-bottom:1px solid #eee;">
                    <strong><?= htmlspecialchars($c['user_name'] ?? 'Người dùng') ?></strong>
                    <span style="color:#666;font-size:0.9em;margin-left:8px;"><?= $c['created_at'] ?></span>
                    <div style="margin-top:6px;"><?= nl2br(htmlspecialchars($c['content'])) ?></div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <p>Chưa có bình luận nào.</p>
              <?php endif; ?>
            </div>

            <?php if(!$isLocked): ?>
              <?php if(isset($_SESSION['user'])): ?>
                <form id="commentForm" style="margin-top:12px;">
                  <textarea name="content" rows="3" style="width:100%;padding:8px;border-radius:6px;border:1px solid #ccc;" placeholder="Viết bình luận..." required></textarea>
                  <input type="hidden" name="product_id" value="<?=$id?>">
                  <button type="submit" style="margin-top:8px;background:#1565c0;color:#fff;padding:8px 12px;border-radius:6px;border:none;">Gửi bình luận</button>
                </form>
              <?php else: ?>
                <p><a href="?act=login">Đăng nhập</a> để bình luận.</p>
              <?php endif; ?>
            <?php endif; ?>
          </div>
                </div>
            </div>
        </section>
    </div>
</main>

<script>
document.getElementById('addToCartForm').addEventListener('submit', async function(e){
    e.preventDefault();

    const formData = new FormData(this);

    try {
        const response = await fetch('?act=addtocart', {
            method: 'POST',
            body: formData
        });
        const data = await response.json();

        alert(data.message);

        if(data.status){
            // redirect sang trang giỏ hàng
            window.location.href = '?act=cart_page';
        }
    } catch(err){
        console.error(err);
        alert('Có lỗi xảy ra, vui lòng thử lại');
    }
});
</script>
<script>
// Comment form submission
const commentForm = document.getElementById('commentForm');
if(commentForm){
  commentForm.addEventListener('submit', async function(e){
    e.preventDefault();
    const formData = new FormData(this);
    try{
      const res = await fetch('?act=add-comment', {
        method: 'POST',
        body: formData
      });
      const data = await res.json();
      alert(data.message);
      if(data.status){
        // prepend new comment to the list
        const c = data.data;
        const list = document.getElementById('commentsList');
        const div = document.createElement('div');
        div.className = 'comment-item';
        div.style.padding = '8px';
        div.style.borderBottom = '1px solid #eee';
        div.innerHTML = `<strong>${c.user_name}</strong> <span style="color:#666;font-size:0.9em;margin-left:8px;">${c.created_at}</span><div style="margin-top:6px;">${c.content.replace(/\n/g,'<br>')}</div>`;
        if(list && list.firstChild){
          list.insertBefore(div, list.firstChild);
        } else if(list){
          list.appendChild(div);
        }
        // clear textarea
        this.querySelector('textarea[name="content"]').value = '';
      }
    }catch(err){
      console.error(err);
      alert('Lỗi khi gửi bình luận');
    }
  });
}
</script>

