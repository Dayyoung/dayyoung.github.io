<script>
<!--
/* 첨부화일이 있을 경우 첨부화일 TR을 숨기고 보이게 해 주는 함수 */
function show_hide(obj)
{
	var status = obj.style.display;

	if(status == "none") {
		obj.style.display = "inline";
	} else {
		obj.style.display = "none";
	}
}

/* 의견글 등록시 체크 */
function chk_comment_form(form_name)
{

	var form = form_name;

	if(!form.c_name.value.length) {
		alert('의견글 이름을 입력해 주세요!');
		form.c_name.focus();
		return false;
	}
	if(!form.c_comment.value.length) {
		alert('의견글 내용을 입력해 주세요!');
		form.c_comment.focus();
		return false;
	}
	if(!form.c_passwd.value.length) {
		alert('의견글 비밀번호를 입력해 주세요!!');
		form.c_passwd.focus();
		return false;
	}
	form.submit();
}

/* 의견글 엔터 Submit */
function chk_submit(form_name)
{
	var Code = event.keyCode;
	if(Code == 13) {
		chk_comment_form(form_name);
	} else {
		return false;
	}
}
-->
</script>
<link rel=stylesheet type='text/css' href='img/sgi_sky/color.css'>
<DIV align="{ALIGN}">
<table width="{B_WIDTH}" border=0 cellspacing=0 cellpadding=0>
  <tr>
    <td align=right colspan=5><img src='img/sgi_sky/dummy.gif' width=1 height=15></td>
  </tr>
  <tr>
    <td colspan="5" height="35" align="center">
      <BR><H4>{B_TITLE}</h4>
    </td>
  </tr>
  <!-- BEGIN DYNAMIC BLOCK: body -->
  <tr>
    <td align=left width=16><img src='img/sgi_sky/title_l.gif'></td>
    <td width=50% background='img/sgi_sky/title_bg.gif' align=left class=base><img src='img/sgi_sky/title_bg.gif'></td>
    <td class=base>
      <table border=0 cellspacing=0 cellpadding=0 background='img/sgi_sky/title_read_bg.gif'>
        <tr valign=top>
          <td align=left><img src='img/sgi_sky/title_read_l.gif'></td>
          <td align=center><img src='img/sgi_sky/dummy.gif' width=1 height=12><br>
            <nobr>{SUBJECT}</nobr>
          </td>
          <td align=right><img src='img/sgi_sky/title_read_r.gif'></td>
        </tr>
      </table>
    </td>
    <td width=50% background='img/sgi_sky/title_bg.gif' align=right class=base><img src='img/sgi_sky/title_bg.gif'></td>
    <td align=right width=16><img src='img/sgi_sky/title_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td colspan=3 class=base>
      <table border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td align=right width=100>성명</td>
          <td align=center width=30><img src='img/sgi_sky/vLine.gif'></td>
          <td align=left width='*'>{NAME} {EMAIL}</td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <tr>
    <td align=left><img src='img/sgi_sky/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_sky/line_bg.gif'><img src='img/sgi_sky/line_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/line_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td colspan=3 class=base>
      <table border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td align=right width=100>홈페이지</td>
          <td align=center width=30><img src='img/sgi_sky/vLine.gif'></td>
          <td align=left width='*'>{URL}</td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <tr>
    <td align=left><img src='img/sgi_sky/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_sky/line_bg.gif'><img src='img/sgi_sky/line_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/line_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td colspan=3 class=base>
      <table border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td align=right width=100 valign="top">첨부파일</td>
          <td align=center width=30><img src='img/sgi_sky/vLine.gif'></td>
          <td align=left width='*'>
            <table width="100%" cellpadding="1" cellspacing="0" border="0">
              <!-- BEGIN DYNAMIC BLOCK: upload -->
              <tr>
                <td>{FILE_UP}</td>
              </tr>
              <!-- END DYNAMIC BLOCK: upload -->
            </table>
          </td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <tr>
    <td align=left><img src='img/sgi_sky/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_sky/line_bg.gif'><img src='img/sgi_sky/line_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/line_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td colspan=3 align=center class=base>
      <table width=98% border=0 cellspacing=1 cellpadding=10 class=boxLn>
        <tr>
          <td align=left class=boxCl>
            {COMMENT}
            <BR><BR>
            <div style="word-break:break-all; font-size:8pt" align="right">{DATE}</div>
          </td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <tr>
    <td align=left><img src='img/sgi_sky/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_sky/line_bg.gif'><img src='img/sgi_sky/line_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/line_r.gif'></td>
  </tr>
  <!-- BEGIN DYNAMIC BLOCK: comment_form -->
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td colspan=3 align=center class=base>
      <table width=98% border=0 cellspacing=1 cellpadding=3 class=boxLn>
        <tr>
          <td class=boxCl align=center>
            <table width=100% border=0 cellspacing=0 cellpadding=0>
              <form method="post" action="./?p=act&code={C_CODE}" name="{FORM_NAME}">
              <input type="hidden" name="mode" value="comment">
              <input type="hidden" name="code" value="{C_CODE}">
              <input type="hidden" name="id" value="{C_ID}">
              <tr>
                <td width=75>이름</td>
                <td width='*'>의견글</td>
                <td width=110>비밀번호</td>
              </tr>
              <tr>
                <td><input type=text name=c_name value='{COMMENT_NAME}' size=8 class=flat2></td>
                <td><input type=text name=c_comment value='' size=30 class=flat2 style='width:98%'></td>
                <td>
                  <input type=password name=c_passwd size=8 class=flat2 onKeyPress='chk_submit(this.form)'>
                  <input type=button value=등록 onClick='chk_comment_form(this.form)' class=flat2 style='height:18'>
                </td>
              </tr>
              </form>
            </table>
          </td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <!-- END DYNAMIC BLOCK: comment_form -->
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td colspan=3 align=center class=base>
      <table width="98%" cellpadding="3" cellspacing="1" border="0" boxLn>
        <tr>
          <td>
            <!-- 의견글 출력 -->
            <table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
              <!-- BEGIN DYNAMIC BLOCK: comment_body -->
              <tr>
                <td width="80" style="word-break:break-all"><b>{COMMENT_NAME}</b></td>
                <td style="word-break:break-all">{COMMENT_BODY}</td>
                <td width="20"><div align="right">{COMMENT_DEL}</div></td>
              </tr>
              <!-- END DYNAMIC BLOCK: comment_body -->
            </table>
            <!-- 의견글 출력 끝 -->
          </td>
        </tr>
      </table>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <!-- 이전글 다음글 -->
  <!-- BEGIN DYNAMIC BLOCK: prenext -->
  <tr>
    <td align=left><img src='img/sgi_sky/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_sky/line_bg.gif'><img src='img/sgi_sky/line_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/line_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td colspan=3 class=base>
      <table border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td align=right width=50>이전글</td>
          <td align=center width=30><img src='img/sgi_sky/vLine.gif'></td>
          <td align=left width='*'>{PREV_ARTICLE}</a></td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <tr>
    <td align=left><img src='img/sgi_sky/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_sky/line_bg.gif'><img src='img/sgi_sky/line_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/line_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td colspan=3 class=base>
      <table border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td align=right width=50>이전글</td>
          <td align=center width=30><img src='img/sgi_sky/vLine.gif'></td>
          <td align=left width='*'>{NEXT_ARTICLE}</td>
        </tr>
      </table>
    </td>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <tr>
    <td align=left><img src='img/sgi_sky/line_l.gif'></td>
    <td align=left colspan=3 background='img/sgi_sky/line_bg.gif'><img src='img/sgi_sky/line_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/line_r.gif'></td>
  </tr>
  <!-- END DYNAMIC BLOCK: prenext -->
  <!-- 이전글 다음글 -->
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td align=center colspan=3 class=base>
      {LINK_LIST}{LINK_MODIFY}{LINK_DEL}{LINK_PREV}{LINK_NEXT}{LINK_REPLY}{LINK_WRITE}
    </td>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <tr>
    <td align=left><img src='img/sgi_sky/tail_l.gif'></td>
    <td colspan=3 background='img/sgi_sky/tail_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/tail_r.gif'></td>
  </tr>
  <tr><td height="30"></td></tr>
  <!-- END DYNAMIC BLOCK: body -->
</table>
</DIV>