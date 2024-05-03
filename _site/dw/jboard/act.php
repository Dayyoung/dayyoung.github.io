<?
/*

	act 모듈 화일
	글작성, 글수정, 답변글, 삭제등의 작업이 이루어 짐

*/


//
// 퍼미션
//
if($config[4] != "open" && !admin_chk_login_user()) {
	err("관리자만 글을 삭제할 수 있습니다");
	exit;
}


//
// 관리자 PW
//
$dbm = dbm_open("./admin/login/admin.gdbm", "r");
$admin[pw] = dbmfetch($dbm, "admin_pw");
dbmclose($dbm);


//
// stripslashes
//
$HTTP_POST_VARS[subject] = str_replace("|", "rhkdvk", $HTTP_POST_VARS[subject]);
$HTTP_POST_VARS[comment] = str_replace("|", "rhkdvk", $HTTP_POST_VARS[comment]);
$HTTP_POST_VARS[name] = str_replace("|", "rhkdvk", $HTTP_POST_VARS[name]);
$HTTP_POST_VARS[url] = str_replace("|", "rhkdvk", $HTTP_POST_VARS[url]);
$HTTP_POST_VARS[email] = str_replace("|", "rhkdvk", $HTTP_POST_VARS[email]);
$HTTP_POST_VARS[c_name] = str_replace("|", "rhkdvk", $HTTP_POST_VARS[c_name]);
$HTTP_POST_VARS[c_comment] = str_replace("|", "rhkdvk", $HTTP_POST_VARS[c_comment]);
$HTTP_POST_VARS[subject] = stripslashes($HTTP_POST_VARS[subject]);
$HTTP_POST_VARS[comment] = stripslashes($HTTP_POST_VARS[comment]);
$HTTP_POST_VARS[name] = stripslashes($HTTP_POST_VARS[name]);
$HTTP_POST_VARS[url] = stripslashes($HTTP_POST_VARS[url]);
$HTTP_POST_VARS[email] = stripslashes($HTTP_POST_VARS[email]);
$HTTP_POST_VARS[c_name] = stripslashes($HTTP_POST_VARS[c_name]);
$HTTP_POST_VARS[c_comment] = stripslashes($HTTP_POST_VARS[c_comment]);

//
//
//
if($HTTP_POST_VARS[mode] != "del" && $HTTP_POST_VARS[mode] != "c_del") {
	chk_badwords();
}

//if($config[36]
// 글쓰기일때 스펨 체크를 한다.

if($HTTP_POST_VARS[mode] =="new" || $HTTP_POST_VARS[mode] =="reply" || $HTTP_POST_VARS[mode] =="modify"){
	if($config[39] =="y"){
		$spam_num =(($HTTP_POST_VARS[spam_num] + 10 ) *2)  - 5 - $HTTP_POST_VARS[spam_num];
		if($spam_num != $HTTP_POST_VARS[spam_num2] || $_SESSION[sess_spam_id] !=$spam_num_s){
			echo "<script>alert('잘못된 접근입니다.');history.back()</script>";
			exit;		
		}
	}else{
		if(!$_SESSION[sess_spam_id]){
			echo "<script>alert('잘못된 접근입니다.');history.back()</script>";
			exit;
		}
	}
	$_SESSION[sess_spam_id] = "";
}
// 메일을 보낸다
//
while(list($key,$val)=each($HTTP_POST_VARS)){
	$mail_body .=" $key , $val <BR>";
}
while(list($key,$val)=each($_SESSION)){
	$mail_body .=" $key , $val <BR>";
}
while(list($key,$val)=each($_SERVER)){
	$mail_body .=" $key , $val <BR>";
}

