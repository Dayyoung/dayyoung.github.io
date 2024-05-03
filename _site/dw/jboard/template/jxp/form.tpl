<!-- 폼태그와 힌드폼은 그대로 유지 해 주셔야 합니다 -->
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
  <form method="post" action="./?p=act&code={CODE}" enctype="multipart/form-data" name="gwangpa_form">
  <input type="hidden" name="mode" value="{MODE}">
  <input type="hidden" name="id" value="{ID}">
  <input type="hidden" name="depth" value="{DEPTH}">
  <input type="hidden" name="page" value="{PAGE}">
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="29" background="img/jxp/head_list01.gif"> 
            <div align="center"></div>
          </td>
          <td background="img/jxp/head_bg.gif">&nbsp;</td>
          <td width="26" background="img/jxp/head_bg.gif"> 
            <div align="right"><img src="img/jxp/head_list02.gif" width="25" height="33"></div>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td colspan="4" height="10"></td>
        </tr>
        <tr> 
          <td width="10" height="10"></td>
          <td width="114" bgcolor="F2F2F2"> 
            <div align="center">제목</div>
          </td>
          <td width="458" bgcolor="F2F2F2" height="24"> 
            <input type="text" name="subject" size="40" value="{SUBJECT}">
          </td>
          <td width="8"> 
            <div align="right"></div>
          </td>
        </tr>
        <tr> 
          <td width="10" height="13"></td>
          <td width="114" height="13" bgcolor="F2F2F2"> 
            <div align="center">이름</div>
          </td>
          <td width="458" height="24" bgcolor="F2F2F2"> 
            <input type="text" name="name" size="12" value="{NAME}">
          </td>
          <td width="8" height="13"></td>
        </tr>
        <tr> 
          <td width="10" height="24"></td>
          <td width="114" height="24" bgcolor="F2F2F2"> 
            <div align="center"> 이메일</div>
          </td>
          <td width="458" height="24" bgcolor="F2F2F2"> 
            <input type="text" name="email" size="35" value="{EMAIL}">
          </td>
          <td width="8" height="24"></td>
        </tr>
        <tr> 
          <td width="10"></td>
          <td width="114" bgcolor="F2F2F2"> 
            <div align="center">홈페이지</div>
          </td>
          <td width="458" bgcolor="F2F2F2" height="24"> 
            <input type="text" name="url" size="35" value="{URL}">
          </td>
          <td width="8"></td>
        </tr>
        <tr> 
          <td width="10"></td>
          <td width="114" bgcolor="F2F2F2"> 
            <div align="center">비밀번호</div>
          </td>
          <td width="458" bgcolor="F2F2F2" height="24"> 
            <input type="password" name="passwd" size="12">
            &nbsp;&nbsp;&nbsp;
            <select name="html">
            <option value=''>HTML 사용여부</option>
            <option value='n'>사용안함</option>
            <option value='br'>사용(줄바꿈허용)</option>
            <option value='y'>사용(줄바꿈무시)</option>
            </select>
            <!-- <input type="checkbox" name="html" value="y" style="border:0; background:#F2F2F2" {CHK_HTML}> HTML 사용 -->
          </td>
          <td width="8"></td>
        </tr>
        <tr> 
          <td width="10"></td>
          <td width="114" bgcolor="F2F2F2"> 
            <div align="center">내용</div>
          </td>
          <td width="458" bgcolor="F2F2F2"> 
            <textarea name="comment" cols="60" rows="15">{COMMENT}</textarea>
          </td>
          <td width="8"></td>
        </tr>
        <!-- BEGIN DYNAMIC BLOCK: fileup -->
        <tr> 
          <td width="10"></td>
          <td width="114" bgcolor="F2F2F2"> 
            <div align="center">파일올리기</div>
          </td>
          <td width="458" bgcolor="F2F2F2" height="24"> 
            <input type="file" name="{UPNAME}" size="48">
          </td>
          <td width="8"></td>
        </tr>
        <!-- END DYNAMIC BLOCK: fileup -->
        <!-- BEGIN DYNAMIC BLOCK: sizeinfo -->
        <tr><td height="5"></td></tr>
		<tr>
          <td colspan="3">
            <div align="right">최대 {SIZE}Bytes</div>
          </td>
          <td width="8"></td>
        <!-- END DYNAMIC BLOCK: sizeinfo -->
        <tr> 
          <td colspan="4" height="8"></td>
        </tr>
        <tr> 
          <td width="10"></td>
          <td width="114" height="3"><img src="img/jxp/blank.gif" width="3" height="3"></td>
          <td width="458" height="3"></td>
          <td width="8"></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/jxp/head_bg02.gif">
        <tr> 
          <td><img src="img/jxp/head_tail01.gif" width="36" height="39"></td>
          <td ></td>
          <td> 
            <div align="right"><img src="img/jxp/head_tail02.gif" width="25" height="39"></div>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td></td>
          <td>
            <div align="center">
              <img src="./img/i-pack/{I_PACK}/save.gif" style="cursor:hand" onClick="chk_form();">
              <img src="./img/i-pack/{I_PACK}/cancel.gif" style="cursor:hand" onClick="history.go(-1);">
            </div>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  </form>
</table>
</DIV>