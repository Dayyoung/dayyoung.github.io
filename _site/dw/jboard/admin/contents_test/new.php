<?php
/*

	글쓰기 모듈 화일

*/


//
// 직접 Access 체크
//
include ("./include/direct.inc");


//
// 템플릿 생성
//
$tpl = new Template("./template");
$tpl -> define(
	array(
		all => "form.tpl",
	)
);


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
	global $HTTP_GET_VARS, $tpl, $HTTP_COOKIE_VARS, $config;

	/* 템플릿 assign */
	$tpl -> assign(
		array(
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
			BOARD_TITLE => "jboard : 게시물관리($HTTP_GET_VARS[code])",
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

	/* 비밀번호 */
	$tpl -> parse(PW, ".pw");

	/* 템플릿 assign및 출력 */
	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();
}
?>