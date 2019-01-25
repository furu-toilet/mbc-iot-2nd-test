<?php
/*
※コードについて
###現在の###トイレの状態を取得するPHPファイルです。
ソースコード内で以下の分を記述してください。
require_once "GetStatus.php";
$status = new GetStatus();  //$statusに結果が格納されます。0,1,-1のどれか

想定している戻り値は空室・在室・使用不可（整備中）を想定して０，１、－１を返す。int型

※注意
Common.phpとこのファイルは同一ディレクトリに保存してください。
*/


require_once "./Common.php";      //～～おまじない～～
$db = new Common();             //
$status = null;

$sql = "SELECT \"Status\" FROM \"ToiletTerminal\"; ";      //トイレ情報テーブルからデータを持ってくるSQLを入れる。
$result = $db->db_sql($sql);  //二次元配列を取得  

if(count($result) == 1)       //1レコードを想定しているのでそれ以外は排除
 {           
  $arr = $result[0];               //二次元配列から配列を取り出し、一次元配列にする。
  $status = $arr['Status'];        //使用状況（int）の値を取り出す。
 }
$db->db_close();

echo json_encode( $status );

?>
