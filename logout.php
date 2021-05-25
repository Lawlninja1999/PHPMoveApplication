<?php
error_reporting(E_ALL);

session_start();

$_SESSION = array();
session_destroy();

header('Location: homepage.php');
?>