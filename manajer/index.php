<?php 
session_start();

/* pengecekan jika tidak ada variable $_SESSION['login'] atau $_SESSION['role'] 
tidak sama dengan 'manajer' maka dialihkan ke halaman login  */
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'manajer') {
    header("Location: ../index.php");
    exit();
}

$title = "Dashboard";

require_once('../base.php');        // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/manajer/templates/sidebar.php");

$products = getAllDataProducts();       // mengambil semua data produk

?>

    <!-- start container-kanan -->
    <div class="container-kanan">
        <!-- start wadah -->
        <div class="wadah">
            <h2>Stok Produk</h2>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <!-- end wadah -->
    </div>
    <!-- end container-kanan -->

</body>

<script src="<?= BASEURL ?>/manajer/node_modules/chart.js/dist/chart.umd.js"></script>
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

</html>