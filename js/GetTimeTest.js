var a = null;
var b = null;
var c = null;

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
/*
function SetDateTime(){
    GetData("./php/GetStatusTime.php").then( (data) => {
      var MyDate = new Date(data['UpdateTime']);
      return　{"Status" : data['Status'],"Hours" : MyDate.getHours,"Minutes" : MyDate.getMinutes};
    });
}
*/
function ChangeData(Data){
    return new Promise((resolve,reject) => {
      var MyDate = new Date(Data['UpdateTime']);
      resolve( {"Status" : Data['Status'],"Hours" : MyDate.getHours,"Minutes" : MyDate.getMinutes} );
    });
}



function SetParameters(Data){
    return new Promise((resolve,reject) => {
        a = Data['Status'];
        b = Data['Hours'];
        c = Data['Minutes'];
    });
}

function ShowSetData(data){
    console.log(a);
    console.log(b);
    console.log(c);
    console.log(data);
}

GetData("./php/GetStatusTime.php").then( data => {
    ChangeData(data).then( data => {
        SetParameters(data).then( data => {
            ShowSetData(data);
        });
    });
});
