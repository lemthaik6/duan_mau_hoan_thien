<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="<?=BASE_URL.'views/admin/css/style.css' ?>">
</head>
<body>
<header class="admin-header">
    <div class="container flex-between">
        <!-- Logo -->
        <div class="logo">
            <a href="<?= BASE_URL ?>">Thaiml<span>Admin</span></a>
        </div>

        <!-- Search Bar -->
        
        <div class="user-info">
            <h1>Xin chào, Admin</h1>
            <a href="<?= BASE_URL ?>?act=login" class="logout-btn">Đăng xuất</a>
        </div>
    </div>
</header>
</body>
</html>
<style>
    /* ===== RESET ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #eef3f9;
}

/* ===== HEADER ===== */
.admin-header {
    background-color: #1976d2; /* Xanh dương chủ đạo */
    color: #fff;
    padding: 15px 30px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

.container {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

/* Logo */
.logo a {
    text-decoration: none;
    font-size: 22px;
    font-weight: bold;
    color: #fff;
}

.logo span {
    color: #ffeb3b; /* Vàng tươi làm điểm nhấn */
}

/* Search Bar */
.search-bar form {
    display: flex;
    align-items: center;
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.search-bar input {
    border: none;
    padding: 8px 14px;
    font-size: 14px;
    outline: none;
    width: 200px;
}

.search-bar button {
    background: #1565c0;
    border: none;
    padding: 8px 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
}

.search-bar button svg {
    fill: #fff;
}

.search-bar button:hover {
    background: #0d47a1;
}

/* User Info */
.user-info {
    display: flex;
    align-items: center;
    gap: 15px;
}

.user-info h1 {
    font-size: 16px;
    font-weight: normal;
}

.logout-btn {
    background: #f44336;
    color: #fff;
    padding: 8px 14px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 14px;
    transition: background 0.3s ease;
}

.logout-btn:hover {
    background: #d32f2f;
}

</style>