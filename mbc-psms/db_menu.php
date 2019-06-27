<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>PSMS  PostgreSQLManegmentStudio</title>
		<link rel="stylesheet" href="./css/style_db_menu.css">
		<link rel="icon" type="image/png" href="../img/CloudDatabase.png" sizes="16x16" id="favicon">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="./js/SqlExcute.js"></script>
		<script type="text/javascript" src="./js/ClearBtn.js"></script>
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
			<input class="right-in" type="button" value="リセット" name="sql_reset" id="sql_reset">
		</div>
		<h2>エラーログ</h2>
		<textarea class="errlog-area" id="msg"></textarea><br>
		<h2>実行結果</h2>
		<div id="log"></div>
		</form>
	</div>
</body>
</html>
