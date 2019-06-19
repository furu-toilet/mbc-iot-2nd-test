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
            //$('.result').html(data);
            //$('.sql-result').val(data);
            makeTable(JSON.parse(data),"log");
            console.log(data);
        })
        // Ajaxリクエストが失敗した時発動
        .fail( (data) => {
            //$('.result').html(data);
            $('.sql-result').val(data);
            console.log(data);
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
    
    
    /*
    if(data[0].length){
        rows.push(table.insertRow(-1));
        //表にヘッダーを設定
        for(var key in data[0]){
            cell = rows[0].insertCell(-1);
            cell.appendChild(document.createTextNode(key));
        }
    }
    */
    
    //表に2次元配列の要素を格納
    for(let i in data){
        rows.push(table.insertRow(-1));      //行の追加　※縦方向
        for(let j in data[i]){
            cell = rows[i].insertCell(-1);    //行に対して項目を追加　※横方向
            cell.appendChild(document.createTextNode(data[i][j]));   //データの追加
        }    
    }
    //指定したdiv要素に表を加える
    document.getElementById(tableId).appendChild(table);
    
}
