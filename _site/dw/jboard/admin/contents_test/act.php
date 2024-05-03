<?
/*

	act 모듈 화일
	글작성, 글수정, 답변글, 삭제등의 작업이 이루어 짐

*/


//
// 직접 Access 체크
//
include ("./include/direct.inc");

// 변수
while(list($key,$value) = each($HTTP_POST_VARS)) {
	$tmp = trim($value);
	$tmp = stripslashes($tmp);
	$tmp = str_replace("rhkdvk", "", $tmp);
	$tmp = str_replace("|", "rhkdvk", $tmp);
	$HTTP_POST_VARS[$key] = $tmp;
}
$HTTP_POST_VARS[subject] = delHTML($HTTP_POST_VARS[subject]);
$HTTP_POST_VARS[name] = delHTML($HTTP_POST_VARS[name]);

//
// mode 별 분기
//
if($HTTP_GET_VARS[mode] == "com_del") $HTTP_POST_VARS[mode] = "com_del";
switch($HTTP_POST_VARS[mode])
{
	case "new" :
		Do_New();
		break;

	case "reply" :
		Do_reply();
		break;

	case "modify" :
		Do_modify();
		break;

	case "del" :
		Do_del();
		break;

	case "comment" :
		Do_comment();
		break;

	case "multidel" :
		Do_multidel();
		break;

	case "com_del" :
		Do_comdel();
		break;

	case "ban" :
		Do_ban();
		break;

	default :
		Do_Nothing();
		break;
}




/*------------------------------------------------------------
    # 액션 모듈용 함수 모음
*/
//
// mode 값이 없이 페이지 호출이 되었을 경우
//
function Do_Nothing() // void
{
	err("오류 입니다.\\n인수부족(인수명 : mode)");
}



//
// 밴시키기
//
function Do_ban()
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $HTTP_REFERER, $sep;

	$dbm = dbm_open("../login/ban.gdbm", "w");
	if(dbmexists($dbm, $HTTP_POST_VARS[ip])) {
		dbm_close($dbm);
		err("이미 등록된 아이피 입니다.");
		exit;
	} else {
		$now = date("Y-m-d H:i:s", time());
		$HTTP_POST_VARS[reason] = str_replace("'", "", $HTTP_POST_VARS[reason]);
		$val = $now."|".$HTTP_POST_VARS[reason];
		dbminsert($dbm, $HTTP_POST_VARS[ip], $val);
	}
	dbm_close($dbm);
	echo "<script>alert('등록되었습니다.');this.document.location.href='$HTTP_REFERER'</script>";
}


//
// 여러글 삭제
//
function Do_multidel()
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $HTTP_REFERER, $sep, $mview;

	$cnt = count($mview);
	for($i = 0 ; $i < $cnt ; $i++) {
		Do_del($mview[$i]);
	}
	Header("Location:$HTTP_REFERER");
}


//
// 의견글 삭제
//
function Do_comdel()
{

	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $HTTP_REFERER, $sep;

	/* 다른 클라이언트의 처리가 있을 경우 대기 한다 */
	stand_by();

	/* 처리시작 알림 */
	sign_process("process");


	$dbm = dbm_open($db_file[comment], "w");
	$data = dbm_fetch($dbm, $HTTP_POST_VARS[id]);
	$data = explode("\n", $data);
	$cnt = count($data) - 1;
	$new_data = "";
	for($i = 0 ; $i < $cnt ; $i++) {
		if($HTTP_POST_VARS[seq] != $i) {
			$new_data .= "$data[$i]\n";
		}
	}
	dbmreplace($dbm, $HTTP_POST_VARS[id], $new_data);
	dbm_close($dbm);


	/* 처리끝 알림 */
	sign_process("");

	Header("Location:$HTTP_REFERER");
}



