<?php

/* 以下テスト */
//$agentLog = $_SERVER['HTTP_USER_AGENT'];
$agentLog = $_SERVER['HTTP_X_FORWARDED_FOR'];
var_dump($agentLog);
/* 以上テスト */

?>
