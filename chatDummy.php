<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <title>チャットルーム</title>
    </head>
    <body>
    <div id="header">再翻訳チャット<br>
        <?php
              if(isset($_REQUEST['fHandle']))$sHandle=$_REQUEST['fHandle']; else $sHandle=""; //HNの受信
              if(isset($_REQUEST['fIn']))$sIn=$_REQUEST['fIn']; else $sIn=""; //ログインフラグの受信
              $conn=mysqli_connect('localhost','C0114269','pass') or die("データベース接続に失敗しました");
              mysqli_select_db($conn,'chat_db') or die("指定されたデータベースは存在しません。");

              //入室ページからこのページに来たときのみハンドル名とそのメッセージを保存
              if($sIn=="logIn"){
                $sMsg="{$sHandle}さんが入室しました。";
                $sql="insert into chat_tbl values(null,'".$sHandle."','".$sMsg."',null);";
                if(mysqli_query($conn,$sql)){
                  mysqli_close($conn);
                  header("Location:chat.php?fHandle={$sHandle}");
                }
                else{
                  echo "データの書き込みに失敗しました。\n";
                  mysqli_close($conn);
                  exit();
                }
              }
        ?>
    </body>
</html>
