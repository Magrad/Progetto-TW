<?php
session_start();
define("UPLOAD_DIR", "./themes/imgs/");
define("SIGNUP_URL", "register.php");
define("HIDDEN_KEY", "6Lfq5r4dAAAAAKIv9dyYqk_j_VPDkRbH16n6hMCM");
define("SITE_NAME", "Build-it");
require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "build-it.bo", 3306);
?>