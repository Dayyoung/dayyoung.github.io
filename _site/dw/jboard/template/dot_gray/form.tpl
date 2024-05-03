<script>
<!--
var process = false;
//
// 입력내용 체크
//
function chk_form()
{
	if(process) {
		alert('처리중입니다!!');
		return false;
	} else {
		var f = document.gwangpa_form;

		if(!f.subject.value.length) {
			alert('제목을 입력해 주세요');
			f.subject.focus();
			return false;
		}
		if(!f.name.value.length) {
			alert('이름을 입력해 주세요');
			f.name.focus();
			return false;
		}
		if(!f.passwd.value.length) {
			alert('비밀번호를 입력해 주세요');
			f.passwd.focus();
			return false;
		}
		if(!f.comment.value.length) {
			alert('내용을 입력해 주세요');
			f.comment.focus();
			return false;
		}
		process = true;	
		f.submit();
	}
}


//
// OnLoad 퍼커스 이동
//
function move_focus()
{
	document.gwangpa_form.subject.focus();
}
-->
</script>

<DIV align="{ALIGN}">
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="24">
        <tr> 
          <td align="left" valign="bottom"></td>
          <td align="right" valign="bottom"><img src="img/dot_gray/img_04.gif" width="165" height="57"></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" height="28">
        <tr>
          <td bgcolor="#FFFFFF" align="center" valign="middle">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="464646" height="26">
              <tr align="center"> 
                <td align="right" valign="top"><img src="img/dot_gray/img_06.gif" width="147" height="24"></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000">
        <form method="post" action="./?p=act&code={CODE}" enctype="multipart/form-data" name="gwangpa_form">
        <input type="hidden" name="mode" value="{MODE}">
        <input type="hidden" name="id" value="{ID}">
        <input type="hidden" name="depth" value="{DEPTH}">
        <input type="hidden" name="page" value="{PAGE}">
        <tr>
          <td bgcolor="#FFFFFF" align="center" valign="middle"> 
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr> 
                <td width="133" align="left" bgcolor="EDEDED">
                  <font size="2">&nbsp;&nbsp;&nbsp;&nbsp<img src="img/dot_gray/arrow.gif" width="8" height="9" align="absmiddle"> 제 목 </font></td>
                <td valign="middle" colspan="2"> 
                  <input type="text" name="subject" size="45" value="{SUBJECT}">
                </td>
              </tr>
              <tr> 
                <td width="133" align="left" bgcolor="EDEDED">
                  <font size="2">&nbsp&nbsp&nbsp&nbsp<img src="img/dot_gray/arrow.gif" width="8" height="9" align="absmiddle"> 이 름 </font></td>
                <td valign="middle" colspan="2">
                  <input type="text" name="name" size="20" value="{NAME}">
                </td>
              </tr>
              <tr> 
                <td width="133" align="left" bgcolor="EDEDED">
                  <font size="2">&nbsp&nbsp&nbsp&nbsp<img src="img/dot_gray/arrow.gif" width="8" height="9" align="absmiddle"> 메 일 </font></td>
                <td valign="middle" colspan="2">
                  <input type="text" name="email" size="40" value="{EMAIL}">
                </td>
              </tr>
              <tr> 
                <td width="133" align="left" bgcolor="EDEDED">
                  <font size="2">&nbsp&nbsp&nbsp&nbsp<img src="img/dot_gray/arrow.gif" width="8" height="9" align="absmiddle"> 홈페이지 </font></td>
                <td valign="middle" colspan="2">
                  <input type="text" name="url" size="40" value="{URL}">
                </td>
              </tr>
              <tr> 
                <td width="133" align="left" bgcolor="EDEDED">
                  <font size="2">&nbsp&nbsp&nbsp&nbsp<img src="img/dot_gray/arrow.gif" width="8" height="9" align="absmiddle"> 비밀번호 </font></td>
                <td valign="middle" width="210">
                  <input type="password" name="passwd" size="20">
                </td>
                <td valign="middle" width="401">
                  <select name="html">
                  <option value=''>HTML 사용여부</option>
                  <option value='n'>사용안함</option>
                  <option value='br'>사용(줄바꿈허용)</option>
                  <option value='y'>사용(줄바꿈무시)</option>
                  </select>
                  <!-- <font size="2"><input type="checkbox" name="html" value="y" style="border:0" {CHK_HTML}> HTML 사용</font> -->
                </td>
              </tr>
              <tr> 
                <td width="133" align="left" bgcolor="EDEDED">
                  <font size="2">&nbsp&nbsp&nbsp&nbsp<img src="img/dot_gray/arrow.gif" width="8" height="9" align="absmiddle"> 내 용 </font></td>
                <td colspan="2" valign="bottom">
                  <textarea name="comment" wrap="VIRTUAL" cols="75" rows="18">{COMMENT}</textarea>
                </td>
              </tr>
              <!-- BEGIN DYNAMIC BLOCK: fileup -->
              <tr> 
                <td width="133" align="left" bgcolor="EDEDED">
                  <font size="2">&nbsp&nbsp&nbsp&nbsp<img src="img/dot_gray/arrow.gif" width="8" height="9" align="absmiddle"> 첨부화일 </font></td>
                <td colspan="2" valign="bottom">
                  <input type="file" name="{UPNAME}" size="60">
                </td>
              </tr>
              <!-- END DYNAMIC BLOCK: fileup -->
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="464646" height="24">
              <tr> 
                <td align="center" valign="middle">
                  <table width="150" border="0" cellspacing="0" cellpadding="0">
                    <tr align="center"> 
                      <td align="left"><img src="./img/i-pack/{I_PACK}/save.gif" style="cursor:hand" onClick="chk_form();"></td>
                      <td align="right"><img src="./img/i-pack/{I_PACK}/cancel.gif" style="cursor:hand" onClick="history.go(-1);"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        </form>
      </table>
    </td>
  </tr>
</table>
</DIV>
<!-- BEGIN DYNAMIC BLOCK: sizeinfo -->
<!-- END DYNAMIC BLOCK: sizeinfo -->