<?php
/*
	관리자 인덱싱(?) 페이지
*/

/* 어드민 콘트롤 화일 */
include ("./include/control.inc");

/* 스킨목록 */
$skin_list = get_directory("../template");
sort($skin_list);
?>
<html>
<head>
<title>::스킨 미리보고 선택하기::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
<style type="text/css">
<!--

td {
	font-size: 9pt;
	line-height: 17px;
}
-->
</style>
<style type="text/css">
<!--
a:link {
	text-decoration: none;
	color: #666666;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: none;
	color: #666666;
}
a:active {
	text-decoration: none;
	color: #666666;
}
td {  font-family: "돋움"; font-size: 9pt}
INPUT,SELECT,TEXTAREA, CHECKBOX { border:1 solid #999999; background-color: #FFFFFF; color: #333333;}
-->
</style>
<script>
<!--
function select_skin(a)
{
	var F = document.form;
	F.skin[a].checked = true;
}
function select_skin2()
{
	var F = this.document.form;
	var len = F.skin.length;
	for(var i = 0 ; i < len ; i++) {
		if(F.skin[i].checked) {
			val = F.skin[i].value;
			opener.form.skin.value=val;
			var chk = true;
		}
	}
	if(!chk) {
		alert('스킨을 선택해 주세요');
		return false;
	} else {
		window.close();
	}
}

function size()
{
	window.resizeTo(698, 600);
}
-->
</script>
<body bgcolor="#FFFFFF" text="#000000" onLoad="size();">
<table width="650" height="215" border="0" cellpadding="0" cellspacing="0" background="img/in1bg_2.gif">
  <tr> 
    <td height="33" valign="top"><img src="img/pre-title.gif" width="651" height="42"></td>
  </tr>
  <tr>
    <td>
      <div align="center">
        <input type="button" value="선택하기" onClick="select_skin2();">
        <input type="button" value="창닫기" onClick="window.close();">
      </div>
    </td>
  </tr>
  <tr> 
    <td height="100" valign="top">
      <div align="left"><br>
        <table width="90%" height="248" border="0" align="center" cellpadding="10" cellspacing="0">
          <form name="form">
          <tr align="center"> 
<?php
for($i = 0, $z = 0 ; $i < count($skin_list) ; $i++) {
	if(file_exists("./img/skin_preview/$skin_list[$i].gif")) {
		$chk = ($i == 0) ? " checked" : "";
		echo "            <td>
              <img src=\"img/skin_preview/$skin_list[$i].gif\" style=\"cursor:hand\" onClick=\"select_skin($z); window.open('./admin_preview_01.php?skin=$skin_list[$i]&seq=$i','preview_01','width=800, height=600')\"><BR>
              [$skin_list[$i]] <input type=\"radio\" name=\"skin\" value=\"$skin_list[$i]\"$chk style=\"border:0 background-color:#FFFFFF\">
            </td>\n";
		if($i % 2) echo "          </tr>\n          <tr align=\"center\">\n";
		$z++;
	}
}
if(count($skin_list) % 2) echo "    <td></td>\n";
?>
          </tr>
          </form>
        </table>
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <div align="center">
        <input type="button" value="선택하기" onClick="select_skin2();">
        <input type="button" value="창닫기" onClick="window.close();">
      </div>
    </td>
  </tr>
  <tr> 
    <td valign="bottom"><img src="img/in3.gif" width="650" height="53"></td>
  </tr>
</table>
</body>
</html>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->