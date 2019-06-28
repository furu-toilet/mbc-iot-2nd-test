<?php
Class Common {
    /* 全てprivateで定義（関数からのみ取得してください。） */
  private $pdo = null;          //DatabaseObject
  private $stmt = null;         //PDOStatmant
  private $sql = null;          //SQL
  private $errmsg = null;       //エラーメッセージ
  private $flg = false;          //環境設定FLG true or false

  function Common(){
    /* $flg=trueならローカルMySQlで接続 */
    /* $flg=falseならリモートPostgreSQLで接続 */
    
    if($this->flg == true){           //ローカルならtrue
        /* ローカルMySQL接続 */
        try{
            $dsn = 'mysql:dbname=toilet;host=localhost;charset=utf8mb4';    //utf-8にて実行
            $user = 'furu';                         //自分のIDを入力してください。
            $password = 'cz4a?5456';                //自分のPasswordを入力してください。
            
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch (Exception $e){
            //print('Error:'.$e->getMessage());
            $this->errmsg = ('データベース接続失敗：' .$e->getMessage());          //エラーメッセージの格納
        }
    }elseif($this->flg == false){                      //リモートならfalse
        /*  リモートPostgreSQLに接続  */
        try{
            $url = parse_url(getenv('DATABASE_URL'));               //サーバーよりデータベース情報取得
            $dsn = sprintf("pgsql:host=%s;dbname=%s",$url['host'],substr($url['path'],1));	//接続前準備

            $this->pdo = new PDO($dsn,$url['user'],$url['pass']);           //DatabaseObject作成
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    //エラーメッセージオプション設定
        }catch(Exception $e){
            $this->errmsg = ('データベース接続失敗：' .$e->getMessage());          //エラーメッセージの格納
        }
      }
  }


	/*  SQL文をDBに投げる （戻り値有 SELECT） */
function db_sql($sql){
    try{
        $this->stmt = $this->pdo->prepare($sql);                    //SQLセット
        $this->stmt->execute();                                     //SQL実行
        $all = $this->stmt->fetchALL(PDO::FETCH_ASSOC);             //昇順で並べ替え
        
        return $all;                                                //戻り値2次元連想配列
    }catch (PDOException $e){
        $this->errmsg = 'SQL実行エラー:' . $e->getMessage();         //エラーメッセージの格納
    }
}

    /*  エラーメッセージ取得  */
  function db_msg(){
  	$msg = $this->errmsg;
	return $msg;               //エラーメッセージを返す
  }

    /* DBとの接続の切断  */
  function db_close(){
	$pdo = null;
  }

}

?>
