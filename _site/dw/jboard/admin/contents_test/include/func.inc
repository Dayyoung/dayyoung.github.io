<?php
/*
	
	함수모음

*/




/*------------------------------------------------------------
	# 에러호출 관련 함수
*/
//
// 에러 리포팅
//
function err($string, $mode="back")
{
	global $dbm;

	//if($dbm) // 디비닫기 함수 호출

	echo "<script>alert('$string');";
	switch($mode)
	{
		case "back" :
			echo "history.go(-1);";
			break;

		case "close" :
			echo "top.close();";
			break;
	}
	echo "</script>"; exit;
}




/*------------------------------------------------------------
	# 게시판 구현 알고리즘 관련
*/
//
// 검색용 인덱스 화일 업테이트
//
function modify_search($file, $row, $str) // void
{
	$row = $row - 1;
	$data = file($file);
	$data[$row] = $str;
	for($i = 0 ; $i < count($data) ; $i++) {
		$new_data .= trim($data[$i])."\n";
	}

	$fp = fopen($file, "w+");
	fwrite($fp, $new_data);
	fclose($fp);
}


//
// 인덱스 뽑아오기
//
function get_idx() // array
{
	global $HTTP_GET_VARS, $db_file, $HTTP_SESSION_VARS;
	global $srch_what;
	global $srch_code;
	global $srch_request;
	global $srch_idx;

	/* 일반 글 목록과 검색결과 루틴 분기 */
	if($HTTP_GET_VARS[mode] == "srch") { // <-- 여긴 검색일 경우
		if($HTTP_SESSION_VARS[srch_what] == $HTTP_GET_VARS[what] && $HTTP_SESSION_VARS[srch_request] == $HTTP_GET_VARS[request]) {
			$idx = $HTTP_SESSION_VARS[srch_idx];
		} else {
			$what = array("subject" => 2, "name" => 3, "comment" => 7);
			$dbm = dbm_open($db_file[data], "r");
			$key = dbmfirstkey($dbm);
			while($key && $key == "config" || $key == "number" || substr($key, 0, 1) == "G") {
				$key = dbmnextkey($dbm, $key);
			}
			while($key) {
				$data = dbm_fetch($dbm, $key);
				$data = explode("|", $data);
				if(ereg($HTTP_GET_VARS[request], $data[$what[$HTTP_GET_VARS[what]]])) {
					$idx[] = $key;
				}
				$key = dbmnextkey($dbm, $key);
				while($key && $key == "config" || $key == "number" || substr($key, 0, 1) == "G") {
					$key = dbmnextkey($dbm, $key);
				}

			}
			if($idx) rsort($idx);

			$srch_code = $HTTP_GET_VARS[code];
			$srch_what = $HTTP_GET_VARS[what];
			$srch_request = $HTTP_GET_VARS[request];
			$srch_idx = $idx;

			session_register(srch_code);
			session_register(srch_what);
			session_register(srch_request);
			session_register(srch_idx);
		}
	} else { // <-- 여긴 검색이 아닐 경우
		/** 인덱스 GDBM 화 작업으로 인한 코멘트 아웃
		if(file_exists($db_file[idx])) {
			$tmp = file($db_file[idx]);
			$tmp = $tmp[0];
			$len = strlen($tmp) - 2;
			$tmp = substr($tmp, 1, $len);
			if($tmp) $idx = explode("|",$tmp);
		}
		*/
		$dbm = dbmopen($db_file[data], "r");
		if(dbmexists($dbm, "idx")) {
			$tmp = dbmfetch($dbm, "idx");
		}
		$len = strlen($tmp) - 2;
		$tmp = substr($tmp, 1, $len);
		if($tmp) $idx = explode("|",$tmp);
		dbmclose($dbm);
	}
	return $idx;
}


//
// 파이프 문자 없애기
//
function do_strip($arr)
{
	for($i = 0 ; $i < count($arr) ; $i++) {
		$arr[$i] = str_replace("rhkdvk", "|", $arr[$i]);
	}
	
	return $arr;
}




