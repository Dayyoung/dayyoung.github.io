<?php
@header('Cache-Control: no-store, no-cache, must-revalidate');
@header('Cache-Control: pre-check=0, post-check=0, max-age=0');

/* 콘트롤 */
include ("./include/control.inc");

/* 생성되어 있는 게시판 구하기 */
$d_list = get_directory("../data");

/* 스킨목록 */
$skin_list = get_directory("../template");
sort($skin_list);

/* 아이콘 목록 */
$ipack_list = get_directory("../img/i-pack");
sort($ipack_list);

if($HTTP_GET_VARS[code]) {
	$mode = "modify";
	$dbm = dbmopen("../data/$HTTP_GET_VARS[code]/data.gdbm", "r");
	$data = dbmfetch($dbm, "config");
	dbmclose($dbm);
	$config = explode("|", $data);

	for($i = 0 ; $i < count($config) ; $i++) {
		$config[$i] = str_replace("rhkdvk", "|", $config[$i]);
	}
}

// 머리글 꼬리글 타이틀
$config[2] = str_replace("<", "&lt;", $config[2]);
$config[2] = str_replace(">", "&gt;", $config[2]);
$config[2] = str_replace("\"", "&quot;", $config[2]);
$config[3] = str_replace("<", "&lt;", $config[3]);
$config[3] = str_replace(">", "&gt;", $config[3]);
$config[3] = str_replace("\"", "&quot;", $config[3]);
$config[14] = str_replace("<", "&lt;", $config[14]);
$config[14] = str_replace(">", "&gt;", $config[14]);
$config[14] = str_replace("\"", "&quot;", $config[14]);

?>
<html>
<head>
<title>::게시판수정하기::</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td {  font-size: 8pt}
.b2 {  border: #999999; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; background-color: #F6F6F6}
-->
</style>
</head>

<script>
<!--
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
	var ele_00 = document.form.upmax;
	var ele_01 = document.form.ext;

	if(val == 0) {
		ele_00.disabled = true;
		ele_01.disabled = true;
	} else {
		ele_00.disabled = false;
		ele_01.disabled = false;
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
		ele.disabled = true;
	} else {
		ele.disabled = false;
		ele.focus();
	}
}

function chkdigit(val)
{
	var cmp = "0123456789";

	if(val) {
		for(var i=0; i < val.length; i++) {
			if(cmp.indexOf(val.charAt(i)) < 0) {
				return false;
				break;
			}
		}
	}
	return true;
}

function chkcode(val)
{
	var cmp = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890-_.";

	for(var i=0; i < val.length; i++) {
		if(cmp.indexOf(val.charAt(i)) < 0) {
			return false;
			break;
		}
	}
	return true;
}

