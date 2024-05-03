<?php
/* 콘트롤 */
include ("./include/control.inc");


/*
	게시판 생성일 경우
*/
if($HTTP_POST_VARS[mode] == "new") {
	/* 입력내용 확인 */
	$d_list = get_directory("../data");
	if(!$HTTP_POST_VARS[code]) {
		err("게시판 고유 아이디를 입력해 주세요");
		exit;
	}
	for($i = 0 ; $i < count($d_list) ; $i++) {
		if($d_list[$i] == $HTTP_POST_VARS[code] || !ereg("(^[0-9a-zA-Z]{2,16}$)", $HTTP_POST_VARS[code])) {
			err("존재하는 게시판 코드 또는, 형식에 어긋난 게시판 코드 입니다");
			exit;
		}
	}

	/**
	if(!$HTTP_POST_VARS[title]) {
		err("게시판 타이틀을 입력해 주세요");
		exit;
	}
	*/

	if(!$HTTP_POST_VARS[skin]) {
		err("게시판 스킨을 선택해 주세요");
		exit;
	}

	/* 설정 데이터 생성 */
	if($HTTP_POST_VARS[pre_set]) {
		$dbm = dbmopen("../data/".$HTTP_POST_VARS[pre_set]."/data.gdbm", "r");
		$base_config = dbmfetch($dbm, "config");
		dbmclose($dbm);
		$base_config = explode("|", $base_config);
		$base_config[14] = $HTTP_POST_VARS[title];
		$base_config[16] = $HTTP_POST_VARS[skin];
		$config = implode("|", $base_config);
	} else {
		include ("./include/head.inc");
		include ("./include/foot.inc");
		$config = "$HTTP_POST_VARS[explain]||$header|$footer|open|";
		$config .= "|";
		$config .= "0|0|0|";
		$config .= "15|";
		$config .= "7|";
		$auth = "no\n\n\n";
		$width = (ereg("sgi", $HTTP_POST_VARS[skin])) ? 700 : 650;
		$config .= "1|1|1|$HTTP_POST_VARS[title]|$width|$HTTP_POST_VARS[skin]|$auth|$HTTP_POST_VARS[skin]||left";
	}

	/* 체크가 끝났으면 게시판 생성 */
	$path[base] = "../data/$HTTP_POST_VARS[code]";
	$path[binary] = "$path[base]/binary";
	if(!mkdir($path[base], "0777")) {
		exec("rm -rf ../data/$HTTP_POST_VARS[code]");
		err("게시판 생성 실패 하였습니다. 다시 시도하세요");
		exit;
	}
	if(!chmod($path[base], 0777)) {
		exec("rm -rf ../data/$HTTP_POST_VARS[code]");
		err("게시판 생성 실패 하였습니다. 다시 시도하세요");
		exit;
	}
	if(!mkdir($path[binary], "0777")) {
		exec("rm -rf ../data/$HTTP_POST_VARS[code]");
		err("게시판 생성 실패 하였습니다. 다시 시도하세요");
		exit;
	}
	if(!chmod($path[binary], 0777)) {
		exec("rm -rf ../data/$HTTP_POST_VARS[code]");
		err("게시판 생성 실패 하였습니다. 다시 시도하세요");
		exit;
	}
	//@exec("touch $path[base]/idx");

	/* 설정데이터 입력 */
	$dbm = dbmopen("$path[base]/data.gdbm", "n");
	dbminsert($dbm, "config", $config);
	dbmclose($dbm);
	$dbm = dbmopen("$path[base]/comment.gdbm", "n");
	dbmclose($dbm);
	echo "<script>alert('생성되었습니다');opener.document.location.reload(true); window.close();</script>";
	/* 생성일 경우 여기까지 루틴 */
}



