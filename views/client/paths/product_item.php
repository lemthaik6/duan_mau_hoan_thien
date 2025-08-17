<div class="item-products">
   <a href="<?= BASE_URL ?>?act=detail&id=<?= $id ?>"><img src="<?= $image ?>" alt=""></a>
<h3><a href="<?= BASE_URL ?>?act=detail&id=<?= $id ?>"><?= $name ?></a></h3>
<p><a href="<?= BASE_URL ?>?act=detail&id=<?= $id ?>">Giá: <?= $price ?></a></p>
<p><a href="<?= BASE_URL ?>?act=detail&id=<?= $id ?>">Mô tả: <?= $description ?></a></p>
</div>

<style>
/* CSS cho sản phẩm */
.item-products {
  background: #ffffffff;
  border-radius: 12px;
  box-shadow: 0 2px 12px rgba(50, 101, 192, 0.07);
  padding: 18px 14px 24px 14px;
  text-align: center;
  transition: box-shadow 0.2s, transform 0.2s;
  margin-bottom: 18px;
}
.item-products img {
  width: 50%;
  height: 300px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 14px;
  background: #f0f4fa;
  transition: transform 0.2s;
}
.item-products h3 {
  font-size: 18px;
  margin-bottom: 8px;
  color: #1565c0;
  font-weight: 600;
}
.item-products p {
  font-size: 16px;
  color: #444;
  margin-bottom: 0;
}
.item-products:hover {
  box-shadow: 0 6px 24px rgba(21, 101, 192, 0.13);
  transform: translateY(-4px) scale(1.03);
}
.item-products:hover img {
  transform: scale(1.05);
}

/* Dàn sản phẩm theo hàng ngang, mỗi sản phẩm chiếm 1/3 màn hình */
.product-list {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
  margin-top: 32px;
}

/* Responsive: 2 cột trên tablet, 1 cột trên mobile */
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

/* Responsive cho sản phẩm */
@media (max-width: 900px) {
  .item-products img {
    height: 140px;
  }
}
@media (max-width: 600px) {
  .item-products {
    padding: 12px 6px 18px 6px;
  }
  .item-products img {
    height: 100px;
  }
}

/* CSS cho nút Sửa/Xóa */
.product-actions {
  margin-top: 12px;
  display: flex;
  justify-content: center;
  gap: 12px;
}
.action-btn {
  color: #2980b9;
  font-weight: bold;
  text-decoration: none;
  padding: 6px 16px;
  border-radius: 4px;
  background: #d6eaf8;
  transition: background 0.2s;
  border: none;
  cursor: pointer;
  font-size: 15px;
  display: inline-block;
}
.action-btn:hover {
  background: #3498db;
  color: #fff;
  text-decoration: underline;
}
</style>
