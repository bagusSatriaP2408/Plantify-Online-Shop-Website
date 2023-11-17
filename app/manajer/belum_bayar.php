<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}
require_once('../base.php');

$title = "Belum Bayar";
require_once('../base.php');
require_once(BASEPATH . "/app/manajer/templates/sidebar.php");
date_default_timezone_set('Asia/Jakarta');
$dt = new DateTime('now');
$dt = $dt->format('Y-m-d H:i:s');
$NewDate =  Date('Y-m-d H:i:s',strtotime('-7 days'));

if(isset($_POST['filter'])){
    $orders = getAllOrderByStatusAndTime($_POST['time1'],$_POST['time2'],1);
}else{
    $orders = getAllOrderByStatusAndTime($NewDate,$dt,0);
}
?>
<?= $dt?>
<?= $NewDate ?>

<div class="container-kanan">
    <form action="rekap.php" method="post">
        <input type="datetime-local" name="time1" value="<?= isset($_POST['time1']) ? $_POST['time1'] :"" ?>">
        <input type="datetime-local" name="time2" value="<?= isset($_POST['time2']) ? $_POST['time2'] :"" ?>">
        <input type="submit" name="filter" class="submit" value="Filter">
    </form>
    <div class="grafik-container">
            <h3>Grafik</h3>
            <div>
                <canvas id="myChart" width="" height="250px"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>

            let lable = [];
            let datas= [];
            <?php foreach($orders as $order):?>
                lable.push("<?= $order['tanggal_order'] ?>");
                datas.push(<?= $order['total_order'] ?>);
            <?php endforeach?>
            console.log(lable);
            console.log(datas);
            const chart = document.getElementById('myChart');
            const data = {
                labels: lable,
                datasets: [{
                    label: 'My First Dataset',
                    data: datas,
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                    ],
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
            <div class="judul">
                <h3>Rekap</h3>
                </div>
                <table>
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
                <h3>Jumlah</h3>
                <table border="1">
                    <tr>
                        <td >Total Pelanggan</td>
                        <td >Jumlah pendapatan</td>
                    </tr>
                    <tr>
                        <td ><?= $count ?></td>
                        <td ><?= $total ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- end customer -->
    </div>
    
</body>
</html>