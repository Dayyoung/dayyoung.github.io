<?php
/*

	상세보기 모듈 화일

*/


//
// 직접 Access 체크
//
include ("./include/direct.inc");


//
// 변수 설정및, 체크
//
$dbm = dbm_open($db_file[data], "r");
if($HTTP_GET_VARS[multiview] != "yes") {
	if(!dbmexists($dbm, $HTTP_GET_VARS[id])) err("존재하지 않는 글번호 아이디 입니다\\n");
}
dbm_close($dbm);


//
// 템플릿 생성
//
$tpl = new Template("./template");
$tpl -> define (
	array (
		all => "detail.tpl",
	)
);


//
// 글보기 모듈 실행
//
Detail_Main();




/*------------------------------------------------------------
    # 글보기 모듈용 함수 모음
*/
//
// 메인함수
//
function Detail_Main() // void
{
	global $HTTP_POST_VARS, $HTTP_GET_VARS, $tpl, $db_file, $HTTP_COOKIE_VARS, $sep, $config;

	if($HTTP_GET_VARS[multiview] != "yes") {
		$m_cnt = 1;
	} else {
		$m_cnt = count($HTTP_GET_VARS[mview]);
	}
	for($m_i = 0 ; $m_i < $m_cnt ; $m_i++) { // 여러글 보기의 경우가 있으므로 Loop

		$id = ($HTTP_GET_VARS[multiview] == "yes") ? $HTTP_GET_VARS[mview][$m_i] : $HTTP_GET_VARS[id];		
		$dbm = dbmopen($db_file[data], "w");
		$data = dbm_fetch($dbm, $id);
		$data = explode("|", $data);
		dbm_close($dbm);
	
		$tpl_title = "JungBo Board - 글보기";
		$data[3] = str_replace("rhkdvk", "|", $data[3]);
		$data[5] = str_replace("rhkdvk", "|", $data[5]);
		$data[6] = str_replace("rhkdvk", "|", $data[6]);
		$tpl_email = d_email_link($data);
		$tpl_url = url_link($data);
		/**
		$tpl_comment = nl2br($data[7]);
		$tpl_comment = str_replace("rhkdvk", "|", $tpl_comment);
		$tpl_comment = auto_link_lib($tpl_comment);
		*/
		$tpl_comment = $data[7];
		$tpl_comment = str_replace("rhkdvk", "|", $tpl_comment);
		$tpl_comment = texthtml($tpl_comment, $data[13]);
		$tpl_subject = str_replace("rhkdvk", "|", $data[2]);
		$nav = get_nav($data[11], $id, $data[8]);
	
		// 템플릿 적용 및 출력
		$tpl -> assign(
			array(
				SUBJECT => $tpl_subject,
				NAME => $data[3],
				EMAIL => $tpl_email,
				URL => $tpl_url,
				COMMENT => $tpl_comment,
				DATE => $data[9]." / ".$data[8],
				NAV => $nav,
				L_ATTACHE => "Attache_".$m_i,
				L_COMMENT => "Comment_".$m_i,
				ID => $HTTP_GET_VARS[id],
				IP => $data[8],
				BOARD_TITLE => "jboard : 게시물관리($HTTP_GET_VARS[code])",
			)
		);

		/* 첨부화일 콘트롤러(?) */
		if($data[11] == 0 && $data[12]) {
			$tpl -> assign(array());
			$tpl -> parse(SHOW_HIDE_ATTACHE, "show_hide_attache");
		}

		/* 첨부화일 */
		$tmp = explode("?", $data[12]);
		$up_cnt = count($tmp) - 1;
		for($i = 1 ; $i <= $up_cnt ; $i++) {
			$seq = "첨부화일$i";
			$attache = get_attache($tmp[($i - 1)]);;
			$tpl -> assign(
				array(
					FILE_SEQ => $seq,
					FILE_UP => $attache,
				)
			);
			$tpl -> parse(UPLOAD, ".upload");
		}

		/* 의견글 */
		if($config[11] == 1) { // 의견글이 가능할 경우 추후 관리자 기능때문에 IF문을 사용함
			$form_name = "comment_form_$m_i"; // 여러글보기기능을위한 자바스크립 객체 시퀀스
			if(1) { // 여러글 보기일 경우 의견글입력폼 출력안함
				/* 쓰기폼 */
				$tpl -> assign(
					array(
						FORM_NAME => $form_name,
						C_CODE => $HTTP_GET_VARS[code],
						C_ID => $id,
						COMMENT_NAME => $HTTP_COOKIE_VARS[jungbo_board_name],
					)
				);
				$tpl -> parse(COMMENT_FORM, "comment_form");
			}
	
			/* 내용 출력 */
			$c_dbm = dbm_open($db_file[comment], "r");
			$tmp = dbm_fetch($c_dbm, $id);
			dbm_close($c_dbm);
			$tmp = explode("\n", $tmp);
			$cnt = count($tmp) - 1;
			for($i = 0 ; $i < $cnt ; $i++) {
				$del_link = "<span style='cursor:hand' title='삭제' onClick=\"chk_com_del('$HTTP_GET_VARS[code]', '$id', '$i');\">[ X ]</span>";
				$data = explode($sep, $tmp[$i]);
				$tpl -> assign (
					array(
						COMMENT_BODY => $data[1],
						COMMENT_NAME => $data[0],
						DEL_LINK => $del_link,
					)
				);
				$tpl -> parse(COMMENT_BODY, ".comment_body");
			}
		}
		$tpl -> parse(BODY, ".body");
		$tpl -> clear_dynamic("comment_body");
		$tpl -> clear_dynamic("upload");
	}

	/* 여러글보기 경우의 링크(새글, 리스트) */
	if($HTTP_GET_VARS[multiview] == "yes") {
		$link = "<a href=\"./?p=new&code=$HTTP_GET_VARS[code]\">[새글]</a> <a href=\"./?p=list&code=$HTTP_GET_VARS[code]\">[목록]</a>";
		$tpl -> assign(
			array(
				LINK => $link,
			)
		);
		$tpl -> parse(MULTIVIEW_LINK, ".multiview_link");
	}

	/** 게시물관리에서 글삭제 오류 부분 수정 */
	$tpl -> assign(
		array(
			C_CODE => $HTTP_GET_VARS[code]
		)
	);

	/* 템플릿 출력 */
	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();
}


