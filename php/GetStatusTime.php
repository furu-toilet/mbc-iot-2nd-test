<?php
/* このファイルについて */
// 作成者：古澤
// 最終更新日付：2019/08/23
// 戻り値：DBの値を配列で返す。ToiletTerminalテーブル
//        array(status,UpdateTime)
/* 以下コード */

require_once "./Common.php";
$db = new Common();

$sql = "select * from \"ToiletTerminal\" where \"TanmatsuInfo\" = 'ラズパイ1F男子トイレ';";
$SqlData = $db->db_sql($sql);     // 現在１レコードを想定

var_dump($SqlData);

$StatusData = $SqlData['status'];
$UpdateTimeData = $SqlData['UpdateTime'];

//$result = json_encode(array("status"=>$StatusData,"UpdateTime"=>$UpdateTimeData));

//echo $result;

var_dump(array("status"=>$StatusData,"UpdateTime"=>$UpdateTimeData));
var_dump($sqlData);

?>
