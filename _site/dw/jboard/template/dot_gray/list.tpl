<script>
<!--
var all = 'ndot_gray';

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

	if(all == 'ndot_gray') {
		all = 'all';
		control = true;
	} else {
		all = 'ndot_gray';
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

<style type="text/css">
<!--
//td {  font-size: 9pt; border: #CCCCCC ndot_gray}
-->
</style>

<DIV align="{ALIGN}">
<table width="{B_WIDTH}" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td align="center">
      <H4>{B_TITLE}</h4>
    </td>
  </tr>
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="24">
        <tr> 
          <td align="left" valign="bottom" width="60"><img src="img/dot_gray/dummy.gif" width="10" height="8">{ADMIN}<img src="img/dot_gray/dummy.gif" width="30" height="5"></td>
          <td align="right" valign="bottom">{INFO}</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" height="28">
        <tr>
          <td bgcolor="#FFFFFF" align="center" valign="middle">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="464646" height="26">
              <tr align="center"> 
                <td width="29" valign="middle"> 
                  <input type="checkbox" name="checkbox" value="" style="cursor:hand; border:0; background-color:#464646" onClick="all_chk();" title="전체 선택">
                </td>
                <td width="40" valign="middle"><font color="#FFFFFF">번호</font></td>
                <td valign="middle"><font color="#FFFFFF">제목</font></td>
                <td width="80" valign="middle"><font size="-1" color="#FFFFFF">이름</font></td>
                <td width="50" valign="middle"><font size="-1" color="#FFFFFF">파일</font></td>
                <td width="60" valign="middle"><font size="-1" color="#FFFFFF">날짜</font></td>
                <td width="50" valign="middle"><font size="-1" color="#FFFFFF">조회</font></td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000">
        <form method="get" action="./?p=detail&code={CODE}" name="mview_form">
        <input type="hidden" name="multiview" value="yes">
        <input type="hidden" name="p" value="detail">
        <input type="hidden" name="code" value="{CODE}">
        <tr>
          <td bgcolor="#FFFFFF" align="center" valign="middle">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" background="img/dot_gray/linebg_01.gif">
              <!-- BEGIN DYNAMIC BLOCK: gonggi -->
              <tr height="23"> 
                <td width="29" align="center" valign="middle"> 
                  {NUMBER}
                </td>
                <td width="40" align="center"><font size="-1">{NOTICE}</font></td>
                <td title="{S_TITLE}"><font size="-1">{SUBJECT}</font></td>
                <td width="80" align="center"><font size="-1">{NAME}</font></td>
                <td width="50" align="center"><font size="-1"></font></td>
                <td width="60" align="center"><font size="-1">{DATE}</font></td>
                <td width="50" align="center"><font size="-1">{HIT}</font></td>
              </tr>
              <!-- END DYNAMIC BLOCK: gonggi -->
              <!-- BEGIN DYNAMIC BLOCK: contents -->
              <tr height="23"> 
                <td width="29" width="29" align="center" valign="middle"> 
                  <input type="checkbox" name="mview[]" value="{ID}" style="border:0">
                </td>
                <td align="center"><font size="-1">{NUMBER}</font></td>
                <td title="{S_TITLE}"><font size="-1">{SUBJECT}</font></td>
                <td width="80" align="center"><font size="-1">{NAME}</font></td>
                <td width="50" align="center"><font size="-1">{ATTACHE}</font></td>
                <td width="60" align="center"><font size="-1">{DATE}</font></td>
                <td width="50" align="center"><font size="-1">{HIT}</font></td>
              </tr>
              <!-- END DYNAMIC BLOCK: contents -->
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" height="51" background="img/dot_gray/bg_01.gif">
              <tr> 
                <td align="right" valign="bottom"><img src="img/dot_gray/img_01.gif"></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="464646" height="24">
              <tr> 
                <td align="right" valign="top"> 
                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr> 
                      <td>{LINK_MVIEW}{LINK_WRITE}</td>
                      <td align="right" width="130"><img src="img/dot_gray/img_1.gif" width="109" height="24"></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        </form>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#000000">
        <form method="get" action="./" name="form">
        <input type="hidden" name="p" value="list">
        <input type="hidden" name="code" value="{CODE}">
        <input type="hidden" name="mode" value="srch">
        <tr bgcolor="#FFFFFF">
          <td>
            {PAGE_NAV}
          </td>
          <td align="right">
            <select name="what">
              <option value="subject" selected>제목</option>
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