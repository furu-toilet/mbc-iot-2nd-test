
<?php
session_start();
require "Common.php";
$prepare = new Common();


function h($str){       //文字列出力用
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}

$selename = $prepare->db_sql("select * from user_info where id = '" . $_SESSION['id'] . "';");
$selepass = $prepare->db_sql("select password  from user_info where id = '" . $_SESSION['id'] . "';");

//var_dump($selename);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>会員情報</title>
  <link rel="stylesheet" href="../css/info.css">
  <link rel="icon" type="image/png" href="../../img/CloudDatabase.png" sizes="16x16" id="favicon">
</head>
<body>
  <header>
  IoT2nd
  </header>
  <div class="main">
  <h1>ユーザー情報</h1>
  <table align="center">
  <tr>
    <td class="left">ユーザー名</td>
    <td class="center"><?php echo $_SESSION['username']; ?></td>
    <td class="right"><a href="name_change.php">ユーザー名の変更</a></td>
  </tr>  
    <tr>
      <td class="left">ID</td>
      <td class="center"><?php echo $_SESSION['id']; ?></td>
      <td class="right"><a href="id_change.php">IDの変更</a></td>
    </tr>  
    <tr>
      <td class="left">パスワード</td>
      <td class="center"><a href="pass_change.php">パスワードの変更</a></td>
    </tr>  
  </table>
  </div>
  <div class="others"><a href="./logout.php">ログアウト</a></div>
</body>
</html>


<?php

//unset($_SESSION['id']);
//unset($_SESSION['password']);
//unset($_SESSION['username']);

?>
