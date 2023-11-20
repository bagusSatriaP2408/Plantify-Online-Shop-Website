<?php 
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'manajer') {
    header("Location: ../index.php");
    exit();
}

$title = "Belum Bayar";
require_once('../base.php');
require_once(BASEPATH . "/app/manajer/templates/sidebar.php");
// date_default_timezone_set('Asia/Jakarta');
// // $dt = new DateTime('now');
// // $dt = $dt->format('Y-m-d H:i:s');
// // $NewDate =  Date('Y-m-d H:i:s',strtotime('-7 days'));

if(isset($_POST['filter'])){
    $orders = getAllOrderByStatusAndTime($_POST['time1'],$_POST['time2'],0);
}else{
    $orders = getAllOrders(0);
}
?>

    <!-- start container-kanan -->
    <div class="container-kanan">
        <div class="form-container">
            <form action="belum_bayar.php" method="post">
                <label>Mulai dari : </label>
                <input type="datetime-local" name="time1" value="<?= isset($_POST['time1']) ? $_POST['time1'] :"" ?>">
                <label>Sampai : </label>
                <input type="datetime-local" name="time2" value="<?= isset($_POST['time2']) ? $_POST['time2'] :"" ?>">
                <input type="submit" name="filter" value="Filter">
            </form>
        </div>
        <div class="wadah">

            <h2>Grafik</h2>

            <div>
                <canvas id="myChart"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            
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
                        label: 'Belum Bayar',
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
        <div class="wadah">

            <h2>Rekap</h2>

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
            
            <h2>Jumlah</h2>

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
        </div>
    </div>
    <!-- end container-kanan -->
    
</body>
</html>