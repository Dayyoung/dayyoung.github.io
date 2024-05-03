<?php
/*

	정보넷 BOARD

		개발자 : 김대현

*/


//
// 세션시작
//
session_start();
@header('Cache-Control: no-store, no-cache, must-revalidate');
@header('Cache-Control: pre-check=0, post-check=0, max-age=0');


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
$db_file[data] = "./data/$HTTP_GET_VARS[code]/data.gdbm";
$db_file[idx] = "./data/$HTTP_GET_VARS[code]/idx";
$db_file[lock] = "./data/$HTTP_GET_VARS[code]/act.lock";
$db_file[comment] = "./data/$HTTP_GET_VARS[code]/comment.gdbm";
$db_file[ban] = "./admin/login/ban.gdbm";
$db_file[admin] = "./admin/login/admin.gdbm";
$admin = get_admin();
if($HTTP_GET_VARS[p] == "new" || $HTTP_GET_VARS[p] == "modify" || $HTTP_GET_VARS[p] == "reply" || $HTTP_GET_VARS[p] == "del" || $HTTP_GET_VARS[p] == "act") {
	chk_ban();
}
$sep = "rlaeoguscjswo"; // 의견글에서의 필드세퍼레이터
$config = get_config();


//
// 인덱스 GDBM호작업시 추가 부분
// 패치 버전에서만 적용시키도록함
// 기존 idx 화일의 데이터를 GDBM 화 시킴
//
$dbm = dbmopen($db_file[data], "w");
if(file_exists($db_file[idx]) && !dbmexists($dbm, "idx")) {
	$tmp = file($db_file[idx]);
	dbminsert($dbm, "idx", $tmp[0]);
}
dbmclose($dbm);


//
// 다른 회원 인증과 연동 체크
// 세션이나, 쿠키 변수에 value 값이 있는지만 체크 함.
//
$auth = explode("\n", $config[17]);
if($auth[0] == "yes" || $auth[0] == "jb_ec" || $auth[0] == "jb_mem") {
	if($auth[1] == "session") {
		if($HTTP_SESSION_VARS[$auth[2]]) {
			$auth_ok = "ok";
		}
	} elseif($auth[1] == "cookie") {
		if($HTTP_COOKIE_VARS[$auth[2]]) {
			$auth_ok = "ok";
		}
	}
	if(!$auth_ok) {
		if($auth[3] == "none") {
			err("회원전용 페이지 입니다!!");
			exit;
		} elseif($auth[3] == "read") {
			if($HTTP_GET_VARS[p] != "list" && $HTTP_GET_VARS[p] != "detail") {
				err("회원전용 페이지 입니다!!");
				exit;
			}
		}
	}
}


//
// 템플릿 생성
//
if($HTTP_GET_VARS[p] != "act") {
	if($HTTP_GET_VARS[p] == "new" || $HTTP_GET_VARS[p] == "modify" || $HTTP_GET_VARS[p] == "reply") {
		$tfname = "form.tpl";
	} else {
		$tfname = $HTTP_GET_VARS[p].".tpl";
	}

	$tpl = new Template("./template/$config[16]");
	$tpl -> define(
		array(
			all => $tfname,
		)
	);
}


//
// 게시판 헤더
//
if($HTTP_GET_VARS[p] != "act" && $HTTP_GET_VARS[p] != "gonggi" && $HTTP_GET_VARS[p] != "comment_del") echo stripslashes($config[2]);


//
// 모듈페이지 삽입
//
$m_file = "$HTTP_GET_VARS[p].php";
if(file_exists($m_file)) {
	include ($m_file);
} else {
	err("게시판 모듈화일이 존재 하지 않습니다\\n화일이름 : $m_file");
}


//
// 게시판 꼬리
//
if($HTTP_GET_VARS[p] != "act" && $HTTP_GET_VARS[p] != "gonggi" && $HTTP_GET_VARS[p] != "comment_del") echo stripslashes($config[3]);
?>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->
