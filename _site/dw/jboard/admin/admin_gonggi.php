<?php
@header('Cache-Control: no-store, no-cache, must-revalidate');
@header('Cache-Control: pre-check=0, post-check=0, max-age=0');
include ("./include/control.inc");
?>
<html>
<head>
<title>::공지사항 작성하기::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td {  font-size: 8pt}
.b2 {  border: #999999; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; background-color: #F6F6F6}
-->
</style>
<script>
<!--
function chk_form()
{
	var F = document.form;

	if(!F.subject.value) {
		alert('제목을 입력하세요');
		F.subject.focus();
		return false;
	}

	if(!F.comment.value) {
		alert('내용을 입력하세요');
		F.comment.focus();
		return false;
	}

	if(!F.name.value) {
		alert('글쓴이를 입력하세요');
		F.name.focus();
		return false;
	}

	F.submit();
}

function size()
{
	window.resizeTo(720, 440);
}
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" onLoad="size();">
  <table width="652" border="0" cellspacing="0" cellpadding="0" align="center">
  <form method="post" action="./contents/?p=act&code=<?=$HTTP_GET_VARS[code]?>" name="form">
  <input type="hidden" name="mode" value="new">
  <input type="hidden" name="gonggi" value="yes">
  <input type="hidden" name="passwd" value="pass">
    <tr> 
      <td valign="top"> 
        <p></p>
        <table width="620" border="1" cellspacing="1" cellpadding="1" bgcolor="#999999" align="center" bordercolor="#FFFFFF" align="center">
          <tr bgcolor="#EEEEFF"> 
            <td colspan="2" height="28"> 
              <p align="center">::: 공지사항 쓰기 :::</p>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" bgcolor="#FEFCF5" height="28"> 
              <div align="center">제 목</div>
            </td>
            <td height="23">&nbsp;
              <input type="text" name="subject" size="60" class="b2" value="">
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" bgcolor="#FEFCF5" height="28"> 
              <div align="center">내 용</div>
            </td>
            <td height="23">&nbsp;
              <textarea name="comment" cols="59" rows="15" class="b2"></textarea>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" bgcolor="#FEFCF5" height="28"> 
              <div align="center">글쓴이</div>
            </td>
            <td height="23">&nbsp;
              <input type="text" name="name" size="35" class="b2" value="">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="html">
              <option value=''>HTML 사용여부</option>
              <option value='n'>사용안함</option>
              <option value='br'>사용(줄바꿈허용)</option>
              <option value='y'>사용(줄바꿈무시)</option>
              </select>
              <!-- <input type="checkbox" name="html" value="y" checked>HTML 사용 -->
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td colspan="2" bgcolor="#FEFCF5" height="28"> 
              <div align="center"><input type="button" value="확인" onClick="chk_form();" class="b2"></div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    </form>
  </table>
</body>
</html>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->