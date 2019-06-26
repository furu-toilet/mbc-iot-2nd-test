<?php
$key = "mbctoilet";
$pass = $_GET['pass'];

$encpass = openssl_encrypt($pass,'AES-128-ECB',$key);

var_dump($encpass);
?>
