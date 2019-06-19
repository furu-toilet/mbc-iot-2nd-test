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
    
    
    for(let x in data){
        rows.push(table.insertRow(-1));
        //表にヘッダーを設定
        for(let y in data){
            cell = rows[x].insertCell(-1);
            cell.appendChild(document.createTextNode(y));
            cell.style.backgroundColor = "#1727ea"; // ヘッダ行
        }
        break;
    }
    //指定したdiv要素に表を加える
    document.getElementById(tableId).appendChild(table);
    
    //表に2次元配列の要素を格納
    for(let i in data){
        rows.push(table.insertRow(1));  // 行の追加
        for(let j in data[i]){
            cell=rows[i+1].insertCell(-1);
            cell.appendChild(document.createTextNode(data[i][j]));
            // 背景色の設定

            if(i==0){
                cell.style.backgroundColor = "#1727ea"; // ヘッダ行
            }else{
                cell.style.backgroundColor = "#878fed"; // ヘッダ行以外
            }

        }
    }
    //指定したdiv要素に表を加える
    document.getElementById(tableId).appendChild(table);
    
}
