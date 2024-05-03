<?php
/*

	정보넷 BOARD

*/


//
// 세션시작
//
session_start();
@header('Cache-Control: no-store, no-cache, must-revalidate');
@header('Cache-Control: pre-check=0, post-check=0, max-age=0');


// 함수 정의
function admin_chk_login() // boolean
{
	global $HTTP_SESSION_VARS;

	// 관리자 로그인시 세션변수 이름은 admin_id
	if($HTTP_SESSION_VARS[admin_id]) {
		$login_session = file("../login/login_session");
		if(trim($login_session[1]) == session_id() && trim($login_session[0]) == $HTTP_SESSION_VARS[admin_id]) {
			return true;
		}
	}
	return false;
}

//
// 관리자 로그인 확인
//
if(!admin_chk_login()) {
	Header("Location:../");
	exit;
}


//
// 외부화일 인클르드
//
include ("./include/func.inc");
include ("./include/gdbm.inc");
include ("./include/get.inc");
include ("./include/check.inc");
include ("./include/parse.inc");
include ("./include/Template.inc");


//
// 변수설정 및 체크
//
if(!$HTTP_GET_VARS[p]) $HTTP_GET_VARS[p] = "list";
chk_index();
$db_file[data] = "../../data/$HTTP_GET_VARS[code]/data_change.gdbm";
$db_file[idx] = "../../data/$HTTP_GET_VARS[code]/idx";
$db_file[lock] = "../../data/$HTTP_GET_VARS[code]/act.lock";
$db_file[comment] = "../../data/$HTTP_GET_VARS[code]/comment.gdbm";
$env[scale] = 20;
$env[pscale] = 5;
$sep = "rlaeoguscjswo"; // 의견글에서의 필드세퍼레이터
$config = get_config();



//
// 모듈페이지 삽입
//
$m_file = "$HTTP_GET_VARS[p].php";
if(file_exists($m_file)) {
	include ($m_file);
} else {
	err("게시판 모듈화일이 존재 하지 않습니다\\n화일이름 : $m_file");
}
?>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->
