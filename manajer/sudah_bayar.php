<?php 
session_start();

/* pengecekan jika tidak ada variable $_SESSION['login'] atau $_SESSION['role'] 
tidak sama dengan 'manajer' maka dialihkan ke halaman login  */
if (!isset($_SESSION['login']) || $_SESSION['role'] != 'manajer') {
    header("Location: ../index.php");
    exit();
}

$title = "Sudah Bayar";

require_once('../base.php');        // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/manajer/templates/sidebar.php");
require_once(BASEPATH . "/validations.php");        //untuk menggunakan fungsi validasi

$errors = array();

// ketika filter ditekan
if(isset($_POST['filter'])){

    validateFilterTanggal($errors, $_POST);

    if ($errors['error'] === "") {
        $orders = getAllOrderByStatusAndTime($_POST['time1'],$_POST['time2'],0);
    } else {
        $orders = getAllOrders(0);
    }
    
} else{
    $orders = getAllOrders(0);
}

?>

    <!-- start container-kanan -->
    <div class="container-kanan">    
        <!-- start form-container -->
        <div class="form-container">
            <p class="error" style="color:red;"><?= $errors['error'] ?? "" ?></p>
            <!-- start form -->
            <form action="sudah_bayar.php" method="post">
                <label>Mulai dari : </label>
                <input type="datetime-local" name="time1" value="<?= isset($_POST['time1']) ? $_POST['time1'] :"" ?>">
                <label>Sampai : </label>
                <input type="datetime-local" name="time2" value="<?= isset($_POST['time2']) ? $_POST['time2'] :"" ?>">
                <input type="submit" name="filter" value="Filter">
            </form>
            <!-- end form -->
        </div>

        <!-- start wadah -->
        <div class="wadah">
            <h2>Grafik</h2>
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        <!-- end wadah -->

        <!-- start wadah -->
        <div class="wadah">
            <h2>Rekap</h2>
            <!-- start table -->
            <table class="rekap">
                <tr>
                    <th>Tanggal Order</th>
                    <th>Username</th>
                    <th>Total Order</th>
                    <th>No Rekening</th>
                    <th>Status</th>
                </tr>
                <?php 
                $total = 0;
                $count = 0;
                foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['tanggal_order']?></td>
                        <td><?= $order['username']?></td>
                        <td><?= $order['total_order']?></td>
                        <td><?= $order['no_rekening'] ?></td>
                        <td><?= $order['status']==0 ? "Belum Dibayar" : "Sudah Dibayar"?></td>
                        <?php $total+= $order['total_order'];$count+=1; ?>
                    </tr>
                <?php endforeach; ?>
            </table>
            <!-- end table -->
            <h2>Jumlah</h2>
            <!-- start table -->
            <table class="jumlah">
                <tr>
                    <th>Total Pelanggan</th>
                    <th>Jumlah pendapatan</th>
                </tr>
                <tr>
                    <td ><?= $count ?></td>
                    <td ><?= $total ?></td>
                </tr>
            </table>
            <!-- end table -->
        </div>
        <!-- end wadah -->
    </div>
    <!-- end container-kanan -->
</body>

<script src="<?= BASEURL ?>/manajer/node_modules/chart.js/dist/chart.umd.js"></script>      
<script>
    let lable = [];
    let datas= [];
    <?php foreach($orders as $order):?>
        lable.push("<?= $order['tanggal_order'] ?>");
        datas.push(<?= $order['total_order'] ?>);
    <?php endforeach?>
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
        labels: lable,
        datasets: [{
            label: 'Sudah Bayar',
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