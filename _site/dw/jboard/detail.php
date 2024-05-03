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
$Q = substr($HTTP_GET_VARS[id], 0, 1);
$sess_detail_id = $HTTP_GET_VARS[id];
session_register("sess_detail_id");

//
// 글보기 모듈 실행
//
Detail_Main();
//echo urldecode($REQUEST_URI);


/*------------------------------------------------------------
    # 글보기 모듈용 함수 모음
*/
//
// 메인함수
//
function Detail_Main() // void
{
	global $HTTP_POST_VARS, $HTTP_GET_VARS, $tpl, $db_file, $HTTP_COOKIE_VARS, $sep, $config, $Q;

	if($HTTP_GET_VARS[multiview] != "yes") {
		$m_cnt = 1;
	} else {
		$m_cnt = count($HTTP_GET_VARS[mview]);
	}

	for($m_i = 0 ; $m_i < $m_cnt ; $m_i++) { // 여러글 보기의 경우가 있으므로 Loop
		$id = ($HTTP_GET_VARS[multiview] == "yes") ? $HTTP_GET_VARS[mview][$m_i] : $HTTP_GET_VARS[id];
		$dbm = dbm_open($db_file[data], "w");
		$data = dbm_fetch($dbm, $id);
		$data = explode("|", $data);
		$data[10]++; // 조회수 증가
		$new_data = implode("|", $data);
		dbm_replace($dbm, $id, $new_data);
		dbm_close($dbm);
	
		$data[3] = str_replace("rhkdvk", "|", $data[3]);
		$data[5] = str_replace("rhkdvk", "|", $data[5]);
		$data[6] = str_replace("rhkdvk", "|", $data[6]);
		$tpl_email = d_email_link($data);
		$tpl_url = url_link($data);
		$tpl_comment = $data[7];
		$tpl_comment = str_replace("rhkdvk", "|", $tpl_comment);
		$tpl_comment = texthtml($tpl_comment, $data[13]);
		$tpl_subject = str_replace("rhkdvk", "|", $data[2]);
		$nav = get_nav($data[11], $id, "img");
		if($config[4] != "open" && !admin_chk_login_user()) {
			$nav[write] = ""; $nav[reply] = ""; $nav[modify] = ""; $nav[del] = "";
		}
		if($Q == "G" && !admin_chk_login_user()) {
			$nav[write] = ""; $nav[reply] = ""; $nav[modify] = ""; $nav[del] = ""; $nav[prev] = ""; $nav[next] = "";
		}
		if($Q == "G" && admin_chk_login_user()) {
			$nav[write] = ""; $nav[reply] = "";
		}
	
		// 여러글 보기일경우 타이틀은 한번만 출력하도록 한다
		if($HTTP_GET_VARS[multiview] == "yes") {
			if($m_i == 0) {
				$tpl -> assign(array(B_TITLE => $config[14]));
			}
		} else { // 아닌경우에도 타이틀을 출력
			$tpl -> assign(array(B_TITLE => $config[14]));
		}

		/* 첨부화일 콘트롤러(?) */
		/*
		if($data[11] == 0 && $data[12]) {
			$tpl -> parse(SHOW_HIDE_ATTACHE, "show_hide_attache");
		}
		*/

		/* 첨부화일 */
		$tmp = explode("?", $data[12]);
		$up_cnt = count($tmp) - 1;
		for($i = 1 ; $i <= $up_cnt ; $i++) {
			$seq = "첨부화일$i";
			$attache = get_attache($tmp[($i - 1)]);
			$body_img .= $attache[1];
			$tpl -> assign(
				array(
					FILE_SEQ => $seq,
					FILE_UP => $attache[0],
				)
			);
			$tpl -> parse(UPLOAD, ".upload");
		}

		/** 아이피 숨김 출력 */
		if($config[21]) {
			$p_date = $data[9]." / ".$data[8];
		} else {
			$p_date = $data[9];
		}

		// 템플릿 적용 및 출력
		$tpl -> assign(
			array(
				TITLE => $tpl_title,
				SUBJECT => $tpl_subject,
				NAME => $data[3],
				EMAIL => $tpl_email,
				URL => $tpl_url,
				COMMENT => $body_img."<BR>".$tpl_comment,
				DATE => $p_date,
				LINK_LIST => $nav[lst],
				LINK_MODIFY => $nav[modify],
				LINK_DEL => $nav[del],
				LINK_PREV => $nav[prev],
				LINK_NEXT => $nav[next],
				LINK_REPLY => $nav[reply],
				LINK_WRITE => $nav[write],
				L_ATTACHE => "Attache_".$m_i,
				L_COMMENT => "Comment_".$m_i,
				B_WIDTH => $config[15],
				ALIGN => $config[20],
			)
		);

		/* 의견글 */
		if($config[11] == 1 && $Q != "G" && $config[4] != "closed") { // 의견글이 가능할 경우 추후 관리자 기능때문에 IF문을 사용함
			$form_name = "comment_form_$m_i"; // 여러글보기기능을위한 자바스크립 객체 시퀀스
			if($HTTP_GET_VARS[multiview] != "yes" || ($HTTP_GET_VARS[multiview] == "yes" && $config[13] == 1)) { // 여러글 보기일 경우 의견글입력폼 출력안함
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
			$cnt = count($tmp);
			//나중에등록한 의견글이 위로
			if($config[36] ==2){
					for($i = 0 ; $i < $cnt ; $i++) {
						if($tmp[$i]) {
							$del_url = "./?p=comment_del&code=$HTTP_GET_VARS[code]&id=$id&seq=$i";
							$data = explode($sep, $tmp[$i]);
							$tpl -> assign (
								array(
									COMMENT_BODY => $data[1],
									COMMENT_NAME => $data[0],
									COMMENT_DEL => "<img src=\"./img/i-pack/$config[18]/c_del.gif\" border=\"0\" align=\"absmiddle\" style=\"cursor:hand\" onClick=\"window.open('$del_url', 'c_del_win','width=280, height=180');\" alt=\"의견글삭제하기\">",
								)
							);
							$tpl -> parse(COMMENT_BODY, ".comment_body");
						}
					}			
			}else{
					for($i = $cnt ; $i >= 0 ; $i--) {
						if($tmp[$i]) {
							$del_url = "./?p=comment_del&code=$HTTP_GET_VARS[code]&id=$id&seq=$i";
							$data = explode($sep, $tmp[$i]);
							$tpl -> assign (
								array(
									COMMENT_BODY => $data[1],
									COMMENT_NAME => $data[0],
									COMMENT_DEL => "<img src=\"./img/i-pack/$config[18]/c_del.gif\" border=\"0\" align=\"absmiddle\" style=\"cursor:hand\" onClick=\"window.open('$del_url', 'c_del_win','width=280, height=180');\" alt=\"의견글삭제하기\">",
								)
							);
							$tpl -> parse(COMMENT_BODY, ".comment_body");
						}
					}						
			}

		}

		/* 글보기시 이전글 다음글 */
		if($config[12] == 2 && $HTTP_GET_VARS[multiview] != "yes") {
			/** 인덱스 GDBM 화 작업으로 인해 주석처리 함
			$fp = fopen("$db_file[idx]", "r");
			$G = fgets($fp, filesize("$db_file[idx]"));
			fclose($fp);
			*/
			$dbm = dbm_open($db_file[data], "r");
			$G = dbmfetch($dbm, "idx");
			dbmclose($dbm);
			$G = explode("|", $G);
			$G_2 = array_flip($G);
			$tmp = $G_2[$HTTP_GET_VARS[id]];
			$prev_id = $G[($tmp - 1)];
			$next_id = $G[($tmp + 1)];
			$dbm = dbm_open($db_file[data], "r");
			/* 이전글 */
			if($prev_id) {
				$p_data = explode("|", dbmfetch($dbm, $prev_id));
				$p_str = "<a href=\"./?code=$HTTP_GET_VARS[code]&p=detail&id=$prev_id\">$p_data[2]</a>";
			} else {
				$p_str = "더이상 글이 없습니다";
			}
			/* 다음글 */
			if($next_id) {
				$n_data = explode("|", dbmfetch($dbm, $next_id));
				$n_str = "<a href=\"./?code=$HTTP_GET_VARS[code]&p=detail&id=$next_id\">$n_data[2]</a>";
			} else {
				$n_str = "더이상 글이 없습니다";
			}
			$tpl -> assign (
				array(
					PREV_ARTICLE => $p_str,
					NEXT_ARTICLE => $n_str,
				)
			);
			$tpl -> parse(PRENEXT, ".prenext");
		}

		/* 템플릿 적용 */
		$tpl -> parse(BODY, ".body");
		$tpl -> clear_dynamic("comment_body");
		$tpl -> clear_dynamic("upload");

		// 본문이미지 초기화
		unset($body_img);
	}

	/* 여러글보기 경우의 링크(새글, 리스트) */
	if($HTTP_GET_VARS[multiview] == "yes") {
		$link = "<a href=\"./?p=new&code=$HTTP_GET_VARS[code]\">[새글]</a> <a href=\"./?p=list&code=$HTTP_GET_VARS[code]\">[목록]</a>";
		$tpl -> assign(
			array(
				LINK => $link,
			)
		);
	}

	/* 템플릿 출력 */
	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();
}


//
// 페이지 네비게이션
//
function get_nav($depth, $id, $mode="") // string, array
{
	global $HTTP_POST_VARS, $HTTP_GET_VARS, $config, $Q;

	$idx = get_idx();
	if(isset($idx)) { $s = implode("|", $idx); }
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
		if($mode == "link") {
			$val[lst] = "./?p=list&code=$HTTP_GET_VARS[code]&page=$c_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]";
		} elseif($mode == "img") {
			$val[lst] = "<a href=\"./?p=list&code=$HTTP_GET_VARS[code]&page=$c_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\"><img src=\"./img/i-pack/$config[18]/list.gif\" border=\"0\" align=\"absmiddle\"></a>&nbsp;";
		} else {
			$val[lst] = "<a href=\"./?p=list&code=$HTTP_GET_VARS[code]&page=$c_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">[검색결과]</a>";
		}
	} else {
		if($mode == "link") {
			$val[lst] = "./?p=list&code=$HTTP_GET_VARS[code]&page=$c_pg";
		} elseif($mode == "img") {
			$val[lst] = "<a href=\"./?p=list&code=$HTTP_GET_VARS[code]&page=$c_pg\"><img src=\"./img/i-pack/$config[18]/list.gif\" border=\"0\" align=\"absmiddle\"></a>&nbsp;";
		} else {
			$val[lst] = "<a href=\"./?p=list&code=$HTTP_GET_VARS[code]&page=$c_pg\">[목록]</a>";
		}
	}

	// 새글
	if($mode == "link") {
		$val[write] = "./?p=new&code=$HTTP_GET_VARS[code]";
	} elseif($mode == "img") {
		$val[write] = "<a href=\"./?p=new&code=$HTTP_GET_VARS[code]\"><img src=\"./img/i-pack/$config[18]/write.gif\" border=\"0\" align=\"absmiddle\"></a>&nbsp;";
	} else {
		$val[write] = "<a href=\"./?p=new&code=$HTTP_GET_VARS[code]\">[새글]</a>";
	}
	
	// 답글
	if($mode == "link") {
		$val[reply] = "./?p=reply&code=$HTTP_GET_VARS[code]&id=$id&depth=$depth&page=$HTTP_GET_VARS[page]";
	} elseif($mode == "img") {
		$val[reply] = "<a href=\"./?p=reply&code=$HTTP_GET_VARS[code]&id=$id&depth=$depth&page=$HTTP_GET_VARS[page]\"><img src=\"./img/i-pack/$config[18]/reply.gif\" border=\"0\" align=\"absmiddle\"></a>&nbsp;";
	} else {
		$val[reply] = "<a href=\"./?p=reply&code=$HTTP_GET_VARS[code]&id=$id&depth=$depth&page=$HTTP_GET_VARS[page]\">[답글]</a>";
	}

	// 수정
	if($mode == "link") {
		$val[modify] = "./?p=modify&code=$HTTP_GET_VARS[code]&id=$id";
	} elseif($mode == "img") {
		$val[modify] = "<a href=\"./?p=modify&code=$HTTP_GET_VARS[code]&id=$id\"><img src=\"./img/i-pack/$config[18]/mod.gif\" border=\"0\" align=\"absmiddle\"></a>&nbsp;";
	} else {
		$val[modify] = "<a href=\"./?p=modify&code=$HTTP_GET_VARS[code]&id=$id\">[수정]</a>";
	}

	// 삭제
	if($mode == "link") {
		$val[del] = "./?p=del&code=$HTTP_GET_VARS[code]&id=$id";
	} elseif($mode == "img") {
		$val[del] = "<a href=\"./?p=del&code=$HTTP_GET_VARS[code]&id=$id\"><img src=\"./img/i-pack/$config[18]/del.gif\" border=\"0\" align=\"absmiddle\"></a>&nbsp;";
	} else {
		$val[del] = "<a href=\"./?p=del&code=$HTTP_GET_VARS[code]&id=$id\">[삭제]</a>";
	}

	// 이전글
	if(!$p_id) {
		if($mode == "link") {
			$val[prev] = "#";
		} else {
			$val[prev] = "<img src=\"./img/i-pack/$config[18]/prev.gif\" align=\"absmiddle\" border=\"0\">&nbsp;";
		}
	} else {
		if($HTTP_GET_VARS[mode] == "srch") {
			if($mode == "link") {
				$val[prev] = "./?p=detail&code=$HTTP_GET_VARS[code]&id=$p_id&page=$p_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]";
			} elseif($mode == "img") {
				$val[prev] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$p_id&page=$p_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\"><img src=\"./img/i-pack/$config[18]/prev.gif\" align=\"absmiddle\" border=\"0\"></a>&nbsp;";
			} else {
				$val[prev] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$p_id&page=$p_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">[이전]</a>";
			}
		} else {
			if($mode == "link") {
				$val[prev] = "./?p=detail&code=$HTTP_GET_VARS[code]&id=$p_id&page=$p_pg";
			} elseif($mode == "img") {
				$val[prev] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$p_id&page=$p_pg\"><img src=\"./img/i-pack/$config[18]/prev.gif\" align=\"absmiddle\" border=\"0\"></a>&nbsp;";
			} else {
				$val[prev] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$p_id&page=$p_pg\">[이전]</a>";
			}
		}
	}

	// 다음글
	if(!$n_id) {
		if($mode == "link") {
			$val[next] = "#";
		} else {
			$val[next] = "<img src=\"./img/i-pack/$config[18]/next.gif\" align=\"absmiddle\" border=\"0\">&nbsp;";
		}
	} else {
		if($HTTP_GET_VARS[mode] == "srch") {
			if($mode == "link") {
				$val[next] = "./?p=detail&code=$HTTP_GET_VARS[code]&id=$n_id&page=$n_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]";
			} elseif($mode == "img") {
				$val[next] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$n_id&page=$n_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\"><img src=\"./img/i-pack/$config[18]/next.gif\" align=\"absmiddle\" border=\"0\"></a>&nbsp;";
			} else {
				$val[next] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$n_id&page=$n_pg&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">[다음]</a>";
			}
		} else {
			if($mode == "link") {
				$val[next] = "./?p=detail&code=$HTTP_GET_VARS[code]&id=$n_id&page=$n_pg";
			} elseif($mode == "img") {
				$val[next] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$n_id&page=$n_pg\"><img src=\"./img/i-pack/$config[18]/next.gif\" align=\"absmiddle\" border=\"0\"></a>&nbsp;";
			} else {
				$val[next] = "<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$n_id&page=$n_pg\">[다음]</a>";
			}
		}
	}

	$rtl = $val;
	return $rtl;
}


//
// URL 링크 생성
//
function url_link($data)
{
	if($data[6]) {
		$str = "<a href=\"$data[6]\" target='_new'>$data[6]</a>";
	}

	return $str;
}


//
// 이메일 링크 생성
//
function d_email_link($data)
{
	if($data[5]) {
		//$str = "<a href=\"mailto:$data[5]\">&lt;$data[5]&gt;</a>";
		$target = str_replace("@", "_NOSPAM_", $data[5]);
		$str = "<a href=\"mailto:$data[5]\" onMouseOut=\"window.status=''; return true;\" onMouseOver=\"window.status='Send mail $data[3]'; return true\">[ E-mail ]</a><iframe name=\"dummy\" width=\"0\" height=\"0\" frameborder=\"0\"></iframe>";
	} else {
		$str = "";
	}

	return $str;
}


//
// 글목록시 리스트 내용 출력
//
if($config[12] == 1 && $HTTP_GET_VARS[multiview] != "yes") {
	include ("./list.php");
}
?>