/*------------------------------------------------------------
	# 각종 체킹...
*/
//
// 인덱스 체킹
// --> 인덱스에서 체크 해주어야 할 사항들 : code
function chk_index() // void
{
	global $HTTP_GET_VARS;

	if(!$HTTP_GET_VARS[code]) {
		err("게시판 고유 코드가 누락되었습니다.");
	}

	if(!is_dir("../../data/$HTTP_GET_VARS[code]")) {
		err("존재하지 않는 게시판 코드 입니다.\\nCode = $HTTP_GET_VARS[code]");
	}
}


//
// URL 유효성
//
function chk_url($url) // string
{
	$url = trim($url);

	if(chk_hangul($url)) return "";

	if(!eregi("^(http://|https://|ftp://|telnet://|news://)", $url))
	$url = eregi_replace("^", "http://", $url);

	if(!eregi("(http|https|ftp|telnet|news):\/\/[a-z0-9-]+\.[][a-zA-Z0-9:&#@=_~%;\?\/\.\+-]+", $url)) return "";

	return $url;
}


//
// 이메일 유효성
//
function chk_email($email) // bool
{
	$email = trim($email);

	if(chk_hangul($email))
		return false;

	if(!eregi("^[a-z0-9_-]+@[a-z0-9-]+\.[a-z0-9\.-]+", $email))
		return false;

	return $email;
}


//
// 한글인가?
//
function chk_hangul($str) // bool 한글이면 true, 한글이 아니면 false
{
	for($i = 0 ; $i < strlen($str) ; $i++) {
		$char = ord($str[$i]);
		if($char >= 0xa1 && $char <= 0xfe) {
			return true;
		}
	}

	return false;
}


//
// 첨부화일
//
function get_attache($data, $mode="")
{
	global $HTTP_GET_VARS;

	if($data) {
		if($HTTP_GET_VARS[p] == "detail" && $mode != "sublist") { // 상세보기일때
			$tmp = explode("?", $data);
			$up = explode(":", $tmp[0]);
			$up[3] = strtolower($up[3]);
			$icon = get_ext_image($up[3]);
			$img_src = "../../data/$HTTP_GET_VARS[code]/binary/$up[0]";
			/* 이미지인지 여부를 확인하여 이미지인경우는 새창 */
			if($up[3] == "gif" || $up[3] == "jpg" || $up[3] == "jpeg" || $up[3] == "png") {
				$val = "<span style=\"cursor:hand\" onClick=\"window.open('./img_win.php?img=$img_src','img_win','width=80, height=80, scrollbars=yes')\" alt=\"첨부화일 : $up[0] ($up[1] Bytes)\"><img src=\"$icon\" align=\"absmiddle\">첨부화일 : $up[0] ($up[1] Bytes)</span>";
			} else {
				$val = "<a href=\"./download.php?file_name=$up[0]&file_size=$up[1]&code=$HTTP_GET_VARS[code]\"><img src=\"$icon\" border=\"0\" alt=\"첨부화일 : $up[0] ($up[1] Bytes)\" align=\"absmiddle\">첨부화일 : $up[0] ($up[1] Bytes)</a>";
			}
		} else { // 리스트 일경우 맨 처음것만
			$tmp = explode("?", $data);
			$up = explode(":", $tmp[0]);
			$up[3] = strtolower($up[3]);
			$icon = get_ext_image($up[3]);
			$img_src = "../../data/$HTTP_GET_VARS[code]/binary/$up[0]";
			/* 이미지인지 여부를 확인하여 이미지인경우는 새창 */
			if($up[3] == "gif" || $up[3] == "jpg" || $up[3] == "jpeg" || $up[3] == "png") {
				$val = "<img src=\"$icon\" style=\"cursor:hand\" align=\"absmiddle\" onClick=\"window.open('./img_win.php?img=$img_src','img_win','width=80, height=80, scrollbars=yes')\" alt=\"첨부화일 : $up[0] ($up[1] Bytes)\">";
			} else {
				$val = "<a href=\"./download.php?file_name=$up[0]&file_size=$up[1]&code=$HTTP_GET_VARS[code]\"><img src=\"$icon\" border=\"0\" align=\"absmiddle\" alt=\"첨부화일 : $up[0] ($up[1] Bytes)\"></a>";
			}
		}
	} else {
		$val = "";
	}

	return $val;
}