/* 
	게시판 수정일 경우
*/
if($HTTP_POST_VARS[mode] == "modify") {
	/* 체크 */
	while(list($key,$value) = each($HTTP_POST_VARS)) {
		$tmp = trim($value);
		$tmp = stripslashes($tmp);
		$tmp = str_replace("rhkdvk", "", $tmp);
		$tmp = str_replace("|", "rhkdvk", $tmp);
		$HTTP_POST_VARS[$key] = $tmp;
	}
	/**
	if(!$HTTP_POST_VARS[title]) {
		err("게시판 타이틀을 입력해 주세요");
		exit;
	}
	*/

	if(!$HTTP_POST_VARS[skin]) {
		err("게시판 스킨을 선택해 주세요");
		exit;
	}

	/**
	if(!trim($HTTP_POST_VARS[header])) {
		err("게시판 머리글을 입력해 주세요");
		exit;
	}
	$HTTP_POST_VARS[header] = stripslashes($HTTP_POST_VARS[header]);

	if(!trim($HTTP_POST_VARS[footer])) {
		err("게시판 꼬리글을 입력해 주세요");
		exit;
	}
	$HTTP_POST_VARS[footer] = stripslashes($HTTP_POST_VARS[footer]);
	*/


	if(!$HTTP_POST_VARS[bwidth]) {
		err("게시판 폭을 입력해 주세요");
		exit;
	}

	if($HTTP_POST_VARS[new_alert] == 1) {
		if(!$HTTP_POST_VARS[new_alert_email]) {
			err("새글등록 알림 메일 주소를 입력해 주세요");
			exit;
		} else {
			if(!chk_email($HTTP_POST_VARS[new_alert_email])) {
				err("유효한 이메일 주소가 아닙니다");
				exit;
			}
		}
	}

	if(!$HTTP_POST_VARS[a_scale]) {
		err("페이지별 게시물 개수를 선택해 주세요");
		exit;
	}
	if($HTTP_POST_VARS[a_scale] == "user") {
		if(!$HTTP_POST_VARS[a_scale_user]) {
			err("페이지별 게시물 개수를 입력해 주세요");
			exit;
		}
	}

	if(!$HTTP_POST_VARS[p_scale]) {
		err("페이지 나눔 개수를 선택해 주세요");
		exit;
	}
	if($HTTP_POST_VARS[p_scale] == "user") {
		if(!$HTTP_POST_VARS[p_scale_user]) {
			err("페이지 나눔 개수를 입력해 주세요");
			exit;
		} else {
			$tmp = $HTTP_POST_VARS[p_scale_user] % 2;
			if(!$tmp) {
				err("페이지 나눔 개수는 홀수로 입력해 주세요");
				exit;
			}
		}
	}

	// 회원인증 관련 부분 체크
	if(!$HTTP_POST_VARS[member_auth]) {
		err("회원인증 사용여부를 선택해 주세요");
		exit;
	}
	if($HTTP_POST_VARS[member_auth] == "yes") {
		if(!$HTTP_POST_VARS[auth_method]) {
			err("인증방법을 선택해 주세요");
			exit;
		}
		if(!$HTTP_POST_VARS[variable_name]) {
			err("변수명을 입력해 주세요");
			exit;
		}
		if(!$HTTP_POST_VARS[mpermission]) {
			err("비회원 권한을 설정해 주세요");
			exit;
		}
	}
	$post = $HTTP_POST_VARS;
	if($post[use_authdetail] == "y") {
		if(!$post[perm_list]) { err("글목록 권한을 선택해 주세요"); exit; }
		if($post[perm_list] == "level" && !$post[list_level]) { err("글목록 레벨을 입력하여 주세요."); exit; }
		if($post[perm_list] == "level" && $post[list_level] && !$post[list_level_dir]) { err("글목록 레벨의 이상, 이하를 입력하여 주세요"); exit; }
		if(!$post[perm_detail]) { err("글보기 권한을 선택해 주세요"); exit; }
		if($post[perm_detail] == "level" && !$post[detail_level]) { err("글보기 레벨을 입력하여 주세요."); exit; }
		if($post[perm_detail] == "level" && $post[detail_level] && !$post[detail_level_dir]) { err("글보기 레벨의 이상, 이하를 입력하여 주세요"); exit; }
		if(!$post[perm_write]) { err("글쓰기 권한을 선택해 주세요"); exit; }
		if($post[perm_write] == "level" && !$post[write_level]) { err("글쓰기 레벨을 입력하여 주세요."); exit; }
		if($post[perm_write] == "level" && $post[write_level] && !$post[write_level_dir]) { err("글쓰기 레벨의 이상, 이하를 입력하여 주세요"); exit; }
	}
	if(!$post[deny_howto]) { err("권한이 없을때의 이동방법을 선택하여 주세요."); exit; }
	if($post[deny_howto] == "msg" && !$post[deny_msg]) { err("권한이 없을때의 경고 메세지를 입력해 주세요"); exit; }
	if($post[deny_howto] == "url" && !$post[deny_url]) { err("권한이 없을때의 이동할 페이지의 경로를 입력해 주세요"); exit; }
	if($post[deny_howto] == "both") {
		if(!$post[deny_msg]) { err("권한이 없을때의 경고 메세지를 입력해 주세요"); exit; }
		if(!$post[deny_url]) { err("권한이 없을때의 이동할 페이지의 경로를 입력해 주세요"); exit; }
	}
	if($post[perm_list] == "level" || $post[perm_detail] == "level" || $post[perm_write] == "level") {
		if(!$post[var_level]) { err("레벨변수명을 입력하여 주세요."); exit; }
	}

	/* 체크가 끝났으면 게시판 수정 */
	$path[base] = "../data/$HTTP_POST_VARS[code]";
	$config = "$HTTP_POST_VARS[explain]|$HTTP_POST_VARS[admin]|$HTTP_POST_VARS[header]|$HTTP_POST_VARS[footer]|$HTTP_POST_VARS[permission]|";
	if($HTTP_POST_VARS[new_alert] == "1") {
		$config .= "$HTTP_POST_VARS[new_alert_email]|";
	} else {
		$config .= "|";
	}
	$config .= "$HTTP_POST_VARS[reply_alert]|$HTTP_POST_VARS[pds]|$HTTP_POST_VARS[upmax]|";
	if($HTTP_POST_VARS[a_scale] == "user") {
		$config .= "$HTTP_POST_VARS[a_scale_user]|";
	} else {
		$config .= "$HTTP_POST_VARS[a_scale]|";
	}
	if($HTTP_POST_VARS[p_scale] == "user") {
		$config .= "$HTTP_POST_VARS[p_scale_user]|";
	} else {
		$config .= "$HTTP_POST_VARS[p_scale]|";
	}
	$HTTP_POST_VARS[bwidth] = str_replace("%", "", $HTTP_POST_VARS[bwidth]);
	$HTTP_POST_VARS[bwidth] = ($HTTP_POST_VARS[bwidth] < 100) ? "$HTTP_POST_VARS[bwidth]%" : $HTTP_POST_VARS[bwidth];
	$auth = "$HTTP_POST_VARS[member_auth]\n$HTTP_POST_VARS[auth_method]\n$HTTP_POST_VARS[variable_name]\n$HTTP_POST_VARS[mpermission]";
	$tmp = explode(",", $HTTP_POST_VARS[ext]);
	for($i = 0 ; $i < count($tmp) ; $i++) {
		if($tmp[$i]) {
			$pre_ext[] = $tmp[$i];
		}
	}
	$ext = ($pre_ext) ? implode(",", $pre_ext) : "";
	$ipack = ($HTTP_POST_VARS[with_icon] == "y") ? $HTTP_POST_VARS[ipack] : $HTTP_POST_VARS[skin];
	$config .= "$HTTP_POST_VARS[comment]|$HTTP_POST_VARS[detail_list]|$HTTP_POST_VARS[multiview_comment]|$HTTP_POST_VARS[title]|$HTTP_POST_VARS[bwidth]|$HTTP_POST_VARS[skin]|$auth|$ipack|$ext|$HTTP_POST_VARS[align]|$HTTP_POST_VARS[ip]|$HTTP_POST_VARS[new_term]|$HTTP_POST_VARS[hot_count]|$HTTP_POST_VARS[pretag]|$HTTP_POST_VARS[auto_link]|$HTTP_POST_VARS[f_header]|$HTTP_POST_VARS[f_footer]|$HTTP_POST_VARS[use_number]|";
	$member_deny = "$post[deny_howto]\n$post[deny_msg]\n$post[deny_url]";
	$use_authdetail = $post[use_authdetail];
	$authdetail[] = "$post[perm_list]?gppg?$post[list_level]?gppg?$post[list_level_dir]";
	$authdetail[] = "$post[perm_detail]?gppg?$post[detail_level]?gppg?$post[detail_level_dir]";
	$authdetail[] = "$post[perm_write]?gppg?$post[write_level]?gppg?$post[write_level_dir]";
	$authdetail = implode("\n", $authdetail);
	$config .= "$member_deny|$use_authdetail|$authdetail|$post[var_level]";
	$config .= "|$post[subject_length]"; // 제목글자수 추가
	$config .= "|$post[body_img_size]"; // 본문이미지 사이즈
	$config .= "|$post[img_win_size_width]GPGPGP$post[img_win_size_height]"; // 새창 사이즈
	$config .= "|$post[comment_align]"; // 의견글 사이즈
	$config .= "|$post[bad_words]"; // 나쁜말
	$config .= "|$post[use_bad_words]"; // 나쁜말 사용여부

	$dbm = dbmopen("$path[base]/data.gdbm", "w");
	dbmreplace($dbm, "config", $config);
	dbmclose($dbm);

	//echo "<script>alert('수정되었습니다'); window.close();</script>";
	echo "<script>alert('수정되었습니다'); this.document.location.href='$HTTP_REFERER'</script>";
	/* 게시판 설정 수정 여기까지 */
}

