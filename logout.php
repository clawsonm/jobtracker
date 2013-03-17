<?php
error_reporting(E_ALL);
session_start();
require_once('includes/config.php');
$user = NULL;
$login = new JT_Login();

$login->logout();

header("Location: login.php");
?>
