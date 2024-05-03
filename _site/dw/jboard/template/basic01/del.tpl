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
<DIV ALIGN="{ALIGN}">
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0">
<form method="post" action="./?p=act&code={CODE}" name="del_form">
<input type="hidden" name="mode" value="del">
<input type="hidden" name="id" value="{ID}">
<!-- 삭제 폼은 form 태그 안에 감싸줘야 합니다 -->
<!-- form 태그와 히든태그는 그대로 유지 하여 주세요 -->
  <tr>
    <td height="297">
      <table width="427" border="0" cellspacing="0" cellpadding="0" height="146" background="img/basic02/del-bg.gif" align="center">
        <tr> 
          <td> 
            <table width="400" border="0" cellspacing="0" cellpadding="0" align="center" height="140">
              <tr> 
                <td height="39" colspan="4"> 
                  <div align="left"><img src="img/basic02/del-icon.gif" width="126" height="39" border="0"></div>
                </td>
              </tr>
              <tr> 
                <td height="16" colspan="4">글을 삭제하려 합니다. 비밀번호를 입력하여 주십시오.</td>
              </tr>
              <tr> 
                <td height="13" colspan="4"> 
                  <div align="center"> 
                    <input type="password" name="passwd" size="16">
                  </div>
                </td>
              </tr>
              <tr> 
                <td height="14" width="130"></td>
                <td height="14" width="72"> 
                  <div align="center"><a href="javascript:history.go(-1)"><img src="img/i-pack/{ICON_PACK}/list.gif" border="0"></a></div>
                </td>
                <td height="14" width="63"> 
                  <div align="center"><img src="img/i-pack/{ICON_PACK}/del.gif" border=0 style="cursor:hand" value="삭제" onClick="chk_form();"></div>
                </td>
                <td height="14" width="135"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</form>
</table>
</DIV>