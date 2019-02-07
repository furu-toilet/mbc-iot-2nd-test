<?php
session_start();
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
		<textarea class="sendarea" name="sql"></textarea><br>
		<div class="right-inputarea">
			<input class="right-in" type="submit" value="実行" name="sql_submit" id="sql_submit">
			<input class="right-in" type="reset" value="リセット" name="sql_reset" id="sql_reset">
		</div>
		</form>
		<div id="log">
		  <h2>実行結果</h2>

<?php if(!empty($_POST['sql'])){           //SQL実行した場合?>       
          <?=h('実行SQL：' . $_POST['sql'])?>	
	  <br>
    <?php if($db->db_msg() == null){       //エラー時の表示を制御  ?>
	    <?=h('正常終了') ?><br>
            <table>
            <tr>
        <?php foreach($result[0] as $key => $_): ?>
            <th><?=h($key) ?></th>
        <?php endforeach; ?>
            </tr>
        <?php foreach($result as $values): ?>
            <tr>
                <?php foreach($values as $value): ?>
                    <td><?=h($value)?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
            </table>
	    <br>
	    <br>

    <?php }else{  //エラーメッセージ ?>	  
          <?= h($db->db_msg()) ?>	     
    <?php }   //else end  ?>
          
<?php } ?>          
			</div>
	</div>

</body>
</html>
