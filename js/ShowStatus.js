var ShowOldStatus = 5;
var Msg = null;

showstatus();

function GoPushbar(){    
    Push.create("トイレ情報が更新されました", {
        body: Msg,
        icon: './img/free.png', // 右側に表示される画像のパス
        timeout: 4000,
        onClick: function () {
            location.href = 'https://yahoo.co.jp';
            this.close();
        }
    });
}

function showstatus(){  
  Promise.all([   //下記で呼び出された関数が全て終了してからthen移行へ移行
    RequestStartStatus('./php/GetStatus.php')     //GetStatus.phpを実行
  ]).then(        //すべて上記が正常終了した場合に処理開始
    success => {        //resolveが代入される
      var status = JSON.parse(success);
      var vacancy = document.getElementById('vacancy');
      var favicon = document.getElementById('favicon');
      if(status != ShowOldStatus){
          switch(status){     //statusの値でcaseで分岐
            case  0:
              Msg = "空室";
              vacancy.src = "./img/free.png";
              favicon.href = "./img/FaviconFree.png";
              break;
            case  1:
              Msg = "使用中";
              vacancy.src = "./img/use.png";
              favicon.href = "./img/FaviconUse.png";
              break;
            case -1:
              Msg = "使用不可"
              vacancy.src = "./img/not.jpg";
              favicon.href = "./img/FaviconExit.png";
              break;
            default :
              break;
          }
          GoPushbar();
          ShowOldStatus = status;
       }
    
    status = null;
    vacancy = null;
    favicon = null;
    },
  )

  function RequestStartStatus(url){
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
    
    setTimeout('showstatus()',1*1000);
}
