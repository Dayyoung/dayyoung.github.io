<html>
<head>
<title>jboard :: 게시물관리</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td,body {  font-family: "돋움"; font-size: 9pt}
a:link,a:visited{text-decoration:none}
a:hover {text-decoration:underline}
INPUT,SELECT,TEXTAREA, CHECKBOX { border:1 solid #999999; background-color: #FFFFFF; color: #333333;}
-->
</style>
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

/* 의견글 삭제 */
function chk_com_del(code, id, seq)
{
	if(confirm('정말 삭제 하시겠습니까?')) {
		var F = document.comm_del_form;
		F.id.value = id;
		F.seq.value = seq;
		F.submit();
	} else {
		return false;
	}
}

/* 관리자 글 삭제 */
function chk_del(id)
{
	if(confirm('정말 삭제 하시겠습니까?')) {
		document.del_form.id.value = id;
		document.del_form.submit();
	} else {
		return false;
	}
}

/* 관리자 등록 거부 */
function chk_ban(ip)
{
	if(confirm('등록거부 하시겠습니까??\n\n등록거부를 하시면 해당 아이피로 글쓰기, 글수정, 글삭제가 거부 됩니다.\n\nIP Addr : '+ip+'\n\n"등록거부자 관리" 에서 추가로 관리 하실수 있습니다')) {
		document.ban_form.ip.value=ip;
		val = window.prompt('등록거부사유를 입력해 주세요','');
		document.ban_form.reason.value=val;
		document.ban_form.submit();
	} else {
		return false;
	}
}
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#333333" link="#333333" vlink="#333333" alink="#333333" topmargin="10" marginwidth="0" marginheight="0">
<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" height="35">
      <div align="center">
        <b>{BOARD_TITLE}</b>
      </div>
    </td>
  </tr>
  <!-- BEGIN DYNAMIC BLOCK: multiview_link -->
  <tr>
    <td colspan="2">
      {LINK}
    </td>
  </tr>
  <tr><td height="15"></td></tr>
  <!-- END DYNAMIC BLOCK: multiview_link -->
  <!-- BEGIN DYNAMIC BLOCK: body -->
  <tr height="10">
    <td>
      <table width="650" border="0" cellspacing="0" cellpadding="3">
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
        <tr bgcolor="#999999"><td height="1" colspan="2"></td></tr>
        <!-- BEGIN DYNAMIC BLOCK: show_hide_attache -->
        <tr><td colspan="2"><font size="-2" face="tahoma" style="cursor:hand" onClick="show_hide({L_ATTACHE});">attache</font></td></tr>
        <!-- END DYNAMIC BLOCK: show_hide_attache -->
        <tr><td colspan="2" height="5"></td></tr>
        <!-- 첨부화일 -->
        <tr id="{L_ATTACHE}" style="display:inline">
          <td colspan="2">
            <table width="100%" cellpadding="0" cellspacing="0">
              <!-- BEGIN DYNAMIC BLOCK: upload -->
              <tr bgcolor="#FFFFFF">
                <td width="80"><div align="right">{FILE_SEQ} : </div></td>
                <td>{FILE_UP}</td>
              </tr>
              <!-- END DYNAMIC BLOCK: upload -->
            </table>
          </td>
        </tr>
        <!-- 첨부화일 -->
        <tr><td colspan="2" height="5"></td></tr>
        <tr>
          <td colspan="2">{COMMENT}</td>
        </tr>
        <tr>
          <td colspan="2"><div align="right"><font size="-2">{DATE}</font></div></td>
        </tr>
        <tr><td height="3"></td></tr>
        <tr bgcolor="#999999"><td height="1" colspan="2"></td></tr>
        <tr>
          <td colspan="2"><div align="right">{NAV}</div></td>
        </tr>
        <tr>
          <td colspan="2" align="right">
            <font color="red">등록거부를 시키시면 해당글쓴곳의 아이피를 검사하여 해당 아이피의 글 등록, 수정, 삭제를 거부합니다</font>
          </td>
        </tr>
        <tr><td colspan="2" height="15"></td></tr>
        <tr>
          <td colspan="2">
            <!-- BEGIN DYNAMIC BLOCK: comment_form -->
            <table width="100%" cellpadding="3" cellspacing="0" border="0" align="right">
              <form method="post" action="./?p=act&code={C_CODE}" name="{FORM_NAME}">
              <input type="hidden" name="mode" value="comment">
              <input type="hidden" name="code" value="{C_CODE}">
              <input type="hidden" name="id" value="{C_ID}">
              <tr>
                <td width="60"></td>
                <td align="right">
                  의견글 : 
                  <input type="text" name="c_name" value="{COMMENT_NAME}" size="8">
                  <input type="text" name="c_comment" value="" size="35" onKeyPress="chk_submit(this.form)">
                  <input type="button" value="의견글등록" onClick="chk_comment_form(this.form)">
                </td>
              </tr>
              </form>
            </table>
            <!-- END DYNAMIC BLOCK: comment_form -->
          </td>
        </tr>
        <tr id="{L_COMMENT}" style="display:inline">
          <td colspan="2">
            <table width="100%" cellpadding="0" cellspacing="0" border="0" align="right">
              <!-- BEGIN DYNAMIC BLOCK: comment_body -->
              <tr>
                <td style="word-break:break-all">
                  {COMMENT_BODY} .. {COMMENT_NAME}
                </td>
                <td width="20">
                  {DEL_LINK}
                </td>
              </tr>
              <!-- END DYNAMIC BLOCK: comment_body -->
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr><td height="20"></td></tr>
  <!-- END DYNAMIC BLOCK: body -->
  <!-- BEGIN DYNAMIC BLOCK: multiview_link -->
  <tr>
    <td colspan="2" align="right">
      {LINK}
    </td>
  </tr>
  <tr><td height="15"></td></tr>
  <!-- END DYNAMIC BLOCK: multiview_link -->
</table>
</body>
</html>
<form name="comm_del_form" method="post" action="./?p=act&code={C_CODE}">
<input type="hidden" name="mode" value="com_del">
<input type="hidden" name="id">
<input type="hidden" name="seq">
</form>
<form name="del_form" method="post" action="./?p=act&code={C_CODE}">
<input type="hidden" name="mode" value="del">
<input type="hidden" name="id">
</form>
<form name="ban_form" method="post" action="./?p=act&code={C_CODE}">
<input type="hidden" name="mode" value="ban">
<input type="hidden" name="ip">
<input type="hidden" name="reason">
</form>