//
// 의견글 등록
//
function Do_comment()
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $HTTP_REFERER, $sep;

	$HTTP_POST_VARS[c_name] = strip_tags($HTTP_POST_VARS[c_name]);
	$HTTP_POST_VARS[c_comment] = strip_tags($HTTP_POST_VARS[c_comment]);
	if(!$HTTP_POST_VARS[c_name]) {
		err("의견글 이릅을 입력해 주세요");
		exit;
	}
	if(!$HTTP_POST_VARS[c_comment]) {
		err("의견글 내용을 입력해 주세요");
		exit;
	}

	/* 다른 클라이언트의 처리가 있을 경우 대기 한다 */
	stand_by();

	/* 처리시작 알림 */
	sign_process("process");

	/* 처리 */
	$comment = str_replace("\n", "", $HTTP_POST_VARS[c_comment]);
	$comment = str_replace($sep, "", $comment);
	$name = str_replace("\n", "", $HTTP_POST_VARS[c_name]);
	$name = str_replace($sep, "", $name);
	$new_data = $name.$sep.$comment."\n";
	$dbm = dbm_open($db_file[comment], "w");
	if(dbmexists($dbm, $HTTP_POST_VARS[id])) {
		$old_data = dbm_fetch($dbm, $HTTP_POST_VARS[id]);
		$data = $new_data.$old_data;
		dbm_replace($dbm, $HTTP_POST_VARS[id], $data);
	} else {
		dbm_insert($dbm, $HTTP_POST_VARS[id], $new_data);
	}
	dbm_close($dbm);
	
	/* 처리끝 알림 */
	sign_process("");

	setcookie("jungbo_board_name", $name, time() + (86400 * 7));
	Header("Location:$HTTP_REFERER");
}


//
// 글 삭 제
//
function Do_del($userid="") // void
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file;

	if($userid) $HTTP_POST_VARS[id] = $userid;
	$num_id = $HTTP_POST_VARS[id] - 1; // 해당글번호에 대한 실제넉인 라인넘버

	/* 다른 클라이언트의 처리가 있을 경우 대기 한다 */
	stand_by();

	/* 처리시작 알림 */
	sign_process("process");

	$dbm = dbm_open($db_file[data], "w");
	$data = dbm_fetch($dbm, $HTTP_POST_VARS[id]);
	$org_data = explode("|", $data);

	/* 업로드 데이터 삭제 */
	$tmp = explode("?", $org_data[12]);
	$cnt = count($tmp) - 1;
	for($i = 0 ; $i < $cnt ; $i++) {
		$upload_data = explode(":", $tmp[$i]);
		@unlink("../../data/$HTTP_GET_VARS[code]/binary/$upload_data[0]");
	}

	//
	// 인덱스 및 검색용 화일 내용 갱신
	//
	/* 인덱스 화일 갱신 */
	$org_idx = dbm_fetch($dbm, "idx");
	$new_idx = str_replace("|$HTTP_POST_VARS[id]|", "|", $org_idx);
	/** 인덱스 GDBM화로 인해 코멘트 처리
	$org_idx = file($db_file[idx]);
	$new_idx = str_replace("|$HTTP_POST_VARS[id]|", "|", $org_idx[0]);
	*/

	/* 디비삭제 */
	dbm_delete($dbm, $HTTP_POST_VARS[id]);

	/* 인덱스 */
	dbm_replace($dbm, "idx", $new_idx);
	/** 인덱스 GDBM화로 인해 코멘트 처리
	$fp = fopen("$db_file[idx]","w+");
	fwrite($fp, $new_idx);
	fclose($fp);
	*/

	dbm_close($dbm);

	/* 의견글 삭제 */
	$dbm = dbm_open($db_file[comment], "w");
	dbm_delete($dbm, $HTTP_POST_VARS[id]);
	dbm_close($dbm);

	/* 처리끝 알림 */
	sign_process("");

	/* 페이지 리다이렉션 */
	if(!$userid) {
		Header("Location:./?p=list&code=$HTTP_GET_VARS[code]");
	}
}



