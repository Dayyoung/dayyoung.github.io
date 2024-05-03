<link rel='stylesheet' type='text/css' href='img/snowy/main.css'>
<script language=javascript src='img/snowy/main.js'></script>
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
<DIV ALIGN="{ALIGN}">
<table width="{B_WIDTH}" border=0 cellpadding=0 cellspacing=0>
  <tr>
    <td width="100%">
      <!-- BEGIN DYNAMIC BLOCK: body -->
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
          <td width=3 background=img/snowy/bg_l.gif><img src=img/snowy/dummy.gif width=3></td>
          <td width=99% align=center class=c2>
            <table width=95% border=0 cellpadding=0 cellspacing=0>
              <tr>
                <td background=img/snowy/line.gif><img src=img/snowy/dummy.gif></td>
              </tr>
              <tr>
                <td align=center><br>
                  <table width=98% border=0 cellspacing=1 cellpadding=2 class=line>
                    <tr>
                      <td width="20%" class=c1 align="center">제목</td>
                      <td width="80%" class=c3>&nbsp;{SUBJECT}</td>
                    </tr>
                    <tr>
                      <td width="20%" class=c1 align="center">이름</td>
                      <td width="80%" class=c3>&nbsp;{NAME} {EMAIL} {URL}</td>
                    </tr>
                    <tr>
                      <td class=c1 align="center">첨부</td>
                      <td class=c3>
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                          <!-- BEGIN DYNAMIC BLOCK: upload -->
                          <tr>
                            <td width="65">{FILE_SEQ} :</td>
                            <td>{FILE_UP}</td>
                          </tr>
                          <!-- END DYNAMIC BLOCK: upload -->
                        </table>
                      </td>
                    </tr>
                    <tr class=c3>
                      <td colspan=2 align=center>
                        <table width=95% border=0 cellspacing=1 cellpadding=0>
                          <tr>
                            <td colspan="2" class=rBody><br>
{COMMENT}
                            </td>
                          </tr>
                          <tr class="rBody">
                            <td width="15"></td>
                            <td style="word-break:break-all" align="right"><font color="#999999" style="font-size:8pt">{DATE}</font></td>
                          </tr>
                          <tr class="rBody">
                            <td colspan="2">
                              <!-- 다이나믹[comment_form] :: 의견글 적는 폼, 게시판설정에 의견글 사용여부가 있으므로 다이나믹으로 처리 -->
                              <!-- BEGIN DYNAMIC BLOCK: comment_form -->
                              <table width="90%" border="0" cellspacing="0" cellpadding="1" bgcolor="#CCCCCC" align="right">
                                <form method="post" action="./?p=act&code={C_CODE}" name="{FORM_NAME}">
                                <input type="hidden" name="mode" value="comment">
                                <input type="hidden" name="code" value="{C_CODE}">
                                <input type="hidden" name="id" value="{C_ID}">  
                                <tr>
                                  <td> 
                                    <table border="0" cellpadding="5" cellspacing="0" width="100%">
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
                                            <input type="text" name="c_name" value="{COMMENT_NAME}" size="8">
                                          </div>
                                        </td>
                                        <td> 
                                          <div align="left">
                                            <input type="text" name="c_comment" value="" size="41" style="width:100%">
                                          </div>
                                        </td>
                                        <td width="140"> 
                                          <div align="left"> 
                                            <input type="password" name="c_passwd" size="8" class="box" onKeyPress="chk_submit(this.form)"> 
                                            <input type="button" value="등록" onClick="chk_comment_form(this.form)">
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
                          <tr>
                            <td colspan="2">
                              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <!-- BEGIN DYNAMIC BLOCK: comment_body -->
                                <tr>
                                  <td width="80" style="word-break:break-all"><b>{COMMENT_NAME}</b></td>
                                  <td style="word-break:break-all">{COMMENT_BODY}</td>
                                  <td width="20"><div align="right">{COMMENT_DEL}</div></td>
                                </tr>
                                <!-- END DYNAMIC BLOCK: comment_body -->
                              </table>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <!-- BEGIN DYNAMIC BLOCK: prenext -->
                    <tr>
                      <td class=c1 align=center>이전글</td>
                      <td style='word-break:break-all;' class=c3>&nbsp;{PREV_ARTICLE}</td>
                    </tr>
                    <tr>
                      <td class=c1 align=center>다음글</td>
                      <td style='word-break:break-all;' class=c3>&nbsp;{NEXT_ARTICLE}</td>
                    </tr>
                    <!-- END DYNAMIC BLOCK: prenext -->
                  </table><br>
                </td>
              </tr>
              <tr>
                <td background=img/snowy/line.gif><img src=img/snowy/dummy.gif></td>
              </tr>
            </table><br>
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
            <!-- 버튼 -->
            {LINK_LIST}{LINK_MODIFY}{LINK_DEL}{LINK_PREV}{LINK_NEXT}{LINK_REPLY}{LINK_WRITE}
          </td>
          <td align=right width=25><img src=img/snowy/btn_r.gif></td>
        </tr>
      </table>
      <BR>
      <!-- END DYNAMIC BLOCK: body -->
    </td>
  </tr>
</table>
</DIV>