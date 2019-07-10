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
	    $vis = strpos($mltsql, "z", $start) + 1;
	    array_push($split_arr,substr($mltsql,$start,$vis));
	    $start = $vis;
	    if(strpos($mltsql, "z", $start) == false){
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

//var_dump( sql_split($datalist) );

$data2 = "azbzczdzezfzg;";

var_dump( sql_split($data2) );



?>
