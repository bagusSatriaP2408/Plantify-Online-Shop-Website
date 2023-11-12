<?php

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: ../index.php");
    exit();
}

	require_once("../base.php");
	require_once(BASEPATH."/app/database.php");
	increaseProductInCart($_GET['pro'],$_GET['krjng']);
