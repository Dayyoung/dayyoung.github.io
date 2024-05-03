<!-- 자바스크립트는 그대로 유지 해 주세요 -->
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
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" colspan="3"><BR><H4>{B_TITLE}</h4></td>
        </tr>
        <tr> 
          <td width="8"></td>
          <td>{ADMIN}</td>
          <td align="right">{INFO}</td>
          <td width="27"></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="29" background="img/jxp/head_list01.gif"> 
            <div align="center">&nbsp;&nbsp;&nbsp;<span id="all_select" style="cursor:hand" onClick="all_chk();" title="전체 선택"><img src="img/jxp/check.gif" width="8" height="8"></span></div>
          </td>
          <td width="42" background="img/jxp/head_bg.gif"> 
            <div align="center"><font color="#FFFFFF">번호</font> </div>
          </td>
          <td background="img/jxp/head_bg.gif"> 
            <div align="center"><font color="#FFFFFF">제목</font></div>
          </td>
          <td width="59" background="img/jxp/head_bg.gif"> 
            <div align="center"><font color="#FFFFFF">이름</font></div>
          </td>
          <td width="36" background="img/jxp/head_bg.gif"> 
            <div align="center"><font color="#FFFFFF">파일</font></div>
          </td>
          <td width="70" background="img/jxp/head_bg.gif"> 
            <div align="center"><font color="#FFFFFF">날짜</font></div>
          </td>
          <td width="36" background="img/jxp/head_bg.gif"> 
            <div align="center"><font color="#FFFFFF">조회</font></div>
          </td>
          <td width="26" background="img/jxp/head_bg.gif"> 
            <div align="right"><img src="img/jxp/head_list02.gif" width="25" height="33"></div>
          </td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <!-- 여러글 보기를 위한 폼입니다. 폼태그와 히든폼 모두 그래도 유지 해야 합니다 -->
        <!-- 현재의 폼이 글 목록을 모두 감싸야 합니다. contents 다이나믹블럭을 감싸 주면 됩니다 -->
        <form method="get" action="./?p=detail&code={CODE}" name="mview_form">
        <input type="hidden" name="multiview" value="yes">
        <input type="hidden" name="p" value="detail">
        <input type="hidden" name="code" value="{CODE}">
        <!-- BEGIN DYNAMIC BLOCK: gonggi -->
        <tr bgcolor="#D8D8D8" height="24"> 
          <td width="10" bgcolor="#FFFFFF"></td>
          <td width="19"> 
            <div align="center">{NUMBER}</div>
          </td>
          <td width="42"> 
            <div align="center">{NOTICE}</div>
          </td>
          <td> 
            <div align="left" title="{S_TITLE}">{SUBJECT}</div>
          </td>
          <td width="59"> 
            <div align="center">{NAME}</div>
          </td>
          <td width="36"> 
            <div align="center"></div>
          </td>
          <td width="70"> 
            <div align="center">{DATE}</div>
          </td>
          <td width="36"> 
            <div align="center">{HIT}</div>
          </td>
          <td width="10" width="#FFFFFF"></td>
        </tr>
        <!-- END DYNAMIC BLOCK: gonggi -->
        <tr>
          <td width="10"></td>
          <td colspan="8" height="1" bgcolor="#F3F3F3"></td>
          <td width="10"></td>
        </tr>
        <!-- BEGIN DYNAMIC BLOCK: contents -->
        <tr bgcolor="F2F2F2" height="24"> 
          <td width="10" bgcolor="#FFFFFF"></td>
          <td width="19"> 
            <div align="center">
              <input type="checkbox" name="mview[]" value="{ID}" style="border:0; background:#F2F2F2">
            </div>
          </td>
          <td width="42"> 
            <div align="center">{NUMBER}</div>
          </td>
          <td> 
            <div align="left" title="{S_TITLE}">{SUBJECT}</div>
          </td>
          <td width="59"> 
            <div align="center">{NAME}</div>
          </td>
          <td width="36"> 
            <div align="center">{ATTACHE}</div>
          </td>
          <td width="70"> 
            <div align="center">{DATE}</div>
          </td>
          <td width="36"> 
            <div align="center">{HIT}</div>
          </td>
          <td width="10" width="#FFFFFF"></td>
        </tr>
        <!-- END DYNAMIC BLOCK: contents -->
        </form>
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
          <td width="27"></td>
          <td width="75">{LINK_MVIEW}</td>
          <td align="center">{PAGE_NAV}</td>
          <td width="75" align="right">{LINK_WRITE}</td>
          <td width="27"></td>
        </tr>
        <tr height="28">
        <form method="get" action="./" name="form">
        <input type="hidden" name="p" value="list">
        <input type="hidden" name="code" value="{CODE}">
        <input type="hidden" name="mode" value="srch">
          <td align="center" colspan="5">
            <select name="what">
              <option value="subject" selected>제목</option>
              <option value="name">이름</option>
              <option value="comment">내용</option>
            </select>
            <input type="text" name="request">
            <input type="submit" value="검색" style="height:18">
          </td>
        </form>
        </tr>
      </table>
    </td>
  </tr>
</table>
</DIV>
