<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}

require_once("../base.php");
require_once(BASEPATH."/app/database.php");
deleteOrderbyId($_GET['id']);

