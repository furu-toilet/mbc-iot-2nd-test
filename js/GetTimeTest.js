var GetMin = null;
var GetHour = null;


function GetTimeStatus(url){
  return new Promise((resolve,reject) => {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState ===4 && xhr.status === 200){    //通信が正常時
        //NowStatus = JSON.parse(xhr.responseText)['Status'];
        //UpdateTime = JSON.parse(xhr.responseText)['UpdateTime'];
          //resolve(responsedata);
        resolve(JSON.parse(xhr.responseText));
        return JSON.parse(xhr.responseText);
      }else if(xhr.status === 404){                     //通信が異常時
        console.log("Err : Not Found Code:404");
        //reject("Err : Not Found");
      }
    }    
    xhr.open("GET",url,true);
    xhr.send(null);
  });
}

GetTimeStatus.then( (data) => {
  console.log(data);
});
