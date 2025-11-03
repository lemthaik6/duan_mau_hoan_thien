<?php  
require_once 'header.php';
?>
<main>
    <div class="container">
       <?php
       // Dynamic slideshow: prefer uploads/banner, fallback to uploads/imgproduct
       $banners = [];
       $bannerDir = __DIR__ . '/../../uploads/banner';
       $imgDir = __DIR__ . '/../../uploads/imgproduct';
       $extRegex = '/\.(jpe?g|png|jfif|webp)$/i';
       if (is_dir($bannerDir)) {
           foreach (scandir($bannerDir) as $f) {
               if (preg_match($extRegex, $f)) {
                   $banners[] = BASE_URL . 'uploads/banner/' . rawurlencode($f);
               }
           }
       }
       if (empty($banners) && is_dir($imgDir)) {
           foreach (scandir($imgDir) as $f) {
               if (preg_match($extRegex, $f)) {
                   $banners[] = BASE_URL . 'uploads/imgproduct/' . rawurlencode($f);
               }
           }
       }
       // Limit to a reasonable number and ensure at least one
       $banners = array_values(array_slice($banners, 0, 8));
       if (empty($banners)) {
           $banners[] = 'https://via.placeholder.com/1400x520?text=LEMTHAI+Shop';
       }
       ?>

       <div class="slideshow" aria-label="Banner slideshow">
         <div class="slides">
           <?php foreach ($banners as $bi): ?>
             <div class="slide"><img src="<?= htmlspecialchars($bi) ?>" alt="Banner"></div>
           <?php endforeach; ?>
         </div>
         <div class="slide-overlay"><strong>Khuyến mãi hôm nay</strong><div style="font-size:13px;">Miễn phí vận chuyển & ưu đãi hấp dẫn</div></div>
         <div class="slideshow-controls">
           <?php foreach ($banners as $i => $b): ?>
             <div class="dot<?= $i === 0 ? ' active' : '' ?>" data-index="<?= $i ?>"></div>
           <?php endforeach; ?>
         </div>
       </div>

       <!-- Policies section -->
       <div class="policies">
         <div class="policy">
           <div class="icon">🔒</div>
           <div>
             <h4>Chính sách bảo hành</h4>
             <p>Bảo hành chính hãng 12 tháng. Hỗ trợ kỹ thuật 24/7 và đổi mới trong 30 ngày nếu lỗi nhà sản xuất.</p>
           </div>
         </div>
         <div class="policy">
           <div class="icon">🔁</div>
           <div>
             <h4>Chính sách đổi trả</h4>
             <p>Đổi trả trong 7 ngày nếu sản phẩm còn nguyên tem và chưa qua sử dụng. Hồ sơ đổi trả nhanh chóng.</p>
           </div>
         </div>
         <div class="policy">
           <div class="icon">🛒</div>
           <div>
             <h4>Hướng dẫn mua hàng</h4>
             <p>Chọn sản phẩm, thêm vào giỏ, thanh toán nhanh qua VNPay/Bank transfer hoặc thanh toán khi nhận hàng.</p>
           </div>
         </div>
       </div>
       <section>
        <h3 style=" color: #1900ffff;">Danh sách sản phẩm</h3>
        <div class="grid grid-cols-4 product-list">
            <?php
                 foreach ($products as $key => $value) {
                    extract($value);
                    include 'paths/product_item.php';
                 }
            ?>
        </div>
        
       </section>
    </div>
</main>
<?php  
require_once 'footer.php';



?>
<script>
// Simple slideshow
(function(){
  const slidesWrap = document.querySelector('.slides');
  const dots = document.querySelectorAll('.dot');
  let idx = 0;
  function go(i){
    idx = (i + dots.length) % dots.length;
    slidesWrap.style.transform = 'translateX(' + (-idx*100) + '%)';
    dots.forEach(d=>d.classList.remove('active'));
    dots[idx].classList.add('active');
  }
  dots.forEach(d=>d.addEventListener('click', ()=>go(parseInt(d.dataset.index))));
  setInterval(()=>go(idx+1), 4000);
})();
// Floating quick-action for mobile: show add-post on bottom center
(function(){
  const btn = document.createElement('a');
  btn.href = '<?= BASE_URL ?>?act=add-post';
  btn.textContent = 'Gửi bài';
  btn.style.position = 'fixed';
  btn.style.left = '50%';
  btn.style.transform = 'translateX(-50%)';
  btn.style.bottom = '14px';
  btn.style.zIndex = '9998';
  btn.style.background = '#ff9800';
  btn.style.color = '#fff';
  btn.style.padding = '10px 14px';
  btn.style.borderRadius = '24px';
  btn.style.boxShadow = '0 6px 18px rgba(0,0,0,0.15)';
  btn.style.display = 'none';
  btn.style.textDecoration = 'none';
  document.body.appendChild(btn);
  function showOnMobile(){
    if(window.innerWidth <= 700){ btn.style.display = 'block'; } else { btn.style.display = 'none'; }
  }
  window.addEventListener('resize', showOnMobile);
  showOnMobile();
})();
</script>