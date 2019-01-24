<?php
/*
※コードについて
###現在の###トイレの状態をセットするPHPファイルです。     ###空室###
URLを開くと自動で状態がセットされます。
※注意
Common.phpとこのファイルは同一ディレクトリに保存してください。
*/
require_once "../php/Common.php";      //～～おまじない～～
$db = new Common();             //

$sql = 'SELECT "Status" FROM "ToiletTerminal";';      //DBManagerからSQL文が決まったらここに入力！ 現在のトイレの状態を取得するクエリ（実行結果：-1,0,1　のどれか）
$status = $db->db_sql($sql);    //現在のトイレの情報を取得

if($status !== 0){   //在室ならDBを操作しない（誤作動の可能性を考慮）
    $sql = 'UPDATE "ToiletTerminal" SET "Status" =  0,"UpdateTime" = CURRENT_TimeStamp + \'9 hours\';';      //DBManagerからSQL文が決まったらここに入力！ 現在のトイレの状態を変化させるクエリ
    $db->db_sql($sql);    //状態のセット実行
    $sql = 'UPDATE    "RuiInfo"  SET "EndTime"   = (SELECT "UpdateTime" FROM "ToiletTerminal" )
            WHERE    "EndTime" IS NULL  AND     "UsedTime"  IS NULL;';
    $db->db_sql($sql);    //状態のセット実行
    $sql = 'UPDATE	"RuiInfo" SET "UsedTime" = CAST(EXTRACT(MINUTE FROM age("EndTime","StartTime")) as INTEGER) 
            WHERE	"UsedTime" IS NULL;';
    $db->db_sql($sql);    //状態のセット実行
}

$db->db_close();
?>
