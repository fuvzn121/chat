<?php
  if(isset($_REQUEST['hdl'])) $hdl = $_REQUEST['hdl']; else $hdl="";
  if(isset($_REQUEST['msg'])) $msg = $_REQUEST['msg']; else $msg="";
  if(isset($_REQUEST['timeOut'])) $timeOut=$_REQUEST['timeOut']; else $timeOut="";
  $conn=mysqli_connect('localhost','C0114269','pass') or die("データベース接続に失敗しました");
  mysqli_select_db($conn,'chat_db') or die("指定されたデータベースは存在しません。");

  //メッセージが入力されていない場合、インターバルによってこのプログラムが呼び出された場合は、
  //データベースへの保存はしない
  if($msg!="" && $timeOut==""){
    $sql="insert into chat_tbl values(null,'".$hdl."','".$msg."',null);";
    if(!mysqli_query($conn,$sql)){
      echo  "データの書き込みに失敗しました。\n";
    }
  }

  //メッセージ表示用のデータの作成
  $sql="select * from chat_tbl order by dateTime desc;";
  if($result=mysqli_query($conn,$sql)){
    $data="";
    while($row=mysqli_fetch_array($result,MYSQL_ASSOC)){

      //すべでのメッセージを一つの文字列にしている
      $data.="<hr><li><span style='color:red;'>".$row['handle']."</span>　>　".$row['message']."　<span class='time'>".$row['dateTime']."</span></li>\n";
    }
  }
  else{
    echo "クエリーに失敗しました。\n";
  }
  mysqli_close($conn);
  echo $data;
?>
