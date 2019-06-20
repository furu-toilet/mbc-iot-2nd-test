<?php
/*
トイレ端末からの自動ログイン機能を持った
トイレ状態遷移ファイル
URLからパラメータ-を与えて、ログインを行う。
パラメーターの取得はURLからGETで行う。
パラメーターはIDとhashのみとする（暫定）
※今後、トイレ状態も付加出来たらいいな...
**下記URLのサンプル**
https://mbc-iot-2nd.herokuapp.com/rasberrypie/SetStatusTest.php/?Terminal=testterminal&hash=testhash
?以降がパラメーターであり、項目は＆で区切る。
*/

if(isset($_GET['Terminal'])){
    $TerminalID = $_GET['Terminal'];        //パラメータから端末ID取得
}
if(isset($_GET['hash'])){
    $hash = $_GET['hash'];        //パラメータから端末ID取得
}
//echo $TerminalID;
//echo $hash;

/*
require_once "../php/Common.php";      //～～おまじない～～
$db = new Common();             //

$sql = 'SELECT "Status" 
        FROM "ToiletTerminal";';      //DBManagerからSQL文が決まったらここに入力！   現在のトイレの状態を取得するクエリ（実行結果：-1,0,1　のどれか）
$status = $db->db_sql($sql);    //現在のトイレの情報を取得
if($status !== 1){   //在室ならDBを操作しない（誤作動の可能性を考慮）
    $sql = 'UPDATE "ToiletTerminal" SET 
                   "Status" =  1,"UpdateTime"    = CURRENT_TimeStamp + \'9 hours\';';
    $db->db_sql($sql);    //状態のセット実行
    
    $sql = 'INSERT INTO "RuiInfo" ("TanmatsuInfo","Date","StartTime","EndTime","UsedTime")
            SELECT "TanmatsuInfo",CAST("UpdateTime"as Date),"UpdateTime",(NULL),(NULL)
            FROM   "ToiletTerminal";'; //入室時間のデータをトイレ情報累積テーブルに格納する。
    $db->db_sql($sql);    //使用状況のセット実行
}
$db->db_close();
*/

?>
