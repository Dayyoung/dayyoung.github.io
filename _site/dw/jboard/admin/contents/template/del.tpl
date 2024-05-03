<html>
<head>
<title>jboard :: 게시물관리</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td {  font-family: "돋움"; font-size: 9pt}
a:link,a:visited{text-decoration:none}
a:hover {text-decoration:underline}
INPUT,SELECT,TEXTAREA { border:1 solid #999999; background-color: #FFFFFF; color: #333333; }
-->
</style>
<script>
<!--
//
// 페이지 로딩시 포커스 이동
//
function move_focus()
{
	document.del_form.passwd.focus();
}


//
// 폼 전송시 입력사항 체크
//
function chk_form()
{
	var f = document.del_form;

	if(!f.passwd.value.length) {
		alert('비밀번호를 입력하세요!!!');
		f.passwd.focus();
		return false;
	} else {
		f.submit();
	}
}
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#333333" link="#333333" vlink="#333333" alink="#333333" topmargin="10" marginwidth="0" marginheight="0" onLoad="move_focus();">
<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr height="10">
    <td>
      <table width="550" border="0" cellspacing="0" cellpadding="3" align="right">
        <tr>
          <td colspan="2" height="35">
            <div align="center">
              <b>{BOARD_TITLE}</b>
            </div>
          </td>
        </tr>
        <tr bgcolor="#999999"><td height="2" colspan="2"></td></tr>
        <tr><td height="1"></td></tr>
        <tr bgcolor="#999999"><td height="1" colspan="2"></td></tr>
        <tr><td height="1"></td></tr>
        <tr bgcolor="#F7F5F5">
          <td width="80"><div align="right">글제목</div></td>
          <td width="470"><B>{SUBJECT}</B></td>
        </tr>
        <tr bgcolor="#F7F5F5">
          <td width="80"><div align="right">글쓴이</div></td>
          <td>{NAME} {EMAIL}</td>
        </tr>
        <tr bgcolor="#F7F5F5">
          <td width="80"><div align="right">홈페이지</div></td>
          <td>{URL}</td>
        </tr>
        <tr><td height="5"></td></tr>
        <tr>
          <td colspan="2">{COMMENT}</td>
        </tr>
        <tr>
          <td colspan="2"><div align="right"><font size="-2">{DATE}</font></div></td>
        </tr>
        <tr><td height="3"></td></tr>
        <tr bgcolor="#999999"><td height="1" colspan="2"></td></tr>
        <tr>
          <form method="post" action="./?p=act&code={CODE}" name="del_form">
            <input type="hidden" name="mode" value="del">
            <input type="hidden" name="id" value="{ID}">
            <td colspan="2">
              <div align="right">
                비밀번호입력 : <input type="password" name="passwd" size="8"> <input type="button" value="삭제" onClick="chk_form();">
              </div>
            </td>
          </form>
        </tr>
        <tr><td height="30"></td></tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
