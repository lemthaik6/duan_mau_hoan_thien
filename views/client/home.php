<?php  
require_once 'header.php';



?>
<main>
    <div class="container">
        <img class="banner" src="./uploads/imgproduct/banner.png" alt="">
       <div id="slider">
        <h1 style="text-align: center; color: #1900ffff;">Hiển Thị Sản Phẩm</h1>
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
<style>
    img.banner {
    width: 100%;        /* Chiếm toàn bộ chiều ngang */
    height: 300px;      /* Chiều cao banner */
    object-fit: cover;  /* Cắt ảnh vừa khung mà không méo */
    display: block;     /* Loại bỏ khoảng trắng dưới ảnh */
    border-radius: 8px; /* Bo góc nếu muốn */
    margin: 5px 0px 20px;
}

.product-list {
  display: grid;
  grid-template-columns: repeat(4, 1fr); /* 4 sản phẩm 1 dòng */
  gap: 24px;
  margin: 32px 0;
}
.item-products {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(21,101,192,0.07);
  padding: 18px;
  text-align: center;
}
@media (max-width: 900px) {
  .product-list {
    grid-template-columns: repeat(2, 1fr);
  }
}
@media (max-width: 600px) {
  .product-list {
    grid-template-columns: 1fr;
  }
}
</style>