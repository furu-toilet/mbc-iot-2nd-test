<?php
/*
RasberryPie用DB朝一処理用phpファイル。
①ラズベリーパイが自身の端末情報がトイレ端末テーブルに存在するか確認
　　①-1→存在した場合は自身の端末情報のレコードを削除
　　①-2→作成する。
②1週間前の日付のトイレ情報累積テーブルの情報を削除する。
③使用中のままで利用時間が入っていないデータを削除する。

上記を実行するphpファイルである。
*/
/*  おまじない  */
require_once "../php/Common.php";
$db = new Common();


/*  実行SQLの用意  */
$SqlTableCheck  = "select * from \"ToiletTerminal\" where \"TanmatsuInfo\" = 'ラズパイ1F男子トイレ';";    //①の端末情報が存在するかチェックするSQL(ToiletTerminal内)。
$SqlTableDelete = "delete from \"ToiletTerminal\" where \"TanmatsuInfo\" = 'ラズパイ1F男子トイレ';";    //①の端末情報に基づきそのレコードを削除(ToiletTerminal内)。
$SqlTableCreate = "insert into \"ToiletTerminal\" values ('ラズパイ1F男子トイレ',0,CURRENT_TimeStamp + '9 hours');";    //①の端末情報に基づき新規レコードを挿入。（朝一処理なので空室データでよい）
$SqlRuiDelete   = "delete from \"RuiInfo\" where \"Date\" <= CURRENT_TimeStamp + '9 hours' + '-7 day';";    //②の累積テーブルより端末情報に基づいた一週間以前のデータを削除する。
$SqlDeleteUsing = "delete from \"RuiInfo\" where \"UsedTime\" is null;";

/*  以下SQL実行＆制御  */
$check = $db->db_sql($SqlTableCheck);       //①チェック用ファイル取得(現在の情報だけなので1レコード想定)

if($check　== null){                     //端末情報が存在した場合
    $db->db_sql($SqlTableDelete);       //①-1端末情報レコード削除
}

$db->db_sql($SqlTableCreate);           //①-2新規空データ作成

$db->db_sql($SqlRuiDelete);             //②1週間以前の累計データ削除

$db->db_sql($SqlDeleteUsing);             //③使用中のままで利用時間が入っていないデータを削除

$db->db_close();      //DB切断

?>
