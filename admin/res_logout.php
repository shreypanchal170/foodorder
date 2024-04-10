<?php
session_start();
session_destroy();
$url = 'res_login.php';
header('Location: ' . $url);

?>