<?php
include '../includes/config.php';
include '../includes/functions.php';

session_start();
session_unset();
session_destroy();

header("Location: login.php");
exit();
?>