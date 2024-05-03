<?php
/*
	글 수정 폼 출력
*/


//
// 주소 입력창에서 직접 호출 걸러냄
//
include ("./include/direct.inc");


//
// 변수 설정 및 체킹
//
if(!$HTTP_GET_VARS[id]) err("수정할 글에 대한 정보가 없습니다.");
$dbm = dbm_open($db_file[data], "r");
if(!dbmexists($dbm, $HTTP_GET_VARS[id])) err("존재하지 않는 글번호 아이디 입니다.\\nID : $HTTP_GET_VARS[id]");
dbm_close($dbm);


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
// 수정폼 모듈 실행
//
Main();




/*------------------------------------------------------------
    # 글수정폼 모듈용 함수 모음
*/
//
// 메인
//
function Main()
{
	global $HTTP_GET_VARS, $tpl, $db_file;

	/* 수정할 글 쿼리 */
	$dbm = dbm_open($db_file[data], "r");
	$org_data = dbmfetch($dbm, $HTTP_GET_VARS[id]);
	dbm_close($dbm);

	/* 내용 파씽~ */
	$org_data = explode("|", $org_data);
	while(list($key, $value) = each($org_data)) {
		$org_dat[$key] = str_replace("rhkdvk", "|", $value);
	}

    /* 템플릿 assign */
	$tpl -> assign(
		array(
			CODE => $HTTP_GET_VARS[code],
			MODE => "modify",
			ID => "$HTTP_GET_VARS[id]",
			DEPTH => "",
			SUBJECT => $org_data[2],
			NAME => $org_data[3],
			URL => $org_data[6],
			EMAIL => $org_data[5],
			COMMENT => "$org_data[7]",
			PAGE => "",
			BOARD_TITLE => "jboard : 게시물관리($HTTP_GET_VARS[code])",
		)
	);

	/* 비밀번호 */
	$tpl -> parse(HPW, ".hpw");
	
	/* 탬플릿 assign 및 출력 */
	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();
}
?>