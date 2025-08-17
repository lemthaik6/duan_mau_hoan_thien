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
                    <p>Giá sản phẩm: <?=number_format($price)?> VNĐ</p>
                    <form id="addToCartForm">
                        <input type="number" name="quantity" value="1" min="1">
                        <input type="hidden" name="productid" value="<?=$id?>">
                        <button type="submit">Thêm giỏ hàng</button>
                    </form>
                    <div class="description">
                        <?=$description?>
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

