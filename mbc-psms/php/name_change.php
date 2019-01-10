<?php
session_start();
require "Common.php";
$prepare = new Common();
$furu = $prepare->db_sql("select * from user_info;");
if (isset($_POST["name_ch"])) {
    $id = $_SESSION['id'];
    $hash = $_SESSION['hash'];
    $name = $_SESSION['username'];
    //$newpass = $_POST['newpass'];
    $newname = $_POST['username'];
	
	$blo_log = true;			//チェックFLG
	   
	foreach($furu as $value){
		if($id == $value['id']  && $hash == $value['hash']){
			$blo_log = false;
			break;
		}
	}		
	
     if($blo_log == true){
	     echo "不正なセッション情報です。";
	     
     }else {
	     $prepare->db_sql("update user_info set name = '" . $newname  . "'where id = '" . $id . "';");
       $_SESSION['username'] = $newname;
	     echo "登録完了";
       header( "Location: info.php" ) ;     //ページ遷移
     }
  // }
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザー名変更</title>
    <link rel="stylesheet" href="../css/inreg.css">
  </head>
  <body>
    <header>
      IoT2nd
    </header>
    <div class="main">
      <form method="post">
        <h1>ユーザー名の変更</h1>
        <div class="form-disc">新しいユーザー名</div>
        <div class="form-group">
        <input type="text" class="form-control" name="username" required />
        </div>
        <button type="submit" class="btn" name="name_ch">変更</button>
      </form>
      <br>
      <div class="fooder">
        <a href="./info.php">戻る</a>
      </div>
    </div>
  </body>
</html>
