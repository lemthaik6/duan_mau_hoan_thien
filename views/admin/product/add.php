
<?php  
require_once __DIR__ . '/../header.php';
?>
<div class="main">
    <aside>
        <?php  
require_once __DIR__ . '/../sidebar.php';
?>
    </aside>
    <main>
       <h1><?=$title?></h1>
       <form action="<?= BASE_URL.'?mode=admin&act=them-san-pham' ?>" method="POST" enctype="multipart/form-data">
        <input type="text" placeholder="tên sản phẩm" name="name">
        <label>Loại danh mục</label>
       <select name="catid">
        <option value="0">chọn danh mục</option>
        <?php
        foreach ($category as $key => $value) {
            ?>
            <option value="<?=$value['id']?>"><?=$value['name']?></option>
            <?php
        }
       ?>
       </select>
       <label >ảnh sản phẩm</label>
       <input type="file" name="image">
       <label >Giá</label>
         <input type="number" name="price" placeholder="Giá sản phẩm">
         <label >Mô tả</label>
         <textarea name="description" placeholder="Mô tả sản phẩm"></textarea>
       <button>Thêm mới</button>
       </form>
    </main>
</div>
<style>
    /* RESET & GLOBAL */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: #f5f7fa;
  color: #222;
}
a {
  text-decoration: none;
  color: #222;
  transition: color 0.2s, background 0.2s;
}
a:hover {
  color: #1565c0;
}
ul, li {
  list-style: none;
}

/* CONTAINER */
.container {
  max-width: 1140px;
  margin: 0 auto;
  padding: 0 20px;
  width: 100%;
}

/* FLEX UTILITY */
.flex {
  display: flex;
  flex-wrap: wrap;
}
.space-between {
  justify-content: space-between;
}
.align-center {
  align-items: center;
}

/* HEADER */
header {
  background: #fff;
  box-shadow: 0 4px 20px rgba(21, 101, 192, 0.07);
  padding: 16px 0;
  position: sticky;
  top: 0;
  z-index: 1000;
  border-radius: 0 0 12px 12px;
}
header .container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 32px;
}
.logo a {
  font-size: 2rem;
  font-weight: bold;
  color: #1565c0;
  letter-spacing: 1px;
}
.logo a:hover {
  color: #0d47a1;
}
.right-header {
  display: flex;
  align-items: center;
  gap: 32px;
}
header nav ul {
  display: flex;
  gap: 18px;
}
header nav li a {
  padding: 8px 18px;
  border-radius: 6px;
  font-weight: 500;
  font-size: 16px;
}
header nav li a:hover {
  background: #e3f2fd;
  color: #1565c0;
  box-shadow: 0 2px 8px rgba(21, 101, 192, 0.08);
}
header form {
  display: flex;
  align-items: center;
  background: #f0f4fa;
  border-radius: 6px;
  padding: 2px 8px;
}
header form input[type="text"] {
  border: none;
  background: transparent;
  padding: 8px 6px;
  font-size: 15px;
  outline: none;
  width: 120px;
  transition: width 0.2s;
}
header form input[type="text"]:focus {
  width: 180px;
}
header form button {
  border: none;
  background: none;
  cursor: pointer;
  padding: 6px;
  display: flex;
  align-items: center;
}
header form svg {
  width: 18px;
  height: 18px;
  fill: #1565c0;
}
header form button:hover svg {
  fill: #0d47a1;
}

/* PRODUCT GRID */
.grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr); /* Chỉ 3 sản phẩm 1 hàng */
  gap: 28px;
  margin-top: 32px;
}
.item-products {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 12px rgba(21, 101, 192, 0.07);
  padding: 18px 14px 24px 14px;
  text-align: center;
  transition: box-shadow 0.3s ease, transform 0.3s ease;
}
.item-products img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 14px;
  background: #f0f4fa;
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
}
.item-products:hover {
  box-shadow: 0 6px 24px rgba(21, 101, 192, 0.15);
  transform: translateY(-6px) scale(1.04);
}

/* FOOTER */
footer {
  background: linear-gradient(90deg, #222, #2c3e50 80%);
  color: #f4f4f4;
  padding: 60px 0 30px 0;
  border-radius: 16px 16px 0 0;
}
footer .container {
  display: flex;
  flex-wrap: wrap;
  gap: 40px;
}
footer .col {
  flex: 1 1 220px;
  min-width: 200px;
}
footer h4 {
  margin-bottom: 22px;
  font-size: 19px;
  font-weight: 600;
}
footer ul li {
  margin-bottom: 12px;
}
footer ul li a {
  color: #b0bec5;
  font-size: 15px;
}
footer ul li a:hover {
  color: #fff;
  text-decoration: underline;
}

/* MAIN CONTENT */
.main {
  display: flex;
  gap: 32px;
  margin: 32px 0;
}
aside {
  min-width: 200px;
}
main {
  flex: 1;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 2px 12px rgba(21, 101, 192, 0.07);
  padding: 32px 24px;
}
main h1 {
  font-size: 2rem;
  color: #1565c0;
  margin-bottom: 28px;
  font-weight: 600;
}

/* Form style */
form {
  display: flex;
  flex-direction: column;
  gap: 18px;
  max-width: 500px;
}
form input[type="text"],
form input[type="number"],
form input[type="file"],
form select,
form textarea {
  padding: 10px 12px;
  border: 1px solid #cfd8dc;
  border-radius: 6px;
  font-size: 15px;
  background: #f8fafc;
  transition: border 0.2s;
}
form input[type="file"] {
  background: #fff;
  padding: 8px 0;
}
form input:focus,
form select:focus,
form textarea:focus {
  border-color: #1565c0;
  outline: none;
}
form label {
  font-weight: 500;
  color: #222;
  margin-bottom: 4px;
}
form textarea {
  min-height: 80px;
  resize: vertical;
}
form button {
  background: #1565c0;
  color: #fff;
  border: none;
  border-radius: 6px;
  padding: 12px 0;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  margin-top: 10px;
  transition: background 0.2s;
}
form button:hover {
  background: #0d47a1;
}

/* RESPONSIVE */
@media (max-width: 900px) {
  .grid {
    grid-template-columns: repeat(2, 1fr);
  }
  .main {
    flex-direction: column;
    gap: 18px;
  }
  main {
    padding: 18px 8px;
  }
}
@media (max-width: 600px) {
  .grid {
    grid-template-columns: 1fr;
  }
}

</style>