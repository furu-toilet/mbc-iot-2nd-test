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

function sql_split($mltsql){
  	$split_arr = array();
  	$start = 0;
  	while(true){
	    if(strpos($mltsql, ";", $start) == false){
  		    $vis = strlen($mltsql);
  	  }else{
	    	  $vis = strpos($mltsql, ";", $start) + 1;
	    }
      array_push($split_arr,substr($mltsql,$start,$vis - $start));
      $start = $vis;
      if(strpos($mltsql, ";", $start) == false){
          if(substr($mltsql,strlen($mltsql),1) != null){
              $vis = strlen($mltsql);
              array_push($split_arr,substr($mltsql,$start,$vis - $start));
          }
          break;
       }
   }
  	var_dump( $split_arr );
  }

sql_split($data2);


?>
