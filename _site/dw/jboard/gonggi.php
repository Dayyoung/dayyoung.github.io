<?php
/*

	공지(새창) 모듈 화일

*/


//
// 직접 Access 체크
//
include ("./include/direct.inc");


//
// 변수 설정및, 체크
//
$dbm = dbm_open($db_file[data], "r");
if(!dbmexists($dbm, $HTTP_GET_VARS[id])) {
	err("존재하지 않는 글번호 아이디 입니다\\n");
} else {
	$data = explode("|", dbmfetch($dbm, $HTTP_GET_VARS[id]));
}
dbm_close($dbm);
if(!is_file("./gonggi/$HTTP_GET_VARS[skin].php")) {
	$HTTP_GET_VARS[skin] = "default";
}
$tpl_comment = nl2br($data[7]);
$tpl_comment = str_replace("rhkdvk", "|", $tpl_comment);
$tpl_comment = auto_link_lib($tpl_comment);
include ("./gonggi/$HTTP_GET_VARS[skin].php");
?>