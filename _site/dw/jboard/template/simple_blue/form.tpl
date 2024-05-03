<script>
<!--
//
// 입력내용 체크
//
function chk_form()
{
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
	
	f.submit();
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
  <table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0" height="568">
    <!-- 여기부분을 추가 하였습니다. 게시판 제목을 출력해야 할거 같아서 -->
    <tr>
          <td align="center"><BR><H4>{B_TITLE}</h4></td>
        </tr>
<!-- 여기부분을 추가 하였습니다. 게시판 제목을 출력해야 할거 같아서 -->
<tr>
    <td>
      <form method="post" action="./?p=act&code={CODE}" enctype="multipart/form-data" name="gwangpa_form">
      <input type="hidden" name="mode" value="{MODE}">
      <input type="hidden" name="id" value="{ID}">
      <input type="hidden" name="depth" value="{DEPTH}">
      <input type="hidden" name="page" value="{PAGE}">
        <table width="100%" border="0" cellspacing="0" cellpadding="0" height="4" bgcolor="#336699">
          <tr> 
          <td>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="27" background="img/simple_blue/top-bg.gif">
              <tr> 
                <td> 
                  <div align="left"><img src="img/simple_blue/top-left.gif"></div>
                </td>
                <td width="7"> 
                  <div align="right"><img src="img/simple_blue/top-right.gif"></div>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
       <table width="100%><tr><td height="5"><img src="img/simple_blue/blank.gif" height=1></td></tr></table>
          <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#333333">
            <tr>
              <td> 
                <table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" bgcolor="#FFFFFF">
                  <tr> 
                    <td align=center width="77" bgcolor="#2D639B"><font color="#FFFFFF">제목</font></td>
                    <td  bgcolor="#FFFFFF">&nbsp;<input type="text" name="subject" size="40" value="{SUBJECT}">
                    </td>
                  </tr>
                  <tr> 
                    <td align=center width="77" bgcolor="#2D639B"><font color="#FFFFFF">이름</font></td>
                    <td bgcolor="#FFFFFF"> 
                      &nbsp;<input type="text" name="name" size="12" value="{NAME}">
                    </td>
                  </tr>
                  <tr> 
                    <td align=center width="77" bgcolor="#2D639B"><font color="#FFFFFF">이메일</font></td>
                    <td bgcolor="#FFFFFF"> 
                      &nbsp;<input type="text" name="email" size="35" value="{EMAIL}">
                    </td>
                  </tr>
                  <tr> 
                    <td align=center width="77" bgcolor="#2D639B"><font color="#FFFFFF">홈페이지</font></td>
                    <td bgcolor="#FFFFFF"> 
                      &nbsp;<input type="text" name="url" size="35" value="{URL}">
                    </td>
                  </tr>
                  <tr> 
                    <td align=center width="77" bgcolor="#2D639B"><font color="#FFFFFF">비밀번호</font></td>
                    <td bgcolor="#FFFFFF"> &nbsp;<input type="password" name="passwd" size="12">
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
                    <td align=center width="77" bgcolor="#5591CE"><font color="#FFFFFF">내용</font></td>
                    <td bgcolor="#FFFFFF">&nbsp;<textarea name="comment" cols="64" rows="15">{COMMENT}</textarea>
                    </td>
                  </tr>
                  <!-- 게시판 설정상 파일첨부부분이 1개 이상이므로 다이나믹으로 처리 -->
                  <!-- BEGIN DYNAMIC BLOCK: fileup -->
                  <tr> 
                    <td align=center width="77" bgcolor="#5591CE"><font color="#FFFFFF">파일올리기</font></td>
                    <td bgcolor="#5591CE">&nbsp;<input type="file" name="{UPNAME}" size="50">
                    </td>
                  </tr>
                  <!-- END DYNAMIC BLOCK: fileup -->
                  <!-- BEGIN DYNAMIC BLOCK: sizeinfo -->
                  <tr bgcolor="#5591CE"> 
                    <td colspan="3"> 
                      <div align="right"><font color="#FFFFFF">최대 {SIZE}Bytes</font></div>
                    </td>
                  </tr>
                  <!-- END DYNAMIC BLOCK: sizeinfo -->
                  <tr> 
                    <td colspan="3" height="39"> 
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/simple_blue/down-bg.gif" height="43">
                        <tr> 
                          <td width="58" height="43"><img src="img/simple_blue/down-left.gif" width="6" height="43"></td>
                          <td height="43"> 
                            <div align="center">
                              <img src="./img/i-pack/{I_PACK}/save.gif" style="cursor:hand" onClick="chk_form();">
                              <img src="./img/i-pack/{I_PACK}/cancel.gif" style="cursor:hand" onClick="history.go(-1);">
                            </div>
                          </td>
                          <td width="50" height="43"> 
                            <div align="right"><img src="img/simple_blue/down-right.gif" width="6" height="43"></div>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
          <p>&nbsp;</p>
        </form>
    </td>
  </tr>
</table>
</DIV>

