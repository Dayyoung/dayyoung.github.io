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


<DIV ALIGN="{ALIGN}">
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><BR><H4>{B_TITLE}</h4></td>
  </tr>
  <tr>
  <form method="post" action="./?p=act&code={CODE}" enctype="multipart/form-data" name="gwangpa_form">
  <input type="hidden" name="mode" value="{MODE}">
  <input type="hidden" name="id" value="{ID}">
  <input type="hidden" name="depth" value="{DEPTH}">
  <input type="hidden" name="page" value="{PAGE}">
    <td>
      <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#EEEEEE bordercolorlight=gray bordercolordark=#FFFFFF>
        <tr> 
          <td style=font-family:Arial;font-size:8pt;color:gray align=center nowrap><img src=/img/basic01/blank.gif height=3></td>
        </tr>
      </table>
      <br>
      <table width="550" border="0" cellspacing="1" cellpadding="0" align="center">
        <tr> 
          <td style=font-family:Matchworks;font-size:8pt align=center width="81" bgcolor="#F2F2F2"><img src=img/basic01/sub.gif></td>
          <td>
            &nbsp;<input type="text" name="subject" size="40" value="{SUBJECT}">
          </td>
        </tr>
        <tr> 
          <td style=font-family:Matchworks;font-size:8pt align=center width="81" bgcolor="#F2F2F2"><img src=img/basic01/name.gif></td>
          <td>
            &nbsp;<input type="text" name="name" size="12" value="{NAME}">
          </td>
        </tr>
        <tr> 
          <td style=font-family:Matchworks;font-size:8pt align=center width="81" bgcolor="#F2F2F2"><img src=img/basic01/mail.gif></td>
          <td>
            &nbsp;<input type="text" name="email" size="35" value="{EMAIL}">
          </td>
        </tr>
        <tr> 
          <td style=font-family:Matchworks;font-size:8pt align=center width="81" bgcolor="#F2F2F2"><img src=img/basic01/homep.gif></td>
          <td> 
            &nbsp;<input type="text" name="url" size="35" value="{URL}">
          </td>
        </tr>
        <tr> 
          <td style=font-family:Matchworks;font-size:8pt align=center width="81" bgcolor="#F2F2F2"><img src=img/basic01/passwd.gif></td>
          <td> 
          &nbsp;<input type="password" name="passwd" size="12">
          &nbsp;&nbsp;&nbsp;
          <select name="html">
          <option value=''>HTML 사용여부</option>
          <option value='n'>사용안함</option>
          <option value='br'>사용(줄바꿈허용)</option>
          <option value='y'>사용(줄바꿈무시)</option>
          </select>
          <!-- <input type="checkbox" name="html" value="y" style="border:0" {CHK_HTML}> HTML 사용 -->
          </td>
        </tr>
        <tr> 
          <td style=font-family:Matchworks;font-size:8pt align=center width="81" bgcolor="#F2F2F2"><img src=img/basic01/comment.gif></td>
          <td> 
            &nbsp;<textarea name="comment" cols="60" rows="15">{COMMENT}</textarea>
          </td>
        </tr>
        <!-- 게시판 설정상 파일첨부부분이 1개 이상이므로 다이나믹으로 처리 -->
        <!-- BEGIN DYNAMIC BLOCK: fileup -->
        <tr> 
          <td style=font-family:Matchworks;font-size:8pt align=center width="81" bgcolor="#F2F2F2"><img src=img/basic01/fileup.gif></td>
          <td> 
            &nbsp;<input type="file" name="{UPNAME}" size="48">
          </td>
        </tr>
        <!-- END DYNAMIC BLOCK: fileup -->
        <!-- BEGIN DYNAMIC BLOCK: sizeinfo -->
        <tr> 
          <td colspan="3" width="482"> 
            <div align="right">최대 {SIZE}Bytes</div>
          </td>
        </tr>
        <!-- END DYNAMIC BLOCK: sizeinfo -->
        <tr> 
          <td colspan="2" height="50"> 
            <div align="center">
              <img src="./img/i-pack/{I_PACK}/save.gif" style="cursor:hand" onClick="chk_form();">
              <img src="./img/i-pack/{I_PACK}/cancel.gif" style="cursor:hand" onClick="history.go(-1);">
            </div>
          </td>
        </tr>
      </table>
      <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#EEEEEE bordercolorlight=gray bordercolordark=#FFFFFF>
        <tr> 
          <td style=font-family:Arial;font-size:8pt;color:gray align=center nowrap><img src=/img/basic01/blank.gif height=1></td>
        </tr>
      </table>
    </td>
  </form>
  </tr>
</table>
</DIV>