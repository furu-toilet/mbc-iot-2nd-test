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
	    $vis = strpos($mltsql, ";", $start);
	    array_push($split_arr,substr($mltsql,$start,$vis + 1));
	    $start = $vis + 1;
	    if(strpos($mltsql, ";", $start) == false){
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
