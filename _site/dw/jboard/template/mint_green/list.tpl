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

<DIV align="{ALIGN}">
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" colspan="2"><BR><H4>{B_TITLE}</h4></td>
  </tr>
  <tr>
    <td> 
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td align="left" valign="bottom" width="60"><img src="img/mint_green/dummy.gif" width="10" height="8">{ADMIN}<img src="img/mint_green/dummy.gif" width="30" height="5"></td>
          <td align="right" valign="bottom">{INFO}</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" height="28">
        <tr>
          <td bgcolor="#FFFFFF" align="center" valign="bottom"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="26" background="img/mint_green/top_bg.gif">
              <tr align="center"> 
                <td width="29" valign="middle">
                  <input type="checkbox" name="" value="" style="cursor:hand" onClick="all_chk();">
                </td>
                <td width="40" valign="middle"><font color="#333333" size="-1">번호</font></td>
                <td valign="middle"><font color="#333333" size="-1">제목</font></td>
                <td width="80" valign="middle"><font color="#333333" size="-1">이름</font></td>
                <td width="30" valign="middle"><font color="#333333" size="-1">파일</font></td>
                <td width="80" valign="middle"><font color="#333333" size="-1">날짜</font></td>
                <td width="50" valign="middle"><font color="#333333" size="-1">조회</font></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000">
        <tr>
          <td bgcolor="#FFFFFF" align="center" valign="bottom"> 
            <table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/mint_green/linebg_01.gif">
              <form method="get" action="./?p=detail&code={CODE}" name="mview_form">
              <input type="hidden" name="multiview" value="yes">
              <input type="hidden" name="p" value="detail">
              <input type="hidden" name="code" value="{CODE}">
              <!-- BEGIN DYNAMIC BLOCK: gonggi -->
              <tr height="23"> 
                <td height="23" width="29" align="center" valign="middle" background="img/mint_green/linebg_02.gif">{NUMBER}</td>
                <td width="40" align="center">{NOTICE}</td>
                <td title="{S_TITLE}">{SUBJECT}</td>
                <td width="80" align="center">{NAME}</td>
                <td width="30" align="center"></td>
                <td width="80" align="center">{DATE}</td>
                <td width="50" align="center">{HIT}</td>
              </tr>
              <!-- END DYNAMIC BLOCK: gonggi -->
              <!-- BEGIN DYNAMIC BLOCK: contents -->
              <tr height="23">
                <td height="23" width="29" align="center" valign="middle" background="img/mint_green/linebg_02.gif"> 
                  <input type="checkbox" name="mview[]" value="{ID}" style="border:0">
                </td>
                <td width="40" align="center">{NUMBER}</td>
                <td title="{S_TITLE}">{SUBJECT}</td>
                <td width="80" align="center">{NAME}</td>
                <td width="30" align="center">{ATTACHE}</td>
                <td width="80" align="center">{DATE}</td>
                <td width="50" align="center">{HIT}</td>
              </tr>
              <!-- END DYNAMIC BLOCK: contents -->
              </form>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="51" bgcolor="E6F3BD">
              <tr>
                <td align="right" valign="bottom"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/mint_green/bot_bg.gif" height="32">
              <tr> 
                <td align="right" valign="bottom"> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr align="right"> 
                      <td valign="bottom">{LINK_MVIEW} {LINK_WRITE}</td>
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
<table width="{B_WIDTH}" border="0" cellpadding="0" cellspacing="0">
  <form method="get" action="./" name="form">
  <input type="hidden" name="p" value="list">
  <input type="hidden" name="code" value="{CODE}">
  <input type="hidden" name="mode" value="srch">
  <tr bgcolor="#FFFFFF">
    <td>{PAGE_NAV}</td>
    <td align="right"> 
      <select name="what">
        <option value="subject" selected>제목</option>
        <option value="name">이름</option>
        <option value="comment">내용</option>
      </select>
      <input type="text" name="request">
      <input type="submit" value="검색">
    </td>
  </tr>
  </form>
</table>
</DIV>