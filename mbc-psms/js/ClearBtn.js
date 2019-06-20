$(function(){
    // リセットボタンクリック
    $('#sql_reset').on('click',function(){
        document.getElementById("log").innerHTML = "";
        document.getElementById("msg").value = "";
        document.getElementById("sql").value = "";
    });
});
