setInterval('showstatus()',1*1000);     //1秒ごとに更新してshowstatusを呼び出し。

function showstatus(){  
  Promise.all([   //下記で呼び出された関数が全て終了してからthen移行へ移行
    RequestStart('./php/GetStatus.php')     //GetStatus.phpを実行
  ]).then(        //すべて上記が正常終了した場合に処理開始
    success => {        //resolveが代入される
      var status = JSON.parse(success);
      switch(status){     //statusの値でcaseで分岐
        case  0:
          document.getElementById("vacancy").src="available.jpg"; //画像のリンク先を変更
          //console.log(0);
          break;
        case  1:
          document.getElementById("vacancy").src="./img/use.img";  //画像のリンク先を変更
          //console.log(1);
          break;
        case -1:
          document.getElementById("vacancy").src="./img/not.img";  //画像のリンク先を変更
          //console.log(-1);
          break;
        default :
          //console.log("default");
          break;
                   }
    },
  )

  function RequestStart(url){
    return new Promise((resolve,reject) => {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function(){
        if(xhr.readyState ===4 && xhr.status === 200){    //通信が正常時
          var responsedata = xhr.responseText;
          resolve(responsedata);
        }else if(xhr.status === 404){                     //通信が異常時
          console.log("Err : Not Found Code:404");
          //reject("Err : Not Found");
        }
      }    
      xhr.open("GET",url,true);
      xhr.send(null);
    });
  }
}