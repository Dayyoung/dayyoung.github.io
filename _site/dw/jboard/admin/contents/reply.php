<?php
/*

	답별글 쓰기 모듈 화일

*/


//
// 직접 Access 체크
//
include ("./include/direct.inc");


//
// 변수 설정및 체크
//
if(!$HTTP_GET_VARS[id]) err("답변을 쓰고자 하시는 글의 고유 아이디 값이 없습니다.");
if(!$HTTP_GET_VARS[depth]) err("답변글을 쓰기위한 데이터가 부족합니다.\\n변수 : depth 의 누락");


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
// 답변글 쓰기 폼 모듈 실행
//
Main();




/*------------------------------------------------------------
    # 답변글쓰기 폼 모듈용 함수 모음
*/
//
// 메인함수
//
function Main()
{
	global $HTTP_GET_VARS, $tpl, $db_file, $HTTP_COOKIE_VARS;

	// 원글 쿼리
	$dbm = dbm_open($db_file[data], "r");
	$data = dbm_fetch($dbm ,$HTTP_GET_VARS[id]);
	$data = explode("|", $data);
	dbm_close($dbm);
	$data = do_strip($data);
	$comment = ereg_replace("\n", "\n: ", $data[7]);
	$comment = "\n\n>> ".$data[3]." 님이 쓰신 내용 <<\n:\n: $comment";

	// 템플릿 적용 및 출력
	$tpl -> assign(
		array(
			CODE => $HTTP_GET_VARS[code],
			MODE => "reply",
			ID => "$HTTP_GET_VARS[id]",
			DEPTH => "$HTTP_GET_VARS[depth]",
			SUBJECT => "$data[2]",
			NAME => "$HTTP_COOKIE_VARS[jungbo_board_name]",
			URL => "$HTTP_COOKIE_VARS[jungbo_board_url]",
			EMAIL => "$HTTP_COOKIE_VARS[jungbo_board_email]",
			COMMENT => "$comment",
			PAGE => "$HTTP_GET_VARS[page]",
			BOARD_TITLE => "jboard : 게시물관리($HTTP_GET_VARS[code])",
		)
	);

	/* 비밀번호 */
	$tpl -> parse(PW, ".pw");

	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();
}
?>