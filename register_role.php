<?php 

require 'validations.php';

session_start();

// cek apakah user sudah pernah login atau belum, jika sudah diarahkan ke page sesuai role
if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
    header("Location: {$_SESSION['role']}/index.php");    
    exit();
}

$kode_ref = array("admin" => "123", "manajer" => "321");
$errors = array();

if (isset($_POST['next'])) {

    // mengambil inputan user 
    $roles = $_POST['roles'];
    $ref = htmlspecialchars($_POST['ref']);

    $_SESSION['roles'] = $roles;
    
    validateRef($errors, $ref, $roles, $kode_ref);

    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }

    if (strlen($cek) == 0) {
        header("Location: register_id.php");
    }
}

$title = "Register";

require_once('base.php');        // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/templates/head.php");

?>
    
    <!-- start form-container -->
    <div class="form-container">
        <!-- start form -->
        <form action="register_role.php" method="post">

            <h2>Register Now</h2>

            <!-- inputan pilih role -->
            <div class="input-container">
                <label for="roles">Pilih Role</label>
                <select name="roles" id="roles">
                    <option value="admin">Admin</option>
                    <option value="manajer" <?php echo (isset($_POST["roles"]) && $_POST["roles"] === "manajer") ? "selected" : ''?>>Manajer</option>
                    <option value="customer" <?php echo (isset($_POST["roles"]) && $_POST["roles"] === "customer") ? "selected" : ''?>>Customer</option>
                </select>
            </div>
            <!-- inputan kode refferal -->
            <div class="input-container">
                <label for="ref">Kode Refferal</label>
                <input type="password" name="ref" id="ref" value="<?php echo $_POST["ref"] ?? '' ?>">
                <span class="error-msg"><?php echo $errors["ref"] ?? '' ?></span>
                <span class="roles-note">*isi jika memilih admin atau manajer</span>
            </div>

            <button type="submit" name="next">Selanjutnya</button>
            <p class="link">sudah punya akun? <a href="index.php">login now</a></p>

        </form>
        <!-- end form -->
    </div>
    <!-- end form-container -->

</body>
</html>
