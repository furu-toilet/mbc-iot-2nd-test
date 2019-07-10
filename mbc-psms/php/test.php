<?php
/*
require_once "./Common.php";
$db = new Common();

$sql = "select * from user_info;";
*/

function sql_split($mltsql){
	//$split_arr = array();
	//$start = 0;
	//while(true){
	    //$leng = mb_strlen($mltsql);
	    //$vis = mb_strpos($mltsql, ";");
	    //array_push($split_arr,mb_substr($mltsql,$start,$vis));
	    //$start = $vis + 1;
	    //$mltsql = mb_substr($mltsql,$start,$leng);
	    //if($mltsql < 2 || mb_strpos($mltsql, ';', $start, UTF-8) == false){
	    //	break;
	    //}
	//}
	//return $split_arr;
}

$datalist = 
  '
  select * from user_info;
  select * from "RuiInfo";
  select * from "ToiletTerminal";
  select * from abctable;
  ';

//sql_split($datalist);

var_dump( $datalist );


?>
