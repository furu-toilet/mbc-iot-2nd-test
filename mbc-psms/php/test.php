<?php
/*
require_once "./Common.php";
$db = new Common();

$sql = "select * from user_info;";
*/

function sql_split($mltsql){
	$split_arr = array();
	$start = 0;
	while(true){
	    $leng = strlen($mltsql);
	    $vis = strpos($mltsql, ";");
	    array_push($split_arr,substr($mltsql,$start,$vis));
	    $start = $vis + 1;
	    $mltsql = substr($mltsql,$start,$leng);
	    if($mltsql < 2 || strpos($mltsql, ';', $start, UTF-8) == false){
	    	break;
	    }
	}
	return $split_arr;
}

$datalist = 
  '
  select * from user_info;
  select * from "RuiInfo";
  select * from "ToiletTerminal";
  select * from abctable;
  ';

var_dump( sql_split($datalist) );





?>
