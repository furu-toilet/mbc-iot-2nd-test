var datalist1;

/*  corechartをロード  */
google.load('visualization', '1', {'packages':['corechart']});
/* コールバックで呼び出してからスタートする（忘れると動かないことも） */
google.setOnLoadCallback(chartstart);
/* 同期処理の始まり */
function chartstart(){
    Promise.all([
        RequestStartMain('./php/GetDailyMerge.php') //全てのRequestStartが終了してからthen以降の処理へ（同期）
      ]).then(
      success => {                  //実行結果はsuccessの中に格納される
          datalist1 = success;   //データのセット
          drawChart();              //グラフの描画スタート
      },
    )
}

/* サーバとのファイル通信用関数 */
function RequestStartMain(url){       
  return new Promise((resolve,reject) => {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if(xhr.readyState ===4 && xhr.status === 200){    //通信成功時
        var responsedata = xhr.responseText;
          resolve(responsedata);
      }else if(xhr.status === 404){     //通信エラー時
        reject("Err : Not Found");
        console.log(reject);
      }
    }    
    xhr.open("GET",url,true);   //urlをもとに接続
    xhr.send(null);
  });
}

/* グラフ描画用関数 */
function drawChart(){
    /* データセット */
    var data1 = google.visualization.arrayToDataTable(JSON.parse(datalist1));

    
   // オプションの設定
    var options1 = {
      title : '1日の累積データ',
     series: {
     　0:{targetAxisIndex:0,
      　type: "line"},     // 第1系列は左のY軸を使用
     　1:{targetAxisIndex:1},         // 第2系列は右のY時を使用
    　},
     hAxis: {title: '時間帯'},
     vAxes: {
       // 0:左のY軸。1:右のY軸
       0: {title: '回数'},
       1: {title: '時間[分]'}
     },
   };

    // 指定されたIDの要素に棒グラフを作成
    var chart1 = new google.visualization.ColumnChart(document.getElementById('chart1_div'));

    //グラフの描画
    chart1.draw(data1, options1);
}