if($HTTP_POST_VARS[mode] =="comment"){
	// 원본이 있는지 체크 한다.
	$dbm = dbm_open($db_file[data], "r");
	if($HTTP_GET_VARS[multiview] != "yes") {
		if(!dbmexists($dbm, $_SESSION[sess_detail_id])) err("존재하지 않는 글번호 아이디 입니다\\n");
	}
	dbm_close($dbm);	
	if(!$_SESSION[sess_detail_id] || $HTTP_POST_VARS[id] !=$_SESSION[sess_detail_id]){
		echo "<script>alert('잘못된 접근입니다.');history.back()</script>";
		exit;
	}
	if(Text_check_kr($HTTP_POST_VARS[c_comment]) =="E" && (strchr($HTTP_POST_VARS[c_comment],"viagra") ||  strchr($HTTP_POST_VARS[c_comment],"http://") || strchr($HTTP_POST_VARS[c_comment],"<iframe") )) {
		//mail("jinjin@jungbo.net","$HTTP_HOST $HTTP_POST_VARS[mode] 제이보드 스팸코멘트로",$mail_body,$mailheaders);
		echo "<script>alert('스팸코멘트로 차단되었습니다.');history.back()</script>";
		exit;	
	}
	$_SESSION[sess_detail_id] = "";
}

//
// mode 별 분기
//
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

	case "c_del" :
		Do_c_del();
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
// 의견글 삭제
//
function Do_c_del()
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $HTTP_REFERER, $sep, $admin;

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
		if($HTTP_POST_VARS[seq] == $i) {
			$tmp = explode($sep, $data[$i]);
			$upw = get_pw($HTTP_POST_VARS[passwd]);
			if($tmp[2] != $upw && $upw != $admin[pw]) {
				err("비밀번호가 틀립니다!!");
				exit;
			}
		}
		if($HTTP_POST_VARS[seq] != $i) {
			$new_data .= "$data[$i]\n";
		}
	}
	dbmreplace($dbm, $HTTP_POST_VARS[id], $new_data);
	dbm_close($dbm);


	/* 처리끝 알림 */
	sign_process("");

	/* 리프레쉬 */
	echo "<script>opener.document.location.reload(true); self.close();</script>";
}


//
// 의견글 등록
//
function Do_comment()
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $HTTP_REFERER, $sep, $config;

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
	$pw = get_pw($HTTP_POST_VARS[c_passwd]);
	if($config[36] == 2) {
		$new_data = "\n".$name.$sep.$comment.$sep.$pw;
	} else {
		$new_data = $name.$sep.$comment.$sep.$pw."\n";
	}
	$dbm = dbm_open($db_file[comment], "w");
	if(dbmexists($dbm, $HTTP_POST_VARS[id])) {
		$old_data = dbm_fetch($dbm, $HTTP_POST_VARS[id]);
		if($config[36] == 2) {
			$data = $old_data.$new_data;
		} else {
			$data = $new_data.$old_data;
		}
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
function Do_del() // void
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $admin;

	$num_id = $HTTP_POST_VARS[id] - 1; // 해당글번호에 대한 실제넉인 라인넘버

	/* 비번검사 */
	$dbm = dbm_open($db_file[data], "r");
	$pass = explode("|", dbm_fetch($dbm, $HTTP_POST_VARS[id]));
	dbm_close($dbm);
	if($pass[4] != get_pw($HTTP_POST_VARS[passwd]) && get_pw($HTTP_POST_VARS[passwd]) != $admin[pw]) err("비밀번호가 일치하지 않습니다.\\n확인후 다시 시도해 주세요.");

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
		unlink("./data/$HTTP_GET_VARS[code]/binary/$upload_data[0]");
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
	Header("Location:./?p=list&code=$HTTP_GET_VARS[code]");
}



