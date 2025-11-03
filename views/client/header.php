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
    <link rel="stylesheet" href="<?= BASE_URL ?>views/client/css/style.css">
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
                <li><a href="<?= BASE_URL ?>">Trang chủ</a></li>
                <li><a href="<?= BASE_URL ?>?act=product">Sản phẩm</a></li>
                <li><a href="<?= BASE_URL ?>?act=news">Tin tức</a></li>
                <li><a href="<?= BASE_URL ?>?act=contact">Liên hệ</a></li>
                <li><a href="<?= BASE_URL ?>?act=add-post">Gửi bài</a></li>
                <li><a href="#" id="chatToggleLink">Chat tư vấn</a></li>
            </ul>
        </nav>

        <!-- Search + Cart + Logout -->
        <div class="header-actions">
            <form class="search-form" action="<?= BASE_URL ?>" method="GET">
                <input type="hidden" name="act" value="search">
                <input type="text" name="keyword" placeholder="Tìm kiếm sản phẩm...">
                <button type="submit">🔍</button>
            </form>

            <a href="<?= BASE_URL ?>?act=cart_page" class="cart-link">
                🛒 <span class="cart-count"><?= $cartCount ?></span>
            </a>

            <a href="<?= BASE_URL ?>?act=add-post" style="background:#ff9800;color:#fff;padding:6px 10px;border-radius:6px;text-decoration:none;margin-right:8px">Gửi bài</a>
            <a href="<?= BASE_URL.'?act=login' ?>" class="logout-btn">Đăng xuất</a>
        </div>
    </div>
</header>
<!-- Floating chat panel -->
<div id="chatPanel" style="position:fixed;right:20px;bottom:20px;z-index:9999;">
    <button id="chatFloatBtn" style="background:#1565c0;color:#fff;border:none;padding:12px 14px;border-radius:50%;box-shadow:0 6px 20px rgba(0,0,0,0.2);cursor:pointer">💬</button>
    <div id="chatBox" style="display:none;width:360px;height:480px;box-shadow:0 8px 30px rgba(0,0,0,0.2);border-radius:10px;overflow:hidden;margin-bottom:10px;background:#fff">
        <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 12px;background:#1565c0;color:#fff">
            <strong>Trợ lý bán hàng</strong>
            <button id="chatCloseBtn" style="background:transparent;border:none;color:#fff;font-size:18px;cursor:pointer">✖</button>
        </div>
        <iframe id="chatIframe" src="?act=chat&embedded=1" style="border:none;width:100%;height:calc(100% - 44px);background:#fff"></iframe>
    </div>
</div>

<script>
// Toggle chat panel
const chatFloatBtn = document.getElementById('chatFloatBtn');
const chatBox = document.getElementById('chatBox');
const chatCloseBtn = document.getElementById('chatCloseBtn');
const chatToggleLink = document.getElementById('chatToggleLink');

function openChat(){ chatBox.style.display = 'block'; }
function closeChat(){ chatBox.style.display = 'none'; }

chatFloatBtn.addEventListener('click', ()=>{
    if(chatBox.style.display === 'block') closeChat(); else openChat();
});
chatCloseBtn.addEventListener('click', closeChat);
if(chatToggleLink) chatToggleLink.addEventListener('click', (e)=>{ e.preventDefault(); openChat(); });
</script>
</body>
</html>
