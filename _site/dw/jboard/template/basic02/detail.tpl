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
    <td colspan="2" height="35">
      <div align="center">
        <!-- 게시판 타이틀 입니다. 기존위치에다 수정을 했습니다. 필요에 따라 위치 이동도 가능함 -->
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
          <td height="59">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="4" bgcolor="#336699">
              <tr> 
                <td><img src="color/blank.gif" width="1" height="1"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr> 
                <td colspan="2" height="5"></td>
              </tr>
              <tr> 
                <td width="100" bgcolor="#E2ECF5"><div align="right"><img src="img/basic02/sub.gif"></dev></td>
                <td width="600">&nbsp;&nbsp;<B>{SUBJECT}</B></td>
              </tr>
              <tr> 
                <td width="100" bgcolor="#E2ECF5"><div align="right"><img src="img/basic02/name.gif"></dev></td>
                <td width="600">&nbsp;&nbsp;{NAME} {EMAIL}</td>
              </tr>
              <tr> 
                <td width="100" bgcolor="#E2ECF5"><div align="right"><img src="img/basic02/homepage.gif"></dev></td>
                <td width="600">&nbsp;&nbsp;<B>{URL}</B></td>
              </tr>
              <!-- 다이나믹[show_hide_attache] :: 첨부화일이 있을 경우에 첨부화일내용을 보이기/숨기기 위한 내용이 출력이 되는 부분. -->
              <!-- BEGIN DYNAMIC BLOCK: show_hide_attache -->
              <!-- <tr><td colspan="2"><font size="-2" face="tahoma" style="cursor:hand" onClick="show_hide({L_ATTACHE});">attache</font></td></tr> -->
              <!-- END DYNAMIC BLOCK: show_hide_attache -->
              <tr><td colspan="2" height="3"></td></tr>
              <!-- 첨부화일 -->
              <tr id="{L_ATTACHE}" style="display:inline">
                <td colspan="2">
                  <table width="100%" cellpadding="0" cellspacing="0">
                    <!-- 다이나믹[upload] :: 첨부화일이 출력되는 부분. 게시판 설정에 첨부화일을 1개이상 올릴수 있으므로 다이나믹블럭으로 1행만 처리함 -->
                    <!-- BEGIN DYNAMIC BLOCK: upload -->
                    <tr bgcolor="#FFFFFF">
                      <td width="100"><div align="right">{FILE_SEQ} : </div></td>
                      <td width="3"></td>
                      <td>{FILE_UP}</td>
                    </tr>
                    <!-- END DYNAMIC BLOCK: upload -->
                  </table>
                </td>
              </tr>
              <tr><td colspan="2" height="8"></td></tr>
              <!-- 첨부화일 -->
              <tr>
                <td colspan="2">
                  <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                      <td width="15"></td>
                      <td>{COMMENT}</td>
                    </tr>
                    <tr>
                      <td width="15"></td>
                      <td style="word-break:break-all" align="right"><font color="#999999" style="font-size:8pt">{DATE}</font></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr><td colspan="2" height="8"></td></tr>
              <tr>
                <td colspan="2">
                  <!-- 다이나믹[comment_form] :: 의견글 적는 폼, 게시판설정에 의견글 사용여부가 있으므로 다이나믹으로 처리 -->
                  <!-- BEGIN DYNAMIC BLOCK: comment_form -->
                  <br>
                  <table width="500" border="0" cellspacing="0" cellpadding="1" bgcolor="#CCCCCC" align="right" height="60">
                    <form method="post" action="./?p=act&code={C_CODE}" name="{FORM_NAME}">
                    <input type="hidden" name="mode" value="comment">
                    <input type="hidden" name="code" value="{C_CODE}">
                    <input type="hidden" name="id" value="{C_ID}">  
                    <tr>
                      <td> 
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                          <tr bgcolor="#F7F7F7" valign="bottom"> 
                            <td width="16" height="32"></td>
                            <td width="72" height="32"> 
                              <div align="left">이름</div>
                            </td>
                            <td height="32"> 
                              <div align="left">내용</div>
                            </td>
                            <td width="140" height="32"> 
                              <div align="left">비밀번호</div>
                            </td>
                          </tr>
                          <tr bgcolor="#F7F7F7"> 
                            <td width="16" height="32"></td>
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
                                <input type="button" value="등록" onClick="chk_comment_form(this.form)" class="box" style="height:18">
                              </div>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    </form>
                  </table>
                  <p></p>
                  <!-- END DYNAMIC BLOCK: comment_form -->
                </td>
              </tr>
              <tr id="{L_COMMENT}" style="display:inline">
                <td colspan="2">
                  <p>
                  <table width="95%" cellpadding="0" cellspacing="0" border="0" align="right">
                    <tr>
                      <td>
                        <!-- 의견글 출력 -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="1" align="center">
                        <!-- 다이나믹[comment_body] :: 의견글 내용, 게시판옵션에 따라 의견글 출력, 출력안함 -->
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
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="3" bgcolor="#336699">
        <tr> 
          <td><img src="color/blank.gif" width="1" height="1"></td>
        </tr>
      </table>
      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <!-- 여기 리스트에 링크를 추가 하였습니다 한번 봐보세요... ^^; -->
          <!-- 그리고 링크가 걸리는 이미지들은 보더를 0으로 하셔야 합니다.. -->
          <!-- 그러면 글 상세 보기 할때 이미지 링크에 걸리는 변수는 다음과 같습니다 -->
          <!-- 글목록:LINK_LIST, 수정:LINK_MODIFY, 삭제:LINK_DEL, 이전:LINK_PREV, 다음:LINK_NEXT, 답변:LINK_REPLY, 새글:LINK_WRITE -->
          <td width="70%">{LINK_LIST}{LINK_MODIFY}{LINK_DEL}{LINK_PREV}{LINK_NEXT}</td>
          <td width="30%"><div align="right">{LINK_REPLY}{LINK_WRITE}</div></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr><td height="50"></td></tr>
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