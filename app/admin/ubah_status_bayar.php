<?php 
session_start();

if (!isset($_SESSION['login']) || !isset($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../base.php");
require_once(BASEPATH."/app/database.php");
updateStatusOrder($_GET['id']);