<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>チャットルーム</title>
        <script type="text/javascript" src="chat.js"></script>
    </head>
    <body>
        <div id="header">再翻訳チャット<br>
        <?php
          if(isset($_REQUEST['fHandle']))$sHandle=$_REQUEST['fHandle']; else $sHandle=""; //HNの受信
          if(isset($_REQUEST['fIn']))$sIn=$_REQUEST['fIn']; else $sIn=""; //ログインフラグの受信
          $conn=mysqli_connect('localhost','C0114269','pass') or die("データベース接続に失敗しました");
          mysqli_select_db($conn,'chat_db') or die("指定されたデータベースは存在しません。");

          //チャットにログインしてきたユーザの情報をDBに保存
          if($sIn=="logIn"){
            $sMsg="{$sHandle}さんが入室しました。";
            $sql="insert into chat_tbl values(null,'".$sHandle."','".$sMsg."',null);";
            if(!mysqli_query($conn,$sql)){
              echo "データの書き込みに失敗しました。\n";
            }
          }
          mysqli_close($conn);
        ?>
        ハンドル名：<span style="color:red;"><?= $sHandle ?></span>
        <form name="form1" method="post" id="sub">
          メッセージ：
          <input name="fMsg" type="text" size="100" id="msg"><!--　メッセージの入力　-->
          <input name="fHandle" type="hidden" value="<?= $sHandle ?>" id="hdl"><!--　HNの再送用　-->
          <input type="submit" name="fSub1" value="発言" id="btn">
        </form>
        </div>

        <!--この下にDBに書き込まれているチャットデータを挿入-->
        <div id="disp"></div>
    </body>
</html>
