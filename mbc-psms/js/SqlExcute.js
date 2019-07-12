$(function(){
    // Ajax button click
    $('#sql_excute').on('click',function(){
        $.ajax({
            url:'./php/SqlExcute.php',
            type:'POST',
            data:{
                'sql':$('#sql').val()
            }
        })
        // Ajaxリクエストが成功した時発動
        .done( (data) => {
            makeTable(JSON.parse(data),"log");
            //makeTable(data,"log");
        })
        // Ajaxリクエストが失敗した時発動
        .fail( (data) => {
            //$('.sql-result').val(data);
        })
        // Ajaxリクエストが成功・失敗どちらでも発動
        .always( (data) => {

        });
    });
});


//表の動的作成
function makeTable(data,tableId){
    //表の作成開始
    //var data = JSON.parse(arr);
    var rows  = [];
    var table = document.createElement("table");
    var cnt = 0;
    var sql = document.getElementById("sql").value;
    
    for(var q = 0; q < data.length;q++){
        if(data[q]['res'] == "100"){
            console.log(data[q]['res']);
            //ErrMsg(sql);                              //※※※変更箇所
            document.getElementById("msg").value = data[q]['data'];
        }else if(data[q]['res'] == "400"){
            console.log(data[q]['res']);
            document.getElementById("msg").value = "正常終了";
        }else if(data[q]['res'] == "100"){
            console.log(data[q]['res']);
            document.getElementById("msg").value = "正常終了";
            //表に2次元配列の要素を格納
            //data = JSON.parse(data);
            for(let i in data[q]['data']){
                rows.push(table.insertRow(-1));  // 行の追加
                if(i == 0){
                   for(let x in data[q]['data'][i]){
                       cell = rows[cnt].insertCell(-1);
                       cell.appendChild(document.createTextNode(x));
                       cell.style.backgroundColor = "#1727ea"; // ヘッダ行
                       rows.push(table.insertRow(-1));
                   }
                   cnt++;
                }
                for(let j in data[q]['data'][i]){
                    cell=rows[cnt].insertCell(-1);
                    cell.appendChild(document.createTextNode(data[q]['data'][i][j]));
                    // 背景色の設定
                    cell.style.backgroundColor = "#878fed"; // ヘッダ行以外
                }
                cnt++;
            }
            //指定したdiv要素に表を加える
            document.getElementById(tableId).appendChild(table);
        }
    }
}
