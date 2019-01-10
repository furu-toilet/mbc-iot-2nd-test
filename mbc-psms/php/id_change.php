<?php
session_start();
require "Common.php";
$prepare = new Common();
$furu = $prepare->db_sql("select * from user_info;");


if (isset($_POST["id_ch"])) {

    $id = $_SESSION['id'];
    $hash = $_SESSION['hash'];
    $name = $_SESSION['username'];
    //$newpass = $_POST['newpass'];
    $newid = $_POST['id'];
	
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
	     //$prepare->db_sql_only("update user_info set 'name' = '" . $name . "' where id = '" . $id . "' AND 'password' = " . $password . ";");		//名前変更の場合
	     //$prepare->db_sql_only("update user_info set 'password' = '" . $newpass . "' where id = '" . $id . "' AND 'name' = " . $username . ";");		//pass変更の場合
	     //$prepare->db_sql_only("update user_info set 'id' = '" . $newid . "' where name = '" . $name . "';");		//ID変更の場合
	     $prepare->db_sql("update user_info set id = '" . $newid  . "'where name = '" . $name . "';");
       $_SESSION['id'] = $newid;
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
    <title>ID変更</title>
    <link rel="stylesheet" href="../css/inreg.css">
  </head>
  <body>
    <header>
      IoT2nd
    </header>
    <div class="main">
      <form method="post">
        <h1>IDの変更</h1>
        <div class="form-disc">
          新しいID</div>
        <div class="form-group">
          <input id="id" type="text" class="form-control" name="id"  required />
        </div>
        <button type="submit" class="btn" name="id_ch">変更</button>
      </form>
      <br>
      <div class="fooder">
        <a href="info.php">戻る</a>
      </div>
    </div>
  </body>
</html>
