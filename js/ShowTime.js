var stime = 0;
var OldStatus = 0;
var min = 0;
var sec = 0;
var TimeStr = "00:00";
var NowStatus = null;
//var usability = document.getElementById('usability');
var VisualizeTime = document.getElementById('time');
var VisualStatus = null;

showtime();

function showtime(){
    RequestStartTime("./php/GetStatus.php").then(
        StatusRequest(NowStatus).then(
            TimeRequest(stime).then(
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
        NowStatus = xhr.responseText;
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
function TimeRequest(stime){
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
        TimeStr = min + " : " + sec;
    });
}

function StatusRequest(NowStatus){
    return new Promise((resolve,reject) => {
        if(NowStatus == 0){                //空室の場合
            OldStatus = 0;
            if(OldStatus == 1){         //今回から空室な場合
                stime = 0;
            }
            resolve(stime);
            //usability.innerHTML = "空室";
        }else if(NowStatus == 1){          //在室の場合
            OldStatus = 1;
            if(OldStatus == NowStatus){    //前回も在室状態であれば
                stime++;
                sec = stime % 60;
                min = Math.floor(stime/60);
            }
            //usability.innerHTML = "在室";
            resolve(stime);
        }else if(NowStatus == -1){         //使用不可の場合
            OldStatus = -1;
            if(OldStatus == 1){         //今回から使用不可の場合
                stime = 0;
            }
            //usability.innerHTML = "使用不可";
        }
    });
}