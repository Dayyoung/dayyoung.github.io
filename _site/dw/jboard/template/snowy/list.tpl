<link rel='stylesheet' type='text/css' href='img/snowy/main.css'>
<script language=javascript src='img/snowy/main.js'></script>
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
<table width="{B_WIDTH}" border=0 cellpadding=0 cellspacing=0><tr><td width=690>
  <tr>
    <td>
      <table width=100% border=0 cellpadding=0 cellspacing=0 background=img/snowy/title_bg.gif>
        <tr>
          <td align=left width=150 valign=bottom><img src=img/snowy/title1i.gif></td>
          <td align=right width='*' valign=bottom>
            {ADMIN}<br>
            <font class=rTitle>{B_TITLE}</font>
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
                <td align=center>
                  <br>
                  <table width=98% border=0 cellspacing=1 cellpadding=2 class=line>
                    <!-- 여러글 보기를 위한 폼입니다. 폼태그와 히든폼 모두 그래도 유지 해야 합니다 -->
                    <!-- 현재의 폼이 글 목록을 모두 감싸야 합니다. contents 다이나믹블럭을 감싸 주면 됩니다 -->
                    <form method="get" action="./?p=detail&code={CODE}" name="mview_form">
                    <input type="hidden" name="multiview" value="yes">
                    <input type="hidden" name="p" value="detail">
                    <input type="hidden" name="code" value="{CODE}">
                    <tr height="28" class=c1>
                      <td width="1" title='전체선택'><p align="center"><input type="checkbox" name="" value="" style="background-color:#CCCCCC" onClick="all_chk();"></p></td>
                      <td width=30><p align=center>번호</p></td>
                      <td><p align=center>글제목</p></td>
                      <td width=35><p align=center>첨부</p></td>
                      <td width=60><p align=center>성명</p></td>
                      <td width=70><p align=center>작성일</p></td>
                      <td width=35><p align=center>조회</p></td>
                    </tr>
                    <!-- BEGIN DYNAMIC BLOCK: gonggi -->
                    <tr height="28" class=c3>
                      <td align=center>{NUMBER}</td>
                      <td align=center>{NOTICE}</td>
                      <td align=left title='{S_TITLE}'>&nbsp;{SUBJECT}</td>
                      <td align=center></td>
                      <td align=center>{NAME}</td>
                      <td align=center>{DATE}</td>
                      <td align=center>{HIT}</td>
                    </tr>
                    <!-- END DYNAMIC BLOCK: gonggi -->
                    <!-- BEGIN DYNAMIC BLOCK: contents -->
                    <tr height="28" class=c3 onMouseOver='trOver(this.style)' onMouseOut='trOut(this.style)'>
                      <td align=center><input type="checkbox" name="mview[]" value="{ID}" style="border:0; background-color:#FFFFFF"></td>
                      <td align=center>{NUMBER}</td>
                      <td align=left title='{S_TITLE}'>&nbsp;{SUBJECT}</td>
                      <td align=center>{ATTACHE}</td>
                      <td align=center>{NAME}</td>
                      <td align=center>{DATE}</td>
                      <td align=center>{HIT}</td>
                    </tr>
                    <!-- END DYNAMIC BLOCK: contents -->
                    </form>
                  </table>
                  <br>
                </td>
              </tr>
              <tr>
                <td background=img/snowy/line.gif><img src=img/snowy/dummy.gif></td>
              </tr>
              <tr>
                <td align=center class=lPage>
                  {PAGE_NAV}
                </td>
              </tr>
            </table>
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
        <form method="get" action="./" name="form">
        <input type="hidden" name="p" value="list">
        <input type="hidden" name="code" value="{CODE}">
        <input type="hidden" name="mode" value="srch">
        <tr>
          <td align=left width=23><img src=img/snowy/btn_l.gif></td>
          <td background=img/snowy/btn_bg.gif>{LINK_MVIEW}</td>
          <td>
            <p align="center"> 
              <select name="what">
                <option value="subject" selected>제목</option>
                <option value="name">이름</option>
                <option value="comment">내용</option>
              </select>
              <input type="text" name="request">
              <input type="submit" value="검색">
            </p>
          </td>
          <td align=right background=img/snowy/btn_bg.gif>{LINK_WRITE}</td>
          <td align=right width=25><img src=img/snowy/btn_r.gif></td>
        </tr>
        </form>
      </table>
    </td>
  </tr>
</table>
</DIV>