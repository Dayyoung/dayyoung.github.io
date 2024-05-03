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

function scrTaker(opt){
	var f1 = 'name';
	var f2 = 'subject';
	var f3 = 'comment';
	var G = new Array('', 'name', 'subject', 'comment');

	for (i=1;i<=3;i++){
		f = eval('f'+i);
		if (i==opt){
			document.form.what.value = G[opt];
			eval('document.scr_'+f).src = 'img/sgi_sky/scr_'+f+'_chk.gif';
		} else {
			eval('document.scr_'+f).src = 'img/sgi_sky/scr_'+f+'.gif';
		}
	}
}
-->
</script>
<!-- 컬러 -->
<link rel=stylesheet type='text/css' href='img/sgi_sky/color.css'>
<map name='mView'> 
  <area shape='circle' coords='24,16,10' href='javascript:all_chk()'>
</map>
<DIV ALIGN="{ALIGN}">
<table width="{B_WIDTH}" border=0 cellspacing=0 cellpadding=0>
  <form method="get" action="./?p=detail&code={CODE}" name="mview_form">
  <input type="hidden" name="multiview" value="yes">
  <input type="hidden" name="p" value="detail">
  <input type="hidden" name="code" value="{CODE}">
  <tr>
    <td align="center" colspan="9"><BR><H4>{B_TITLE}</h4></td>
  </tr>
  <tr>
    <td width="16"></td>
    <td colspan="4">{INFO}</td>
    <td align=right colspan="4">{ADMIN}</td>
  </tr>
  <tr>
    <td align=left width=16><img src='img/sgi_sky/title_l.gif'></td>
    <td width='49' background='img/sgi_sky/title_bg.gif' align=center><img src='img/sgi_sky/title_select.gif' usemap='#mView' border="0"></td>
    <td width='63' background='img/sgi_sky/title_bg.gif' align=center><img src='img/sgi_sky/title_no.gif'></td>
    <td width='*' background='img/sgi_sky/title_bg.gif' align=center><img src='img/sgi_sky/title_subject.gif'></td>
    <td width='72' background='img/sgi_sky/title_bg.gif' align=center><img src='img/sgi_sky/title_name.gif'></td>
    <td width='63' background='img/sgi_sky/title_bg.gif' align=center><img src='img/sgi_sky/title_file.gif'></td>
    <td width='65' background='img/sgi_sky/title_bg.gif' align=center><img src='img/sgi_sky/title_date.gif'></td>
    <td width='63' background='img/sgi_sky/title_bg.gif' align=center><img src='img/sgi_sky/title_access.gif'></td>
    <td align=right width=16><img src='img/sgi_sky/title_r.gif'></td>
  </tr>
  <!-- BEGIN DYNAMIC BLOCK: gonggi -->
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td align="center" width='49' class=base>{NUMBER}</td>
    <td align="center" width='63' class=base>{NOTICE}</td>
    <td width='*' class=base title="{S_TITLE}">{SUBJECT}</td>
    <td align="center" width='72' class=base>{NAME}</td>
    <td align="center" width='63' class=base></td>
    <td align="center" width='65' class=base>{DATE}</td>
    <td align="center" width='63' class=base>{HIT}</td>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <tr>
    <td align=left><img src='img/sgi_sky/line_l.gif'></td>
    <td align=left colspan=7 background='img/sgi_sky/line_bg.gif'><img src='img/sgi_sky/line_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/line_r.gif'></td>
  </tr>
  <!-- END DYNAMIC BLOCK: gonggi -->
  <!-- BEGIN DYNAMIC BLOCK: contents -->
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td align="center" width='49' class=base><input type="checkbox" name="mview[]" value="{ID}" class="check"></td>
    <td align="center" width='63' class=base>{NUMBER}</td>
    <td width='*'  class=base title="{S_TITLE}">{SUBJECT}</td>
    <td align="center" width='72' class=base>{NAME}</td>
    <td align="center" width='63' class=base>{ATTACHE}</td>
    <td align="center" width='65' class=base>{DATE}</td>
    <td align="center" width='63' class=base>{HIT}</td>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <tr>
    <td align=left><img src='img/sgi_sky/line_l.gif'></td>
    <td align=left colspan=7 background='img/sgi_sky/line_bg.gif'><img src='img/sgi_sky/line_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/line_r.gif'></td>
  </tr>
  <!-- END DYNAMIC BLOCK: contents -->
  </form>
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td colspan=7 align=center class=base>
      {PAGE_NAV}
    </td>
    <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <tr>
    <td align=left><img src='img/sgi_sky/line_l.gif'></td>
    <td align=left colspan=7 background='img/sgi_sky/line_bg.gif'><img src='img/sgi_sky/line_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/line_r.gif'></td>
  </tr>
  <tr>
    <td align=left background='img/sgi_sky/list_l.gif'><img src='img/sgi_sky/list_l.gif'></td>
    <td align=left colspan=3 class=base>
      <!--검색 -->
      <table border=0 cellpadding=0 cellspacing=0>
        <form method="get" action="./" name="form">
        <input type="hidden" name="p" value="list">
        <input type="hidden" name="code" value="{CODE}">
        <input type="hidden" name="mode" value="srch">
        <input type="hidden" name="what" value="subject">
        <tr>
          <td align=center>
            <input type=text name=request value='' size=14 maxlength=20 class=flat style='width:120px'>
            <input type=image value='submit' src='img/sgi_sky/scr_lupe.gif' align=absmiddle style="border:0">
          </td>
        </tr>
        <tr>
          <td align=center>
            <img src='img/sgi_sky/scr_name.gif' name='scr_name' border=0 onClick="scrTaker(1)" style="cursor: hand">
            <img src='img/sgi_sky/scr_subject_chk.gif' name='scr_subject' border=0 onClick="scrTaker(2)" style="cursor: hand">
            <img src='img/sgi_sky/scr_comment.gif' name='scr_comment' border=0 onClick="scrTaker(3)" style="cursor: hand">
          </td>
        </tr>
        </form>
      </table>
    </td>
    <td align=right colspan=4 class=base>
      {LINK_MVIEW} {LINK_WRITE}
    </td>
   <td align=right background='img/sgi_sky/list_r.gif'><img src='img/sgi_sky/list_r.gif'></td>
  </tr>
  <tr>
    <td align=left><img src='img/sgi_sky/tail_l.gif'></td>
    <td colspan=7 background='img/sgi_sky/tail_bg.gif'></td>
    <td align=right><img src='img/sgi_sky/tail_r.gif'></td>
  </tr>
</table>