/* 게시판 삭제 */
if($HTTP_POST_VARS[mode] == "del") {
	if(!$HTTP_POST_VARS[code]) {
		err("게시판 코드가 없습니다");
		exit;
	}

	$path = "../data/$HTTP_POST_VARS[code]";
	@exec("rm -rf $path");

	echo "<script>alert('삭제되었습니다'); this.document.location.href='$HTTP_REFERER'</script>";
	/* 게시판 삭제 루틴 끝 */
}

/* 관리자 비번 변경 */
if($HTTP_POST_VARS[mode] == "modify_pw") {
	if(!$HTTP_POST_VARS[pw1] || !$HTTP_POST_VARS[pw2]) {
		err("비밀번호를 입력해 주세요");
		exit;
	}
	if($HTTP_POST_VARS[pw1] != $HTTP_POST_VARS[pw2]) {
		err("비밀번호가 일치하지 않습니다");
		exit;
	}
	
	$dbm = dbmopen("./login/admin.gdbm", "w");
	$pw = get_pw($HTTP_POST_VARS[pw1]);
	dbmreplace($dbm, "admin_pw", $pw);
	dbmclose($dbm);
	echo "<script>alert('변경되었습니다. 변경된 비밀번호는 다음번 로그인시 부터 적용됩니다');this.document.location.href='$HTTP_REFRERE'</script>";
}

