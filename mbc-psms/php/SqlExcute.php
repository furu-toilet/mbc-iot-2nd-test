<?php

//Ajaxにて実行でSQL事項結果を2次元連想配列にて返す。
//$data内に配置

require_once "./Common.php";
$db = new Common();
/*  戻り値について  */
//  実行結果の状態と、エラーメッセージまたは実行結果データを返す。
//  array(
//      "res" => 実行結果の状態（正常終了[700]またはエラー[100]）
//                              ※正常終了時、結果データがない場合は400を返す。
//      "data"=> 実行結果データ。正常終了時は結果データを２次元連想配列にて返す。
//                             エラー時はエラーメッセージを文字列にて格納する。
//  )
//  
//  

//header('Content-type: text/plain; charset= UTF-8');
/*
if(isset($_POST['sql'])){
    $sql = $_POST['sql'];
    $data = $db->db_sql($sql);
    
    if($data == null){
        if($db->db_msg() == null){
            //$data = "OK";
            $result = array("res" => "400","data" =>$db->db_msg());
            echo json_encode( $result );
        }else{
            $result = array("res" => "100","data" =>$db->db_msg());
            //$data = "ERR";
            echo json_encode( $result );
        }
    }else{
        //正常終了時
        //echo json_encode( $data );
        $result = array("res" => "700","data" =>$data);
        echo json_encode( $result );
    }
    //echo json_encode( $data );
}else{
    echo 'FAIL TO AJAX REQUEST';
}
*/

$datalist = 
'
select * from user_info;
select * from "RuiInfo";
select * from "ToiletTerminal";
select * from abctable;
';

//if(isset($_POST['sql'])){
//if(isset($datalist){
    $result = array();
    //$sql = $_POST['sql'];
    $sql = $datalist;
    $data = $db->sql_excute($sql);
    foreach($data as $once){
        if($once['data'] == null){            
            if($once['msg'] == null){
                array_push($once,array("res" => "400"));
            }else{
                array_push($once,array("res" => "100"));
            }
        }else{
            array_push($once,array("res" => "700"));
        }
        array_push($result,$once);
    }        
    echo json_encode( $result );
//}else{
//    echo 'FAIL TO AJAX REQUEST';
//}


?>
