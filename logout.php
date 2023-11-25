<?php 

session_start();

session_destroy();      // menghapus session

header("Location: index.php");
exit();

?>