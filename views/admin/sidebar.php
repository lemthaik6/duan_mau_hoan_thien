<nav>
    <ul>
        <li><a href="#">Quản lý sản phẩm</a>
        <ul class="submenu">
            <li><a href="<?= BASE_URL.'?mode=admin&act=them-san-pham'?>">Thêm sản phẩm</a></li>
            <li><a href="<?= BASE_URL.'?mode=admin&act=danh-sach-san-pham'?>">Danh sách sản phẩm</a></li>
        </ul>
    </li>
  <li><a href="#">Quản lý bài viết</a>
     <ul class="submenu">
      <li><a href="<?= BASE_URL.'?mode=admin&act=danh-sach-bai-viet'?>">Duyệt bài viết</a></li>
    </ul>
  </li>
        <li><a href="#">Quản lý danh mục</a>
         <ul class="submenu">
            <li><a href="<?= BASE_URL.'?mode=admin&act=them-danh-muc'?>">Thêm danh mục</a></li>
            <li><a href="<?= BASE_URL.'?mode=admin&act=danh-muc'?>">Danh sách danh mục</a></li>
        </ul>
    </li>
    </ul>
</nav>
<style>
    nav {
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 12px rgba(21, 101, 192, 0.07);
  padding: 24px 18px;
  min-width: 220px;
}

nav ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

nav > ul > li {
  margin-bottom: 18px;
}

nav a {
  display: block;
  color: #1565c0;
  font-weight: 600;
  font-size: 16px;
  padding: 10px 12px;
  border-radius: 6px;
  transition: background 0.2s, color 0.2s;
  text-decoration: none;
}

nav a:hover {
  background: #e3f2fd;
  color: #0d47a1;
}

.submenu {
  margin-top: 6px;
  margin-left: 12px;
  padding-left: 10px;
  border-left: 2px solid #e3f2fd;
}

.submenu li {
  margin-bottom: 8px;
}

.submenu a {
  font-weight: 400;
  font-size: 15px;
  color: #222;
  background: none;
  padding: 7px 10px;
}

.submenu a:hover {
  background: #f0f4fa;
  color: #1565c0;
}

/* Responsive */
@media (max-width: 900px) {
  nav {
    min-width: 100%;
    margin-bottom: 18px;
  }
}
</style>