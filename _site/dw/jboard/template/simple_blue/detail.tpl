<!-- BEGIN DYNAMIC BLOCK: show_hide_attache -->
<!-- END DYNAMIC BLOCK: show_hide_attache -->
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
<DIV ALIGN="{ALIGN}">
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0">
 <tr>
    <td colspan="2">
      <div align="center">
        <BR><H4>{B_TITLE}</h4>
      </div>
    </td>
  </tr>
  <!-- BEGIN DYNAMIC BLOCK: body --> 
  <tr>
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/simple_blue/top-bg.gif">
        <tr> 
          <td> 
            <div align="left"><img src="img/simple_blue/top-left.gif" width="9" height="27"></div>
          </td>
          <td width="10"> 
            <div align="right"><img src="img/simple_blue/top-right.gif" width="7" height="27"></div>
          </td>
        </tr>
      </table>
      <table widht="100%"><tr><td height="1"></td></tr></table>
      <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#333333">
        <tr>
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor="#FFFFFF">
              <tr> 
                <td align=center bgcolor="#FFFFFF"> 
                  <table width="100%" border="0" cellspacing="1" cellpadding="0">
                    <tr> 
                      <td width="100" bgcolor="#2D639B"> 
                        <div align="center"><font color="#FFFFFF">제목</font></div>
                      </td>
                      <td bgcolor="#FFFFFF"><b>&nbsp;&nbsp;{SUBJECT}</b></td>
                    </tr>
                    <tr> 
                      <td width="100" bgcolor="#2D639B"> 
                        <div align="center"><font color="#FFFFFF">이름</font></div>
                      </td>
                      <td bgcolor="#FFFFFF">&nbsp;&nbsp; {NAME} {EMAIL}</td>
                    </tr>
                    <tr> 
                      <td width="100" bgcolor="#2D639B"> 
                        <div align="center"><font color="#FFFFFF">홈페이지</font></div>
                      </td>
                      <td bgcolor="#FFFFFF"><b>&nbsp;&nbsp;{URL}</b></td>
                    </tr>
                    <!-- 다이나믹[show_hide_attache] :: 첨부화일이 있을 경우에 첨부화일내용을 보이기/숨기기 위한 내용이 출력이 되는 부분. -->
                    <!-- 첨부화일 -->
                    <tr id="{L_ATTACHE}" style="display:inline"> 
                      <td width="100" bgcolor="#2D639B" valign="top">
                        <div align="center"><font color="#FFFFFF">첨부화일</font></div>
                      </td>
                      <td> 
                        <table width="100%" cellpadding="2" cellspacing="0">
                          <!-- 다이나믹[upload] :: 첨부화일이 출력되는 부분. 게시판 설정에 첨부화일을 1개이상 올릴수 있으므로 다이나믹블럭으로 1행만 처리함 -->
                          <!-- BEGIN DYNAMIC BLOCK: upload -->
                          <tr bgcolor="#FFFFFF">
                            <td width="6"></td>
                            <td>{FILE_UP}</td>
                          </tr>
                          <!-- END DYNAMIC BLOCK: upload -->
                        </table>
                      </td>
                    </tr>
                    <!-- 첨부화일 -->
                  </table>
                </td>
              </tr>
              <tr> 
                <td> 
                  <table width="100%" bgcolor="#FFFFFF" cellpadding="0" border="0" cellspacing="0">
                    <tr bgcolor="#FFFFFF"> 
                      <td  align=center colspan="3"> <br>
                        <table width="90%" border="0" cellspacing="0" cellpadding="0">
                          <tr> 
                            <td style="word-break:break-all">{COMMENT}</td>
                          </tr>
                        </table>
                        <p> 
                        <!-- BEGIN DYNAMIC BLOCK: comment_form -->
                        <table width="500" border="0" cellspacing="0" cellpadding="1" bgcolor="#CCCCCC" align="center" height="60">
                          <form method="post" action="./?p=act&code={C_CODE}" name="{FORM_NAME}">
                          <input type="hidden" name="mode" value="comment">
                          <input type="hidden" name="code" value="{C_CODE}">
                          <input type="hidden" name="id" value="{C_ID}">
                            <tr> 
                              <td> 
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                  <tr bgcolor="#508DCC" valign="bottom"> 
                                    <td width="16" height="32">&nbsp;</td>
                                    <td width="72" height="32"> 
                                      <div align="left"><font color="#FFFFFF">이름</font></div>
                                    </td>
                                    <td height="32"> 
                                      <div align="left"><font color="#FFFFFF">내용</font></div>
                                    </td>
                                    <td width="140" height="32"> 
                                      <div align="left"><font color="#FFFFFF">비밀번호</font></div>
                                    </td>
                                  </tr>
                                  <tr bgcolor="#508DCC"> 
                                    <td width="16" height="32">&nbsp;</td>
                                    <td width="72" height="36"> 
                                      <div align="left"> 
                                        <input type="text" name="c_name" value="{COMMENT_NAME}" size="8" class="box">
                                      </div>
                                    </td>
                                    <td  height="36"> 
                                      <div align="left"> 
                                        <input type="text" name="c_comment" value="" size="41" class="box">
                                      </div>
                                    </td>
                                    <td width="140" height="36"> 
                                      <div align="left"> 
                                        <input type="password" name="c_passwd" size="8" class="box" onKeyPress="chk_submit(this.form)">
                                        <input type="button" value="등록" onClick="chk_comment_form(this.form)" class="box" style="height:18" name="button">
                                      </div>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </form>
                        </table>
                        <!-- END DYNAMIC BLOCK: comment_form -->
                        <p> 
                        <!-- 의견글 출력 -->
                        <table width="500" border="0" cellspacing="0" cellpadding="1" align="center">
                          <!-- 다이나믹[comment_body] :: 의견글 내용, 게시판옵션에 따라 의견글 출력, 출력안함 -->
                          <!-- BEGIN DYNAMIC BLOCK: comment_body -->
                          <tr> 
                            <td width="80" style="word-break:break-all"><b>{COMMENT_NAME}</b></td>
                            <td style="word-break:break-all">{COMMENT_BODY}</td>
                            <td width="20"> 
                              <div align="right">{COMMENT_DEL}</div>
                            </td>
                          </tr>
                          <!-- END DYNAMIC BLOCK: comment_body -->
                        </table>
                        <!-- 의견글 출력 끝 -->
                      </td>
                    </tr>
                    <tr> 
                      <td colspan="3" height="42"> 
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/simple_blue/down-bg.gif" height="43">
                          <tr> 
                            <td width="6"><img src="img/simple_blue/down-left.gif" width="6" height="43"></td>
                            <td width="*">{LINK_LIST}{LINK_MODIFY}{LINK_DEL}{LINK_PREV}{LINK_NEXT}</td>
                            <td align="right">{LINK_REPLY}{LINK_WRITE}</td>
                            <td align="right"><img src="img/simple_blue/down-right.gif" width="6" height="43"></td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>            
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr><td height="25"></td></tr>
<!-- END DYNAMIC BLOCK: body -->
</table>
<!-- BEGIN DYNAMIC BLOCK: prenext -->
<table border=0 width={B_WIDTH} cellspacing=0 cellpadding=0>
  <tr> 
    <td colspan=8 bgcolor=#336699><img src=img/web/blank.gif height=2></td>
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
    <td colspan=8 bgcolor=E8E8E8><img src=img/web/blank.gif height=1></td>
  </tr>
  <tr align=center height=22>
    <td width=50>다음</td>
    <td align=left style='word-break:break-all;'>
      <img src=img/web/blank.gif height=3>&nbsp; &nbsp;{NEXT_ARTICLE}
    </td>
  </tr>
</table>
<table border=0 cellpadding cellspacing=0 width={B_WIDTH}>
  <tr><td colspan=10 bgcolor=#336699><img src=img/web/blank.gif height=1></td></tr>
</table>
<br>
<!-- END DYNAMIC BLOCK: prenext -->
</DIV>