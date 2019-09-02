var GetMin = null;
var GetHour = null;

function GetTimeStatus(url){
    return new Promise((resolve,reject) => {
    //var url = "./php/GetStatusTime.php";
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState ===4 && xhr.status === 200){    //通信が正常時
        resolve(JSON.parse(xhr.responseText));
      }else if(xhr.status === 404){                     //通信が異常時
        console.log("Err : Not Found Code:404");
      }
    }    
    xhr.open("GET",url,true);
    xhr.send(null);
  });
}

GetTimeStatus("./php/GetStatusTime.php").then( (data) => {
  console.log(data);
});