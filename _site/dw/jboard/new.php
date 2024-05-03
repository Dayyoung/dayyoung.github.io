<?php
/*

	글쓰기 모듈 화일

*/


//
// 직접 Access 체크
//
include ("./include/direct.inc");


//
// 퍼미션
//
if($config[4] != "open" && !admin_chk_login_user()) {
	err("관리자만 글을 작성할 수 있습니다");
	exit;
}


//
// 글쓰기 폼 모듈 실행
//
Main();




/*------------------------------------------------------------
	# 글쓰기 폼 모듈용 함수 모음
*/
//
// 메인함수
//
function Main() // void
{
	global $HTTP_GET_VARS, $tpl, $HTTP_COOKIE_VARS, $config, $sess_spam_id;

	$size = get_cfg_var('upload_max_filesize');
	if(!strstr($size, "M")) {
		$size = number_format($size);
	}
	/* 스펨채크 */
	$spam_body = "style=display:none";
	$spam_num = date("sm",time());
	if($spam_num < 1000) $spam_num = $spam_num + 1234;
	
	$sess_spam_id = $spam_num;
	session_register("sess_spam_id");	
	if($config[39] =="y"){
		// 세션도 만든다.

		$spam_body = "";
		$add_js = "
			if(!f.spam_num2.value.length) {
				alert('스펨방지 숫자를 입력하여 주세요');
				f.spam_num2.focus();
				return false;
			}		
		";
	}
	/* 템플릿 assign */
	$tpl -> assign(
		array(
			I_PACK => $config[18],
			TITLE => "JungBo Board - 새글쓰기",
			CODE => $HTTP_GET_VARS[code],
			MODE => "new",
			ID => "",
			DEPTH => "",
			SUBJECT => "",
			NAME => "$HTTP_COOKIE_VARS[jungbo_board_name]",
			URL => "$HTTP_COOKIE_VARS[jungbo_board_url]",
			EMAIL => "$HTTP_COOKIE_VARS[jungbo_board_email]",
			COMMENT => "",
			PAGE => "1",
			B_WIDTH => $config[15],
			B_TITLE => $config[14],
			ALIGN => $config[20],
			CHK_HTML => "checked",
			MAX_SIZE => "",
			spam_body => $spam_body,
			spam_num => $spam_num,
			add_js => $add_js,
		)
	);

	/* 업로드 */
	for($i = 1 ; $i <= $config[8] ; $i++) {
		$tpl -> assign(
			array(
				FIELD => "화일$i",
				UPNAME => "upload[]",
			)
		);
		$tpl -> parse(FILEUP, ".fileup");
	}
	if($config[7]) {
		$tpl -> assign(
			array(
				SIZE => $size,
			)
		);
		$tpl -> parse(SIZEINFO, ".sizeinfo");
	}

	/* 템플릿 assign및 출력 */
	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();
}
?>
