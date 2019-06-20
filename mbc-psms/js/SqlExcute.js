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
            //makeTable(JSON.parse(data),"log");
            makeTable(data,"log");
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
    var rows  = [];
    var table = document.createElement("table");
    var cnt = 0;
    var sql = document.getElementById("sql").value;
    if(data == 0 || data == null){
        ErrLog(sql);
    }else{
        //表に2次元配列の要素を格納
        data = JSON.parse(data);
        for(let i in data){
            rows.push(table.insertRow(-1));  // 行の追加
            if(i == 0){
               for(let x in data[i]){
                   cell = rows[cnt].insertCell(-1);
                   cell.appendChild(document.createTextNode(x));
                   cell.style.backgroundColor = "#1727ea"; // ヘッダ行
                   rows.push(table.insertRow(-1));
               }
               cnt++;
            }
            for(let j in data[i]){
                cell=rows[cnt].insertCell(-1);
                cell.appendChild(document.createTextNode(data[i][j]));
                // 背景色の設定
                cell.style.backgroundColor = "#878fed"; // ヘッダ行以外
            }
            cnt++;
        }
        //指定したdiv要素に表を加える
        document.getElementById(tableId).appendChild(table);
    }
}


//エラーメッセージの取得
function ErrMsg(sql){
    $.ajax({
        url:'./php/ErrMsg.php',
        type:'POST',
        data:{
            'sql':$('#sql').val()
        }
    })
    // Ajaxリクエストが成功した時発動
    .done( (data) => {
        document.getElementById("msg").value(JSON.parse(data));
    })
    // Ajaxリクエストが失敗した時発動
    .fail( (data) => {
        //$('.sql-result').val(data);
    })
    // Ajaxリクエストが成功・失敗どちらでも発動
    .always( (data) => {

    });
}
