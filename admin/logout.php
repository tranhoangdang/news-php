<?php
session_start();
require_once('functions.php');
unset($_SESSION['login']);
redirect('login.php');
?>