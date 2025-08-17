<?php
// Nếu chưa có hằng BASE_URL thì định nghĩa (tránh lỗi khi include nhiều lần)
if (!defined('BASE_URL')) {
    define('BASE_URL', '/');
}

// Đếm số sản phẩm trong giỏ hàng (lưu trong session)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$cartCount = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEMTHAI</title>
    <style>
        /* ===== Reset ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f9f9f9;
        }

        /* ===== Header ===== */
        header {
            background: linear-gradient(90deg, #007BFF, #00C6FF);
            padding: 10px 0;
            color: #fff;
        }
        .container {
            width: 90%;
            margin: 0 auto;
        }
        .flex {
            display: flex;
            align-items: center;
        }
        .header-wrap {
            justify-content: space-between;
        }
        .logo a {
            font-size: 1.5rem;
            font-weight: bold;
            color: #fff;
            text-decoration: none;
        }

        /* ===== Menu ===== */
        .nav-menu ul {
            list-style: none;
            gap: 20px;
            display: flex;
        }
        .nav-menu ul li a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .nav-menu ul li a:hover {
            color: #FFD700;
        }

        /* ===== Search + Cart + Logout ===== */
        .header-actions {
            gap: 15px;
            display: flex;
            align-items: center;
        }
        .search-form {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 20px;
            overflow: hidden;
        }
        .search-form input {
            border: none;
            padding: 6px 10px;
            outline: none;
            font-size: 0.9rem;
        }
        .search-form button {
            border: none;
            background: #FFD700;
            padding: 6px 10px;
            cursor: pointer;
            font-size: 1rem;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -10px;
            background: red;
            color: #fff;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 50%;
        }
        .logout-btn {
            background: #ff4d4d;
            padding: 6px 12px;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s ease;
        }
        .logout-btn:hover {
            background: #e60000;
        }
    </style>
</head>
<body>
<header>
    <div class="container flex header-wrap">
        <!-- Logo -->
        <div class="logo">
            <a href="<?= BASE_URL ?>">Lemthai</a>
        </div>

        <!-- Menu -->
        <nav class="nav-menu">
            <ul>
                <li><a href="http://localhost/duan_mau/duan_mau1/">Trang chủ</a></li>
                <li><a href="http://localhost/duan_mau/duan_mau1/?act=product">Sản phẩm</a></li>
                <li><a href="http://localhost/duan_mau/duan_mau1/?act=news">Tin tức</a></li>
                <li><a href="http://localhost/duan_mau/duan_mau1/?act=contact">Liên hệ</a></li>
            </ul>
        </nav>

        <!-- Search + Cart + Logout -->
        <div class="header-actions">
            <form class="search-form" action="<?= BASE_URL ?>" method="GET">
                <input type="hidden" name="act" value="search">
                <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm...">
                <button type="submit">🔍</button>
            </form>

            <a href="http://localhost/duan_mau/duan_mau1/?act=cart_page" class="cart-link">
                🛒 <span class="cart-count"><?= $cartCount ?></span>
            </a>

            <a href="<?= BASE_URL.'?act=login' ?>" class="logout-btn">Đăng xuất</a>
        </div>
    </div>
</header>
</body>
</html>
