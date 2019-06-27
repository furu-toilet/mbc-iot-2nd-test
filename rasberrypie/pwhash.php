<?php
$pass = $_GET['pass'];

$hash = password_hash($pass, PASSWORD_BCRYPT);
//password_hash($password, PASSWORD_DEFAULT, $options);

var_dump($hash);
?>
