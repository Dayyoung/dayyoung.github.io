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

<style type="text/css">
<!--
td {  font-size: 9pt; line-height: 15pt}
.box {  border: 1px #CCCCCC solid; background-color: #FFFFFF;  font-size: 9pt}
.title { font-family:Matchworks,Tahoma;font-size:8pt;color:#gray }
-->
</style>

<DIV ALIGN="{ALIGN}">
<table width="{B_WIDTH}" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" height="20">
        <!-- 여기부분을 추가 하였습니다. 게시판 제목을 출력해야 할거 같아서 -->
        <tr>
          <td align="center" colspan="2"><BR><H4>{B_TITLE}</h4></td>
        </tr>
        <!-- 여기부분을 추가 하였습니다. 게시판 제목을 출력해야 할거 같아서 -->
        <tr>
          <td>{ADMIN}</td>
          <td width="50%" align="right">{INFO}</td>
        </tr>
        <tr><td colspan="2" height="3"></td></tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="26"> 
            <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#EEEEEE bordercolorlight=gray bordercolordark=#FFFFFF>
              <tr> 
                <td height="14">
                  <div align="center"><span id="all_select" style="cursor:hand" onClick="all_chk();" title="전체 선택"><img src=img/basic01/x.gif></span></div>
                </td>
              </tr>
            </table>
          </td>
          <td width="35" height="14"> 
            <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#EEEEEE bordercolorlight=gray bordercolordark=#FFFFFF>
              <tr> 
                <td height="14" align=center> 
                 <img src=img/basic01/no.gif></td>
              </tr>
            </table>
          </td>
          <td> 
            <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#EEEEEE bordercolorlight=gray bordercolordark=#FFFFFF>
              <tr> 
                 <td height="14" align=center><img src=img/basic01/sub.gif></td>
              </tr>
            </table>
          </td>
          <td width="60"> 
            <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#EEEEEE bordercolorlight=gray bordercolordark=#FFFFFF>
              <tr> 
                 <td height="14" align=center><img src=img/basic01/name.gif></td>
              </tr>
            </table>
          </td>
          <td width="36"> 
            <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#EEEEEE bordercolorlight=gray bordercolordark=#FFFFFF>
              <tr> 
                 <td height="14" align=center><img src=img/basic01/file.gif></td>
              </tr>
            </table>
          </td>
          <td width="70"> 
            <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#EEEEEE bordercolorlight=gray bordercolordark=#FFFFFF>
              <tr> 
                 <td height="14" align=center><img src=img/basic01/date.gif></td>
              </tr>
            </table>
          </td>
          <td width="36"> 
            <table width=100% border=1 cellspacing=0 cellpadding=0 bgcolor=#EEEEEE bordercolorlight=gray bordercolordark=#FFFFFF>
              <tr> 
                 <td height="14" align=center><img src=img/basic01/hit.gif></td>
              </tr>
            </table>
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
        <tr height="23" bgcolor="#F6F6F6">
          <td width="26" >
            <div align="center">{NUMBER}</div>
          </td>
          <td width="36">
            <div align="center">{NOTICE}</div>
          </td>
          <td> 
            <div align="left" title="{S_TITLE}">{SUBJECT}</div>
          </td>
          <td width="60" > 
            <div align="center">{NAME}</div>
          </td>
          <td width="36" > 
            <div align="center"></div>
          </td>
          <td width="70" > 
            <div align="center">{DATE}</div>
          </td>
          <td width="36" > 
            <div align="center">{HIT}</div>
          </td>
        </tr>
        <!-- END DYNAMIC BLOCK: gonggi -->
        <tr><td colspan="7" height="1" bgcolor="#F3F3F3"></td></tr>
        <!-- BEGIN DYNAMIC BLOCK: contents -->
        <tr onmouseout="this.style.backgroundColor=''" onmouseover="this.style.backgroundColor='#E8E8E8'"> 
          <td width="26" > 
            <div align="center"><input type="checkbox" name="mview[]" value="{ID}" style="border:0"></div>
          </td>
          <td width="35" > 
            <div align="center">{NUMBER}</div>
          </td>
          <td > 
            <div align="left" title="{S_TITLE}">&nbsp;&nbsp;{SUBJECT}</div>
          </td>
          <td width="60" > 
            <div align="center">{NAME}</div>
          </td>
          <td width="36" > 
            <div align="center">{ATTACHE}</div>
          </td>
          <td width="70" > 
            <div align="center">{DATE}</div>
          </td>
          <td width="36" > 
            <div align="center">{HIT}</div>
          </td>
        </tr>
        <tr><td colspan=10 height=1 bgcolor="#e1e1e1"><img src=img/basic012/blank.gif height=1></td></tr>
        <!-- END DYNAMIC BLOCK: contents -->
        </form>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td height="4" bgcolor="#e1e1e1"></td>
        </tr>
      </table>
      <br>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="75">{LINK_MVIEW}</td>
          <td>
            <div align="center">{PAGE_NAV}</div>
          </td>
          <td width="75"> 
            <div align="right">{LINK_WRITE}</div>
          </td>
        </tr>
        <tr height="28">
        <form method="get" action="./" name="form">
        <input type="hidden" name="p" value="list">
        <input type="hidden" name="code" value="{CODE}">
        <input type="hidden" name="mode" value="srch">
          <td colspan="3"> 
            <p align="center"> 
              <select name="what">
                <option value="subject"selected>제목</option>
                <option value="name">이름</option>
                <option value="comment">내용</option>
              </select>
              <input type="text" name="request">
              <input type="submit" value="검색" style="height:18">
            </p>
          </td>
        </tr>
        </form>
      </table>
    </td>
  </tr>
</table>
</DIV>