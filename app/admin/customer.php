<?php 
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}

$title = "Customer";
require_once('../base.php');
require_once(BASEPATH . "/app/admin/templates/sidebar.php");
require_once(BASEPATH . "/app/admin/templates/header.php");
$customers = getAllDataCustomer();
?>

        <!-- start customer -->
        <div class="wadah">
            <div class="judul">
                <h2>Customer</h2>
            </div>
            <table>
                <tr>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>No. Telepon</th>
                    <th>Alamat</th>
                </tr>
                <?php foreach ($customers as $customer): ?>
                    <tr>
                        <td><?= $customer['username']; ?></td>
                        <td><?= $customer['nama']; ?></td>
                        <td><?= $customer['no_telepon']; ?></td>
                        <td><?= $customer['alamat']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <!-- end customer -->
                    
    </div>

</body>
</html>
    