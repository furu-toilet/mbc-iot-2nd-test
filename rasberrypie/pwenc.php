<?php
$key = "mbctoilet";
$pass = $_GET['pass'];

$encpass = openssl_encrypt($pass,'AES-128-ECB',$key);

echo $encpass;
var_dump($encpass);
console.log($encpass);
?>
