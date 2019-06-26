<?php
$key = "mbctoilet";
$pass = $_GET['pass'];

$encpass = openssl_encrypt($pass,'ACS-128-ECB',$key);

//echo $encpass;
var_dump($encpass);
?>
