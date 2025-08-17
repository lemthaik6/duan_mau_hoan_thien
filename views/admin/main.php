<?php
require_once 'header.php';
?>
<style>
    /* ===== RESET & GLOBAL ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: "Segoe UI", Tahoma, sans-serif;
        background: #f5f7fa;
        color: #333;
    }
    .main {
        display: flex;
        min-height: 100vh;
    }
    aside {
        width: 220px;
        background: #1e3a8a;
        color: white;
        padding: 20px;
    }
    main {
        flex: 1;
        padding: 20px;
        background: #f5f7fa;
    }

    /* ===== DASHBOARD CARDS ===== */
    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }
    .card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .card h3 {
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: #1e3a8a;
    }
    .card p {
        font-size: 1.5rem;
        font-weight: bold;
    }

    /* ===== TABLE ===== */
    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    th, td {
        padding: 12px 15px;
        text-align: left;
    }
    th {
        background: #1e3a8a;
        color: white;
    }
    tr:nth-child(even) {
        background: #f9fafb;
    }
    tr:hover {
        background: #e0e7ff;
    }

    /* ===== CHART ===== */
    .chart-container {
        margin-top: 30px;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    canvas {
        width: 100%;
        height: 300px;
    }
</style>

<div class="main">
    <aside>
        <?php require_once 'sidebar.php'; ?>
    </aside>
    <main>
        <h1 style="margin-bottom:20px;">📊 Bảng điều khiển Admin</h1>

        <!-- Cards thống kê -->
        <div class="dashboard-cards">
            <div class="card">
                <h3>Người dùng</h3>
                <p>1,245</p>
            </div>
            <div class="card">
                <h3>Đơn hàng</h3>
                <p>530</p>
            </div>
            <div class="card">
                <h3>Doanh thu</h3>
                <p>₫125,000,000</p>
            </div>
            <div class="card">
                <h3>Sản phẩm</h3>
                <p>320</p>
            </div>
        </div>

        <!-- Biểu đồ -->
        <div class="chart-container">
            <h2>📈 Doanh thu theo tháng</h2>
            <canvas id="revenueChart"></canvas>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6'],
            datasets: [{
                label: 'Doanh thu (VND)',
                data: [20000000, 30000000, 25000000, 40000000, 35000000, 45000000],
                borderColor: '#1e3a8a',
                backgroundColor: 'rgba(30,58,138,0.1)',
                fill: true,
                tension: 0.3
            }]
        }
    });
</script>
