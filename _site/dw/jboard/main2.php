<?php
/**
	최근글 출력하기 2번째 버전(?)
	고객이 최근글 출력에 대한 여러움 그리고 다양성의 부족으로
	좀더 쉽고 많은 다양성을 주고, 그 다양성의 선택 또한 쉽게 한다.
*/
/** 외부화일 */
include ("./include/Template.inc");
include ("./include/func.inc");
include ("./include/parse.inc");
include ("./include/get.inc");
include ("./include/check.inc");

/** 변수확인 - 유효하지 않는 변수에 대해서는 기본 값으로 대체 한다. */
if(!$HTTP_GET_VARS[code] && !$info[code]) {
	echo "코드값이 누락 되었습니다";
	exit;
}

/** 경로 설정 및 변수 확인. */
$path[base] = "./";
$code = (isset($info[code])) ? $info[code] : $HTTP_GET_VARS[code];
$path[data] = $path[base]."data/".$code;
if(!is_dir($path[data])) {
	echo "코드값이 유효하지 않습니다";
	exit;
}

/** 템플릿 생성 */
$tfname = ($HTTP_GET_VARS[mode] == "detail") ? "detail.tpl" : "list.tpl";
$skin = (isset($info[skin])) ? $info[skin] : $HTTP_GET_VARS[skin];
$tpl = new Template("./gonggi/$skin");
$tpl -> define(
	array(
		all => $tfname,
	)
);

/** 실행 */
if($HTTP_GET_VARS[mode] == "detail") {
	Do_detail();
} else {
	Do_list();
}



/**
	함수 모음
*/

/** 목록 함수 */
function Do_list()
{
	global $path, $tpl, $info, $code, $skin;

	$dbm = dbmopen("$path[data]/data.gdbm", "r");
	/** 인덱스 GDBM화 작업으로 인해 주석처리
	$idx = @file("$path[data]/idx");
	$idx = explode("|", $idx[0]);
	*/
	$idx = explode("|", dbmfetch($dbm, "idx"));
	for($i = 0 ; $i < $info[cnt] ; $i++) {
		unset($main);
		$data = explode("|", dbmfetch($dbm, $idx[($i + 1)]));
		if($data[0]) {
			$tmp = explode(" ", $data[9]);
			$main[reg_date] = date("m.d", get_stamp($tmp[0], 0));
			$main[subject] = $data[2];
			if($info[str_len] > 0) {
				$main[subject] = cut_string_lib($main[subject], $info[str_len]);
			}
			if($info[popup] == "yes") {
				$str = "<a class=\"notice\" href=\"javascript:open_win('$info[jboard]/main2.php?code=$code&id=$data[0]&skin=$skin&mode=detail')\">$main[subject]</a>";
			} else {
				$str = "<a href=\"$info[jboard]/?p=detail&code=$code&id=$data[0]\" target=\"$info[target]\" class=\"notice\">$main[subject]</a>";
			}

			/** 프리셋에서 지정한 부분 */
			if($info[preset] == "01") {
			    $tpl -> assign(array(DATE_01 => $main[reg_date]));
				$tpl -> parse(PRESET_01, ".preset_01");
			} elseif($info[preset] == "02")  {
			    $tpl -> assign(array(DATE_02 => $main[reg_date]));
				$tpl -> parse(PRESET_02, ".preset_02");
			}
			/** 제목 */
			$tpl -> assign(
				array(
					LINK => $str,
					//SUBJECT => $main[subject],
				)
			);
			$tpl -> parse(SUBJECT, ".subject");

			/** 템플릿 파싱 */
			$tpl -> parse(TR, ".tr");
			$tpl -> clear_dynamic("subject");
			$tpl -> clear_dynamic("preset_01");
			$tpl -> clear_dynamic("preset_02");
		}
	}
	dbmclose($dbm);

	/** 나머지 처리 및 출력 */
	$tpl -> assign(
		array(
			MORE => "./?code=$code",
			TARGET => $info[target]
		)
	);
	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();
}

/** 보기 함수 */
function Do_detail()
{
	global $HTTP_GET_VARS, $path, $jboard, $tpl, $PHP_SELF;

	$dbm = dbmopen("$path[data]/data.gdbm", "r");
	$data = dbmfetch($dbm, $HTTP_GET_VARS[id]);
	$data = explode("|", $data);

	$tpl_comment = $data[7];
	$tpl_comment = str_replace("rhkdvk", "|", $tpl_comment);
	$tpl_comment = texthtml($tpl_comment, $data[13]);
	$tpl_subject = str_replace("rhkdvk", "|", $data[2]);
	$tpl_date = "<font color=\"#999999\" style=\"font-size:8pt\">2002-08-21 10:15:21</font>";

	$tpl -> assign(
		array(
			SUBJECT => $tpl_subject,
			COMMENT => $tpl_comment,
			DATE => $tpl_date
		)
	);

	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();
}
?>
