<?php
/*
	관리자 페이지 관련 함수
*/



/* 로그인 체크 */
function admin_chk_login() // boolean
{
	global $HTTP_SESSION_VARS;

	// 관리자 로그인시 세션변수 이름은 admin_id
	if($HTTP_SESSION_VARS[admin_id]) {
		$login_session = file("./login/login_session");
		if(trim($login_session[1]) == session_id() && trim($login_session[0]) == $HTTP_SESSION_VARS[admin_id]) {
			return true;
		}
	}
	return false;
}

/* 디렉토리 읽어 오기 */
function get_directory($path, $mode="") {
	if(is_dir($path)) {
		$dir = opendir($path);
	} else {
		err("경로명이 일치하지 않습니다");
	}
	while($lst = readdir($dir)) {
		if($lst != "." && $lst != ".." && is_dir("$path/$lst")) {
			if($mode == "full") {
				$r_value[] = "$path/$lst";
			} else {
				$r_value[] = $lst;
			}
		}
	}
	
	return $r_value;
}

// GDBM 함수 사용 가능한가?
if(!function_exists('dbmopen')) {
	echo "<table width=\"100%\" cellpadding=\"\" border=\"0\" cellspacing=\"0\" height=\"100%\"><tr><td align=\"center\">GDBM이 불가능한 서버 입니다. 서버관리자에게 문의해 주세요</td></tr></table>";
	exit;
}
?>