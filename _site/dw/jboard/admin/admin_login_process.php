<?php
/*
	로그인처리, 로그아웃 처리
*/


/* 세션시작 */
session_start();


/* 외부화일 INCLUDE */
include ("../include/func.inc");


/* 프로그램 실행 */
if($HTTP_GET_VARS[mode] == "login") {
	$dbm = dbmopen("./login/admin.gdbm", "r");
	$admin2[id] = dbmfetch($dbm, "admin_id");
	$admin2[pw] = dbmfetch($dbm, "admin_pw");
	dbmclose($dbm);
	if(trim($admin2[id]) == $HTTP_POST_VARS[admin_id] && $admin2[pw] == get_pw($HTTP_POST_VARS[admin_pw])) {
		unset($admin_id);
		$admin_id = $HTTP_POST_VARS[admin_id];
		$str = $HTTP_POST_VARS[admin_id]."\n".session_id();
		$fp = fopen("./login/login_session", "w");
		flock($fp, 2);
		fwrite($fp, $str, strlen($str));
		flock($fp, 3);
		fclose($fp);
		session_register(admin_id);
		Header("Location:./index.php");
	} else {
		echo "<script>alert('입력하신 정보가 일치하지 않습니다.'); history.go(-1);</script>";
	}
} else {
	session_destroy();
	Header("Location:./index.php");
	exit;
}
?>