<!-- 자바스크립트는 그대로 유지 해 주세요 -->
<!-- 원래것과 비교해서 검색폼을 추가 시켜 주세요 -->
<!--
    * 블록으로 처리 하는 부분은 두가지 경우
      ! 게시판 옵션상 출력이 되어야 할 때, 출력이 되지 않아야 할때.
      ! 반복이 되는 부분(반복이 되는 부분은 1번만 필요)
-->
<!-- 맨처음, 마지막 이미지 추가해주세요 -->
<script>
<!--
var all = 'none';

/*
	검색시 검색어 입력 확인 스크립
*/
function search()
{
	var ff = document.search_form;

	if(ff.request.value.length <= 0) {
		alert('검색어를 입력하세요');
		ff.request.focus();
		return false;
	} else {
		ff.submit();
	}
}

/*
	여러글 보기 기능시 체크 여부 확인 스크립
*/
function chk_multiview()
{
	var chkchk;
	var F = document.mview_form;

	for(i = 0 ; i < F.elements.length ; i++) {
		if(F.elements[i].type == 'checkbox') {
			if(F.elements[i].checked) {
				chkchk = "ok";
			}
		}
	}

	if(chkchk == "ok") {
		F.submit();
	} else {
		alert('여러글 보기를 할 글을 선택해 주세요!!');
		return false;
	}
}

/*
	여러글 보기의 모든글 체크
*/
function all_chk()
{
	var F = document.mview_form;

	if(all == 'none') {
		all = 'all';
		control = true;
	} else {
		all = 'none';
		control = false;
	}

	for(i = 0 ; i < F.elements.length ; i++) {
		if(F.elements[i].type == 'checkbox') {
			F.elements[i].checked = control;
		}
	}
}
-->
</script>
<DIV ALIGN="{ALIGN}">
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0" height="88">
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="20">
<!-- 여기부분을 추가 하였습니다. 게시판 제목을 출력해야 할거 같아서 -->
        <tr>
          <td align="center" colspan="2"><BR><H4>{B_TITLE}</h4></td>
        </tr>