//
// 페이지 네비게이션
//
function get_nav($depth, $id, $ip) // string, array
{
	global $HTTP_POST_VARS, $HTTP_GET_VARS, $config;

	$idx = get_idx();
	if($idx) $s = implode("|", $idx);
	$key = array_search_lib($id, $idx);
	$p_id = $idx[($key - 1)]; // 이전글 ID
	$n_id = $idx[($key + 1)]; // 다음글 ID
	$key2 = ($key) ? $key : 1;
	$c_pg = ceil(($key + 1) / $config[9]);
	$p_pg = ceil(($key + 1 - 1) / $config[9]);
	$n_pg = ceil(($key + 1 + 1) / $config[9]);
	$depth++;

	// 글목록
	if($HTTP_GET_VARS[mode] == "srch") {
		$val[lst] = "<a href=\"./?p=list&code=$HTTP_GET_VARS[code]&page=$c_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">[검색결과]</a>";
	} else {
		$val[lst] = "<a href=\"./?p=list&code=$HTTP_GET_VARS[code]&page=$c_pg\">[목록]</a>";
	}

	// 새글
	$val[write] = "<a href=\"./?p=new&code=$HTTP_GET_VARS[code]\">[새글]</a>";
	
	// 답글
	$val[reply] = "<a href=\"./?p=reply&code=$HTTP_GET_VARS[code]&id=$id&depth=$depth&page=$HTTP_GET_VARS[page]\">[답글]</a>";

	// 수정
	$val[modify] = "<a href=\"./?p=modify&code=$HTTP_GET_VARS[code]&id=$id\">[수정]</a>";

	// 삭제
	$val[del] = "<span style=\"cursor:hand\" onClick=\"chk_del('$id');\">[삭제]</span></a>";

	// 밴 시키기
	$val[ban] = "<span style=\"cursor:hand\" onClick=\"chk_ban('$ip')\">[등록거부]</span>";

	// 이전글
	if(!$p_id) {
		$val[prev] = "[이전]";
	} else {
		if($HTTP_GET_VARS[mode] == "srch") {
			$val[prev] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$p_id&page=$p_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">[이전]</a>";
		} else {
			$val[prev] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$p_id&page=$p_pg\">[이전]</a>";
		}
	}

	// 다음글
	if(!$n_id) {
		$val[next] = "[다음]";
	} else {
		if($HTTP_GET_VARS[mode] == "srch") {
			$val[next] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$n_id&page=$n_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">[다음]</a>";
		} else {
			$val[next] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$n_id&page=$n_pg\">[다음]</a>";
		}
	}

	$rtl = $val[lst]." ".$val[write]." ".$val[reply]." ".$val[modify]." ".$val[del]." ".$val[prev]." ".$val[next]." <font color='red'>".$val[ban]."</font>";
	return $rtl;
}


//
// URL 링크 생성
//
function url_link($data)
{
	if($data[6]) {
		$str = "<a href=\"$data[6]\">$data[6]</a>";
	} else {
		$str = "None";
	}

	return $str;
}


//
// 이메일 링크 생성
//
function d_email_link($data)
{
	if($data[5]) {
		$str = "<a href=\"mailto:$data[5]\">[@]</a>";
	} else {
		$str = "[@]";
	}

	return $str;
}
?>
