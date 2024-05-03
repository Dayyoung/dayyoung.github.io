<?php
/* 콘트롤 */
include ("./include/control.inc");
$size = getimagesize("./img/skin_preview/$skin.gif");
?>
<html>
<title>::스킨 미리보기::</title>
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
function size()
{
	window.resizeTo(<?=$size[0] + 35?>, <?=$size[1] + 35?>);
}
-->
</script>
<body bgcolor="#FFFFFF" text="#000000" link="#333333" vlink="#333333" alink="#FF0033" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0" onLoad="size();">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center" valign="middle">
      <img src="./img/skin_preview/<?=$skin?>.gif" style="cursor:hand" onClick="window.close()" alt="그림을 클릭하시면 창이 닫힙니다">
    </td>
  </tr>
</table>
</body>
</html>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->