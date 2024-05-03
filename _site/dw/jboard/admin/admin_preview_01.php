<?php
/*
	관리자 인덱싱(?) 페이지
*/

/* 어드민 콘트롤 화일 */
include ("./include/control.inc");
?>
<html>
<head>
<title>::스킨 미리보고 선택하기::</title>
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
function select_skin2()
{
	var F = opener.opener.form;
	F.skin.value = '<?=$skin?>';
	opener.window.close();
	window.close();
}
function select_skin()
{
	var F = opener.form;
	F.skin[<?=$seq?>].checked = true;
	window.close();
}
-->
</script>
<body bgcolor="#FFFFFF" text="#000000">
<table width="100%" height="100%" cellpadding="3" cellspacing="0" border="0">
  <tr>
    <td valign="top">
      <iframe src="http://www.jungbo.net/jboard_rel/?code=<?=$skin?>" frameborder="0" width="100%" height="550"></iframe>
    </td>
  </tr>
  <tr><td height="1" bgcolor="#000000"></td></tr>
  <tr><td height="2" bgcolor="#FFFFFF"></td></tr>
  <tr>
    <td align="center">
      <font color="blue" onClick="select_skin2();" style="cursor:hand"><B>{스킨선택하기}</B></font>
      <font color="blue" onClick="window.close();" style="cursor:hand"><B>{창 닫 기}</B></font>
    </td>
  </tr>
</table>
</body>
</html>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->