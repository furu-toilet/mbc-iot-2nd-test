<?php
unset($_SESSION['id']);                //セッション情報クリア
unset($_SESSION['username']);          //セッション情報クリア
unset($_SESSION['hash']);          //セッション情報クリア

header( "Location: ../index.php" ) ;        //ページ遷移(トップページへ)


?>