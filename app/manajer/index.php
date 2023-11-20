<?php 
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'manajer') {
    header("Location: ../index.php");
    exit();
}

$title = "Dashboard";
require_once('../base.php');
require_once(BASEPATH . "/app/manajer/templates/sidebar.php");
$products = getAllProducts();
?>

    <!-- start container-kanan -->
    <div class="container-kanan">
        <div class="wadah">

            <h2>Stok Produk</h2>

            <div>
                <canvas id="myChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
                let label = [];
                let datas = [];
                <?php foreach ($products as $pro): ?>
                    label.push("<?= $pro['nama_produk'] ?>");
                    datas.push(<?= $pro['stok_produk'] ?>);
                <?php endforeach; ?>
                const backgroundColors = Array.from({ length: datas.length }, () => {
                    const letters = '0123456789ABCDEF';
                    let color = '#';
                    for (let i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                    return color;
                });
                const chart = document.getElementById('myChart');
                const data = {
                    labels : label,
                    datasets: [{
                        label: 'Stok Produk',
                        data: datas,
                        backgroundColor: backgroundColors,
                        hoverOffset: 4
                    }]
                };

                const config = {
                    type: 'bar',
                    data: data,
                };

                new Chart(chart, config);
            </script>
        </div>
    </div>
    <!-- end container-kanan -->

</body>
</html>