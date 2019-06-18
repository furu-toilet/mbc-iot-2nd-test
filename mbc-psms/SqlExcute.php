<?php

//Ajaxにて実行でSQL事項結果を2次元連想配列にて返す。
//$data内に配置

require_once "../php/Common.php";
$db = new Common();

header('Content-type: text/plain; charset= UTF-8');

if(isset($_POST['sql'])){
    $sql = $_POST['sql'];
    $str = "\n\n\nAJAX REQUEST SUCCESS\nSQL:".$sql."\n";
    
    $data = $db->db_sql($sql);
    
    if($data == null){
        $data = "該当データなし";
    }else {
        //実行結果がNull値以外であればそのまま返す。
    }

    echo data;
}else{
    echo 'FAIL TO AJAX REQUEST';
}

?>