<?php 

define("BASEURL", "http://localhost/TA-tes");
define("BASEPATH", $_SERVER["DOCUMENT_ROOT"]."/TA-tes");
define("DB", new PDO('mysql:host=localhost;dbname=store', 'root', '',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]));   // database connection 

?>