var time = 0;
var OldStatus = 99;
var min = 0;
var sec = 0;
var TimeStr = "00:00";
var NowStatus = null;
var UpdateTime = null;
var usability = document.getElementById('usability');
var VisualizeTime = document.getElementById('time');
var vacancy = document.getElementById('vacancy');
var favicon = document.getElementById('favicon');
var VisualStatus = null;

showtime();

function showtime(){
    RequestStartTime("./php/GetStatusTime.php").then(
        StatusRequest(NowStatus).then(
            TimeRequest(time).then(
                TimePulus().then(
                    VisualizeTime.innerHTML = TimeStr
                )
            )
        )
    )
    setTimeout('showtime()',1*1000);  //1秒ごとに更新してshowstatusを呼び出し。
}

function RequestStartTime(url){
  return new Promise((resolve,reject) => {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState ===4 && xhr.status === 200){    //通信が正常時
        NowStatus = xhr.responseText[0]['Status'];
        //UpdateTime = JSON.parse(xhr.responseText)[0]['UpdateTime'];
          //resolve(responsedata);
      }else if(xhr.status === 404){                     //通信が異常時
        console.log("Err : Not Found Code:404");
        //reject("Err : Not Found");
      }
    }    
    xhr.open("GET",url,true);
    xhr.send(null);
  });
}
function TimeRequest(time){
    return new Promise((resolve,reject) => {
        if(NowStatus == 1){
            if(sec < 10){
               sec = "0" + sec;
            }
            if(min < 10){
               min = "0" + min;
            }
        }else{
            sec = "00";
            min = "00";
        }
    });
}

function TimePulus(){
    return new Promise((resolve,reject) => {
        if(sec == 0 & min == 0){
           //TimeStr = "00:00";
           resolve("00:00");
        }else{
            //TimeStr = min + " : " + sec;
            resolve(min + " : " + sec);
           }
    });
}

function StatusRequest(NowStatus){
    return new Promise((resolve,reject) => {
        if(NowStatus == 0){                //空室の場合
                time = 0;
                sec = 0;
                min = 0;
            resolve(time);
            vacancy.src = "./img/free.png";
            favicon.href = "./img/FaviconFree.png";
            if(NowStatus != OldStatus){
                GoPushbar("空室");
                OldStatus = 0;
            }
        }else if(NowStatus == 1){          //在室の場合
            if(OldStatus == NowStatus){    //前回も在室状態であれば
                time++;
                sec = time % 60;
                min = Math.floor(time/60);
            }
            vacancy.src = "./img/use.png";
            favicon.href = "./img/FaviconUse.png";
            if(NowStatus != OldStatus){
                GoPushbar("在室");
                OldStatus = 1;
            }
            resolve(time);
        }else if(NowStatus == -1){         //使用不可の場合
            time = 0;
            sec = 0;
            min = 0;
            vacancy.src = "./img/not.jpg";
            favicon.href = "./img/FaviconExit.png";
            if(NowStatus != OldStatus){
                GoPushbar("使用不可");
                OldStatus = -1;
            }
        }
    });
}

function GoPushbar(Msg){    
    Push.create("テスト環境のトイレ情報が更新されました", {
        body: Msg,
        icon: './img/free.png', // 右側に表示される画像のパス
        timeout: 4000,
        onClick: function () {
            location.href = 'https://yahoo.co.jp';
            this.close();
        }
    });
}
