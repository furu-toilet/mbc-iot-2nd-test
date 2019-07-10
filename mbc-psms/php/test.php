<?php

require_once "./Common.php";
$db = new Common();

$datalist = 
  '
  select * from user_info;
  select * from "RuiInfo";
  select * from "ToiletTerminal";
  select * from abctable;
  ';

$data2 = "select * from user_info";

//var_dump( $db->sql_excute($datalist) );

var_dump( $db->sql_once($data2) );

?>
