<link rel='stylesheet' type='text/css' href='img/snowy/main.css'>
<script language=javascript src='img/snowy/main.js'></script>
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
<table width="{B_WIDTH}" border=0 cellpadding=0 cellspacing=0>
  <tr>
    <td width=100%>
      <table width=100% border=0 cellpadding=0 cellspacing=0 background=img/snowy/title_bg.gif>
        <tr>
          <td align=left width=150 valign=bottom><img src=img/snowy/title1i.gif></td>
          <td align=right width='*' valign=bottom>
            <br><font class=rTitle>{B_TITLE}</font>
            <img src=img/snowy/title_r.gif align=absmiddle><br>
          </td>
        </tr>
      </table>
      <table width=100% border=0 cellpadding=0 cellspacing=0>
        <tr>
          <td width=3 background="img/snowy/bg_l.gif"><img src=img/snowy/dummy.gif width=3></td>
          <td width=99% align=center class=c4>
            <table width=100% border=0 cellpadding=0 cellspacing=0>
              <form method="post" action="./?p=act&code={CODE}" enctype="multipart/form-data" name="gwangpa_form">
              <input type="hidden" name="mode" value="{MODE}">
              <input type="hidden" name="id" value="{ID}">
              <input type="hidden" name="depth" value="{DEPTH}">
              <input type="hidden" name="page" value="{PAGE}">
              <tr>
                <td background=img/snowy/line.gif><img src=img/snowy/dummy.gif></td>
              </tr>
              <tr>
                <td align=center><br>
                  <table border=0 cellspacing=0 cellpadding=0>
                    <tr>
                      <td colspan=4 background=img/snowy/line2.gif><img src=img/snowy/dummy.gif width=1 height=8></td>
                    </tr>
                    <tr>
                      <td width=80>　 이 　 름</td>
                      <td colspan="3"><input type=text name=name size=8 maxlength=12 style=width:150px value='{NAME}'></td>
                    </tr>
                    <tr><td colspan=4 background=img/snowy/line2.gif><img src=img/snowy/dummy.gif width=1 height=8></td></tr>
                    <tr>
                      <td width=80>　 비밀번호</td>
                      <td colspan="3">
                        <input type=password name=passwd size=8 maxlength=12 style=width:100px value=''>
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
                    <tr><td colspan=4 background=img/snowy/line2.gif><img src=img/snowy/dummy.gif width=1 height=8></td></tr>
                    <tr>
                      <td>　 메 　 일</td>
                      <td colspan=3><input type=text name=email size=32 maxlength=50 style=width:450px value='{EMAIL}'></td>
                    </tr>
                    <tr>
                      <td colspan=4 background=img/snowy/line2.gif><img src=img/snowy/dummy.gif width=1 height=8></td>
                    </tr>
                    <tr>
                      <td>　 제 　 목</td>
                      <td colspan=3><input type=text name=subject size=32 maxlength=50 style=width:450px value='{SUBJECT}'></td>
                    </tr>
                    <tr><td colspan=4 background=img/snowy/line2.gif><img src=img/snowy/dummy.gif width=1 height=8></td></tr>
                    <tr>
                      <td>　 내 　 용</td>
                      <td colspan=3><textarea name=comment cols=34 rows=10 style=width:450px wrap=virtual>{COMMENT}</textarea></td>
                    </tr>
                    <tr><td colspan=4 background=img/snowy/line2.gif><img src=img/snowy/dummy.gif width=1 height=8></td></tr>
                    <!-- BEGIN DYNAMIC BLOCK: fileup -->
                    <tr>
                      <td>　 파일전송</td>
                      <td colspan=3><input type=file name="{UPNAME}" size=24  style=width:450px></td>
                    </tr>
                    <tr><td colspan=4 background=img/snowy/line2.gif><img src=img/snowy/dummy.gif width=1 height=8></td></tr>
                    <!-- END DYNAMIC BLOCK: fileup -->
                  </table><br>
                </td>
              </tr>
              </form>
            </table>
          </td>
         <td width=4 background=img/snowy/bg_r.gif><img src=img/snowy/dummy.gif width=4></td>
       </tr>
       <tr>
         <td width=3><img src=img/snowy/bg_l.gif></td>
         <td width=99% background=img/snowy/line.gif><img src=img/snowy/dummy.gif width=1></td>
         <td width=4><img src=img/snowy/bg_r.gif></td>
       </tr>
     </table>
     <table width=100% border=0 cellpadding=0 cellspacing=0 background=img/snowy/btn_bg.gif>
       <tr>
         <td align=left width=23><img src=img/snowy/btn_l.gif></td>
         <td align=right background=img/snowy/btn_bg.gif>
           <img src="./img/i-pack/{I_PACK}/save.gif" style="cursor:hand" onClick="chk_form();">
           <img src="./img/i-pack/{I_PACK}/cancel.gif" style="cursor:hand" onClick="history.go(-1);">
         </td>
         <td align=right width=25><img src=img/snowy/btn_r.gif></td>
       </tr>
     </table>
   </td>
  </tr>
</table>
</DIV>
<!-- BEGIN DYNAMIC BLOCK: sizeinfo -->
<!-- END DYNAMIC BLOCK: sizeinfo -->