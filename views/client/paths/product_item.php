<div class="item-products">
   <a href="<?= BASE_URL ?>?act=detail&id=<?= $id ?>"><img src="<?= $image ?>" alt="<?= htmlspecialchars($name) ?>"></a>
  <h3><a href="<?= BASE_URL ?>?act=detail&id=<?= $id ?>"><?= htmlspecialchars($name) ?></a></h3>
  <div class="price">Giá: <?= number_format($price) ?> VNĐ</div>
  <div class="desc"><?= htmlspecialchars(mb_strimwidth($description, 0, 90, '...')) ?></div>
</div>
