<?php
$key = "mbctoilet";
$pass = $_GET['pass'];

$encpass = openeel_encrypt($pass,'ACS-128-ECB',$key);

echo $encpass;
?>
