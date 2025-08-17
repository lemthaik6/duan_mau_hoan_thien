<?php require_once 'header.php'; ?>
<div class="main">
    <aside>
        <?php require_once 'sidebar.php'; ?>
    </aside>
    <main>
       <h1>Danh sách sản phẩm</h1>
       <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <!-- Bỏ cột Ảnh -->
                <th>Mô tả</th>
                <th>Danh mục</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($result as $key=>$item){
                echo "<tr>
                <td>".($key+1)."</td>
                <td>".$item["name"]."</td>
                <td>".number_format($item["price"])." VNĐ</td>
                <!-- Bỏ cột ảnh -->
                <td>".htmlspecialchars($item["description"])."</td>
                <td>".$item["catid"]."</td>
                <td>
                    <a href='?mode=admin&act=edit-product&id=".$item['id']."' class='action-btn'>Sửa</a> |
                    <a href='?mode=admin&act=delete-product&id=".$item['id']."' class='action-btn' onclick=\"return confirm('Bạn chắc chắn muốn xóa?');\">Xóa</a>
                </td>
                </tr>";
            }
            ?>
        </tbody>
       </table>
    </main>
</div>
<?php require_once 'footer.php'; ?>
<style>
/* Copy nguyên phần CSS từ file listcat.php của bạn */
.main { display: flex; gap: 20px; padding: 20px; background-color: #f4f6f8; min-height: calc(100vh - 60px); font-family: Arial, sans-serif; }
aside { background: #2c3e50; color: white; width: 220px; padding: 20px; border-radius: 8px; }
main { flex: 1; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
main h1 { font-size: 20px; margin-bottom: 15px; color: #333; }
table { width: 100%; border-collapse: collapse; background: white; border-radius: 6px; overflow: hidden; }
thead { background-color: #3498db; color: white; }
thead th { padding: 10px; text-align: left; }
tbody tr:nth-child(even) { background-color: #f8f9fa; }
tbody tr:hover { background-color: #ecf0f1; }
tbody td { padding: 10px; border-bottom: 1px solid #ddd; }
td:last-child { color: #2980b9; font-weight: bold; cursor: pointer; }
td:last-child:hover { text-decoration: underline; }
.action-btn { color: #2980b9; font-weight: bold; text-decoration: none; padding: 4px 10px; border-radius: 4px; transition: background 0.2s; }
.action-btn:hover { background: #d6eaf8; text-decoration: underline; }
table img { border-radius: 6px; box-shadow: 0 1px 4px rgba(21,101,192,0.07); }
</style>