<?php
/* 콘트롤 */
include ("./include/control.inc");

/* 생성되어 있는 게시판 구하기 */
$d_list = get_directory("../data");

/* 스킨목록 */
$skin_list = get_directory("../template");
sort($skin_list);
?>
<html>
<head>
<title>::게시판 생성하기::</title>
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
function view_sample(value)
{
	var F = document.form;

	F.sample.value = 'false';

	window.open('./preview.php?skin=' + value, 'skin_preview_win', 'width=320, height=240');
}

function chk_code_dup()
{
	var F = document.form;
	if(!F.code.value.length) {
		alert('중복확인할 게시판 아이디를 입력해 주세요');
		F.code.focus();
		return false;
	}
	var url = './chk_dup.php?val=' + F.code.value;
	window.open(url, 'dup_win','width=320, height=160');
}

function f_pds(val, ele)
{
	var ele = document.form.upmax;

	if(val == 0) {
		ele.disabled = true;
		ele.selectedIndex = 0;
	} else {
		ele.disabled = false;
	}
}

function f_userinput(val, ele)
{
	if(val == "user") {
		ele.disabled = false;
		ele.focus();
	} else {
		ele.value = "";
		ele.disabled = true;
	}
}

function f_new_alert(val, ele)
{
	if(val == 0) {
		ele.value = "";
		ele.disabled = true;
	} else {
		ele.disabled = false;
		ele.focus();
	}
}

function chkdigit(val)
{
	var cmp = "0123456789";

	for(var i=0; i < val.length; i++) {
		if(cmp.indexOf(val.charAt(i)) < 0) {
			return false;
			break;
		}
	}
	return true;
}

function chkcode(val)
{
	var cmp = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890";

	for(var i=0; i < val.length; i++) {
		if(cmp.indexOf(val.charAt(i)) < 0) {
			return false;
			break;
		}
	}
	return true;
}

function chkdigit(val)
{
	var cmp = "0123456789";

	for(var i=0; i < val.length; i++) {
		if(cmp.indexOf(val.charAt(i)) < 0) {
			return false;
			break;
		}
	}
	return true;
}

function f_auth(code)
{
	var disable, F = document.form;

	if(code == 'yes') {
		disable = false;
	} else {
		disable = true;
	}

	for(var i = 0 ; i < F.auth_method.length ; i++) {
		F.auth_method[i].disabled = disable;
	}
	for(var i = 0 ; i < F.mpermission.length ; i++) {
		F.mpermission[i].disabled = disable;
	}
	F.variable_name.disabled = disable;
	F.n_00.disabled = disable;
	F.n_01.disabled = disable;
	F.n_02.disabled = disable;
}

function chk_form()
{
	var F = document.form;

	/* 게시판 아이디 */
	if(!F.code.value) {
		alert('게시판 고유 아이디를 입력해 주세요');
		F.code.focus();
		return false;
	}
	if(!chkcode(F.code.value) || F.code.value.length < 2 || F.code.value.length > 16) {
		alert('게시판 고유아이디는 영문, 숫자 2자~16자까지 입니다');
		F.code.focus();
		return false;
	}

	/* 게시판 타이틀 */
	/**
	if(!F.title.value) {
		alert('게시판 타이틀을 입력해 주세요');
		F.title.focus();
		return false;
	}
	*/

	/* 게시판 설명 */
	/*
	if(!F.explain.value) {
		alert('게시판 설명을 입력해 주세요');
		F.explain.focus();
		return false;
	}
	*/

	/* SUBMIT */
	F.submit();
}

