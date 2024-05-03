<?php
/*

	답별글 쓰기 모듈 화일

*/


//
// 직접 Access 체크
//
include ("./include/direct.inc");


//
// 퍼미션
//
if($config[4] != "open") {
	err("관리자만 글을 수정할 수 있습니다");
	exit;
}


//
// 변수 설정및 체크
//
if(!$HTTP_GET_VARS[id]) err("답변을 쓰고자 하시는 글의 고유 아이디 값이 없습니다.");
if(!$HTTP_GET_VARS[depth]) err("답변글을 쓰기위한 데이터가 부족합니다.\\n변수 : depth 의 누락");


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
	global $HTTP_GET_VARS, $tpl, $db_file, $HTTP_COOKIE_VARS, $config, $sess_spam_id;

	// 원글 쿼리
	$dbm = dbm_open($db_file[data], "r");
	$data = dbm_fetch($dbm ,$HTTP_GET_VARS[id]);
	$data = explode("|", $data);
	dbm_close($dbm);
	$data = do_strip($data);
	$comment = ereg_replace("\n", "\n: ", $data[7]);
	$comment = "\n\n>> ".$data[3]." 님이 쓰신 내용 <<\n:\n: $comment";
	/* 스펨채크 */
	$spam_body = "style=display:none";
	// 세션도 만든다.
	$spam_num = date("sm",time());
	if($spam_num < 1000) $spam_num = $spam_num + 1234;
	
	$sess_spam_id = $spam_num;
	session_register("sess_spam_id");	
	if($config[39] =="y"){
		// 세션도 만든다.
		$spam_num = date("sm",time());
		if($spam_num < 1000) $spam_num = $spam_num + 1234;
		
		$sess_spam_id = $spam_num;
		session_register("sess_spam_id");
		//$spam_body = "<tr><td bgcolor='#F9F2E9' align=center rowspan=2>스펨방지</td><td valign=top >&nbsp;<input type=text name=spam_num2 size=10>(아래 보이는 숫자를 입력하세요,copy 가능)<input type=hidden name=spam_num_s value='$spam_num'><input type=hidden name=spam_num value='$spam_num'></td></tr><tr><td>&nbsp;<script language=javascript src='spamswf.php?spam_num=$spam_num'></script></td></tr>";
		$spam_body = "";
		$add_js = "
			if(!f.spam_num2.value.length) {
				alert('스펨방지 숫자를 입력하여 주세요');
				f.spam_num2.focus();
				return false;
			}		
		";
	}
	
	// 템플릿 적용 및 출력
	$tpl -> assign(
		array(
			I_PACK => $config[18],
			TITLE => "JungBo Board - 답변글쓰기",
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
			B_WIDTH => $config[15],
			B_TITLE => $config[14],
			ALIGN => $config[20],
			CHK_HTML => "checked",
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
	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();
}
?>