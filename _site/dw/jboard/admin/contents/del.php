<?php
/*

	글 삭제 폼 모둘

*/


//
// 직접 Access 체크
//
include ("./include/direct.inc");


//
// 변수 설정및 체크, 셋팅
//
if(!$HTTP_GET_VARS[id]) err("수정할 글에 대한 정보가 없습니다.");
$dbm = dbm_open($db_file[data], "r");
if(!dbmexists($dbm, $HTTP_GET_VARS[id])) err("존재하지 않는 글번호 아이디 입니다.\\nID : $HTTP_GET_VARS[id]");
dbm_close($dbm);


//
// 템를릿 생성
//
$tpl = new Template("./template");
$tpl -> define(
	array(
		all => "del.tpl",
	)
);


//
// 삭제 폼 모듈 실행
//
Del_Main();




/*------------------------------------------------------------
	# 글삭제 폼 모듈 실행
*/
//
// 메인함수
//
function Del_Main() // void
{
	global $HTTP_GET_VARS, $tpl, $db_file;

	$dbm = dbm_open($db_file[data], "r");
	$data = dbm_fetch($dbm, $HTTP_GET_VARS[id]);
	dbm_close($dbm);
	$data = explode("|", $data);

	$tpl_title = "JungBo Board - 글삭제";
	$data[3] = str_replace("rhkdvk", "|", $data[3]);
	$data[5] = str_replace("rhkdvk", "|", $data[5]);
	$data[6] = str_replace("rhkdvk", "|", $data[6]);
	$tpl_email = "";
	$tpl_url = ($data[6]) ? $data[6] : "None";
	$tpl_comment = nl2br($data[7]);
	$tpl_comment = str_replace("rhkdvk", "|", $tpl_comment);
	$tpl_comment = auto_link_lib($tpl_comment);
	$tpl_subject = str_replace("rhkdvk", "|", $data[2]);

	// 템플릿 적용 및 출력
	$tpl -> assign(
		array(
			SUBJECT => $tpl_subject,
			NAME => $data[3],
			EMAIL => $tpl_email,
			URL => $tpl_url,
			COMMENT => $tpl_comment,
			DATE => $data[9],
			CODE => $HTTP_GET_VARS[code],
			ID => $HTTP_GET_VARS[id],
			BOARD_TITLE => "jboard : 게시물관리($HTTP_GET_VARS[code])",
		)
	);

	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();
}
?>
