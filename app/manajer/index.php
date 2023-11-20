<?php 
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'manajer') {
    header("Location: ../index.php");
    exit();
}

$title = "Dashboard";
require_once('../base.php');
require_once(BASEPATH . "/app/manajer/templates/sidebar.php");
?>

    <div class="container-kanan">
        <div class="grafik-container">
            <div>
                <canvas id="myChart" width="400" height="100"></canvas>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <script>
            const chart = document.getElementById('myChart');
            const data = {
                labels: [
                    'Red',
                    'Blue',
                    'Yellow'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [300, 50, 100],
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
            };

            const config = {
                type: 'pie',
                data: data,
            };

            new Chart(chart, config);
            </script>
        </div>
    </div>

</body>
</html>