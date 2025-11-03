<?php require_once 'header.php'; ?>
<style>
  .contact-container{max-width:900px;margin:32px auto;background:#fff;padding:22px;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,0.04)}
  .contact-grid{display:grid;grid-template-columns:1fr 360px;gap:20px}
  .contact-card{padding:12px;border-radius:8px;border:1px solid #f0f0f0;background:#fafafa}
  .contact-form textarea,input{width:100%;padding:10px;border-radius:6px;border:1px solid #ccc;margin-bottom:10px}
  .contact-form button{background:#1565c0;color:#fff;padding:10px 14px;border:none;border-radius:6px}
  @media(max-width:900px){.contact-grid{grid-template-columns:1fr}}
</style>
<main>
  <div class="container">
    <div class="contact-container">
      <h1>Liên hệ với chúng tôi</h1>
      <p style="color:#666;margin-bottom:16px">Mọi thắc mắc về sản phẩm, đơn hàng hay bảo hành, vui lòng liên hệ theo thông tin bên cạnh hoặc gửi tin nhắn cho chúng tôi.</p>

      <div class="contact-grid">
        <div>
          <div class="contact-card">
            <h3>Thông tin cửa hàng</h3>
            <p><strong>Hotline:</strong> 0354 966 919</p>
            <p><strong>Email:</strong> lemthai1808@gmail.com</p>
            <p><strong>Địa chỉ:</strong> Số 1, phố Trường Chinh, Hà Nội</p>
            <p><strong>Giờ mở cửa:</strong> 08:30 - 20:00 (Tất cả các ngày)</p>
          </div>

          <div class="contact-card" style="margin-top:12px;">
            <h3>Hỗ trợ nhanh</h3>
            <ul>
              <li><a href="#">Chính sách đổi trả</a></li>
              <li><a href="#">Chính sách bảo hành</a></li>
              <li><a href="#">Thanh toán & Vận chuyển</a></li>
            </ul>
          </div>
        </div>

        <div>
          <div class="contact-card contact-form">
            <h3>Gửi tin nhắn</h3>
            <form id="contactForm">
              <input type="text" name="name" placeholder="Họ và tên" required>
              <input type="email" name="email" placeholder="Email" required>
              <input type="text" name="phone" placeholder="Số điện thoại">
              <textarea name="message" rows="6" placeholder="Nội dung" required></textarea>
              <button type="submit">Gửi liên hệ</button>
            </form>
            <div id="contactResult" style="margin-top:10px;display:none"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e){
  e.preventDefault();
  // Simple client-side submission: show success message (no backend configured)
  document.getElementById('contactResult').style.display = 'block';
  document.getElementById('contactResult').innerHTML = '<div style="padding:10px;background:#e6ffed;border:1px solid #b7f5c9;border-radius:6px;color:#064c2d">Cám ơn bạn, chúng tôi đã nhận được tin nhắn. Chúng tôi sẽ liên hệ lại sớm nhất.</div>';
  this.reset();
});
</script>

<?php require_once 'footer.php'; ?>
