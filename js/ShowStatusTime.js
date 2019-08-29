var OldStatus = 99;
var Msg = null;
var time = 0;
var OldStatus = 0;
var min = 0;
var sec = 0;
var TimeStr = "00:00";
var NowStatus = null;
var usability = document.getElementById('usability');
var VisualizeTime = document.getElementById('time');
var VisualStatus = null;
showstatus();

function GoPushbar(){    
    Push.create("トイレ情報が更新されました", {
        body: Msg,
        icon: './img/free.png', // 右側に表示される画像のパス
        timeout: 4000,
        onClick: function () {
            location.href = 'https://yahoo.co.jp';
            this.close();
        }
    });
}
