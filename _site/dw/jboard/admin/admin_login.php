<?php
/* 새션시작 */
session_start();


/* 외부화일 */
include ("./include/admin.inc");

/* 설치된게시판인가? */
if(!file_exists("./login/admin.gdbm")) {
	Header("Location:./install.php");
	exit;
}

/* 로그인 체크 */
if(admin_chk_login()) {
	Header("Location:./index.php");
}
?>
<html>
<head>
<title>jboard :: 관리자 로그인</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td {  font-size: 9pt}
.b2 {  border-color: black black #333333; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px}
.b3 {  background-color: #F2F2F2; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px}
.b4 {  border-style: solid; border-top-width: 1px; border-right-width: 0px; border-bottom-width: 1px; border-left-width: 0px}
-->
</style>
<script>
<!--
/* 폼 입력 내용 체크 */
function chk_form()
{
	var F = document.admin_login_form;

	if(!F.admin_id.value.length) {
		alert('관리자 아이디를 입력하세요');
		F.admin_id.focus();
		return false;
	}
	if(!F.admin_pw.value.length) {
		alert('관리자 비밀번호를 입력하세요');
		F.admin_pw.focus();
		return false;
	}
	F.submit();
}
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" onLoad="admin_login_form.admin_id.focus();">
<p><form method="post" action="./admin_login_process.php?mode=login" name="admin_login_form">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" height="100%">
    <tr>
      <td>
        <table width="520" border="0" cellspacing="0" cellpadding="0" height="215" background="./img/in1bg.gif" align="center">
          <tr> 
            <td valign="top" height="33"><img src="./img/login.gif" width="520" height="44"></td>
          </tr>
          <tr> 
            <td height="100"><BR>
              <table width="191" border="0" cellspacing="1" cellpadding="1" align="center" height="58" class="b4">
                <tr bgcolor="#F7F7F7"> 
                  <td width="72" height="34"> 
                    <div align="center"><b>아이디</b></div>
                  </td>
                  <td width="112" height="34"> 
                    <div align="center"> 
                      <input type="text" name="admin_id" size="10" class="b2" onKeyPress="if(event.keyCode == 13) { chk_form(); }">
                    </div>
                  </td>
                </tr>
                <tr bgcolor="#F7F7F7"> 
                  <td width="72" height="34"> 
                    <div align="center"><b>비밀번호</b></div>
                  </td>
                  <td width="112" height="34"> 
                    <div align="center"> 
                      <input type="password" name="admin_pw" size="10" class="b2" onKeyPress="if(event.keyCode == 13) { chk_form(); }">
                    </div>
                  </td>
                </tr>
              </table>
              <br>
              <div> 
                <div align="center"> 
                  <input type="button" value="확인" class="b3" onClick="chk_form()"; name="button">
                  <input type="button" value="뒤로" class="b3" onClick="history.go(-1);" name="button">
                </div>
              </div>
            </td>
          </tr>
          <tr> 
            <td valign="bottom"><BR><img src="./img/in3.gif" width="520" height="53"></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
  </form>
</body>
</html>