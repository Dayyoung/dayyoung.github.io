<?php
/* 콘트롤 */
include ("./include/control.inc");


//
// 삭제 처리
//
if($mode == "del") {
	$dbm = dbmopen("./login/ban.gdbm", "w");
	dbmdelete($dbm, $key);
	dbmclose($dbm);
	echo "<script>alert('삭제되었습니다');history.go(-1);</script>";
	exit;
}
?>
<html>
<head>
<title>::등록거부자관리::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td,body {  font-family: "돋움"; font-size: 9pt}
a:link,a:visited{text-decoration:none}
a:hover {text-decoration:underline}
INPUT,SELECT,TEXTAREA, CHECKBOX { border:1 solid #999999; background-color: #FFFFFF; color: #333333;}
-->
</style>
<script>
<!--
function chk_del(key)
{
	if(confirm('삭제하시겠습니까?')) {
		var url = '<?=$PHP_SELF?>?mode=del&key='+key;
		this.document.location.href=url;
	} else {
		return false;
	}
}
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000">
  <table width="652" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td valign="top"> 
        <p></p>
        <table width="620" border="1" cellspacing="1" cellpadding="1" bgcolor="#999999" align="center" bordercolor="#FFFFFF" align="center">
          <tr bgcolor="#EEEEFF"> 
            <td height="28"> 
              <p align="center">::: 등 록 거 부 자 관 리 :::</p>
            </td>
          </tr>
        </table>
        <p></p>
        <table width="620" border="1" cellspacing="1" cellpadding="3" bgcolor="#999999" align="center" bordercolor="#FFFFFF" align="center">
         <tr bgcolor="#FEFCF5" height="28">
           <td align="center">번호</td>
           <td align="center">아이피</td>
           <td align="center">거부사유</td>
           <td align="center">등록일</td>
           <td align="center">삭제</td>
         </tr>
<?php
$dbm = dbmopen("./login/ban.gdbm", "r");
$key = dbmfirstkey($dbm);
$num = 1;
while($key) {
	$data = explode("|", dbmfetch($dbm, $key));
	echo "
        <tr bgcolor=\"#FFFFFF\">
          <td align='center'>$num</td>
          <td>$key</td>
          <td>$data[1]</td>
          <td>$data[0]</td>
          <td align=\"center\"><input type=\"button\" onClick=\"chk_del('$key')\" value=\"제거\"></td>
        </tr>";
	$key = dbmnextkey($dbm, $key);
	$num++;
}
dbmclose($dbm);
?>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->