<?php
$result = null;
$msg = null;

if(isset($_POST['sql_submit'])){    //実行ボタン後の処理
	require "./php/Common.php";
	$db = new Common();
	$sql = $_POST['sql'];
	$result = $db->db_sql($sql);   //SQL実行（戻り値あり）
	
	
	$db->db_close();          //接続切断
}

function h($str){                   //HTMLに文字列出力
	return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PSMS  PostgreSQLManegmentStudio</title>
		<link rel="stylesheet" href="./css/style_db_menu.css">
		<link rel="icon" type="image/png" href="../img/CloudDatabase.png" sizes="16x16" id="favicon">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="./js/SqlExcute.js"></script>
	</head>
<body>
	<header>
	<h1>MBC-PSMS  --PostgreSQLManegmentStudio--</h1>
        <input class="left-in" type="submit" name="info_menu" value="ユーザ情報" onclick="location.href='./php/info.php'">
	</header>
    	<iframe class="leftframe" src="left.php" scrolling="yes"></iframe>
    	<div class="right">
	   <form method="post" name="SQL_sendform">
	      <h2>SQL</h2>
		<textarea class="sendarea" name="sql" id="sql"></textarea><br>
		<div class="right-inputarea">
			<input class="right-in" type="button" value="実行" id="sql_excute">
			<!--input class="right-in" type="submit" value="実行" name="sql_submit" id="sql_excute"-->
			<input class="right-in" type="reset" value="リセット" name="sql_reset" id="sql_reset">
			<!--button class="right-in" id="sql_excute">実行</button-->
		</div>
		<h2>エラーログ</h2>
		<textarea id="msg"></textarea><br>
		<div class="errlog-area" id="log"></div>
		</form>
	</div>

</body>
</html>
