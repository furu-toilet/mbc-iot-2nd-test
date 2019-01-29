<!DOCTYPE html>
<?php
session_start();

require "./php/Common.php";
$prepare = new Common();


$furu = $prepare->db_sql("select * from user_info;");

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
    <!-- Common.cssの読み込み -->
    <link rel="stylesheet" href="./css/Common.css">

    <!-- Common.cssの読み込み -->
    <link rel="stylesheet" href="./css/Chart.css">

    <!-- ナビゲーションメニューのボタンを読み込み -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css">

    <!-- Pushbar.cssの呼び出し -->
    <link rel="stylesheet" type="text/css" href="css/pushbar.css">
    </head>
    <body>
    <!-- ナビゲーションメニューヘッダー -->
	  <header>
	    <span data-pushbar-target="left">
	      <i id="menubtn" class="fa fa-bars"></i>
	    </span>
	    <p class="title">IoT2nd</p>
	  </header>
	  <!-- ナビゲーションメニュー項目設定 -->
	  <aside data-pushbar-id="left" class="pushbar from_left">
	    <div class="menutitle"><span data-pushbar-close class="close push_right"></span></div>
	    <ul class="menu">
	      <li class = "menu" id = "current"> <a href="https://mbc-iot-2nd.herokuapp.com/Index.html" class="link">Home</a></li>
	      <li class = "menu" id = "current"> <a href="https://mbc-iot-2nd.herokuapp.com/Chart.html" class="link">Graph</a></li>
	      <li class = "menu" id = "current"> <a href="https://www.google.com" class="link">About</a></li>
	      <li class = "menu" id = "current"> <a href="https://mbc-iot-2nd.herokuapp.com/mbc-psms" class="link">MBC-PSMS</a></li>
	    </ul>
	  </aside>
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

  <!-- pushbar.jsの呼び出し -->
  <script type="text/javascript" src="../js/pushbar.js"></script>
  <!-- 実際にナビゲーションメニューの描画はJSで -->
  <script type="text/javascript">
    var pushbar = new Pushbar({
    blur:true,
    overlay:true,
  });
</script>
  </body>
</html>
