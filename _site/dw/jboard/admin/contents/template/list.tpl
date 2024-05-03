<html>
<head>
<title>jboard :: 게시물관리</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td {  font-family: "돋움"; font-size: 9pt}
a:link,a:visited{text-decoration:none}
a:hover {text-decoration:underline}
INPUT,SELECT,TEXTAREA, CHECKBOX { border:1 solid #999999; background-color: #FFFFFF; color: #333333;}
-->
</style>
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
function chk_multi(code)
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
		if(code == "del") {
			if(confirm('정말 삭제 하시겠습니까?')) {
				F.action='./?p=act&code={CODE}';
				F.method='post';
				F.mode.value='multidel';
			} else {
				return false;
			}
		}
		F.submit();
	} else {
		alert('글을 선택해 주세요!!');
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
</head>

<body bgcolor="#FFFFFF" text="#333333" link="#333333" vlink="#333333" alink="#333333" topmargin="10" marginwidth="0" marginheight="0">
<table width="650" border="0" cellspacing="0" cellpadding="0">
  <tr height="10">
    <td>
      <table width="650" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td colspan="7" height="35">
            <div align="center">
              <b>{BOARD_TITLE}</b>
            </div>
          </td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td colspan="4">
            {INFO}
          </td>
          <td colspan="3">
            <div align="right">
              {WRITE}
            </div>
          </td>
        </tr>
        <tr bgcolor="#999999">
          <td colspan="7" height="1"></td>
        </tr>
        <tr bgcolor="#E4E4E4">
          <td>
            <div align="center">
              <span id="all_select" style="cursor:hand" onClick="all_chk();" title="전체 선택">■</span>
            </div>
          </td>
          <td>
            <div align="center">
              번호
            </div>
          </td>
          <td>
            제목
          </td>
          <td>
            <div align="center">
              글쓴이
            </div>
          </td>
          <td>
            <div width="15" align="center">@</div>
          </td>
          <td>
            <div align="center">
              등록일
            </div>
          </td>
          <td>
            <div align="center">
              조회수
            </div>
          </td>
        <tr>
        <tr bgcolor="#999999">
          <td colspan="7" height="1"></td>
        </tr>
        <!-- 여러글 보기기능을 위한 폼 -->
        <form method="get" action="./?p=detail&code={CODE}" name="mview_form">
        <input type="hidden" name="multiview" value="yes">
        <input type="hidden" name="p" value="detail">
        <input type="hidden" name="code" value="{CODE}">
        <input type="hidden" name="mode" value="{CODE}">
        <!-- BEGIN DYNAMIC BLOCK: gonggi -->
        <tr height="23">
          <td width="26" >
            <div align="center">{NUMBER}</div>
          </td>
          <td width="36">
            <div align="center">{NOTICE}</div>
          </td>
          <td> 
            <div align="left">{SUBJECT}</div>
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
        <tr bgcolor="#999999">
          <td colspan="7" height="1"></td>
        </tr>
        <!-- END DYNAMIC BLOCK: gonggi -->
        <!-- BEGIN DYNAMIC BLOCK: contents -->
        <tr onMouseOver=this.style.backgroundColor="#F3F3F3"; onMouseOut=this.style.backgroundColor="#FFFFFF">
          <td>
            <div align="center">
              <input type="checkbox" name="mview[]" value="{ID}" style="border:0">
            </div>
          </td>
          <td>
            <div align="center">
              {NUMBER}
            </div>
          </td>
          <td>
            {SUBJECT}
          </td>
          <td>
            <div align="center">
              {NAME}
            </div>
          </td>
          <td><div align="center">{ATTACHE}</div></td>
          <td>
            <div align="center">
              {DATE}
            </div>
          </td>
          <td>
            <div align="center">
              {HIT}
            </div>
          </td>
        <tr>
        <tr bgcolor="#999999">
          <td colspan="7" height="1"></td>
        </tr>
        <!-- END DYNAMIC BLOCK: contents -->
        </form>
        <!-- 여러글 보기기능을 위한 폼 -->
        <tr>
          <td colspan="7">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
                  {PAGE_NAV} <span style="cursor:hand" onClick="chk_multi('view')">[여러글보기]</span> <span style="cursor:hand" onClick="chk_multi('del')">[여러글삭제]</span>
                </td>
              </tr>
              <tr><td height="20"></td></tr>
              <tr>
              <form method="get" action="./" name="search_form">
              <input type="hidden" name="p" value="list">
              <input type="hidden" name="code" value="{CODE}">
              <input type="hidden" name="mode" value="srch">
                <td>
                  <div align="center">
                    검색 : 
                    <select name="what">
                      <option value="subject">제목</option>
                      <option value="name">이름</option>
                      <option value="comment">내용</option>
                    </select>
                    <input type="text" name="request" size="8">
                    <input type="button" value="검색" onClick="search();">
                  </div>
                </td>
              </tr>
              </form>
            </table>
          </td>
        </tr>
        <tr><td height="30"></td></tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
