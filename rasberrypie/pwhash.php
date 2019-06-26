<?php
$key = "mbctoilet";
$pass = $_GET['pass'];
$encpass = openssl_encrypt($pass,'AES-128-ECB',$key);
$decpass = openssl_decrypt($encpass,'AES-128-ECB',$key);
var_dump($encpass,$decpass);
?>