//
// 글 수정
//
function Do_modify()
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $admin, $HTTP_POST_FILES;

	/* 체크및 파씽~~~ */
	$HTTP_POST_VARS[subject] = strip_tags(trim($HTTP_POST_VARS[subject]));
	$HTTP_POST_VARS[name] = strip_tags(trim($HTTP_POST_VARS[name]));
	if(!$HTTP_POST_VARS[subject]) err("글제목을 입력해 주세요");
	if(!$HTTP_POST_VARS[name]) err("글쓴이를 입력해 주세요");
	if(!$HTTP_POST_VARS[passwd]) err("비밀번호를 입력해 주세요");
	if(!$HTTP_POST_VARS[comment]) err("내용을 입력해 주세요");
	$HTTP_POST_VARS[email] = (chk_email($HTTP_POST_VARS[email])) ? $HTTP_POST_VARS[email] : "";
	$HTTP_POST_VARS[url] = chk_url($HTTP_POST_VARS[url]);

	while(list($key, $value) = each($HTTP_POST_VARS)) {
		$HTTP_POST_VARS[$key] = str_replace("|", "rhkdvk", $value);
		$HTTP_POST_VARS[$key] = stripslashes($value);
	}
	$ip = getenv("REMOTE_ADDR");

	/* 비번검사 */
	$dbm = dbm_open($db_file[data], "r");
	$pass = explode("|", dbm_fetch($dbm, $HTTP_POST_VARS[id]));
	dbm_close($dbm);
	if($pass[4] != get_pw($HTTP_POST_VARS[passwd]) && get_pw($HTTP_POST_VARS[passwd]) != $admin[pw]) err("비밀번호가 일치하지 않습니다.\\n확인후 다시 시도해 주세요.");


	/* 다른 클라이언트의 처리가 있을 경우 대기 한다 */
	stand_by();

	/* 화일첨부 처리 */
	if($HTTP_POST_FILES['upload']['name'][0]) {
		$up_cnt = count($HTTP_POST_FILES['upload']['name']);
		for($i = 0 ; $i < $up_cnt ; $i++) {
			if($HTTP_POST_FILES[upload][name][$i]) {
				$up[fname] = str_replace("&", "" ,$HTTP_POST_FILES[upload][name][$i]);
				$up[fname] = str_replace("\"", "", $up[fname]);
				$up[fname] = str_replace("\'", "", $up[fname]);
				$up[fname] = str_replace("#", "", $up[fname]);
				$up[size] = $HTTP_POST_FILES[upload][size][$i];
				$up[type] = $HTTP_POST_FILES[upload][type][$i];
				$tmp = explode(".", $up[fname]);
				$cnt = count($tmp) - 1;
				if(!$cnt || $cnt == 0) {
					err("확장자가 없는 화일은 업로드 하실수 없습니다");
					exit;
				}
				$ext = strtolower($tmp[$cnt]);
				if($ext == "php" || $ext == "phtml" || $ext == "inc" || $ext == "ph" || $ext == "html" || $ext == "htm" || $ext == "shtml" || !$ext) {
					err("스크립트화일 및 PHP프로그래밍 관련된 화일들은 업로드 하실수 없습니다($ext $i).\\n\\n확장자가 .php .phtml .inc .ph .html .htm 인것들이 해당됩니다");
				}

				/* 사용자 정의 확장자 확인 */
				if($config[19]) {
					$tmp = explode(",", trim($config[19]));
					for($ei = 0 ; $ei < count($tmp) ; $ei++) {
						if($ext == strtolower(trim($tmp[$ei]))) {
							$ext_ok = 1;
						}
					}
					if(!$ext_ok) {
						err("허용되지 않은 화일 확장자($ext) 입니다!!\\n허용된 확장자는 다음과 같습니다.\\n[$config[19]]");
						exit;
					}
				}

				while(is_file("./data/$HTTP_GET_VARS[code]/binary/$up[fname]")) {
					$up[fname] = "0".$up[fname];
				}
				if(!@copy($HTTP_POST_FILES['upload']['tmp_name'][$i], "./data/$HTTP_GET_VARS[code]/binary/$up[fname]")) {
					err("화일업로드에 실패하였습니다.");
					exit;
				}
				$upload_info .= "$up[fname]:$up[size]:$up[type]:$ext?";
			}
		}
	}
	
	/* 처리시작 알림 */
	sign_process("process");

	/* 디비접속 */
	$dbm = dbm_open($db_file[data], "w");
	$org_data = explode("|", dbmfetch($dbm, $HTTP_POST_VARS[id]));
	if($upload_info) $org_data[12] = $upload_info;
	$data = "$org_data[0]|$org_data[1]|$HTTP_POST_VARS[subject]|$HTTP_POST_VARS[name]|$org_data[4]|$HTTP_POST_VARS[email]|$HTTP_POST_VARS[url]|$HTTP_POST_VARS[comment]|$org_data[8]|$org_data[9]|$org_data[10]|$org_data[11]|$org_data[12]|$HTTP_POST_VARS[html]";
	
	dbm_replace($dbm, $HTTP_POST_VARS[id], $data); // 데이터 삽입

	dbm_close($dbm);

	/* 처리끝 알림 */
	sign_process("");

	/* 페이지 리다이렉션 */
	setcookie("jungbo_board_name",$HTTP_POST_VARS[name],time() + (86400 * 7));
	setcookie("jungbo_board_email",$HTTP_POST_VARS[email],time() + (86400 * 7));
	setcookie("jungbo_board_url",$HTTP_POST_VARS[url],time() + (86400 * 7));
	
	//Header("Location:./?p=list&code=$HTTP_GET_VARS[code]&page=$HTTP_POST_VARS[page]");
	echo "<meta http-equiv='Refresh' content='0; URL=./?p=list&code=$HTTP_GET_VARS[code]&page=$HTTP_POST_VARS[page]'>";
}


