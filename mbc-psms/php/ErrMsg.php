<?php
//Ajaxにて実行でSQL事項結果を2次元連想配列にて返す。
//$data内に配置
require_once "./Common.php";
$db = new Common();
//header('Content-type: text/plain; charset= UTF-8');
if(isset($_POST['sql'])){
    $sql = $_POST['sql'];
    $db->db_sql($sql);
    
    echo json_encode( $db->db_msg() );
}else{
    echo 'FAIL TO AJAX REQUEST';
}
?>
