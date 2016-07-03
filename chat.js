window.onload = function() {

    //ログインした時に最初にメッセージが表示されるようにAjaxで処理
    var handle = document.getElementById("hdl");
    var message = document.getElementById("msg");
    var send = "hdl=" + handle.value + "&msg=" + message.value;
    sendReturn(send);

    //「発言」ボタンをクリックしたときにメッセージの送信をAjaxを使って行う
    document.getElementById("sub").onsubmit = function(e) {
        var handle = document.getElementById("hdl");
        var message = document.getElementById("msg");
        e.preventDefault(); //サブミットイベントの中止

        //ハンドル名とメッセージをURLエンコードデータにしている
        var send = "hdl=" + handle.value + "&msg=" + message.value;
        sendReturn(send);
        message.value = ""; //メッセージ送信後、メッセージのテキストフィールドをクリア
    }

    //10秒ごとにメッセージの表示を更新するようにインターバルを設定
    timerID = setInterval(function() {

        //発言ボタンを押したときも同じ関数が呼び出されるのでインターバルで呼び出されるときは、発言ボタンのクリック時と
        //異なるURLエンコードデータを送信（引数に）している
        sendReturn("timeOut=para")
    }, 10000);
}

//サーバから帰ってきたチャットのデータをHTMLの「<div id="disp"></div>」に挿入
function returnDataSHow() {
    if (xmlhttp.readyState == 4) {
        document.getElementById("disp").innerHTML = xmlhttp.responseText;
    }
}

//「chatDisp.php」にハンドル名とメッセージを送信する関数
function sendReturn(chat) {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = returnDataSHow;
    xmlhttp.open("POST", "chatDisp.php");
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send(chat);
}
