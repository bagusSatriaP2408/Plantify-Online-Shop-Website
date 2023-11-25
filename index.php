<?php 
session_start();

// cek apakah user sudah pernah login atau belum, jika sudah diarahkan ke page sesuai role
if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
    header("Location: {$_SESSION['role']}/index.php");    
    exit();
}

require 'validations.php';

$errors = array();
$success = false;

if (isset($_POST['login'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $role = validateLogin($errors, $username, $password);

    $cek = "";
    foreach ($errors as $error) {
        $cek .= $error;
    }

    // cek apakah role tidak false
    if ($role) {

        $_SESSION["role"] = $role;
        $_SESSION['username'] = $username;
        $_SESSION["login"] = true;

        // arahkan ke halaman sesuai role
        header("Location: $role/index.php");
    }
}

$title = "Login";

require_once('base.php');        // untuk mengunakan variable constant BASEURL/BASEPATH
require_once(BASEPATH . "/templates/head.php");

?>
    
    <!-- start form-container -->
    <div class="form-container">
        <!-- start form -->
        <form action="index.php" method="post">

            <h2>Login Now</h2>

            <!-- inputan username -->
            <div class="input-container">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $_POST["username"] ?? '' ?>">
                <span class="error-msg"><?php echo $errors["username"] ?? '' ?></span>
            </div>
            <!-- inputan password -->
            <div class="input-container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo $_POST["password"] ?? '' ?>">
                <span class="error-msg"><?php echo $errors["password"] ?? '' ?></span>
            </div>

            <button type="submit" name="login">Login</button>
            <p class="link">belum punya akun? <a href="register_role.php">register now</a></p>

        </form>
        <!-- end form -->
    </div>
    <!-- end form-container -->

</body>
</html>
