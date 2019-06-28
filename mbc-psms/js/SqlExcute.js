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
        .done( (data,str) => {
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
    if(data['res'] == "100"){
        //ErrMsg(sql);                              //※※※変更箇所
        document.getElementById("msg").value = data['data'];
    }else if(data['res'] == "400"){
        document.getElementById("msg").value = "正常終了";
    }else{
        document.getElementById("msg").value = "正常終了";
        //表に2次元配列の要素を格納
        //data = JSON.parse(data);
        for(let i in data['data']){
            rows.push(table.insertRow(-1));  // 行の追加
            if(i == 0){
               for(let x in data['data'][i]){
                   cell = rows[cnt].insertCell(-1);
                   cell.appendChild(document.createTextNode(x));
                   cell.style.backgroundColor = "#1727ea"; // ヘッダ行
                   rows.push(table.insertRow(-1));
               }
               cnt++;
            }
            for(let j in data['data'][i]){
                cell=rows[cnt].insertCell(-1);
                cell.appendChild(document.createTextNode(data['data'][i][j]));
                // 背景色の設定
                cell.style.backgroundColor = "#878fed"; // ヘッダ行以外
            }
            cnt++;
        }
        //指定したdiv要素に表を加える
        document.getElementById(tableId).appendChild(table);
    }
}

/*  以下のメソッドは使用しない  */
//エラーメッセージの取得
/*
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
        document.getElementById("msg").value = JSON.parse(data); data;
    })
    // Ajaxリクエストが失敗した時発動
    .fail( (data) => {
        //$('.sql-result').val(data);
    })
    // Ajaxリクエストが成功・失敗どちらでも発動
    .always( (data) => {

    });
}
*/
