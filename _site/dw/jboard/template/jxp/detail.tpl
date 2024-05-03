<!-- 자바스크립트는 고대로 유지 해 주세요 -->
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

<style type="text/css">
<!--
td {  font-size: 9pt; line-height: 15pt}
.box {  border: 1px #CCCCCC solid; background-color: #FFFFFF;  font-size: 9pt}
-->
</style>

<DIV align="{ALIGN}">
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" height="35">
      <div align="center">
        <BR><H4>{B_TITLE}</h4>
      </div>
    </td>
  </tr>
  <!-- 다이나믹[body] :: 여러글 보기시 반복이 되는 부분입니다 -->

  <!-- BEGIN DYNAMIC BLOCK: body -->
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
          <td width="10"></td>
          <td width="114" bgcolor="F2F2F2"> 
            <div align="center">제목</div>
          </td>
          <td bgcolor="F2F2F2" height="24"><B>{SUBJECT}</B></td>
          <td width="7" height="8"> 
            <div align="right"></div>
          </td>
        </tr>
        <tr> 
          <td width="10" height="13"></td>
          <td width="114" height="13" bgcolor="F2F2F2"> 
            <div align="center">이름</div>
          </td>
          <td height="24" bgcolor="F2F2F2"><B>{NAME} {EMAIL}</B></td>
          <td width="8" height="13"></td>
        </tr>
        <tr> 
          <td width="10"></td>
          <td width="114" bgcolor="F2F2F2"> 
            <div align="center">홈페이지</div>
          </td>
          <td bgcolor="F2F2F2" height="24"><B>{URL}</B></td>
          <td width="8"></td>
        </tr>
        <tr> 
          <td width="10"></td>
          <td width="114" bgcolor="F2F2F2" valign="top"> 
            <div align="center">첨부화일</div>
          </td>
          <td bgcolor="F2F2F2" height="24">
            <table width="100%" cellpadding="2" cellspacing="0" border="0">
              <!-- BEGIN DYNAMIC BLOCK: upload -->
              <tr>
                <td>{FILE_SEQ} : {FILE_UP}</td>
              </tr>
              <!-- END DYNAMIC BLOCK: upload -->
            </table>
          </td>
          <td width="8"></td>
        </tr>
        <tr><td height="10" colspan="4"></td></tr>
        <tr> 
          <td width="10"></td>
          <td colspan="2" style="word-break:break-all"> 
{COMMENT}
          </td>
          <td width="8"></td>
        </tr>
        <tr>
          <td colspan="3" align="right"><font color="#999999" style="font-size:8pt">{DATE}</font></td>
          <td width="8"></td>
        </tr>
        <tr><td height="10" colspan="4"></td></tr>
        <!-- BEGIN DYNAMIC BLOCK: comment_form -->
        <tr>
        <form method="post" action="./?p=act&code={C_CODE}" name="{FORM_NAME}">
        <input type="hidden" name="mode" value="comment">
        <input type="hidden" name="code" value="{C_CODE}">
        <input type="hidden" name="id" value="{C_ID}">  
          <td colspan="3">
            <table width="500" border="0" cellspacing="0" cellpadding="3" bgcolor="F2F2F2" align="right">
              <tr> 
                <td width="26%">이 름</td>
                <td width="48%">내 용</td>
                <td width="26%">비밀번호</td>
              </tr>
              <tr>
                <td width="26%"> 
                  <input type="text" name="c_name" size="15" value="{COMMENT_NAME}">
                </td>
                <td width="48%"> 
                  <input type="text" name="c_comment" size="35" value="">
                </td>
                <td width="26%"> 
                  <input type="password" name="c_passwd" size="8" onKeyPress="chk_submit(this.form)">
                  <input type="button" name="Submit" value="등록" onClick="chk_comment_form(this.form)" style="height:18">
                </td>
              </tr>
            </table>
          </td>
          <td width="8"></td>
        </form>
        </tr>
        <tr><td colspan="4" height="20"></td></tr>
        <!-- END DYNAMIC BLOCK: comment_form -->
        <tr>
          <td colspan="3">
            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="right">
              <!-- BEGIN DYNAMIC BLOCK: comment_body -->
              <tr> 
                <td width="80" style="word-break:break-all"><b>{COMMENT_NAME}</b></td>
                <td style="word-break:break-all">{COMMENT_BODY}</td>
                <td width="20"><div align="right">{COMMENT_DEL}</div></td>
              </tr>
              <!-- END DYNAMIC BLOCK: comment_body -->
            </table>
          </td>
          <td width="8"></td>
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
          <td></td>
          <td>
            <div align="right"><img src="img/jxp/head_tail02.gif" width="25" height="39"></div>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="10"></td>
          <td> 
            <div align="left">{LINK_LIST}{LINK_MODIFY}{LINK_DEL}{LINK_PREV}{LINK_NEXT}</div>
          </td>
          <td>
            <div align="right">{LINK_REPLY}{LINK_WRITE}</div>
          </td>
          <td width="10"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr><td height="50"></td></tr>
  <!-- END DYNAMIC BLOCK: body -->
</table>
<!-- BEGIN DYNAMIC BLOCK: prenext -->
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="0298F7"> 
    <td colspan="3" height="3"><img src="img/web4/blank.gif" width="3" height="3"></td>
  </tr>
  <tr bgcolor="#666666"> 
    <td colspan="3" height="1" bgcolor="#666666"><img src="img/web4/blank.gif" width="1" height="1"></td>
  </tr>
</table>
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="40"> 
      <div align="center">이전</div>
    </td>
    <td width="1" bgcolor="#666666"><img src="img/web4/blank.gif" width="1" height="1"></td>
    <td height="20">&nbsp;&nbsp;{PREV_ARTICLE}</td>
    <td width="1" bgcolor="#666666"><img src="img/web4/blank.gif" width="1" height="1"></td>
  </tr>
  <tr bgcolor="#666666"> 
    <td colspan="5" height="1"> 
      <div align="center"><img src="img/web4/blank.gif" width="1" height="1"></div>
    </td>
  </tr>
  <tr> 
    <td width="32"> 
      <div align="center">다음</div>
    </td>
    <td width="1" bgcolor="#666666"><img src="img/web4/blank.gif" width="1" height="1"></td>
    <td height="20">&nbsp;&nbsp;{NEXT_ARTICLE}</td>
    <td width="1" bgcolor="#666666"><img src="img/web4/blank.gif" width="1" height="1"></td>
  </tr>
</table>
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0">
  <tr bgcolor="0298F7">
    <td colspan="3" height="1" bgcolor="#666666"><img src="img/web4/blank.gif" width="1" height="1"></td>
  </tr>
  <tr bgcolor="0298F7"> 
    <td colspan="3" height="3"><img src="img/web4/blank.gif" width="3" height="3"></td>
  </tr>
</table>
<!-- END DYNAMIC BLOCK: prenext -->
</DIV>