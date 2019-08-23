function GoPushbar(){    
    Push.create("Push 通知だよ！", {
        body: "本文だよここに表示されるよ",
        icon: './images/icon.png', // 右側に表示される画像のパス
        timeout: 4000,
        onClick: function () {
            location.href = 'https://yahoo.co.jp';
            this.close();
        }
    });
}
