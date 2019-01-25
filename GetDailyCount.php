<?php
/*
GetDailyCount.phpについて
1日ごとのトイレ使用回数を戻り値として返すphp
グラフでの仕様なので戻り値は「print」関数にて返す。
※形式はjson
*/


require_once "Common.php";      //～～おまじない～～
$db = new Common();             //
$result = array();
$timezone = 24;   //グラフのメモリを何時まで表示するか決める。


/*グラフ用データの土台を作成する    

ex）[
    ['時間帯','使用回数'],
    [0:00,  0],
    [1:00,  0],
         ・
         ・
         ・
    [23:00, 0]
*/


//今日の時間帯ごとの使用回数を求めるSQLを格納する。
$sql = "
SELECT EXTRACT (HOUR FROM \"StartTime\")  ||':00',COUNT(*)
FROM \"RuiInfo\"
WHERE CAST(\"StartTime\" as DATE) = CAST(CURRENT_TimeStamp + '9 hours'  as DATE)
GROUP BY EXTRACT(HOUR FROM \"StartTime\")
ORDER BY EXTRACT(HOUR FROM \"StartTime\");
";      //DBManagerからSQL文が決まったらここに入力！
$daycount = $db->db_sql($sql);    //二次元配列を取得。　値は 時間帯(Str型),使用回数(Int型)

array_push($result,array("時間帯","使用回数"));

for($i=0;$i<$timezone;$i++)     //時間帯と使用回数 0をセットする
{
    array_push($result,[$i.":00",0]);
}

$icount = 0;
foreach($result as $i)      //0:00～23:00までのデータを格納する。    i
{    
    foreach($daycount as $list)    //$daycountのデータの数だけforeach文を回す    j
    {
        if(strcmp($list['?column?'],$icount.":00") == 0)    //$listの時間帯を参照し、対応する部分にデータを格納する
        {                
            $result[$icount + 1][1] = $list['count'];
            break;        //データを格納した場合、ループを抜ける
        }            
    }
    $icount++;
} 

echo json_encode( $result);//jsonで使用する型に変換する。

?>
