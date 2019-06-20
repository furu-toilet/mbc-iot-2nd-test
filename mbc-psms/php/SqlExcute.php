<?php

//Ajaxにて実行でSQL事項結果を2次元連想配列にて返す。
//$data内に配置

require_once "./Common.php";
$db = new Common();

//header('Content-type: text/plain; charset= UTF-8');

if(isset($_POST['sql'])){
    $sql = $_POST['sql'];
    $result= array();
    $header = array();
    
    $data = $db->db_sql($sql);
    
    foreach($data[0] as $h => $_){
        array_push($header,$h)
    }
    array_push($result,$header);
    
    if($data == null){
        $data = ["実行結果"["該当データなし"]];
    }else {
        //実行結果がNull値以外であればそのまま返す。
        foreach($data as $row){
            array_push($result,$row);
        }
    }
    echo json_encode( $result );
}else{
    echo 'FAIL TO AJAX REQUEST';
}

?>
