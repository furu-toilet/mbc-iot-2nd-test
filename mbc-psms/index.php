<!DOCTYPE html>
<?php
session_start();

require "./php/Common.php";
$prepare = new Common();


$furu = $prepare->db_sql("select * from user_info;");

if ($furu == null){
     $prepare->db_sql("create table user_info (id varchar PRIMARY KEY, name varchar NOT NULL, hash varchar NOT NULL)");
}

if (isset($_POST["login"])) {

   //if (!empty($_POST['id']) && !empty($_POST['password'])) {
     $id = $_POST['id'];
     $password = $_POST['password'];
     $username = null;
     $hash = null;
	//echo "ID" . $_POST['id'];
	//echo "password". $_POST['password'];
	
	   $blo_log = false;			//ログインFLG
	foreach($furu as $value){	
		//echo "id" . $value['id'];
		//echo "pass" . $value['password'];
		   
		 foreach($furu as $value){
            if($id == $value['id']  && password_verify($password,$value['hash'])){
                $blo_log = true;         //ログインON
                $username = $value['name'];
                $hash     = $value['hash'];
                break;
            }
        }	
    }
     if($blo_log == false){
       echo("ユーザーIDまたはパスワードが間違っています");
     }else {
	     $_SESSION['id'] = $id;
	     $_SESSION['hash'] = $hash;
	     $_SESSION['username'] = $username;
	     header('location: ./db_menu.php');
     }
  // }
}

?>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DB管理者ログイン用ページ</title>
    <link rel="stylesheet" href="./css/inreg.css">
    <!-- bootstrap? -->
    <!-- link rel="stylesheet" href="styles.css"-->
    <link rel="icon" type="image/png" href="../img/CloudDatabase.png" sizes="32x32" id="favicon">
  </head>
  <body>
    <!--div class="col-xs-6 col-xs-offset-3"-->
    <header>
    IoT2nd
    </header>
    <div class="main">
    <form method="post">
      <h1>ログイン</h1>
      <div class="form-disc">
      ユーザーID</div>
      <div class="form-group">
        <input type="text" class="form-control" name="id"  required />
      </div>
      <div class="form-disc">
      パスワード</div>
      <div class="form-group">    
        <input type="password" class="form-control" name="password"  required />
      </div>
      <button type="submit" class="btn" name="login">ログイン</button>
      </form>
      <br>
      <div class="fooder">
      <a href="./php/register.php">ユーザー登録はこちら</a>
      </div>
    </div>
    <!-- /div-->
  </body>
</html>