<!-- 여기부분을 추가 하였습니다. 게시판 제목을 출력해야 할거 같아서 -->
        <tr>
          <td width="50%">{ADMIN}</td>
          <td width="50%" align="right">{INFO}</td>
        </tr>
        <tr><td colspan="2" height="3"></td></tr>
      </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" height="27" background="img/simple_orange/top-bg.gif">
          <tr> 
            <td width="9"> 
              <div align="left"><img src="img/simple_orange/top-left.gif" width="9" height="27"></div>
            </td>
            <td width="18">
            <div align="center"><span id="all_select" style="cursor:hand" onClick="all_chk();" title="전체 선택"><img src="img/simple_orange/check.gif" width="12" height="13"></span></div>
            </td>
            <td width="35"> 
              <div align="center"><img src="img/web/blank.gif" width="1" height="13"><font color="#00000">번호</font></div>
            </td>
            <td> 
              <div align="center"><img src="img/web/blank.gif" width="1" height="13"><font color="#00000">제목</font></div>
            </td>
            <td width="60"> 
              <div align="center"><img src="img/web/blank.gif" width="1" height="13"><font color="#00000">이름</font></div>
            </td>
            <td width="36"> 
              <div align="center"><img src="img/web/blank.gif" width="1" height="13"><font color="#00000">파일</font></div>
            </td>
            <td width="70"> 
              <div align="center"><img src="img/web/blank.gif" width="1" height="13"><font color="#00000">날짜</font></div>
            </td>
            <td width="36"> 
              <div align="center"><img src="img/web/blank.gif" width="1" height="13"><font color="#00000">조회</font></div>
            </td>
            <td width="7">
              <div align="right"><img src="img/simple_orange/top-right.gif"></div>
            </td>
          </tr>
        </table>
	    <table widht="100%"><tr><td height="1"></td></tr></table>
        <table width="100%" border="0" cellspacing="1" cellpadding="0" bgcolor="#333333">
          <tr>
            <td height="85"> 
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <!-- 여러글 보기를 위한 폼입니다. 폼태그와 히든폼 모두 그래도 유지 해야 합니다 -->
                <!-- 현재의 폼이 글 목록을 모두 감싸야 합니다. contents 다이나믹블럭을 감싸 주면 됩니다 -->
                <form method="get" action="./?p=detail&code={CODE}" name="mview_form">
                  <input type="hidden" name="multiview" value="yes">
                  <input type="hidden" name="p" value="detail">
                  <input type="hidden" name="code" value="{CODE}">
                  <!-- BEGIN DYNAMIC BLOCK: gonggi -->
                  <tr height="23"> 
                    <td width="26" colspan="2" bgcolor="#F4F8FF" > 
                      <div align="center">{NUMBER}</div>
                    </td>
                    <td width="36" bgcolor="#F4F8FF"> 
                      <div align="center">{NOTICE}</div>
                    </td>
                    <td bgcolor="#F4F8FF"> 
                      <div align="left">{SUBJECT}</div>
                    </td>
                    <td width="60" bgcolor="#F4F8FF" > 
                      <div align="center">{NAME}</div>
                    </td>
                    <td width="36" bgcolor="#F4F8FF" > 
                      <div align="center"></div>
                    </td>
                    <td width="70" bgcolor="#F4F8FF" > 
                      <div align="center">{DATE}</div>
                    </td>
                    <td width="36" bgcolor="#F4F8FF" > 
                      <div align="center">{HIT}</div>
                    </td>
                  </tr>
                  <!-- END DYNAMIC BLOCK: gonggi -->
                  <tr> 
                    <td colspan="8" height="1" bgcolor="#F3F3F3"></td>
                  </tr>
                  <!-- BEGIN DYNAMIC BLOCK: contents -->
                  <tr> 
                    <td width="9" bgcolor="#FFFFFF" > 
                      <div align="center"></div>
                    </td>
                    <td width="18" bgcolor="#FFFFFF" > 
                      <input type="checkbox" name="mview[]" value="{ID}" style="border:0">
                    </td>
                    <td width="35" bgcolor="#FFFFFF" > 
                      <div align="center">{NUMBER}</div>
                    </td>
                    <td bgcolor="#FFFFFF" > 
                      <div align="left">&nbsp;&nbsp;{SUBJECT}</div>
                    </td>
                    <td width="60" bgcolor="#FFFFFF" > 
                      <div align="center">{NAME}</div>
                    <td width="36" bgcolor="#FFFFFF" > 
                      <div align="center">{ATTACHE}</div>
                    </td>
                    <td width="70" bgcolor="#FFFFFF" > 
                      <div align="center">{DATE}</div>
                    </td>
                    <td width="36" bgcolor="#FFFFFF" > 
                      <div align="center">{HIT}</div>
                    </td>
                  </tr>
                                 <tr> 
                    <td colspan=11 height=1>
                      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="1" background="img/simple_orange/line.gif">
                        <tr>
                          <td height="1"></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  <!-- END DYNAMIC BLOCK: contents -->
                </form>
              </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/simple_orange/down-bg.gif" height="43">
                <tr> 
                  <td width="10"><img src="img/simple_orange/down-left.gif"></td>
                  <td width="109">{LINK_MVIEW}</td>
                  <td><!-- --></td>
                  <td> 
                    <div align="right">{LINK_WRITE}</div>
                  </td>
                  <td width="10" height="43"> 
                    <div align="right"><img src="img/simple_orange/down-right.gif"></div>
                  </td>
                </tr>
              </table>
              </td>
          </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <form method="get" action="./" name="form">
          <input type="hidden" name="p" value="list">
          <input type="hidden" name="code" value="{CODE}">
          <input type="hidden" name="mode" value="srch">
     	  <tr><td height="10" colspan="3"></td></tr>
          <tr height="28">
            <td>
              <div align="left">{PAGE_NAV}</div>
            </td>
            <td align="right">
              <select name="what">
                <option value="subject"selected>제목</option>
                <option value="name">이름</option>
                <option value="comment">내용</option>
              </select>
              <input type="text" name="request">
              <input type="submit" value="검색" style="height:18">
            </td>
          </tr>
          </form>
        </table>
    </td>
  </tr>
</table>
