<?php
/* 콘트롤 */
include ("./include/control.inc");

/* 인자값 확인 */
if(!$HTTP_GET_VARS[val]) {
	err("검색할 아이디를 입력해 주세요!");
}

/* 생성되어 있는 게시판 구하기 */
$d_list = get_directory("../data");
?>
<html>
<head>
<title>jboard :: 게시판 아이디 중복 검색</title>
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
function check_out()
{
	opener.form.code.value = '<?=$HTTP_GET_VARS[val]?>';
	window.close();
}
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#333333" vlink="#333333" alink="#FF0033" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0">
<table width="100%" cellpadding="5" cellspacing="0" border="1" bordercolordark="#FFFFFF" bordercolorlight="#000000">
  <tr bgcolor="#F5F5F5">
    <td>
      중복검색결과
    </td>
  </tr>
  <tr>
    <td align="center" height="100">
<?php
for($i = 0 ; $i < count($d_list) ; $i++) {
	if($d_list[$i] == $HTTP_GET_VARS[val] || !ereg("(^[0-9a-zA-Z]{2,16}$)", $HTTP_GET_VARS[val])) {
		$result = "true";
	}
}
if($result == "true") {
	echo "
      <font color='blue'><B>\"$HTTP_GET_VARS[val]\"</B></font>은 이미 등록된 아이디, <BR>또는 형식에 어긋난 아이디 입니다.\n";
} else {
	echo "
      <font color='blue'><B>\"$HTTP_GET_VARS[val]\"</B></font>은 사용가능한 아이디 입니다. <input type='button' value='사용하기' onClick=\"check_out();\">\n";
}
?>
    </td>
  </tr>
</table>
<table width="100%" cellpadding="5" cellspacing="0" border="0" bordercolordark="#FFFFFF" bordercolorlight="#000000">
  <form method="get" action="<?=$PHP_SELF?>" name="srch_form">
  <tr>
    <td>
      다른아이디검색 : 
    </td>
    <td>
      <input type="text" name="val"> <input type="submit" value="검색">
    </td>
  </tr>
  </form>
</table>
</body>
</html>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->