function chkcode2(val)
{
	var cmp = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_";

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

function change_m_solution(val)
{
	F = document.form;
	if(F.member_solution.checked) {
		f_auth("yes", "id");
	} else {
		f_auth("no");
	}
}

function show_hide_table()
{
	var s_00 = detail_table.style.display;
	//var s_01 = detail_table_button.style.display;
	if(s_00 == "none") {
		detail_table.style.display = "inline";
		document.form.detail_button.value="상세수정 닫기";
		size(700, 500);
	} else {
		detail_table.style.display = "none";
		document.form.detail_button.value="상세수정 보기";
		size(700, 280);
	}
}

function f_auth(code)
{
	var disable, F = document.form;

	if(code == 'yes' || code == 'jb_ec' || code == 'jb_mem') {
		disable = false;
	} else {
		disable = true;
	}

	if(code == 'yes') {
		sp_auth.style.display = 'inline';
	} else {
		sp_auth.style.display = 'none';
	}

	if(code == 'jb_ec') {
		for(var i = 0 ; i < F.auth_method.length ; i++) {
			if(F.auth_method[i].value = 'cookie') F.auth_method[i].checked = true;
		}
		F.variable_name.value = 'guid';
		F.var_level.value = 'ulevel';
	}

	if(code == 'jb_mem') {
		for(var i = 0 ; i < F.auth_method.length ; i++) {
			if(F.auth_method[i].value = 'session') F.auth_method[i].checked = true;
		}
		F.variable_name.value = 'id';
		F.var_level.value = 'level';
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

function ctrl_ipack()
{
	var F = document.form;
	if(F.with_icon.checked) {
		F.ipack.disabled = false;
	} else {
		F.ipack.disabled = "disable";
	}
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
	/**
	if(!F.explain.value) {
		alert('게시판 설명을 입력해 주세요');
		F.explain.focus();
		return false;
	}
	*/

	/** 글자수 제한 체크 */
	if(F.subject_length.value && !chkdigit(F.subject_length.value)) {
		alert('제목 글자수는 숫자로 입력하셔야 합니다.');
		F.subject_length.focus();
		return false;
	}

	/* 게시판 머리 */
	/**
	if(!F.header.value) {
		alert('게시판 머리부분을 셋팅해 주십시오');
		F.header.focus();
		return false;
	}
	*/

	/* 게시판 꼬리 */
	/**
	if(!F.footer.value) {
		alert('게시판 꼬리말을 셋팅해 주십시오');
		F.footer.focus();
		return false;
	}
	*/

	/* 게시판 폭 */
	if(!F.bwidth.value) {
		alert('게시판 폭을 입력해 주세요');
		F.bwidth.focus();
		return false;
	}

	/* 새글 등록 */
	for(var i = 0 ; i < F.new_alert.length ; i++) {
		if(F.new_alert[i].checked) {
			if(F.new_alert[i].value == 1) {
				if(!F.new_alert_email.value) {
					alert('새글알림 이메일 주소를 입력해 주세요');
					F.new_alert_email.focus();
					return false;
				} else {
					if(F.new_alert_email.value.search(/(\S+)@(\S+)\.(\S+)/) == -1 ) {
						alert('새글알림 이메일 주소가 유효하지 않는 이메일 주소 입니다.');
						F.new_alert_email.focus();
						return false;
					}
				}
			}
		}
	}

	/** 본문 이미지 사이즈 체크 */
	if(F.body_img_size.value && !chkdigit(F.body_img_size.value)) {
		alert('본문 이미지 사이즈는 숫자로 입력하셔야 합니다.');
		F.body_img_size.focus();
		return false;
	}

	/** 새창 사이즈 조절 하기 */
	if(F.img_win_size_width.value && !chkdigit(F.img_win_size_width.value)) {
		alert('새창의 사이즈는 숫자로 입력하여 주십시오.');
		F.img_win_size_width.focus();
		return false;
	}
	if(F.img_win_size_height.value && !chkdigit(F.img_win_size_height.value)) {
		alert('새창의 사이즈는 숫자로 입력하여 주십시오.');
		F.img_win_size_height.focus();
		return false;
	}
	if(F.img_win_size_width.value && !F.img_win_size_height.value) {
		alert('새창의 사이즈는 가로, 세로 모두 입력하여 주십시오.');
		F.img_win_size_height.focus();
		return false;
	}
	if(!F.img_win_size_width.value && F.img_win_size_height.value) {
		alert('새창의 사이즈는 가로, 세로 모두 입력하여 주십시오.');
		F.img_win_size_width.focus();
		return false;
	}

	/* 페이지당 글 개수 */
	if(F.a_scale.value == "user") {
		if(!F.a_scale_user.value) {
			alert('페이지별 게시물 개수를 입력해 주세요');
			F.a_scale_user.focus();
			return false;
		} else {
			if(!chkdigit(F.a_scale_user.value)) {
				alert('페이지별 개시물 개수는 숫자로 입력하셔야 합니다');
				F.a_scale_user.focus();
				return false;
			}
		}
	}

	/* 페이지 나눔 개수 */
	if(F.p_scale.value == "user") {
		if(!F.p_scale_user.value) {
			alert('페이지 나눔 개수를 입력해 주세요');
			F.p_scale_user.focus();
			return false;
		} else {
			if(!chkdigit(F.p_scale_user.value)) {
				alert('페이지 나눔 개수는 숫자로 입력하셔야 합니다');
				F.p_scale_user.focus();
				return false;
			}
			var Ood = F.p_scale_user.value % 2;
			if(!Ood) {
				alert('페이지 나눔 개수는 홀수로 입력하셔야 합니다');
				F.p_scale_user.focus();
				return false;
			}
		}
	}

	/* 회원인증 */
	for(i = 0 ; i < F.member_auth.length ; i++) {
		if(F.member_auth[i].checked) {
			var ma_chk = F.member_auth[i].value;
		}
	}
	if(!ma_chk) {
		alert('회원인증 사용 여부를 선택해 주세요');
		return false;
	} else {
		if(ma_chk == 'yes') {
			for(i = 0 ; i < F.auth_method.length ; i++) {
				if(F.auth_method[i].checked) {
					var method = F.auth_method[i].value;
				}
			}
			if(!method) {
				alert('회원인증 방법을 선택해 주세요');
				return false;
			}
			if(!F.variable_name.value) {
				alert('변수이름을 입력해 주세요');
				F.variable_name.focus();
				return false;
			}
		}
	}

	// 상세 설정인경우 체크
	if(ma_chk != 'no' && F.use_authdetail.checked) {
		// 목록보기
		for(i = 0 ; i < F.perm_list.length ; i++) {
			if(F.perm_list[i].checked) {
				var perm_list = F.perm_list[i].value;
			}
		}
		if(!perm_list) {
			alert('글목록 권한을 선택해 주세요');
			F.perm_list[0].focus();
			return false;
		}
		if(perm_list == 'level' && !F.list_level.value) {
			alert('글목록의 레벨을 입력하여 주세요');
			F.list_level.focus();
			return false;
		}
		if(!chkdigit(F.list_level.value)) {
			alert('레벨입력은 숫자만 가능합니다.');
			F.list_level.value = '';
			F.list_level.focus();
			return false;
		}
		for(i = 0 ; i < F.list_level_dir.length ; i++) {
			if(F.list_level_dir[i].checked) {
				var list_level_dir = F.list_level_dir[i].value;
			}
		}
		if(perm_list == 'level' && !list_level_dir) {
			alert('입력하신 레벨의 이상, 이하를 선택하여 주세요');
			F.list_level_dir[0].focus();
			return false;
		}

		// 상세보기
		for(i = 0 ; i < F.perm_detail.length ; i++) {
			if(F.perm_detail[i].checked) {
				var perm_detail = F.perm_detail[i].value;
			}
		}
		if(!perm_detail) {
			alert('글보기 권한을 선택해 주세요');
			F.perm_detail[0].focus();
			return false;
		}
		if(perm_detail == 'level' && !F.detail_level.value) {
			alert('글보기의 레벨을 입력하여 주세요');
			F.detail_level.focus();
			return false;
		}
		if(!chkdigit(F.detail_level.value)) {
			alert('레벨입력은 숫자만 가능합니다.');
			F.detail_level.value = '';
			F.detail_level.focus();
			return false;
		}
		for(i = 0 ; i < F.detail_level_dir.length ; i++) {
			if(F.detail_level_dir[i].checked) {
				var detail_level_dir = F.detail_level_dir[i].value;
			}
		}
		if(perm_detail == 'level' && !detail_level_dir) {
			alert('입력하신 레벨의 이상, 이하를 선택하여 주세요');
			F.detail_level_dir[0].focus();
			return false;
		}

		// 글쓰기
		for(i = 0 ; i < F.perm_write.length ; i++) {
			if(F.perm_write[i].checked) {
				var perm_write = F.perm_write[i].value;
			}
		}
		if(!perm_write) {
			alert('글쓰기 권한을 선택해 주세요');
			F.perm_write[0].focus();
			return false;
		}
		if(perm_write == 'level' && !F.write_level.value) {
			alert('글쓰기의 레벨을 입력하여 주세요');
			F.write_level.focus();
			return false;
		}
		if(!chkdigit(F.write_level.value)) {
			alert('레벨입력은 숫자만 가능합니다.');
			F.write_level.value = '';
			F.write_level.focus();
			return false;
		}
		for(i = 0 ; i < F.write_level_dir.length ; i++) {
			if(F.write_level_dir[i].checked) {
				var write_level_dir = F.write_level_dir[i].value;
			}
		}
		if(perm_write == 'level' && !write_level_dir) {
			alert('입력하신 레벨의 이상, 이하를 선택하여 주세요');
			F.write_level_dir[0].focus();
			return false;
		}
	}

	// 권한이 없을 경우의 방법 체크
	if(ma_chk != 'no') {
		for(i = 0 ; i < F.deny_howto.length ; i++) {
			if(F.deny_howto[i].checked) {
				var deny_howto = F.deny_howto[i].value;
			}
		}
		if(!deny_howto) {
			alert('권한이 없을경우의 방법을 선택해 주세요');
			F.deny_howto[0].focus();
			return false;
		}
		if(deny_howto == 'msg' && !F.deny_msg.value) {
			alert('권한이 없을 경우의 경고 메세지를 입력해 주세요');
			F.deny_msg.focus();
			return false;
		}
		if(deny_howto == 'url' && !F.deny_url.value) {
			alert('권한이 없을경우의 이동할 URL 을 입력해 주세요');
			F.deny_url.focus();
			return false;
		}
		if(deny_howto == 'both') {
			if(!F.deny_msg.value) {
				alert('권한이 없을 경우의 경고 메세지를 입력해 주세요');
				F.deny_msg.focus();
				return false;
			}
			if(!F.deny_url.value) {
				alert('권한이 없을경우의 이동할 URL 을 입력해 주세요');
				F.deny_url.focus();
				return false;
			}
		}
	}

	// 레벨권한을 사용했을때 레벨변수 입력체크
	if(perm_list == "level" || perm_detail == "level" || perm_write == "level") {
		if(!F.var_level.value) {
			alert('레벨변수명을 입력하여 주세요');
			F.var_level.focus();
			return false;
		}
		if(!chkcode2(F.var_level.value)) {
			alert('레벨변수명은 영문, 숫자만 가능합니다. ');
			F.var_level.focus();
			return false;
		}
	}

	/* SUBMIT */
	F.submit();
}

function size(width, height)
{
	window.resizeTo(width, height);
}

function view_sample(value)
{
	var F = document.form;

	F.sample.value = 'false';

	window.open('./preview.php?skin=' + value, 'skin_preview_win', 'width=320, height=240');
}
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" onLoad="size(700, 250); show_hide_table();">
<form method="post" action="./admin_act.php" name="form">
<input type="hidden" name="mode" value="modify">
<input type="hidden" name="code" value="<?=$HTTP_GET_VARS[code]?>">
  <table width="652" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr> 
      <td valign="top"> 
        <p></p>
        <table width="620" border="1" cellspacing="1" cellpadding="1" bgcolor="#999999" align="center" bordercolor="#FFFFFF" align="center">
          <tr bgcolor="#EEEEFF"> 
            <td colspan="4" height="28"> 
              <p align="center">::: 게시판 기본수정 :::</p>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" bgcolor="#FEFCF5" height="23"> 
              <div align="center">게시판 코드</div>
            </td>
            <td colspan="3" height="23"> &nbsp;&nbsp;<?=$HTTP_GET_VARS[code]?></td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" bgcolor="#FEFCF5" height="23"> 
              <div align="center">게시판 타이틀</div>
            </td>
            <td colspan="3" height="23"> &nbsp; 
              <input type="text" name="title" size="40" value="<?=$config[14]?>"class="b2"> 게시판의 제목을 입력해 주세요
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" bgcolor="#FEFCF5" height="23"> 
              <div align="center">게시판 설명</div>
            </td>
            <td colspan="3" height="23"> &nbsp; 
              <input type="text" name="explain" size="40" value="<?=$config[0]?>"class="b2"> 게시판의 간단한 설명
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="123" height="23" bgcolor="#FEFCF5"> 
              <div align="center">스킨선택</div>
            </td>
            <td height="23"> &nbsp; 
              <select name="skin" class="b2">
<?php
for($i = 0 ; $i < count($skin_list) ; $i++) {
	if($config[16] == $skin_list[$i]) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	echo "<option value='$skin_list[$i]' $selected>$skin_list[$i]</option>\n";
}
?>
              </select>
              <font style="cursor:hand;" color="red" onClick="window.open('./admin_preview_00.php','preview_00','width=1000, height=600, scrollbars=yes');">[미리보고선택하기]</font>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td colspan="4" height="23"> 
              <div align="center"> 
                <input type="button" value="확인" class="b2" onClick="chk_form();">
                <input type="button" name="detail_button" value="상세수정 보기" class="b2" onClick="show_hide_table();">
              </div>
            </td>
          </tr>
        </table>
		<div align="center"><br></div>
        <table id="detail_table" width="620" border="1" cellspacing="1" cellpadding="1" height="918" bgcolor="#666666" align="center" bordercolor="#FFFFFF" align="center" style="display:none">
          <tr bgcolor="#EEEEFF"> 
            <td colspan="2" height="28"> 
              <div align="center"><font color="#333333">::: 게시판 상세수정 :::</font></div>
            </td>
          </tr>
<?php
unset($selected);
$selected[$config[20]] = "selected";
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">게시판정렬</div>
            </td>
            <td width="491"> &nbsp; 
              <select name="align">
                <option value="left" <?=$selected[left]?>>왼쪽</option>
                <option value="center" <?=$selected[center]?>>가운데</option>
                <option value="right" <?=$selected[right]?>>오른쪽</option>
              </select>
            </td>
          </tr>

          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">제목글자수</div>
            </td>
            <td width="491"> &nbsp; 
              <input type="text" name="subject_length" value="<?=$config[33]?>" size="8" class="b2"> 글자
              <BR>&nbsp;&nbsp;제한을 두지 않으려면 0을 입력하시거나, 비워두십시요.
              <BR>&nbsp;&nbsp;영문자 기준입니다. (한글1자 = 영문2자)
            </td>
          </tr>

          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">아이콘 선택</div>
            </td>
            <td width="491"> &nbsp; 
              <select name="ipack" disabled>
<?php
for($i = 0 ; $i < count($ipack_list) ; $i++) {
	if($config[18] == $ipack_list[$i]) {
		$selected = "selected";
	} else {
		$selected = "";
	}
	echo "<option value='$ipack_list[$i]' $selected>$ipack_list[$i]</option>\n";
}
?>
              </select><BR>
              &nbsp;<input type="checkbox" name="with_icon" value="y" onClick="ctrl_ipack();">아이콘을 별도로 수정하시려면 체크 하신후 상세 설정에서 아이콘을 변경해 주세요.
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5"> 
              <div align="center">게시판 머리글 [화일]</div>
            </td>
            <td width="491"> 
              <div align="left"> &nbsp; 
                <input type="text" name="f_header" value="<?=$config[26]?>" size="20">
                <BR> &nbsp;&nbsp;jboard 디렉토리를 기준으로 상대 경로를 입력해 주세요
              </div>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5"> 
              <div align="center">게시판 머리글</div>
            </td>
            <td width="491"> 
              <div align="left"> &nbsp; 
                <textarea name="header" cols="60" rows="10" class="b2"><?=$config[2]?></textarea>
              </div>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5"> 
              <div align="center">게시판 꼬리글 [화일]</div>
            </td>
            <td width="491"> 
              <div align="left"> &nbsp; 
                <input type="text" name="f_footer" value="<?=$config[27]?>" size="20">
                <BR> &nbsp;&nbsp;jboard 디렉토리를 기준으로 상대 경로를 입력해 주세요
              </div>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5"> 
              <div align="center">게시판 꼬리글</div>
            </td>
            <td width="491"> 
              <div align="left">&nbsp; 
                <textarea name="footer" cols="60" rows="10" class="b2"><?=$config[3]?></textarea>
              </div>
            </td>
          </tr>
<?php
$config[15] = str_replace("%", "", $config[15]);
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">게시판 폭</div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <input type="text" name="bwidth" size="5" value="<?=$config[15]?>" class="b2">100보다 작을 경우는 퍼센트(%)로 설정됩니다.
            </td>
          </tr>
<?php
unset($chk);
if($config[4] == "open") {
	$chk[0] = "checked";
} else {
	$chk[1] = "checked";
}
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">글쓰기 권한 </div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <input type="radio" name="permission" value="open" <?=$chk[0]?>>
              모든이 
              <input type="radio" name="permission" value="closed" <?=$chk[1]?>>
              관리자만
            </td>
          </tr>
<?php
unset($chk);
unset($disabled);
if($config[5]) {
	$chk[0] = "checked";
} else {
	$chk[1] = "checked";
	$disabled = "disabled";
}
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">새글등록 알림 </div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <input type="radio" name="new_alert" value="0" <?=$chk[1]?> onClick="f_new_alert(this.value, document.form.new_alert_email)">
              사용안함 
              <input type="radio" name="new_alert" value="1" <?=$chk[0]?> onClick="f_new_alert(this.value, document.form.new_alert_email)">
              사용함 / 메일 주소 
              <input type="text" name="new_alert_email" size="14" class="b2" value="<?=$config[5]?>" <?=$disabled?>>
              (여러개일 경우 콤마(,)로 구분
            </td>
          </tr>
<?php
unset($chk);
if($config[6] == 1) {
	$chk[0] = "checked";
} elseif($config[6] == 2) {
	$chk[2] = "checked";
} else {
	$chk[1] = "checked";
}
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">답변글등록 알림 </div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <input type="radio" name="reply_alert" value="0" <?=$chk[1]?>>
              사용안함 
              <input type="radio" name="reply_alert" value="1" <?=$chk[0]?>>
              사용함
            </td>
          </tr>
<?php
unset($chk);
unset($disabled);
if($config[7] == 1) {
	$chk[0] = "checked";
} else {
	$chk[1] = "checked";
	$disabled = "disabled";
}
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">자료실 기능 </div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <input type="radio" name="pds" value="0" <?=$chk[1]?> onClick="f_pds(this.value, document.form.upmax);">
              사용안함 
              <input type="radio" name="pds" value="1" <?=$chk[0]?> onClick="f_pds(this.value, document.form.upmax);">
              사용함
            </td>
          </tr>
<?php
unset($chk);
$tmp = $config[8];
$chk[$tmp] = "selected";
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">첨부개수</div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <select name="upmax" <?=$disabled?>>
                <option value="1" <?=$chk[1]?>>1개</option>
                <option value="2" <?=$chk[2]?>>2개</option>
                <option value="3" <?=$chk[3]?>>3개</option>
                <option value="4" <?=$chk[4]?>>4개</option>
                <option value="5" <?=$chk[5]?>>5개</option>
              </select> 개
            </td>
          </tr>

          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">허용확장자</div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <input type="text" name="ext" value="<?=$config[19]?>" size="10" class="b2" <?=$disabled?>>
              예) exe,zip,hwp (여러개일 경우 콤마(,)로 구분) / 비워두면 모두 허용
            </td>
          </tr>

          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">본문이미지 사이즈</div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <input type="text" name="body_img_size" value="<?=$config[34]?>" size="8" class="b2"> Pixel
              <BR>&nbsp;&nbsp;<img height="18" width="1" align="absmiddle">이미지를 첨부하였을때 본문에 첨부된 이미지가 자동으로 보여지게 되며,
              <BR>&nbsp;&nbsp;본문에 보여질 이미지의 최대사이즈(폭)를 지정하는 설정사항입니다.
              <BR>&nbsp;&nbsp;제한을 두지 않으려면 비워두십시오.
            </td>
          </tr>

<?php
$tmp = explode("GPGPGP", $config[35]);
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">이미지새창사이즈</div>
            </td>
            <td width="491" height="23"> &nbsp; 
              가로 : <input type="text" name="img_win_size_width" value="<?=$tmp[0]?>" size="4" class="b2"> , 
              세로 : <input type="text" name="img_win_size_height" value="<?=$tmp[1]?>" size="4" class="b2">
              <BR>&nbsp;&nbsp;<img height="18" width="1" align="absmiddle">첨부된 이미지를 볼때 뜨는 새창의 사이즈를 지정합니다.
              <BR>&nbsp;&nbsp;제한을 두지 않으려면 비워두십시오.
            </td>
          </tr>

<?php
unset($chk);
$tmp = $config[9];
$disabled = "disabled";
$chk[$tmp] = "selected";
if($tmp == "user" || ($tmp != 10 && $tmp != 15 && $tmp != 20 && $tmp != 30)) { $chk[user] = "selected"; $uvalue = $tmp; $disabled = ""; }
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">페이지별 게시물 수 </div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <select name="a_scale" onChange="f_userinput(this.value, document.form.a_scale_user)">
                <option value="10" <?=$chk[10]?>>10개
                <option value="15" <?=$chk[15]?>>15개
                <option value="20" <?=$chk[20]?>>20개
                <option value="30" <?=$chk[30]?>>30개
                <option value="user" <?=$chk[user]?>>직접입력
              </select>
              <input type="text" name="a_scale_user" size="3" value="<?=$uvalue?>" maxlength="4" class="b2" <?=$disabled?>> 개
            </td>
          </tr>
<?php
unset($chk);
unset($uvalue);
$tmp = $config[10];
$disabled = "disabled";
$chk[$tmp] = "selected";
if($tmp == "user" || ($tmp != 5 && $tmp != 7 && $tmp != 9 && $tmp != 11)) { $chk[user] = "selected"; $uvalue = $tmp; $disabled = ""; }
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">페이지 나눔 개수</div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <select name="p_scale" onChange="f_userinput(this.value, document.form.p_scale_user)">
                <option value="5" <?=$chk[5]?>>5페이지
                <option value="7" <?=$chk[7]?>>7페이지
                <option value="9" <?=$chk[8]?>>9페이지
                <option value="11" <?=$chk[11]?>>11페이지
                <option value="user" <?=$chk[user]?>>직접입력
              </select>
              <input type="text" name="p_scale_user" size="3" maxlength="3" value="<?=$uvalue?>" <?=$disabled?> class="b2"> 페이지(홀수만 가능)
            </td>
          </tr>
<?php
unset($chk);
$tmp = $config[11];
$chk[$tmp] = "checked";
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">의견글 기능 </div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <input type="radio" name="comment" value="0" <?=$chk[0]?>>
              사용안함 
              <input type="radio" name="comment" value="1" <?=$chk[1]?>>
              사용
            </td>
          </tr>
<?php
// 값이 1 또는 없으면 나중글이 위쪽(기본값)
// 처음 구현된것과 호환되게 하기 위해...
unset($chk);
if(!$config[36]) $config[36] = 1;
$chk[$config[36]] = "checked";
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">의견글 정렬순서</div>
            </td>
            <td width="491" height="23"> &nbsp; 
              나중에등록한 의견글이 
              <input type="radio" name="comment_align" value="1" <?=$chk[1]?>>
              위쪽으로
              <input type="radio" name="comment_align" value="2" <?=$chk[2]?>>
              아래쪽으로
            </td>
          </tr>
<?php
unset($chk);
$tmp = $config[12];
$chk[$tmp] = "checked";
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">본문아래 목록</div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <input type="radio" name="detail_list" value="0" <?=$chk[0]?>>
              보이지않음 
              <input type="radio" name="detail_list" value="1" <?=$chk[1]?>>
              글목록
              <input type="radio" name="detail_list" value="2" <?=$chk[2]?>>
              이전다음
            </td>
          </tr>
<?php
unset($chk);
$tmp = $config[13];
$chk[$tmp] = "checked";
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">여러글 보기시<br>의견글출력및작성</div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <input type="radio" name="multiview_comment" value="0" <?=$chk[0]?>>
              사용안함 
              <input type="radio" name="multiview_comment" value="1" <?=$chk[1]?>>
              사용
            </td>
          </tr>
<?php
unset($chk);
$tmp = $config[21];
$chk[$tmp] = "checked";
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">IP 숨김/출력</div>
            </td>
            <td width="491" height="23"> &nbsp; 
              <input type="radio" name="ip" value="0" <?=$chk[0]?>>
              숨김
              <input type="radio" name="ip" value="1" <?=$chk[1]?>>
              출력
            </td>
          </tr>
<?php
unset($chk);
if($config[22]) {
	$chk[1] = $config[22];
}
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">New 아이콘표시</div>
            </td>
            <td width="491" height="23"> &nbsp;
              글등록후 <input type="text" name="new_term" value="<?=$chk[1]?>" size="2" class="b2"> 일 까지 출력
              (입력안할시 출력안됨)
            </td>
          </tr>
<?php
unset($chk);
$chk[1] = $config[23];
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">Hot 아이콘표시</div>
            </td>
            <td width="491" height="23"> &nbsp;
              조회수가 <input type="text" name="hot_count" value="<?=$chk[1]?>" size="2" class="b2"> 회 이상이면 출력
              (입력안할시 출력안됨)
            </td>
          </tr>
<?php
unset($chk);
$tmp = $config[24];
if(!$config[24]) $tmp = "y";
$chk[$tmp] = "checked";
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">테이블 늘어남 방지</div>
            </td>
            <td width="491" height="23"> &nbsp;
              <input type="radio" name="pretag" value="y" <?=$chk[y]?>>
              설정
              <input type="radio" name="pretag" value="n" <?=$chk[n]?>>
              설정안함
              <BR> &nbsp;html사용안함으로 체크하고 엔터없이 긴글을 입력시 테이블이 늘어나는것을 방지 합니다.
            </td>
          </tr>
<?php
unset($chk);
$tmp = $config[25];
if(!$config[25]) $tmp = "y";
$chk[$tmp] = "checked";
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">URL 자동링크 사용</div>
            </td>
            <td width="491" height="23"> &nbsp;
              <input type="radio" name="auto_link" value="y" <?=$chk[y]?>>
              사용
              <input type="radio" name="auto_link" value="n" <?=$chk[n]?>>
              사용안함
              <BR> &nbsp;본문내 URL 주소가 있을 경우 자동으로 링크가 생성이 되는 옵션입니다.
            </td>
          </tr>
<?php
unset($chk);
$tmp = explode("\n", $config[17]);
if($tmp[0] == "yes" || $tmp[0] == "jb_ec" || $tmp[0] == "jb_mem") $disable = ""; else $disable = "disabled";
if($tmp[0] == "yes") $display = "inline"; else $display = "none";
for($i = 0 ; $i < count($tmp) ; $i++) {
	$G = $tmp[$i];
	$chk[$G] = "checked";
}
if(!$chk[session] && !$chk[cookie] && !$chk[sesscookie]) {
	$chk[session] = "checked";
}
if(!$chk[none] && !$chk[read] && !$chk[write]) {
	$chk[read] = "checked";
}
$chk[variable_name] = $tmp[2];
?>
<script>
<!--
function show_hide_authdetail(key)
{
	if(key) {
		dis_0 = 'inline';
		dis_1 = 'none';
	} else {
		dis_0 = 'none';
		dis_1 = 'inline';
	}
	auth_detailtr.style.display = dis_0;
	ilban_premission.style.display = dis_1;
}
-->
</script>
<?php
if($config[30] == "y") {
	$chk2 = "checked";
	$disp2 = "inline";
} else {
	$disp2 = "none";
}
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5"> 
              <div align="center">회원인증<BR><font color='red'>상세설정사용하기<input type="checkbox" name="use_authdetail" value="y" onClick="show_hide_authdetail(this.checked);" <?=$chk2?>></font></div>
            </td>
            <td width="491">&nbsp;
              <input type="radio" name="member_auth" value="jb_ec" style="border:0" onClick="f_auth(this.value);" <?=$chk[jb_ec]?>> 정보넷 EC 호스팅 인증사용
              <input type="radio" name="member_auth" value="jb_mem" style="border:0" onClick="f_auth(this.value);" <?=$chk[jb_mem]?>> 정보넷 회원관리 인증사용<BR>
              &nbsp;
              <input type="radio" name="member_auth" value="yes" style="border:0" onClick="f_auth(this.value);" <?=$chk[yes]?>> 기타 인증사용
              <input type="radio" name="member_auth" value="no" style="border:0" onClick="f_auth(this.value);" <?=$chk[no]?>> 인증사용안함
              <input type="hidden" name="member_solution" value="yes" style="border:0" onClick="change_m_solution();"><BR>
              <span id="ilban_premission" name="ilban_premission">
              <input type="text" name="n_02" style="border:0" value="비회원 권한" size="12" <?=$disable?> readonly class="b2">
              <input type="radio" name="mpermission" value="none" style="border:0"  <?=$disable?> <?=$chk[none]?>> 권한없음
              <input type="radio" name="mpermission" value="read" style="border:0" <?=$disable?> <?=$chk[read]?>> 읽기
              <input type="radio" name="mpermission" value="write" style="border:0" <?=$disable?> <?=$chk[write]?>> 쓰기 (회원은 모든권한)<BR>
              </span>
              <span ID="sp_auth" style="display:<?=$display?>">
              <input type="text" name="n_00" style="border:0" value="인증방법 선택" size="12" <?=$disable?> readonly class="b2">
              <input type="radio" name="auth_method" value="session" style="border:0" <?=$disable?> <?=$chk[session]?>> 세션 인증
              <input type="radio" name="auth_method" value="cookie" style="border:0" <?=$disable?> <?=$chk[cookie]?>> 쿠키 인증<BR>
              <input type="text" name="n_01" style="border:0" value="변수 이름 설정" size="12" <?=$disable?> class="b2">
              <input type="text" name="variable_name" size="10" <?=$disable?> value="<?=$chk[variable_name]?>" class="b2"> *대소문자를 구분하오니 정확하게 입력해 주세요
              </span>
            </td>
          </tr>

<?php
unset($chk);
$tmp = explode("\n", $config[29]);
if(!$tmp[1]) $tmp[1] = "권한이 없습니다.";
if(!$tmp[0]) $tmp[0] = "msg";
$chk[$tmp[0]] = "checked";
?>

          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5"> 
              <div align="center">권한이 없을 경우</div>
            </td>
            <td width="491">
              &nbsp;<input type="radio" name="deny_howto" value="msg" <?=$chk[msg]?>> 경고창띄우기<img width="10" height="1"><font color="#ff0066">경고메세지</font> <input type="text" name="deny_msg" value="<?=$tmp[1]?>" size="28" class="b2"><BR>
              <img width="1" height="5"><BR>
              &nbsp;<input type="radio" name="deny_howto" value="url" <?=$chk[url]?>> 페이지이동<img width="10" height="1"><font color="#ff0066">이동 주소</font> <input type="text" name="deny_url" value="<?=$tmp[2]?>" size="28" class="b2"><BR>
              &nbsp;<font color="#CC33FF">경로는 jboard/index.php 를 기준으로한 상대 경로 또는 절대 경로를 입력하세요</font>
              <img width="1" height="5"><BR>
              &nbsp;<input type="radio" name="deny_howto" value="both" <?=$chk[both]?>> 경고창띄운후 페이지 이동
            </td>
          </tr>

          <tr bgcolor="#FFFFFF" id="auth_detailtr" name="auth_detailtr" style="display:<?=$disp2?>"> 
            <td width="122" bgcolor="#F9ECEC">
              <div align="center">회원인증 상세설정</div>
            </td>
            <td width="491">
              &nbsp;<font color='red'>이부분은 회원인증 옵션을 사용할 경우에만 해당됩니다</font><BR>
              &nbsp;<B>글목록(list)</B>
<?php
$tmp = explode("\n", $config[31]);
unset($chk2, $chk, $cfg);
$cfg = explode("?gppg?", $tmp[0]);
$chk[$cfg[0]] = "checked";
$chk2[$cfg[2]] = "checked";
?>
              <input type="radio" name="perm_list" value="open" <?=$chk[open]?>> 비회원,
              <input type="radio" name="perm_list" value="member" <?=$chk[member]?>> 회원만,
              <input type="radio" name="perm_list" value="level" <?=$chk[level]?>> 레벨 (
              <input type="text" name="list_level" value="<?=$cfg[1]?>" size="4" class="b2">
              <input type="radio" name="list_level_dir" value="more" <?=$chk2['more']?>>이상, <input type="radio" name="list_level_dir" value="less" <?=$chk2['less']?>>이하 )<BR>
              &nbsp;<B>글보기(detail)</B>
<?php
unset($chk2, $chk, $cfg);
$cfg = explode("?gppg?", $tmp[1]);
$chk[$cfg[0]] = "checked";
$chk2[$cfg[2]] = "checked";
?>
              <input type="radio" name="perm_detail" value="open" <?=$chk[open]?>> 비회원,
              <input type="radio" name="perm_detail" value="member" <?=$chk[member]?>> 회원만,
              <input type="radio" name="perm_detail" value="level" <?=$chk[level]?>> 레벨 (
              <input type="text" name="detail_level" value="<?=$cfg[1]?>" size="4" class="b2">
              <input type="radio" name="detail_level_dir" value="more" <?=$chk2['more']?>>이상, <input type="radio" name="detail_level_dir" value="less" <?=$chk2['less']?>>이하 )<BR>
              &nbsp;<B>글쓰기</B>
<?php
unset($chk2, $chk, $cfg);
$cfg = explode("?gppg?", $tmp[2]);
$chk[$cfg[0]] = "checked";
$chk2[$cfg[2]] = "checked";
?>
              <input type="radio" name="perm_write" value="open" <?=$chk[open]?>> 비회원,
              <input type="radio" name="perm_write" value="member" <?=$chk[member]?>> 회원만,
              <input type="radio" name="perm_write" value="level" <?=$chk[level]?>> 레벨 (
              <input type="text" name="write_level" value="<?=$cfg[1]?>" size="4" class="b2">
              <input type="radio" name="write_level_dir" value="more" <?=$chk2['more']?>>이상, <input type="radio" name="write_level_dir" value="less" <?=$chk2['less']?>>이하 )<BR>
              &nbsp;레벨변수설정 : <input type="text" name="var_level" value="<?=$config[32]?>" size="8" class="b2">
            </td>
          </tr>


<?php
unset($chk);
$chk[$config[28]] = "checked";
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">글번호</div>
            </td>
            <td width="491" height="23"> &nbsp;
              <input type="radio" name="use_number" value="y" <?=$chk[y]?>>
              실제글번호사용
              <input type="radio" name="use_number" value="n" <?=$chk[n]?>>
              가상글번호사용
              <BR> &nbsp;가상 글번호는 글이 삭제가 되더라도 순서에 맞게 맞춰지게 됩니다.
            </td>
          </tr>

<?php
unset($chk);
if($config[38] == "y") $chk = "checked";
?>
          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">나쁜말 등록거부</div>
            </td>
            <td width="491" height="23"> &nbsp;
              <input type="checkbox" name="use_bad_words" value="y" <?=$chk?>>
              나쁜말 등록거부기능을 사용합니다. (제목, 내용, 이름)
            </td>
          </tr>

          <tr bgcolor="#FFFFFF"> 
            <td width="122" bgcolor="#FEFCF5" height="23"> 
              <div align="center">나쁜말 단어</div>
            </td>
            <td width="491" height="23"> &nbsp;
              <textarea name="bad_words" rows="10" cols="60"><?=$config[37]?></textarea>
              <BR>&nbsp;&nbsp;<input type="button" value="자동삽입" onClick="insert_BadWords()" class="b2">
              미리 정의된 단어를 삽입합니다.
            </td>
          </tr>

          <tr bgcolor="#FFFFFF"> 
            <td colspan="2"> 
              <div align="center"> 
                <input type="button" value="확인" class="b2" onClick="chk_form();">
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</form>
</body>

<script>
<!--
function insert_BadWords()
{
	var str = "8억,새끼,개새끼,소새끼,병신,지랄,씨팔,십팔,니기미,찌랄,지랄,쌍년,쌍놈,빙신,좆까,니기미,좆같은게,잡놈,벼엉신,바보새끼,씹새끼,씨발,씨팔,시벌,씨벌,떠그랄,좆밥,추천인,추천id,추천아이디,추천id,추천아이디,추/천/인,쉐이,등신,싸가지,미친놈,미친넘,찌랄,죽습니다,님아,님들아,씨밸넘";
	document.form.bad_words.value += str;
}
-->
</script>

</html>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->

<pre>
<? //print_r($config) ?>
</pre>