//
// 확장자에 대한 이미지 구하기
//
function get_ext_image($ext)
{
	$ext = strtolower($ext);

	switch($ext)
	{
		case "gif" :
			$img = "gif.gif";
			break;

		case "bmp" :
			$img = "bmp.gif";
			break;

		case "com" :
			$img = "com.gif";
			break;

		case "zip" :
		case "rar" :
		case "gz" :
		case "tar" :
		case "tgz" :
			$img = "compressed.gif";
			break;

		case "exe" :
			$img = "exe.gif";
			break;

		case "jpg" :
		case "jpeg" :
			$img = "jpg.gif";
			break;

		case "png" ;
			$img = "image.gif";
			break;

		case "doc" :
			$img = "doc.gif";
			break;

		case "xls" :
			$img = "xls.gif";
			break;

		case "ppt" :
			$img = "ppt.gif";
			break;

		case "hwp" :
			$img = "hwp.gif";
			break;

		case "pcx" :
			$img = "pcx.gif";
			break;

		case "mp3" :
			$img = "mp3.gif";
			break;

		case "asf" :
		case "wma" :
		case "asx" :
		case "wmx" :
		case "mpeg" :
			$img = "sound.gif";
			break;

		case "wav" :
			$img = "wav.gif";
			break;

		case "rm" :
		case "ra" :
			$img = "ra.gif";
			break;

		case "txt" :
		case "text" :
			$img = "txt.gif";
			break;

		default : 
			$img = "unknown.gif";
			break;
	}
	$img = "../../img/icon/$img";
	if(!is_file("$img")) $img = "../../img/icon/unknown.gif";
	return $img;
}

//
// 메일 보내기
//
function alert_mail($POST_VARS, $minfo, $code)
{
	$subject = ($code == "new") ? "[jboard] 새글등록알림 - $POST_VARS[subject]" : "[jboard] 답변글등록알림 - $POST_VARS[subject]";
	$info = date("Y년 m월 d일 H시 i분 s초", time())."에 아래와 같은 글이 등록되었습니다";

	$Header  = "Return-Path: \r\n";
	$Header .= "From: jboard<>\r\n";
	$Header .= "X-Mailer: Jungbo Interface\r\n";
	$Header .= "MIME-Version: 1.0\r\n";
	$Header .= "Content-Type: text/html\n\n";

	include ("./include/mail.inc");
	
	if(is_array($minfo[to])) {
		for($i = 0 ; $i < count($minfo[to]) ; $i++) {
			mail($minfo[to][$i], $subject, $jb_mail_body, $Header);
		}
	} else {
		mail($minfo[to], $subject, $jb_mail_body, $Header);
	}
}


//
// 게시판 설정내용 불러 오기
//
function get_config()
{
	global $HTTP_GET_VARS, $db_file;

	$dbm = dbm_open($db_file[data], "r");
	$data = dbm_fetch($dbm, "config");
	$data = explode("|", $data);
	dbm_close($dbm);

	return $data;
}


//
// Array Search
//
function array_search_lib($val, $arr)
{
	$cnt = count($arr);
	for($i = 0 ; $i < $cnt ; $i++) {
		if($arr[$i] == $val) {
			return $i;
		}
	}
}


//
// is_null 함수
//
function is_null_lib($str)
{
	if(isset($str)) {
		return false;
	} else {
		return true;
	}
}


//
// 비밀번호 암호화
//
function get_pw($pass) 
{ 
	$bae_pw= array(10);
	$bae_mixpw= array(10);
	$bae_mix= array(3,5,2,1,7,0,4,8,9,6);
	$bae_gong= array(33,117,59,6,108);
	$bae_16= array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');
	$new_pw="";
	$gong=0;
	$change=0; $hex_mok=0; $hex_namer=0;

	for($i=0; $i<10; $i++) {
		if($i< strlen($pass)) {
			$bae_pw[$i]= ord(substr($pass,$i,1));
		} else {
			$bae_pw[$i]= 128+ $bae_gong[$gong];
			$gong++;
		}
	}

	for($i=0; $i<count($bae_pw); $i++) {
		$bae_mixpw[$i]= $bae_pw[$bae_mix[$i]];
	}

	for($i=0; $i<count($bae_pw); $i++) {
		$change= $bae_mixpw[$i]+23+$i*50;
		if($change>255) $change= $change%256;
		$hex_mok= floor($change/16);
		$new_pw.= $bae_16[$hex_mok];
		$hex_namer= $change%16;
		$new_pw.= $bae_16[$hex_namer];
	}
	return $new_pw;
}

