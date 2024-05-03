<?php
/*

	URL에서 직접 호출하는것을 방지 한다.

*/


//
// 실행한다
//
chk_block_direct();


//
// index.php에서 include 하지 않은 화일을 바로 접근 거부시킨다
// list.php, act.php 등등은 url에서 바로 호출할수 없게 맹근다 -.-
//
function chk_block_direct()
{
	global $HTTP_GET_VARS, $PHP_SELF;

	$tmp = explode("/", $PHP_SELF);
	$cnt = count($tmp);
	$page = $tmp[$cnt - 1];
	if($page != "index.php") {
		echo "<script>alert('$page 는 URL입력창에 주소를 직접입력하여 호출 할수 없습니다.');history.go(-1);</script>";
	}
}
?>
