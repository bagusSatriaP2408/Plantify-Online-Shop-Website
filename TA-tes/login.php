<?php 

require 'functions.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/styles/style.css">
</head>
<body>
    
    <div class="form-container">
        <form action="login.php" method="post">
            <h2>Login Now</h2>
            <div class="input-container">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo $_POST["username"] ?? '' ?>">
                <span class="error-msg">errormsg</span>
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo $_POST["password"] ?? '' ?>">
                <span class="error-msg">errormsg</span>
            </div>
            <button type="submit" name="login">Login</button>
            <p class="link">belum punya akun? <a href="register2t.php">register now</a></p>
        </form>
    </div>

</body>
</html>