/* 이메일주소 변경 */
if($HTTP_POST_VARS[mode] == "modify_email") {
	if(!$HTTP_POST_VARS[email]) {
		err("이메일 주소를 입력해 주세요");
		exti;
	}
	if(!chk_email($HTTP_POST_VARS[email])) {
		err("유효한 이메일 주소가 아닙니다. 확인후 다시 입력해 주세요");
		exit;
	}
	$dbm = dbmopen("./login/admin.gdbm", "w");
	dbmreplace($dbm, "admin_email", $HTTP_POST_VARS[email]);
	dbmclose($dbm);
	echo "<script>alert('변경되었습니다.');this.document.location.href='$HTTP_REFRERE'</script>";
}

/* 게시판 주소 변경 */
if($HTTP_POST_VARS[mode] == "modify_url") {
	if(!$HTTP_POST_VARS[url]) {
		err("게시판 주소를 입력해 주세요");
		exti;
	}
	if(!chk_url($HTTP_POST_VARS[url])) {
		err("유효한 게시판 주소가 아닙니다. 확인후 다시 입력해 주세요");
		exit;
	}
	$dbm = dbmopen("./login/admin.gdbm", "w");
	dbmreplace($dbm, "url", $HTTP_POST_VARS[url]);
	dbmclose($dbm);
	echo "<script>alert('변경되었습니다.');this.document.location.href='$HTTP_REFRERE'</script>";
}
?>
<!--##### copyright (c) 2002 by jungbo.net all rights reserved #####-->