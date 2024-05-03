<?php
/*
	글 수정 폼 출력
*/


//
// 주소 입력창에서 직접 호출 걸러냄
//
include ("./include/direct.inc");


//
// 퍼미션
//
if($config[4] != "open" && !admin_chk_login_user()) {
	err("관리자만 글을 수정할 수 있습니다");
	exit;
}


//
// 변수 설정 및 체킹
//
if(!$HTTP_GET_VARS[id]) err("수정할 글에 대한 정보가 없습니다.");
$dbm = dbm_open($db_file[data], "r");
if(!dbmexists($dbm, $HTTP_GET_VARS[id])) err("존재하지 않는 글번호 아이디 입니다.\\nID : $HTTP_GET_VARS[id]");
dbm_close($dbm);


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
	global $HTTP_GET_VARS, $tpl, $db_file, $config, $sess_spam_id;

	/* 수정할 글 쿼리 */
	$dbm = dbm_open($db_file[data], "r");
	$org_data = dbmfetch($dbm, $HTTP_GET_VARS[id]);
	dbm_close($dbm);

	/* 내용 파씽~ */
	$org_data = explode("|", $org_data);
	while(list($key, $value) = each($org_data)) {
		$org_data[$key] = str_replace("rhkdvk", "|", $value);
	}
	if($org_data[13] == "y") {
		$chk_html = "checked";
	} else {
		$chk_html = "";
	}
	/* 스펨채크 */
	$spam_body = "style=display:none";
	// 세션도 만든다.
	$spam_num = date("sm",time());
	if($spam_num < 1000) $spam_num = $spam_num + 1234;
	
	$sess_spam_id = $spam_num;
	session_register("sess_spam_id");
	if($config[39] =="y"){

		$spam_body = "<tr><td bgcolor='#F9F2E9' align=center rowspan=2>스펨방지</td><td valign=top >&nbsp;<input type=text name=spam_num2 size=10>(아래 보이는 숫자를 입력하세요,copy 가능)<input type=hidden name=spam_num_s value='$spam_num'><input type=hidden name=spam_num value='$spam_num'>	</td></tr><tr><td>&nbsp;<script language=javascript src='spamswf.php?spam_num=$spam_num'></script></td></tr>";
		$spam_body ="";
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
			TITLE => "JungBo Board - 글 수정하기",
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
			B_WIDTH => $config[15],
			B_TITLE => $config[14],
			ALIGN => $config[20],
			CHK_HTML => $chk_html,
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
	
	/* 탬플릿 assign 및 출력 */
	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();

	// 글수정시 html 옵션 선택
	$tmp = array("n" => 1, "br" => 2, "y" => 3);
	$idx = $tmp[$org_data[13]];
	if(!$idx) $idx = 1;
	echo "
	<script>
		document.gwangpa_form.html.selectedIndex = $idx;
	</script>
	";
}
?>
