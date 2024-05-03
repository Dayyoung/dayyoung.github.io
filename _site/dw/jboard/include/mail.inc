<?php
$jb_mail_body = "
<html>
<head>
<title>JungBo Board - 글보기</title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<style type='text/css'>
<!--
td {  font-family: '돋움'; font-size: 9pt}
a:link,a:visited{text-decoration:none}
a:hover {text-decoration:underline}
INPUT,SELECT,TEXTAREA { border:1 solid #999999; background-color: #FFFFFF; color: #333333; }
-->
</style>
<script>
<!--
-->
</script>
</head>

<body bgcolor='#FFFFFF' text='#333333' link='#333333' vlink='#333333' alink='#333333' topmargin='10' marginwidth='0' marginheight='0'>
<table width='550' border='0' cellspacing='0' cellpadding='0'>
  <tr height='10'>
    <td>
      <table width='550' border='0' cellspacing='0' cellpadding='3' align='right'>
        <tr><td colspan='2'>$info</td></tr>
        <tr><td colspan='2' height='15'></td></tr>
        <tr bgcolor='#999999'><td height='2' colspan='2'></td></tr>
        <tr><td height='1'></td></tr>
        <tr bgcolor='#999999'><td height='1' colspan='2'></td></tr>
        <tr><td height='1'></td></tr>
        <tr bgcolor='#F7F5F5'>
          <td width='50'><div align='left'>글제목</div></td>
          <td width='470'><B>$POST_VARS[subject]</B></td>
        </tr>
        <tr bgcolor='#F7F5F5'>
          <td width='50'><div align='left'>글쓴이</div></td>
          <td>$POST_VARS[name]</td>
        </tr>
        <tr bgcolor='#999999'><td height='1' colspan='2'></td></tr>
        <tr><td colspan='2' height='5'></td></tr>
        <tr>
          <td colspan='2'>".nl2br($POST_VARS[comment])."</td>
        </tr>
        <tr><td height='3'></td></tr>
        <tr bgcolor='#999999'><td height='1' colspan='2'></td></tr>
      </table>
    </td>
  </tr>
</table>
<table width='550' cellpadding='5' cellspacing='0' border='0'>
  <tr>
    <td>
      <a href='$minfo[url]'>URL 바로가기 : $minfo[url]</a>
    </td>
  </tr>
  <tr>
    <td>
      <font color='red'>본 메일은 발신전용 주소에서 발신된 메일입니다. 답변하지 말아 주십시오!!</font>
    </td>
  </tr>
</table>
</body>
</html>
";
?>