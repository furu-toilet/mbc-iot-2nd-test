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
	    $vis = strpos($mltsql, ";", $start) + 1;
	    array_push($split_arr,substr($mltsql,$start,$vis - $start));
	    $start = $vis;
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

//var_dump( sql_split($datalist) );

$data2 = "a;b;c;d;e;f;g;";

//var_dump( sql_split($data2) );

//$vis = $start - strpos($mltsql, ";", 6) + 1;
//var_dump(substr($data2,6,$vis));


?>
