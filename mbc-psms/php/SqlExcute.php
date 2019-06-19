<?php

//Ajaxにて実行でSQL事項結果を2次元連想配列にて返す。
//$data内に配置

require_once "./Common.php";
$db = new Common();

//header('Content-type: text/plain; charset= UTF-8');

if(isset($_POST['sql'])){
    $sql = $_POST['sql'];
    $header = [];
    
    $data = $db->db_sql($sql);
    
    if($data == null){
        $data = "該当データなし";
    }else {
        //実行結果がNull値以外であればそのまま返す。
    }
    echo json_encode( $data );
}else{
    echo 'FAIL TO AJAX REQUEST';
}

?>
