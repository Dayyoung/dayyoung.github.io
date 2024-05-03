<?php
/* 콘트롤 */
include ("./include/control.inc");

/* 삭제 하려는 게시판 정보 */
$base_path = "../data/$HTTP_GET_VARS[code]";
$idx = @file("$base_path/idx");
$usage_article = exec("du -sH $base_path");
$usage_article = explode("\t", $usage_article);
$usage_binary = exec("du -sH $base_path/binary");
$usage_binary = explode("\t", $usage_binary);
$usage[article] = $usage_article[0];
$usage[binary] = $usage_binary[0];
$all = count(explode("|", $idx[0])) - 2;
$all = ($all <= 0) ? 0 : $all;
?>
<html>
<head>
<title>관리자 로그인</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td {  font-family: "돋움"; font-size: 9pt}
a:link,a:visited{text-decoration:none}
a:hover {text-decoration:underline}
INPUT,SELECT,TEXTAREA, CHECKBOX { border:1 solid #999999; background-color: #FFFFFF; color: #333333;}
-->
</style>
<script>
<!--
function chkdel()
{
	if(confirm('정말 삭제 하시겠습니까?')) {
		document.form.submit();
	} else {
		return false;
	}
}
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#333333" vlink="#333333" alink="#FF0033" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
<table width='100%' height="50%" cellpadding='0' cellspacing='0' border='0' bordercolordark='#FFFFFF' bordercolorlight='#000000'>
  <tr>
    <td>
      <table width='400' cellpadding='5' cellspacing='0' border='1' bordercolordark='#FFFFFF' bordercolorlight='#999999' align="center">
        <form method="post" action="./admin_act.php" name="form">
        <input type="hidden" name="mode" value="del">
        <input type="hidden" name="code" value="<?=$HTTP_GET_VARS[code]?>">
        <tr>
          <td>
            <B>게시판 삭제</B>
          </td>
        </tr>
        <tr>
          <td>
            게시판을 삭제 하시려면 확인을 눌러 주세요.<BR>
            게시판 삭제시 모든 데이터가 삭제 됩니다.(업로드된 자료 포함)
          </td>
        </tr>
        </form>
      </table>
      <table width='400' cellpadding='5' cellspacing='0' border='0' bordercolordark='#FFFFFF' bordercolorlight='#999999' align="center">
        <tr>
          <td>
            <div align="right"><input type="button" value="삭제!!" onClick="chkdel();"></div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->