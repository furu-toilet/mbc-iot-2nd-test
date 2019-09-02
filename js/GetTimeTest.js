var GetMin = null;
var GetHour = null;

function GetData(url){
    return new Promise((resolve,reject) => {
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

function SetDateTime(){
    var MyHour = null;
    var MyMinutes = null;
    GetData("./php/GetStatusTime.php").then( (data) => {
      var MyDate = new Date(data['UpdateTime']);
      return　{"Hours" : MyDate.getHours,"Minutes" : MyDate.getMinutes};
    });
}

function ReturnDateTime(){
    console.log(SetDateTime());
}

ReturnDateTime();
