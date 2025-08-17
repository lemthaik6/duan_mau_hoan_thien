<?php
require_once 'header.php';
?>
<div class="main">
    <aside>
        <?php  
require_once 'sidebar.php';
?>
    </aside>
    <main>
       <h1><?=$title?></h1>
       <form action="<?= BASE_URL.'?mode=admin&act=them-danh-muc' ?>" method="POST">
        <input type="text" placeholder="tên danh mục" name="name">
        <label>Loại danh mục</label>
       <select name="type">
        <option value="0">Tin tức</option>
        <option value="1">Sản phẩm</option>
       </select>
       <button>Thêm mới</button>
       </form>
    </main>
</div>
<?php  
?>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f8;
    color: #333;
}

.main {
    display: flex;
    min-height: calc(100vh - 120px); /* trừ header & footer */
}

aside {
    width: 250px;
    background: #2c3e50;
    padding: 20px;
    color: #fff;
}

/* Nội dung chính */
main {
    flex: 1;
    padding: 30px;
    background: #fff;
}

/* Tiêu đề */
main h1 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #2c3e50;
}

/* Form */
form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    max-width: 400px;
    background: #fdfdfd;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 3px 8px rgba(0,0,0,0.1);
}

form input[type="text"],
form select {
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    transition: border 0.2s ease;
}

form input[type="text"]:focus,
form select:focus {
    border-color: #3498db;
}

form label {
    font-size: 14px;
    color: #555;
}

form button {
    padding: 10px;
    font-size: 15px;
    background: #3498db;
    color: #fff;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.2s ease;
}

form button:hover {
    background: #2980b9;
}

</style>