//
// 글 수정
//
function Do_modify()
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file;

	/* 체크및 파씽~~~ */
	if(!$HTTP_POST_VARS[subject]) err("글제목을 입력해 주세요");
	if(!$HTTP_POST_VARS[name]) err("글쓴이를 입력해 주세요");
	if(!$HTTP_POST_VARS[passwd]) err("비밀번호를 입력해 주세요");
	if(!$HTTP_POST_VARS[comment]) err("내용을 입력해 주세요");
	$HTTP_POST_VARS[email] = (chk_email($HTTP_POST_VARS[email])) ? $HTTP_POST_VARS[email] : "";
	$HTTP_POST_VARS[url] = chk_url($HTTP_POST_VARS[url]);
	$HTTP_POST_VARS[subject] = strip_tags(trim($HTTP_POST_VARS[subject]));
	$HTTP_POST_VARS[name] = strip_tags(trim($HTTP_POST_VARS[name]));
	while(list($key, $value) = each($HTTP_POST_VARS)) {
		$HTTP_POST_VARS[$key] = str_replace("|", "rhkdvk", $value);
	}
	$ip = getenv("REMOTE_ADDR");

	/* 다른 클라이언트의 처리가 있을 경우 대기 한다 */
	stand_by();

	/* 처리시작 알림 */
	sign_process("process");

	/* 디비접속 */
	$dbm = dbm_open($db_file[data], "w");
	$org_data = explode("|", dbmfetch($dbm, $HTTP_POST_VARS[id]));
	$data = "$org_data[0]|$org_data[1]|$HTTP_POST_VARS[subject]|$HTTP_POST_VARS[name]|$org_data[4]|$HTTP_POST_VARS[email]|$HTTP_POST_VARS[url]|$HTTP_POST_VARS[comment]|$org_data[8]|$org_data[9]|$org_data[10]|$org_data[11]|$org_data[12]|$HTTP_POST_VARS[html]";
	dbm_replace($dbm, $HTTP_POST_VARS[id], $data); // 데이터 삽입

	dbm_close($dbm);

	/* 처리끝 알림 */
	sign_process("");

	/* 페이지 리다이렉션 */
	setcookie("jungbo_board_name",$HTTP_POST_VARS[name],time() + (86400 * 7));
	setcookie("jungbo_board_email",$HTTP_POST_VARS[email],time() + (86400 * 7));
	setcookie("jungbo_board_url",$HTTP_POST_VARS[url],time() + (86400 * 7));
	Header("Location:./?p=list&code=$HTTP_GET_VARS[code]");
}


//
// 답변글 처리 함수
//
function Do_reply()
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $config;

	/* 체크및 파씽~~~ */
	if(!$HTTP_POST_VARS[subject]) err("글제목을 입력해 주세요");
	if(!$HTTP_POST_VARS[name]) err("글쓴이를 입력해 주세요");
	if(!$HTTP_POST_VARS[passwd]) err("비밀번호를 입력해 주세요");
	if(!$HTTP_POST_VARS[comment]) err("내용을 입력해 주세요");
	$HTTP_POST_VARS[email] = (chk_email($HTTP_POST_VARS[email])) ? $HTTP_POST_VARS[email] : "";
	$HTTP_POST_VARS[url] = chk_url($HTTP_POST_VARS[url]);
	$HTTP_POST_VARS[subject] = strip_tags(trim($HTTP_POST_VARS[subject]));
	$HTTP_POST_VARS[name] = strip_tags(trim($HTTP_POST_VARS[name]));
	while(list($key, $value) = each($HTTP_POST_VARS)) {
		$HTTP_POST_VARS[$key] = str_replace("|", "rhkdvk", $value);
	}
	$ip = getenv("REMOTE_ADDR");
	$reg_date = date("Y-m-d H:i:s", time());

	/* 다른 클라이언트의 처리가 있을 경우 대기 한다 */
	stand_by();

	/* 처리시작 알림 */
	sign_process("process");

	/* 처리 함둥... */
	$idx = $idx2 = get_idx();
	rsort($idx2);
	$unique = $idx2[0] + 1;
	$key = array_search_lib($HTTP_POST_VARS[id], $idx);
	$s_idx = array_slice($idx, 0, $key + 1);
	$e_idx = array_slice($idx, $key + 1, count($idx));
	$new_idx = "|".implode("|", $s_idx)."|$unique|".implode("|", $e_idx);
	if($key != count($idx) - 1) {
		$new_idx .= "|";
	}
	$dbm = dbm_open($db_file[data], "w");
	$data = "$unique||$HTTP_POST_VARS[subject]|$HTTP_POST_VARS[name]|$HTTP_POST_VARS[passwd]|$HTTP_POST_VARS[email]|$HTTP_POST_VARS[url]|$HTTP_POST_VARS[comment]|$ip|$reg_date|0|$HTTP_POST_VARS[depth]||$HTTP_POST_VARS[html]";
	if(dbmexists($dbm, $unique)) {
		dbm_close($dbm);
		err("글등록시 에러가 발생하였습니다.\\n이유 : 중복된 키값의 데이터 삽입");
		exit;
    } else {
		dbm_insert($dbm, $unique, $data); // 데이터 삽입
		dbm_replace($dbm, "idx", $new_idx);
		/** 인덱스 GDBM화로 인한 코멘트 처리
		$fp = fopen("$db_file[idx]","w+");
		fwrite($fp, $new_idx);
		fclose($fp);
		*/
	}

	dbm_close($dbm);

	/* 처리끝 알림 */
	sign_process("");

	/* 답글등록시 관리자 메일 */
	if($config[6] == 1) { // 관리자 메일 받기 설정된경우와 메일주소가 유효한 경우 보낸다
		$dbm = dbm_open($db_file[data], "r");
		$data = dbm_fetch($dbm, $HTTP_POST_VARS[id]);
		dbm_close($dbm);
		$data = explode("|", $data);
		if($data[5]) {
			$base_url = "http://lightwave.ohhappy.net/JBoard_all_gdbm";
			$minfo[url] = "$base_url/?p=detail&id=$unique&code=$HTTP_GET_VARS[code]"; // url 부분과 디렉토리명은 관리자 설정에서 설장하게끔하여야 함
			$minfo[to] = $data[5];
			alert_mail($HTTP_POST_VARS, $minfo, "reply");
		}
	}

	/* 페이지 리다이렉션 */
	setcookie("jungbo_board_name",$HTTP_POST_VARS[name],time() + (86400 * 7));
	setcookie("jungbo_board_email",$HTTP_POST_VARS[email],time() + (86400 * 7));
	setcookie("jungbo_board_url",$HTTP_POST_VARS[url],time() + (86400 * 7));
	Header("Location:./?p=list&code=$HTTP_GET_VARS[code]&page=$HTTP_POST_VARS[page]");

}


