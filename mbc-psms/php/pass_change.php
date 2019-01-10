<?php
session_start();
require "Common.php";
$prepare = new Common();
$furu = $prepare->db_sql("select * from user_info;");
if (isset($_POST["pass_ch"])) {
    $id = $_SESSION['id'];
    $password = $_POST['password'];
    $name = $_SESSION['username'];
    $newpass = $_POST['newpass'];
    $hash    = $_SESSION['hash'];
    $newhash = password_hash($_POST['newpass'], PASSWORD_BCRYPT);
	
	$blo_log = true;			//チェックFLG
	   
	foreach($furu as $value){
		if($id == $value['id'] && $hash == $value['hash'] && password_verify($password,$value['hash'])){
			$blo_log = false;
			break;
		}
	}	
	
     if($blo_log == true){
	     echo "不正なセッション情報です。";
	     
     }else {
        $prepare->db_sql("update user_info set hash = '" . $newhash  . "'where id = '" . $id . "';");
        $_SESSION['hash'] = $newhash;
        echo "登録完了";
        header( "Location: ./info.php" ) ;     //ページ遷移
     }
  // }
}
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>パスワードの変更</title>
    <link rel="stylesheet" href="../css/inreg.css">
  </head>
  <body>
    <header>
      IoT2nd
    </header>
    <div class="main">
      <form method="post">
        <h1>パスワードの変更</h1>
        <div class="form-disc">現在のパスワード
          </div>
        <div class="form-group">
          <input id="pass" type="password" class="form-control" name="password"  required />
        </div>
        <div class="form-disc">
          新しいパスワード</div>
        <div class="form-group">    
          <input id="pass"  type="password" class="form-control" name="newpass"  required />
        </div>
        <button type="submit" class="btn" name="pass_ch" >変更</button>
      </form>
      <br>
      <div class="fooder">
        <a href="./info.php">戻る</a>
      </div>
    </div>
  </body>
</html>
