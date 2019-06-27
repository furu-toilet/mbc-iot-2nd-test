<?php
$pass = $_GET['pass'];

//$hash = password_hash($password, PASSWORD_BCRYPT);
$hash = password_hash($password);

var_dump($hash);
?>