function size()
{
	window.resizeTo(720, 280);
}
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#333333" vlink="#333333" alink="#FF0033" topmargin="0" leftmargin="0" marginwidth="0" marginheight="0" onLoad="size();">
<html>
<head>
<title>jboard :: 게시판 생성</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td {  font-size: 8pt}
.b2 {  border: #999999; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; background-color: #F6F6F6}
-->
</style>
</head>

<body bgcolor="#FFFFFF" text="#000000">
<form method="post" action="./admin_act.php" name="form">
<input type="hidden" name="mode" value="new">
  <table width="652" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td> 
        <p>&nbsp;</p>
        <table width="620" border="1" cellspacing="1" cellpadding="1" height="157" bgcolor="#999999" align="center" bordercolor="#FFFFFF">
          <tr bgcolor="#EEEEFF"> 
            <td colspan="4" height="28"> 
              <p align="center">::: 게시판 생성 :::</p>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" bgcolor="#FEFCF5" height="23"> 
              <div align="center">게시판 코드</div>
            </td>
            <td colspan="3" height="23"> &nbsp;
              <input type="text" name="code" size="6" value="<?=$HTTP_GET_VARS[code]?>" class="b2">
              게시판의 고유 아이디를 입력해 주세요(2자~16자 영문,숫자) <input type="button" value="중복확인" onClick="chk_code_dup()" class="b2">
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" bgcolor="#FEFCF5" height="23"> 
              <div align="center">게시판 타이틀</div>
            </td>
            <td colspan="3" height="23"> &nbsp; 
              <input type="text" name="title" value="<img src=./img/board.gif>" size="40" class="b2"> 게시판의 제목을 입력해 주세요
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" bgcolor="#FEFCF5" height="23"> 
              <div align="center">게시판 설명</div>
            </td>
            <td colspan="3" height="23"> &nbsp;
              <input type="text" name="explain" size="40" class="b2"> 게시판의 간단한 설명
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" height="23" bgcolor="#FEFCF5"> 
              <div align="center">스킨선택</div>
            </td>
            <td height="23" colspan="3"> &nbsp; 
              <select name="skin" class="b2">
<?php
for($i = 0 ; $i < count($skin_list) ; $i++) {
	echo "<option value='$skin_list[$i]'>$skin_list[$i]</option>\n";
}
?>
              </select>
              <font style="cursor:hand;" color="red" onClick="window.open('./admin_preview_00.php','preview_00','width=1000, height=600, scrollbars=yes');">[미리보고선택하기]</font>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" bgcolor="#FEFCF5" height="23"> 
              <div align="center">이미 생성된 게시판<BR>설정 적용</div>
            </td>
            <td colspan="3" height="23"> &nbsp; 
              <select name="pre_set">
                <option value="0">선택해 주세요</option>
<?php
for($i = 0 ; $i < count($d_list) ; $i++) {
	echo "<option value=\"$d_list[$i]\">$d_list[$i]</option>\n";
}        
?>
              </select>
              <BR>&nbsp;* 이미생성된 게시판의 설정을 적용하시고 싶으시면 해당하는 게시판을 선택해 주세요.
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td colspan="4" height="23"> 
              <div align="center"> 
                <input type="button" name="Submit" value="확인" class="b2" onClick="chk_form()">
              </div>
            </td>
          </tr>
        </table>
<!--
<table width="100%" cellpadding="5" cellspacing="0" border="1" bordercolordark="#FFFFFF" bordercolorlight="#000000">
<form method="post" action="./admin_act.php" name="form">
<input type="hidden" name="mode" value="new">
  <tr>
    <td width="100" align="right">
      게시판 코드
    </td>
    <td width="*">
      <input type="text" name="code" size="18"> * 게시판의 고유 아이디를 입력해 주세요(3자~8자 영문,숫자) <input type="button" value="중복확인" onClick="chk_code_dup()">
    </td>
  </tr>
    <tr>
    <td width="100" align="right">
      게시판 타이틀
    </td>
    <td width="*">
      <input type="text" name="title" size="40" value="<img src='./img/board.gif'>"> * 게시판에 대한 간단한 설명을 입력해 주세요
    </td>
  </tr>
  <tr>
    <td width="100" align="right">
      게시판 설명
    </td>
    <td width="*">
      <input type="text" name="explain" size="40"> * 게시판에 대한 간단한 설명을 입력해 주세요
    </td>
  </tr>
  <tr>
    <td width="100" align="right">
      스킨선택
    </td>
    <td>
      <select name="skin">
<?php
for($i = 0 ; $i < count($skin_list) ; $i++) {
	echo "<option value='$skin_list[$i]'>$skin_list[$i]</option>\n";
}
?>
      </select>
    </td>
  </tr>
</table>
</form>
<table width="100%" cellpadding="5" cellspacing="0" border="0">
  <tr>
    <td colspan="2">
      <div align="right">
        <input type="button" value="확인!!" onClick="chk_form()">
      </div>
    </td>
  </tr>
</table>
-->
</body>
</html>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->
