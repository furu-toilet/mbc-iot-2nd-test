<?php
session_start();
require "./php/Common.php";
$test = new Common();
$list = null;                 //テーブル名リスト
$tbal = null;
/*      PG用	*/
$sql = "select pg_statio_user_tables.relname
			from pg_catalog.pg_class,pg_catalog.pg_statio_user_tables
			where relkind='r'
			and pg_catalog.pg_statio_user_tables.relid=pg_catalog.pg_class.relfilenode;";

/* MySQL用 */
//$sql = "show tables from toilet;";



/*  テーブル一覧取得  */
$tbal = $test->db_sql($sql);  //データを取得

//var_dump($tbal);

function h($str){
	return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}


$cnt = 0;
foreach($tbal as $value){		//配列を調整
        $list[$cnt] = $value['relname'];    //Postgres用
        //$list[$cnt] = $value['Tables_in_toilet'];    //MySQL用
        $cnt++;
}


?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>right</title>
    <link rel="stylesheet" href="./css/style_left.css">
  </head>
  <body>
　<script>
	function set2fig(num) {
		// 桁数が1桁だったら先頭に0を加えて2桁に調整する
		var ret;
		if( num < 10 ) { ret = "0" + num; }
		else { ret = num; }
			return ret;
		}
	function showClock2() {
		var nowTime = new Date();
		var nowHour = set2fig( nowTime.getHours() );
		var nowMin  = set2fig( nowTime.getMinutes() );
		var nowSec  = set2fig( nowTime.getSeconds() );
		var msg = nowHour + ":" + nowMin + ":" + nowSec;
		document.getElementById("RealtimeClockArea2").innerHTML = msg;
	}
	setInterval('showClock2()',1000);
	 
	function ReloadTable(){
		location.reload();
	}
  </script>
  <div id="left">
    <h3>現在の時刻</h3>
    <h3 id="RealtimeClockArea2"></h3>
    <div id="file">
      <h3>ファイル</h3>
      <div class="button">
        <input class="left-in" type="button" name="export" value="更新" onClick="ReloadTable()">
        <input class="left-in" type="button" name="import" value="テスト..">
      </div>
    </div>
    <div class="space"></div>
    <h3>メニュー</h3>
    <ul id="menu">
      
      <li>テーブル一覧
        <ul>
          <?php foreach($list as $value){ ?>
          <li><?php echo $value; ?></li>
          <?php } /*foreach終了*/ ?>
        </ul>
      </li>
      
      
    </ul>
  </div>
  </body>
</html>
