<?php
$pass = $_GET['pass'];

$hash = password_hash($password, PASSWORD_BCRYPT);

var_dump($hash);
?>
