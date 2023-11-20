<?php

session_start();

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'customer') {
    header("Location: ../index.php");
    exit();
}

	require_once("../base.php");
	require_once(BASEPATH."/app/database.php");
	increaseProductInCart($_GET['pro'],$_GET['krjng']);