//
// 새글 처리 함수
//
function Do_New() // void
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $HTTP_POST_FILES, $upload, $config;

	/* 체크및 파씽~~~ */
	if(!$HTTP_POST_VARS[subject]) err("글제목을 입력해 주세요");
	if(!$HTTP_POST_VARS[name]) err("글쓴이를 입력해 주세요");
	if(!$HTTP_POST_VARS[passwd]) err("비밀번호를 입력해 주세요");
	if(!$HTTP_POST_VARS[comment]) err("내용을 입력해 주세요");
	$HTTP_POST_VARS[email] = (chk_email($HTTP_POST_VARS[email])) ? $HTTP_POST_VARS[email] : "";
	$HTTP_POST_VARS[url] = chk_url($HTTP_POST_VARS[url]);
	$HTTP_POST_VARS[subject] = strip_tags(trim($HTTP_POST_VARS[subject]));
	$HTTP_POST_VARS[name] = strip_tags(trim($HTTP_POST_VARS[name]));
	while(list($key, $value) = each($HTTP_POST_VARS)) {
		$HTTP_POST_VARS[$key] = str_replace("|", "rhkdvk", trim($value));
	}
	$ip = getenv("REMOTE_ADDR");
	$reg_date = date("Y-m-d H:i:s", time());

	/* 화일첨부 처리 */
	if($HTTP_POST_FILES['upload']['name'][0]) {
		$up_cnt = count($HTTP_POST_FILES['upload']['name']);
		for($i = 0 ; $i < $up_cnt ; $i++) {
			if($HTTP_POST_FILES[upload][name][$i]) {
				$up[fname] = str_replace("&", "" ,$HTTP_POST_FILES[upload][name][$i]);
				$up[fname] = str_replace("\"", "", $up[fname]);
				$up[fname] = str_replace("\'", "", $up[fname]);
				$up[size] = $HTTP_POST_FILES[upload][size][$i];
				$up[type] = $HTTP_POST_FILES[upload][type][$i];
				$tmp = explode(".", $up[fname]);
				$cnt = count($tmp) - 1;
				$ext = strtolower($tmp[$cnt]);
				if($ext == "php" || $ext == "phtml" || $ext == "inc" || $ext == "ph" || $ext == "html" || $ext == "htm" || !$ext) {
					err("스크립트화일 및 PHP프로그래밍 관련된 화일들은 업로드 하실수 없습니다($ext $i).\\n\\n확장자가 .php .phtml .inc .ph .html .htm 인것들이 해당됩니다");
				}
				while(is_file("./data/$HTTP_GET_VARS[code]/binary/$up[fname]")) {
					$up[fname] = "0".$up[fname];
				}
				if(!@copy($HTTP_POST_FILES['upload']['tmp_name'][$i], "../../data/$HTTP_GET_VARS[code]/binary/$up[fname]")) {
					err("화일업로드에 실패하였습니다.");
					exit;
				}
				$upload_info .= "$up[fname]:$up[size]:$up[type]:$tmp[1]?";
			}
		}
	}

	/* 다른 클라이언트의 처리가 있을 경우 대기 한다 */
	stand_by();

	/* 처리시작 알림 */
	sign_process("process");

	/* 디비와 관련된것들의 처리 및 디비 입력 */
	$dbm = dbm_open($db_file[data], "w");

	if($HTTP_POST_VARS[gonggi] == "yes") {
		if(!dbmexists($dbm, "G_num")) {
			$unique = "G_0";
			dbminsert($dbm, "G_num", "1");
		} else {
			$tmp = dbmfetch($dbm, "G_num");
			$g_new = $tmp + 1;
			$unique = "G_".$tmp;
			dbmreplace($dbm, "G_num", $g_new);
		}
	} else {
		if(dbmexists($dbm, "idx")) {
			$idx = dbmfetch($dbm, "idx");
			$tmp = explode("|", $idx);
			rsort($tmp);
			$unique = $tmp[0] + 1;
			$new_idx = "|".$unique.$idx;
		} else {
			$unique = 1;
			$new_idx = "|1|";
		}	
		/** 인덱스 GDBM화 작업으로 코멘트 
		if(file_exists($db_file[idx])) {
			$idx = file($db_file[idx]);
			$idx = $idx[0];
			$tmp = explode("|", $idx);
			rsort($tmp);
			$unique = $tmp[0] + 1;
			$new_idx = "|".$unique.$idx;
		} else {
			$unique = 1;
			$new_idx = "|1|";
		}
		*/
	}

	$num = dbm_fetch($dbm, "number");
	if(!$num) $num = 1;
	$next_num = $num + 1;
	$pw = get_pw($HTTP_POST_VARS[passwd]);
	$data = "$unique|$num|$HTTP_POST_VARS[subject]|$HTTP_POST_VARS[name]|$pw]|$HTTP_POST_VARS[email]|$HTTP_POST_VARS[url]|$HTTP_POST_VARS[comment]|$ip|$reg_date|0|0|$upload_info|$HTTP_POST_VARS[html]";
	if(dbmexists($dbm, $unique)) {
		dbm_close($dbm);
		err("글등록시 에러가 발생하였습니다.\\n이유 : 중복된 키값의 데이터 삽입");
		exit;
	} else {
		if($HTTP_POST_VARS[gonggi] != "yes") {
			dbm_replace($dbm, "number", $next_num); // 인덱스 갱신
			dbm_replace($dbm, "idx", $new_idx);
			/** 인덱스 DGBM 화 작업으로 인해 코멘트 처리
			$fp = fopen("$db_file[idx]", "w+");
			fwrite($fp, $new_idx);
			fclose($fp);
			*/
		}
		dbm_insert($dbm, $unique, $data); // 데이터 삽입
	}

	dbm_close($dbm);

	/* 처리끝 알림 */
	sign_process("");

	/* 새글등록시 관리자 메일 */
	if($HTTP_POST_VARS[gonggi] != "yes") {
		if($config[5]) { // 관리자 메일 받기 설정된경우와 메일주소가 유효한 경우 보낸다
			$base_url = $admin[url];
			$minfo[url] = "$base_url/?p=detail&id=$unique&code=$HTTP_GET_VARS[code]"; // url 부분과 디렉토리명은 관리자 설정에서 설장하게끔하여야 함
			$minfo[to] = $config[5]; // 관리자 주소가 될 예정(?)
			alert_mail($HTTP_POST_VARS, $minfo, "new");
		}
	}

	/* 페이지 리다이렉션 */
	setcookie("jungbo_board_name",$HTTP_POST_VARS[name],time() + (86400 * 7));
	setcookie("jungbo_board_email",$HTTP_POST_VARS[email],time() + (86400 * 7));
	setcookie("jungbo_board_url",$HTTP_POST_VARS[url],time() + (86400 * 7));
	if($HTTP_POST_VARS[gonggi] == "yes") {
		echo "<script>alert('공지사항이 등록되었습니다'); window.close();</script>";
	} else {
		Header("Location:./?p=list&code=$HTTP_GET_VARS[code]");
	}
}




/*------------------------------------------------------------
    # 액션 기타 함수
*/
//
// 나 진행중??
//
function sign_process($str) // void
{
	global $db_file;

	exec("echo $str > $db_file[lock]");
}


//
// Stand By
//
function stand_by() // void
{
	// 데이터 일관성을 위하여 1개 이상의 작업에 대해 디렉토리 접근을 허용안함
	// 일정시간 딜레이 시킨후 일정시간이 지난후에는 강제 Access 시킨다.
	global $db_file;

	while(exec("cat $db_file[lock]") == "process")
	{
		usleep(10000);
		$cnt++;
		if($cnt > 3) exec("echo > $db_file[lock]");
	}
}
?>