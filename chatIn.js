window.onload=function(){
  document.getElementById("sub").onsubmit=function(e){
    if(document.getElementById("hand").value==""){
      document.getElementById("handMsg").innerHTML="※HNを入力してください。";
      if(e.preventDefault){  //「preventDefault()」メソッドがあるかをチェック
        e.preventDefault();  //IE以外のブラウザの場合、ひとつ前のイベントを取り消し
      }
      return false;  //IEの場合のは、「return false」でイベントを取り消し
    }
  return true;
  }
}
