<script language=javascript>
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

function useHTML(){
  sFRM = document.gwangpa_form.html
  sIMG = document.uHtml

	if ( sFRM.value == 'y' ) {
	  sFRM.value = '';
	  sIMG.src = 'img/sgi_chocolate/useHTML.gif';
	} else {
	  sFRM.value = 'y';
	  sIMG.src = 'img/sgi_chocolate/useHTML_chk.gif';
	}
}
-->
</script>
<link rel=stylesheet type='text/css' href='img/sgi_chocolate/color.css'>
<DIV ALIGN="{ALIGN}">
<table width="{B_WIDTH}" border=0 cellspacing=0 cellpadding=0>
  <form method="post" action="./?p=act&code={CODE}" enctype="multipart/form-data" name="gwangpa_form">
  <input type="hidden" name="mode" value="{MODE}">
  <input type="hidden" name="id" value="{ID}">
  <input type="hidden" name="depth" value="{DEPTH}">
  <input type="hidden" name="page" value="{PAGE}">
  <tr valign=top>
    <td align=right colspan=5><img src='img/sgi_chocolate/dummy.gif' width=1 height=15></td>
  </tr>
  <tr>
    <td align=left width=16><img src='img/sgi_chocolate/title_l.gif'></td>
    <td width=50% background='img/sgi_chocolate/title_bg.gif' align=left class=base><img src='img/sgi_chocolate/title_bg.gif'></td>
	<td class=base>
      <table border=0 cellspacing=0 cellpadding=0 background='img/sgi_chocolate/title_write_bg.gif'>
        <tr valign=top>
          <td align=left><img src='img/sgi_chocolate/title_write_l.gif'></td>
          <td align=center><img src='img/sgi_chocolate/dummy.gif' width=200 height=1>　</td>
          <td align=right><img src='img/sgi_chocolate/title_write_r.gif'></td>
        </tr>
      </table>
    </td>
    <td width="50%" background='img/sgi_chocolate/title_bg.gif' align=right class=base><img src='img/sgi_chocolate/title_bg.gif'></td>
    <td align=right width=16><img src='img/sgi_chocolate/title_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_chocolate/list_l.gif'><img src='img/sgi_chocolate/list_l.gif'></td>
    <td colspan=3 class=base>
      <table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td align=right width=100>제목</td>
          <td align=center width=30><img src='img/sgi_chocolate/vLine.gif'></td>
          <td align=left width='*'><input type=text size=40 name=subject class=flat style='width:85%' value="{SUBJECT}"></td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_chocolate/list_r.gif'><img src='img/sgi_chocolate/list_r.gif'></td>
  </tr>
  <tr valign=top>
    <td align=left><img src='img/sgi_chocolate/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_chocolate/line_bg.gif'><img src='img/sgi_chocolate/line_bg.gif'></td>
    <td align=right><img src='img/sgi_chocolate/line_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_chocolate/list_l.gif'><img src='img/sgi_chocolate/list_l.gif'></td>
    <td colspan=3 class=base>
      <table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td align=right width=100>성명</td>
          <td align=center width=30><img src='img/sgi_chocolate/vLine.gif'></td>
          <td align=left width='*'><input type=text size=40 name=name class=flat style='width:85%' value="{NAME}"></td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_chocolate/list_r.gif'><img src='img/sgi_chocolate/list_r.gif'></td>
  </tr>
  <tr valign=top>
    <td align=left><img src='img/sgi_chocolate/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_chocolate/line_bg.gif'><img src='img/sgi_chocolate/line_bg.gif'></td>
    <td align=right><img src='img/sgi_chocolate/line_r.gif'></td>
  </tr>
    <td align=left background='img/sgi_chocolate/list_l.gif'><img src='img/sgi_chocolate/list_l.gif'></td>
    <td colspan=3 class=base>
      <table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td align=right width=100>메일</td>
          <td align=center width=30><img src='img/sgi_chocolate/vLine.gif'></td>
          <td align=left width='*'><input type=text size=40 name=email class=flat style='width:85%' value="{EMAIL}"></td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_chocolate/list_r.gif'><img src='img/sgi_chocolate/list_r.gif'></td>
  </tr>
  <tr valign=top>
    <td align=left><img src='img/sgi_chocolate/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_chocolate/line_bg.gif'><img src='img/sgi_chocolate/line_bg.gif'></td>
    <td align=right><img src='img/sgi_chocolate/line_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_chocolate/list_l.gif'><img src='img/sgi_chocolate/list_l.gif'></td>
    <td colspan=3 class=base>
      <table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td align=right width=100>홈페이지</td>
          <td align=center width=30><img src='img/sgi_chocolate/vLine.gif'></td>
          <td align=left width='*'><input type=text size=40 name=url class=flat style='width:85%' value="{URL}"></td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_chocolate/list_r.gif'><img src='img/sgi_chocolate/list_r.gif'></td>
  </tr>
  <tr valign=top>
    <td align=left><img src='img/sgi_chocolate/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_chocolate/line_bg.gif'><img src='img/sgi_chocolate/line_bg.gif'></td>
    <td align=right><img src='img/sgi_chocolate/line_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_chocolate/list_l.gif'><img src='img/sgi_chocolate/list_l.gif'></td>
    <td colspan=3 class=base>
      <table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr>
        <td align=right width=100>비밀번호</td>
        <td align=center width=30><img src='img/sgi_chocolate/vLine.gif'></td>
        <td align=left width='*'><input type=password size=40 name=passwd class=flat style='width:95%'></td>
        <td align=left width=100>
          <select name="html">
          <option value=''>HTML 사용여부</option>
          <option value='n'>사용안함</option>
          <option value='br'>사용(줄바꿈허용)</option>
          <option value='y'>사용(줄바꿈무시)</option>
          </select>
          <!-- <img src='img/sgi_chocolate/useHTML_chk.gif' name=uHtml border=0 onClick="useHTML()" style="cursor: hand"><br> -->
        </td>
      </tr>
    </table>
    </td>
    <td align=right background='img/sgi_chocolate/list_r.gif'><img src='img/sgi_chocolate/list_r.gif'></td>
  </tr>
  <tr valign=top>
    <td align=left><img src='img/sgi_chocolate/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_chocolate/line_bg.gif'><img src='img/sgi_chocolate/line_bg.gif'></td>
    <td align=right><img src='img/sgi_chocolate/line_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_chocolate/list_l.gif'><img src='img/sgi_chocolate/list_l.gif'></td>
    <td colspan=3 align=center class=base>
      <textarea name=comment rows=15 cols=60 class=flat style='width:98%'>{COMMENT}</textarea>
	</td>
    <td align=right background='img/sgi_chocolate/list_r.gif'><img src='img/sgi_chocolate/list_r.gif'></td>
  </tr>
  <tr valign=top>
    <td align=left><img src='img/sgi_chocolate/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_chocolate/line_bg.gif'><img src='img/sgi_chocolate/line_bg.gif'></td>
    <td align=right><img src='img/sgi_chocolate/line_r.gif'></td>
  </tr>
  <!-- BEGIN DYNAMIC BLOCK: fileup -->
  <tr>
    <td align=left background='img/sgi_chocolate/list_l.gif'><img src='img/sgi_chocolate/list_l.gif'></td>
    <td colspan=3 class=base>
      <table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td align=right width=100>파일올리기</td>
          <td align=center width=30><img src='img/sgi_chocolate/vLine.gif'></td>
          <td align=left width='*'><input type=file size=48 name="{UPNAME}" class=flat style='width:85%'></td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_chocolate/list_r.gif'><img src='img/sgi_chocolate/list_r.gif'></td>
  </tr>
  <tr valign=top>
    <td align=left><img src='img/sgi_chocolate/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_chocolate/line_bg.gif'><img src='img/sgi_chocolate/line_bg.gif'></td>
    <td align=right><img src='img/sgi_chocolate/line_r.gif'></td>
  </tr>
  <!-- END DYNAMIC BLOCK: fileup -->
  <!-- BEGIN DYNAMIC BLOCK: sizeinfo -->
  <tr>
    <td align=left background='img/sgi_chocolate/list_l.gif'><img src='img/sgi_chocolate/list_l.gif'></td>
    <td colspan=3 class=base>
      <table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td align=right>최대 {SIZE}Bytes</td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_chocolate/list_r.gif'><img src='img/sgi_chocolate/list_r.gif'></td>
  </tr>
  <tr valign=top>
    <td align=left><img src='img/sgi_chocolate/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_chocolate/line_bg.gif'><img src='img/sgi_chocolate/line_bg.gif'></td>
    <td align=right><img src='img/sgi_chocolate/line_r.gif'></td>
  </tr>
  <!-- END DYNAMIC BLOCK: sizeinfo -->
  <tr>
    <td align=left background='img/sgi_chocolate/list_l.gif'><img src='img/sgi_chocolate/list_l.gif'></td>
	<td align=center colspan=3 class=base>
      <img src="./img/i-pack/{I_PACK}/save.gif" style="cursor:hand" onClick="chk_form();">
      <img src="./img/i-pack/{I_PACK}/cancel.gif" style="cursor:hand" onClick="history.go(-1);">
    </td>
    <td align=right background='img/sgi_chocolate/list_r.gif'><img src='img/sgi_chocolate/list_r.gif'></td>
  </tr>
  <tr valign=top>
    <td align=left><img src='img/sgi_chocolate/tail_l.gif'></td>
    <td colspan=3 background='img/sgi_chocolate/tail_bg.gif'></td>
    <td align=right><img src='img/sgi_chocolate/tail_r.gif'></td>
  </tr>
</form>
</table>
</DIV>