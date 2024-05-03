<script>
<!--
/* 첨부화일이 있을 경우 첨부화일 TR을 숨기고 보이게 해 주는 함수 */
function show_hide(obj)
{
	var status = obj.style.display;

	if(status == "ndot_gray") {
		obj.style.display = "inline";
	} else {
		obj.style.display = "ndot_gray";
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

<DIV ALIGN="{ALIGN}">
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">
      <h4>{B_TITLE}</h4>
    </td>
  </tr>
  <tr>
    <td>
      <!-- BEGIN DYNAMIC BLOCK: body -->
      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="24">
        <tr> 
          <td align="left" valign="bottom"></td>
          <td align="right" valign="bottom"><img src="img/dot_gray/img_03.gif"></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" height="28">
        <tr>
          <td bgcolor="#FFFFFF" align="center" valign="middle">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="464646" height="26">
              <tr align="center"> 
                <td align="right" valign="top"><img src="img/dot_gray/img_05.gif" width="163" height="24"> 
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000">
        <tr>
          <td bgcolor="#FFFFFF" align="center" valign="middle"> 
            <table width="100%" border="0" cellspacing="1" cellpadding="0" height="84">
              <tr> 
                <td width="133" align="left" bgcolor="D1D1D1">
                  <font size="2">&nbsp;&nbsp;&nbsp;&nbsp<img src="img/dot_gray/arrow.gif" width="8" height="9" align="absmiddle"> 이 름 </font>
                </td>
                <td valign="middle" colspan="2" background="img/dot_gray/linebg_02.gif" height="23"><font size="2">{NAME} {EMAIL}</font></td>
              </tr>
              <tr> 
                <td width="133" align="left" bgcolor="D1D1D1">
                  <font size="2">&nbsp&nbsp&nbsp&nbsp<img src="img/dot_gray/arrow.gif" width="8" height="9" align="absmiddle"> 제 목 </font>
                </td>
                <td valign="middle" colspan="2" background="img/dot_gray/linebg_02.gif" height="23">
                  <font size="2">{SUBJECT}</font>
                </td>
              </tr>
              <tr> 
                <td width="133" align="left" bgcolor="D1D1D1">
                  <font size="2">&nbsp&nbsp&nbsp&nbsp<img src="img/dot_gray/arrow.gif" width="8" height="9" align="absmiddle"> 홈페이지 </font>
                </td>
                <td valign="middle" colspan="2" background="img/dot_gray/linebg_02.gif" height="23"><font size="2">{URL}</font></td>
              </tr>
			  <!-- BEGIN DYNAMIC BLOCK: upload -->
              <tr> 
                <td width="133" align="left" bgcolor="D1D1D1">
                  <font size="2">&nbsp&nbsp&nbsp&nbsp<img src="img/dot_gray/disk.gif" width="14" height="14" align="absmiddle"> {FILE_SEQ} </font>
                </td>
                <td valign="middle" colspan="2" background="img/dot_gray/linebg_02.gif" height="23">
                  {FILE_UP}
                </td>
              </tr>
              <!-- END DYNAMIC BLOCK: upload -->
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="D1D1D1">
              <tr> 
                <td bgcolor="#FFFFFF" height="45">
                  <table width="100%" border="0" cellspacing="10" cellpadding="3">
                    <tr>
                      <td> 
{COMMENT}
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <tr>
                <td>
                  <!-- BEGIN DYNAMIC BLOCK: comment_form -->
                  <table width="500" border="0" cellspacing="0" cellpadding="1" bgcolor="#CCCCCC" align="right">
                    <form method="post" action="./?p=act&code={C_CODE}" name="{FORM_NAME}">
                    <input type="hidden" name="mode" value="comment">
                    <input type="hidden" name="code" value="{C_CODE}">
                    <input type="hidden" name="id" value="{C_ID}">  
                    <tr>
                      <td> 
                        <table border="0" cellpadding="3" cellspacing="0" width="100%">
                          <tr bgcolor="#F7F7F7" valign="bottom"> 
                            <td width="16"></td>
                            <td width="72"> 
                              <div align="left">이름</div>
                            </td>
                            <td> 
                              <div align="left">내용</div>
                            </td>
                            <td width="140"> 
                              <div align="left">비밀번호</div>
                            </td>
                          </tr>
                          <tr bgcolor="#F7F7F7"> 
                            <td width="16"></td>
                            <td width="72"> 
                              <div align="left">
                                <input type="text" name="c_name" value="{COMMENT_NAME}" size="8" class="box">
                              </div>
                            </td>
                            <td> 
                              <div align="left">
                                <input type="text" name="c_comment" value="" class="box" style="width:100%">
                              </div>
                            </td>
                            <td width="140"> 
                              <div align="left"> 
                                <input type="password" name="c_passwd" size="8" class="box" onKeyPress="chk_submit(this.form)"> 
                                <input type="button" value="등록" onClick="chk_comment_form(this.form)" class="box">
                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    </form>
                  </table>
                  <!-- END DYNAMIC BLOCK: comment_form -->
                </td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
              <!-- BEGIN DYNAMIC BLOCK: comment_body -->
              <tr>
                <td width="80" style="word-break:break-all"><b>{COMMENT_NAME}</b></td>
                <td style="word-break:break-all">{COMMENT_BODY}</td>
                <td width="20"><div align="right">{COMMENT_DEL}</div></td>
              </tr>
              <!-- END DYNAMIC BLOCK: comment_body -->
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="51" background="img/dot_gray/bg_01.gif">
              <tr> 
                <td></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="464646" height="24">
              <tr> 
                <td align="center" valign="middle">
                  <table width="530" border="0" cellspacing="0" cellpadding="0">
                    <tr align="center"> 
                      <td align="left">{LINK_LIST}</td>
                      <td width="60">{LINK_MODIFY}</td>
                      <td width="60">{LINK_DEL}</td>
                      <td align="right" width="120">{LINK_PREV}</td>
                      <td width="70">{LINK_NEXT}</td>
                      <td align="right">{LINK_REPLY} {LINK_WRITE}</td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <!-- END DYNAMIC BLOCK: body -->
    </td>
  </tr>
</table>
<BR>
<!-- BEGIN DYNAMIC BLOCK: prenext -->
<table border=0 width={B_WIDTH} cellspacing=0 cellpadding=0>
  <tr> 
    <td colspan=8 bgcolor="#464646" height="1"></td>
  </tr>
  <tr align=center height=22>
    <td width=50>이전</td>
    <td align=left style='word-break:break-all;'>
      <img src=img/web/blank.gif height=3>&nbsp; &nbsp;{PREV_ARTICLE}
    </td>
  </tr>
</table>
<table border=0 width={B_WIDTH} cellspacing=0 cellpadding=0>
  <tr>
    <td colspan=8  bgcolor="#464646" height="1"></td>
  </tr>
  <tr align=center height=22>
    <td width=50>다음</td>
    <td align=left style='word-break:break-all;'>
      <img src=img/web/blank.gif height=3>&nbsp; &nbsp;{NEXT_ARTICLE}
    </td>
  </tr>
</table>
<table border=0 cellpadding cellspacing=0 width={B_WIDTH}>
  <tr><td colspan=10 bgcolor="#464646" height="1"></td></tr>
</table>
<!-- END DYNAMIC BLOCK: prenext -->
</DIV>