//
//
//
function texthtml($text, $html)
{
	if($html == 'n' || !$html) {
		$text = htmlspecialchars($text);
		$text = eregi_replace("<\\?", "&lt;?", $text);
		$text = eregi_replace("\\?>", "?&gt;", $text);
		$text = eregi_replace("<script([^>]*)>", "&lt;script\\1&gt;", $text);
		$text = eregi_replace("</script>", "&lt;/script&gt;", $text);
		$text = eregi_replace("<table([^>]*)>", "&lt;table\\1&gt;", $text);
		$text = eregi_replace("</table>", "&lt;/table&gt;", $text);
		$text = eregi_replace("<tr([^>]*)>", "&lt;tr\\1&gt;", $text);
		$text = eregi_replace("</tr>", "&lt;/tr&gt;", $text);
		$text = eregi_replace("<td([^>]*)>", "&lt;td\\1&gt;", $text);
		$text = eregi_replace("</td>", "&lt;/td&gt;", $text);
		$text = eregi_replace("<title([^>]*)>", "&lt;title\\1&gt;", $text);
		$text = eregi_replace("</title>", "&lt;/title&gt;", $text);
		$text = eregi_replace("<iframe([^>]*)>", "&lt;iframe\\1&gt;", $text);
		$text = eregi_replace("</iframe>", "&lt;/iframe&gt;", $text);
		$text = eregi_replace("<form([^>]*)>", "&lt;form\\1&gt;", $text);
		$text = eregi_replace("</form>", "&lt;/form&gt;", $text);
		$text = eregi_replace("<plaintext([^>]*)>", "&lt;plaintext\\1&gt;", $text);
		$text = eregi_replace("<base([^>]*)>", "&lt;base\\1&gt;", $text);
		$text = eregi_replace("</plaintext>", "&lt;/plaintext&gt;", $text);
		$text = eregi_replace("<xmp>", "&lt;xmp&gt;", $text);
		$text = eregi_replace("</xmp>", "&lt;/xmp&gt;", $text);
		$text = eregi_replace("<xml>", "&lt;xml&gt;", $text);
		$text = eregi_replace("</xml>", "&lt;/xml&gt;", $text);
		$text = eregi_replace("<textarea([^>]*)>", "&lt;textarea\\1&gt;", $text);
		$text = eregi_replace("</textarea>", "&lt;textarea\\1&gt;", $text);
		$text = eregi_replace("<style([^>]*)>", "&lt;style\\1&gt;", $text);
		$text = eregi_replace("</style>", "&lt;/style&gt;", $text);
		$text = str_replace("\r\n", "\n", $text);
		$text = auto_link_lib($text);
		$text = str_replace("\n", "\r\n", $text);
		$text = nl2br($text);
		$text = str_replace("<br />", "<br>", $text);
		$text = str_replace("<br>\n", "<BR>", $text);
		$text = "<PRE>$text</PRE>";
	} else {
		$text = eregi_replace("<script([^>]*)>", "&lt;script\\1&gt;", $text);
		$text = eregi_replace("</script>", "&lt;/script&gt;", $text);
		$text = eregi_replace("<meta([^>]*)>", "&lt;script\\1&gt;", $text);
		$text = eregi_replace("</meta>", "&lt;/script&gt;", $text);
		$text = auto_link_lib($text);
	}
	if($html == "br") {
		$text = nl2br($text);
	}

	return $text;
}

// HTML 꺽회괄호를 특수문자로 치환
function delHTML($str)
{
    $str = str_replace("<", "&lt;", $str);
    $str = str_replace(">", "&gt;", $str);
    
    return $str;
}
?>