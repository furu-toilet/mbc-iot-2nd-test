var datalist1;
var datalist2;
var datalist3;
var datalist4;

// ライブラリのロード
// name:visualization(可視化),version:バージョン(1),packages:パッケージ(corechart)
google.load('visualization', '1', {'packages':['corechart']});
// グラフを描画する為のコールバック関数を指定
google.setOnLoadCallback(chartstart);

/* 同期処理の始まり */
function chartstart(){
    Promise.all([
        RequestStartRui('./php/GetDailyCount.php'), //全てのRequestStartが終了してからthen以降の処理へ（同期）
        RequestStartRui('./php/GetDailyTime.php'),
        RequestStartRui('./php/GetWeeklyCount.php'),
        RequestStartRui('./php/GetWeeklyTime.php')
      ]).then(
      success => {                  //実行結果はsuccessの中に格納される
          datalist1 = success[0];   //データのセット
          datalist2 = success[1];
          datalist3 = success[2];
          datalist4 = success[3];
          drawChart();              //グラフの描画スタート
      },
    )
}

/* サーバとのファイル通信用関数 */
function RequestStartRui(url){       
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

// グラフの描画
function drawChart() {
    var DayCountData1       = google.visualization.arrayToDataTable(JSON.parse(datalist1));
    var DayTimeData2        = google.visualization.arrayToDataTable(JSON.parse(datalist2));
    var WeeklyCountData3    = google.visualization.arrayToDataTable(JSON.parse(datalist3));
    var WeeklyTimeData4     = google.visualization.arrayToDataTable(JSON.parse(datalist4));
    

// オプションの設定
var DayCountOptions1 = {
  title : '1日の使用回数',
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

  var DayTimeOptions2 = {
    title : '1日の使用時間[分]',
    series: {
      0:{targetAxisIndex:0},     // 第1系列は左のY軸を使用
      1:{targetAxisIndex:1,
        type: "line"},         // 第2系列は右のY時を使用
      },
      hAxis: {title: '時間帯'},
      vAxes: {
        // 0:左のY軸。1:右のY軸
        0: {title: '時間[分]'},
        1: {title: '時間[分]'}
      },
    };

    var WeeklyCountOptions3 = {
      title : '1週間の使用回数',
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

      var WeeklyTimeOptions4 = {
        title : '1週間の使用時間[分]',
        series: {
          0:{targetAxisIndex:0},     // 第1系列は左のY軸を使用
          1:{targetAxisIndex:1,
            type: "line"},         // 第2系列は右のY時を使用
          },
          hAxis: {title: '時間帯'},
          vAxes: {
            // 0:左のY軸。1:右のY軸
            0: {title: '時間[分]'},
            1: {title: '時間[分]'}
          },
        };

  // 指定されたIDの要素に棒グラフを作成
  var chart1 = new google.visualization.LineChart(document.getElementById('chart1_div'));
  var chart2 = new google.visualization.ColumnChart(document.getElementById('chart2_div'));
  var chart3 = new google.visualization.LineChart(document.getElementById('chart3_div'));
  var chart4 = new google.visualization.ColumnChart(document.getElementById('chart4_div'));

  //グラフの描画
  chart1.draw(DayCountData1, DayCountOptions1);
  chart2.draw(DayTimeData2, DayTimeOptions2);
  chart3.draw(WeeklyCountData3, WeeklyCountOptions3);
  chart4.draw(WeeklyTimeData4, WeeklyTimeOptions4);
}
