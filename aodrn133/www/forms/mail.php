<!DOCTYPE html>
<html lang="ko-KR">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>메일테스트</title>
<style type="text/css">
body {margin:0;padding:0;text-align:center;color:#333;font-size:12px;line-height:40px;}
h2 {

}
</style>
</head>
<?php
header("Content-Type: text/html; charset=UTF-8;");
?>
<body>
<h2>메일이가는지 테스트합니다</h2>
<?php
   $name_01=$_POST['name'];
   $mail_02=$_POST['mail_add'];
   $msg_03=$_POST['message'];
  
   $to='admin@visual-fun.com'; //발송되는 이메일 변경//
   $subject='Visual-fun.com에서 발송된 메세지 입니다.';
   $msg="보낸사람:$name_01\n"."보낸사람메일주소:$mail_02\n"."내용:$msg_03\n";

   $header = "From:$subject\n";
   $header .= "From: $mail_02 <".$mail_02.">\n";

	mail($to,$subject,$msg.$header); 

	$to='test@visual-fun.com';
	mail($to,$subject,$msg.$header);
 
  echo "
        <script>
        window.alert ('정상적으로 발송되었습니다.');
        history.go(-1);
        </script>
        ";
  exit;

return true;	
  
?>
</body>
</html>