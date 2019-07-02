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
        $this->errmsg = '実行SQL:' . $sql. '\n' . 'SQL実行エラー:' . $e->getMessage();         //エラーメッセージの格納
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
  
  /* 下記新規メソッド作成中 */
  /* SQL実行用メソッド */
  function sql_excute($mltsql){
	$ex_result = array();/*
  	foreach(sql_split($mltsql) as $ex_sql){
		array_push($ex_result,sql_once($ex_sql));
	}*/
	//$ex_result = ["sql" => "123", "data" => "456"];
	//sql_split("select * from user_info;");
	
  	return sql_once("select * from user_info;");
  }
  /* SQL分割用メソッド(文字列) （未完）*/
  function sql_split($mltsql){
	$split_arr = array();
	$start = 0;
	while(true){
	    $leng = $mltsql.length();
	    $vis = mb_strpos($mltsql, ';', $start, UTF-8);
	    array_push($split_arr,mb_substr($mltsql,$start,$vis));
	    $start = $vis + 1;
	    $mltsql = mb_substr($mltsql,$start,$leng);
	    if($mltsql < 2 || mb_strpos($mltsql, ';', $start, UTF-8) == false){
	    	break;
	    }
	}
	return $split_arr;
  }
  /* 単一SQL実行用メソッド（完了） */
  function sql_once($sql){
  	$once_result = $this->db_sql($sql);	//実行結果格納
	$once_msg    = $this->db_msg();		//メッセージ格納
	$once_arr    = array("sql" => $sql ,"data" => $once_result ,"msg" => $once_msg);//3次元連想配列作成
	return $once_arr;	//戻り値を返す
  }
  
  
  
}

/*  追加機能実装予定 ↑↑↑↑↑↑新規メソッド作成。　2019/06/28　15:55
複数のSQLに対応
→" ; "を検出してSQL文を分割する。
各SQL文を配列に格納後、foreachにてすべて実行。
実行中にErrMsgを確認しながら、正常終了するまで実行する。
結果データを返す。
ex)
実行済みSQL：正常終了
実行済みSQL：正常終了
エラー発生SQL：エラーメッセージ
未実行SQL：未実行
未実行SQL：未実行

上記内容の２次元配列と、実行結果２次元連想配列を組み合わせた多次元連想配列にて戻り値として返す。

実装効果：
複数のテストデータを同時に挿入できる。
上記の場合に、どこでエラーが起きたのか明確に分かるようにする。

懸念課題1：同時にSELECT文を実行した際に、どの様に戻り値を表示するか（PSMS内）
懸念課題2：他の連携ファイルとの干渉や、不具合について

上記課題1解決案：SQLの開始部分にて"SELECT"を検出した場合に...（被採用）
      すべての戻り値があるものについては表示をする。（PSMSにてforeach等ですべて検出後、表にて配備）（採用）
上記課題2解決案：新規でメソッドを作成する。
　　　　　　　　ｐｓｍｓに求められる機能の追加なので別途PSMSのみにて呼び出し方を変える。（SqlExcute.php、left.php等...）
	
作成予定メソッド：
暫定メソッド数：3つ
・実行用メソッド：sql_excute($mltsql)  戻り値：SQLすべての実行結果を4次元連想配列？で返す。
	・SQLデータ分割用メソッド:sql_split($mltsql)　戻り値：SQLを格納した1次元配列
	・単一SQL実行＆メッセージ取得用メソッド:sql_once($sql)　　戻り値：*SQLと*結果データと*エラーメッセージを格納した3次元連想配列


*/



?>
