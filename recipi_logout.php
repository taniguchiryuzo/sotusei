<?php
// recipi_logout.php

session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
header('Location:recipi_login.php');
exit();
