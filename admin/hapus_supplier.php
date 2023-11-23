<?php 
session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../index.php");
    exit();
}

require_once("../base.php");
require_once(BASEPATH."/database.php");
deleteSupplier($_GET['id']);
$previousPage = $_SERVER['HTTP_REFERER'];
header("Location: $previousPage");