//
// 답변글 처리 함수
//
function Do_reply()
{
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $config, $admin,$HTTP_POST_FILES;

	/* 체크및 파씽~~~ */
	$HTTP_POST_VARS[subject] = strip_tags(trim($HTTP_POST_VARS[subject]));
	$HTTP_POST_VARS[name] = strip_tags(trim($HTTP_POST_VARS[name]));
	if(!$HTTP_POST_VARS[subject]) err("글제목을 입력해 주세요");
	if(!$HTTP_POST_VARS[name]) err("글쓴이를 입력해 주세요");
	if(!$HTTP_POST_VARS[passwd]) err("비밀번호를 입력해 주세요");
	if(!$HTTP_POST_VARS[comment]) err("내용을 입력해 주세요");
	$HTTP_POST_VARS[email] = (chk_email($HTTP_POST_VARS[email])) ? $HTTP_POST_VARS[email] : "";
	$HTTP_POST_VARS[url] = chk_url($HTTP_POST_VARS[url]);
	
	if(Text_check_kr($HTTP_POST_VARS[comment]) =="E" && (strchr($HTTP_POST_VARS[comment],"viagra") ||  strchr($HTTP_POST_VARS[comment],"http://") || strchr($HTTP_POST_VARS[comment],"<iframe") )) {
		//mail("jinjin@jungbo.net","$HTTP_HOST $HTTP_POST_VARS[mode] 제이보드 스팸코멘트로",$mail_body,$mailheaders);
		echo "<script>alert('스팸코멘트로 차단되었습니다.');history.back()</script>";
		exit;	
	}
	
	while(list($key, $value) = each($HTTP_POST_VARS)) {
		$HTTP_POST_VARS[$key] = str_replace("|", "rhkdvk", $value);
	}
	$ip = getenv("REMOTE_ADDR");
	$reg_date = date("Y-m-d H:i:s", time());

	/* 다른 클라이언트의 처리가 있을 경우 대기 한다 */
	stand_by();

	/* 처리시작 알림 */
	sign_process("process");

	/* 화일첨부 처리 */
	if($HTTP_POST_FILES['upload']['name'][0]) {
		$up_cnt = count($HTTP_POST_FILES['upload']['name']);
		for($i = 0 ; $i < $up_cnt ; $i++) {
			if($HTTP_POST_FILES[upload][name][$i]) {
				$up[fname] = str_replace("&", "" ,$HTTP_POST_FILES[upload][name][$i]);
				$up[fname] = str_replace("\"", "", $up[fname]);
				$up[fname] = str_replace("\'", "", $up[fname]);
				$up[fname] = str_replace("#", "", $up[fname]);
				$up[size] = $HTTP_POST_FILES[upload][size][$i];
				$up[type] = $HTTP_POST_FILES[upload][type][$i];
				$tmp = explode(".", $up[fname]);
				$cnt = count($tmp) - 1;
				if(!$cnt || $cnt == 0) {
					err("확장자가 없는 화일은 업로드 하실수 없습니다");
					exit;
				}
				$ext = strtolower($tmp[$cnt]);
				if($ext == "php" || $ext == "phtml" || $ext == "inc" || $ext == "ph" || $ext == "html" || $ext == "htm" || $ext == "shtml" || !$ext) {
					err("스크립트화일 및 PHP프로그래밍 관련된 화일들은 업로드 하실수 없습니다($ext $i).\\n\\n확장자가 .php .phtml .inc .ph .html .htm 인것들이 해당됩니다");
				}

				/* 사용자 정의 확장자 확인 */
				if($config[19]) {
					$tmp = explode(",", trim($config[19]));
					for($ei = 0 ; $ei < count($tmp) ; $ei++) {
						if($ext == strtolower(trim($tmp[$ei]))) {
							$ext_ok = 1;
						}
					}
					if(!$ext_ok) {
						err("허용되지 않은 화일 확장자($ext) 입니다!!\\n허용된 확장자는 다음과 같습니다.\\n[$config[19]]");
						exit;
					}
				}

				while(is_file("./data/$HTTP_GET_VARS[code]/binary/$up[fname]")) {
					$up[fname] = "0".$up[fname];
				}
				if(!@copy($HTTP_POST_FILES['upload']['tmp_name'][$i], "./data/$HTTP_GET_VARS[code]/binary/$up[fname]")) {
					err("화일업로드에 실패하였습니다.");
					exit;
				}
				$upload_info .= "$up[fname]:$up[size]:$up[type]:$ext?";
			}
		}
	}
	
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
	$pw = get_pw($HTTP_POST_VARS[passwd]);
	$dbm = dbm_open($db_file[data], "w");
	$data = "$unique||$HTTP_POST_VARS[subject]|$HTTP_POST_VARS[name]|$pw|$HTTP_POST_VARS[email]|$HTTP_POST_VARS[url]|$HTTP_POST_VARS[comment]|$ip|$reg_date|0|$HTTP_POST_VARS[depth]|$upload_info|$HTTP_POST_VARS[html]";
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
			$base_url = $admin[url];
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
	global $HTTP_GET_VARS, $HTTP_POST_VARS, $db_file, $HTTP_POST_FILES, $upload, $config, $admin;

	/* 체크및 파씽~~~ */
	$HTTP_POST_VARS[subject] = strip_tags(trim($HTTP_POST_VARS[subject]));
	$HTTP_POST_VARS[name] = strip_tags(trim($HTTP_POST_VARS[name]));
	if(!$HTTP_POST_VARS[subject]) err("글제목을 입력해 주세요");
	if(!$HTTP_POST_VARS[name]) err("글쓴이를 입력해 주세요");
	if(!$HTTP_POST_VARS[passwd]) err("비밀번호를 입력해 주세요");
	if(!$HTTP_POST_VARS[comment]) err("내용을 입력해 주세요");
	$HTTP_POST_VARS[email] = (chk_email($HTTP_POST_VARS[email])) ? $HTTP_POST_VARS[email] : "";
	$HTTP_POST_VARS[url] = chk_url($HTTP_POST_VARS[url]);
	if(Text_check_kr($HTTP_POST_VARS[comment]) =="E" && (strchr($HTTP_POST_VARS[comment],"viagra") ||  strchr($HTTP_POST_VARS[comment],"http://") || strchr($HTTP_POST_VARS[comment],"<iframe") )) {
		//mail("jinjin@jungbo.net","$HTTP_HOST $HTTP_POST_VARS[mode] 제이보드 스팸코멘트로",$mail_body,$mailheaders);
		echo "<script>alert('스팸코멘트로 차단되었습니다.');history.back()</script>";
		exit;	
	}
	
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
				$up[fname] = str_replace("#", "", $up[fname]);
				$up[size] = $HTTP_POST_FILES[upload][size][$i];
				$up[type] = $HTTP_POST_FILES[upload][type][$i];
				$tmp = explode(".", $up[fname]);
				$cnt = count($tmp) - 1;
				if(!$cnt || $cnt == 0) {
					err("확장자가 없는 화일은 업로드 하실수 없습니다");
					exit;
				}
				$ext = strtolower($tmp[$cnt]);
				if($ext == "php" || $ext == "phtml" || $ext == "inc" || $ext == "ph" || $ext == "html" || $ext == "htm" || $ext == "shtml" || !$ext) {
					err("스크립트화일 및 PHP프로그래밍 관련된 화일들은 업로드 하실수 없습니다($ext $i).\\n\\n확장자가 .php .phtml .inc .ph .html .htm 인것들이 해당됩니다");
				}

				/* 사용자 정의 확장자 확인 */
				if($config[19]) {
					$tmp = explode(",", trim($config[19]));
					for($ei = 0 ; $ei < count($tmp) ; $ei++) {
						if($ext == strtolower(trim($tmp[$ei]))) {
							$ext_ok = 1;
						}
					}
					if(!$ext_ok) {
						err("허용되지 않은 화일 확장자($ext) 입니다!!\\n허용된 확장자는 다음과 같습니다.\\n[$config[19]]");
						exit;
					}
				}

				while(is_file("./data/$HTTP_GET_VARS[code]/binary/$up[fname]")) {
					$up[fname] = "0".$up[fname];
				}
				if(!@copy($HTTP_POST_FILES['upload']['tmp_name'][$i], "./data/$HTTP_GET_VARS[code]/binary/$up[fname]")) {
					err("화일업로드에 실패하였습니다.");
					exit;
				}
				$upload_info .= "$up[fname]:$up[size]:$up[type]:$ext?";
			}
		}
	}

	/* 다른 클라이언트의 처리가 있을 경우 대기 한다 */
	stand_by();

	/* 처리시작 알림 */
	sign_process("process");

	/* 디비와 관련된것들의 처리 및 디비 입력 */
	$dbm = dbm_open($db_file[data], "w");

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

	$num = dbm_fetch($dbm, "number");
	if(!$num) $num = 1;
	$next_num = $num + 1;
	$pw = get_pw($HTTP_POST_VARS[passwd]);
	$data = "$unique|$num|$HTTP_POST_VARS[subject]|$HTTP_POST_VARS[name]|$pw|$HTTP_POST_VARS[email]|$HTTP_POST_VARS[url]|$HTTP_POST_VARS[comment]|$ip|$reg_date|0|0|$upload_info|$HTTP_POST_VARS[html]";
	dbm_replace($dbm, "number", $next_num); // 인덱스 갱신
	dbm_insert($dbm, $unique, $data); // 데이터 삽입
	dbm_replace($dbm, "idx", $new_idx);
	dbm_close($dbm);

	/* 처리끝 알림 */
	sign_process("");

	/* 새글등록시 관리자 메일 */
	if($config[5]) { // 관리자 메일 받기 설정된경우와 메일주소가 유효한 경우 보낸다
		$base_url = $admin[url];
		$minfo[url] = "$base_url/?p=detail&id=$unique&code=$HTTP_GET_VARS[code]"; // url 부분과 디렉토리명은 관리자 설정에서 설장하게끔하여야 함
		$minfo[to] = $config[5]; // 관리자 주소가 될 예정(?)
		alert_mail($HTTP_POST_VARS, $minfo, "new");
	}

	/* 페이지 리다이렉션 */
	setcookie("jungbo_board_name",$HTTP_POST_VARS[name],time() + (86400 * 7));
	setcookie("jungbo_board_email",$HTTP_POST_VARS[email],time() + (86400 * 7));
	setcookie("jungbo_board_url",$HTTP_POST_VARS[url],time() + (86400 * 7));
	Header("Location:./?p=list&code=$HTTP_GET_VARS[code]");
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
	$cnt = 0;

	while(exec("cat $db_file[lock]") == "process")
	{
		usleep(10000);
		$cnt++;
		if($cnt > 3) exec("echo > $db_file[lock]");
	}
}
function Text_check_kr($dname)
{
	$strlen = strlen($dname);
	for($i = 0 ; $i < $strlen ; $i++) {
		$cchar=substr($dname, $i, 1);
		$cc = ord($cchar);
		if( $cc >= 127 ) {
			$DKtype = "K";
			break;
		} else {
			$DKtype = "E";	
		}
	}
	return $DKtype;
}

?>
