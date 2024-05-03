<?php
/** ============================================================

	Jboarfd 엑셀데이버 변환

	04/08/03 김대현

============================================================ **/

// 메모리 증가
ini_set("memory_limit", "64M");

/* 실행시간 늘이기 */
set_time_limit(180000);

// 외부화일
include ("./include/control.inc");

// 인수확인
if(!$_GET[code]) err("데이터 변환에 필요한 인수가 부족합니다.");

// 디비오픈
$dbm = dbmopen("../data/$_GET[code]/data.gdbm", "r");
$dbm2 = dbmopen("../data/$_GET[code]/comment.gdbm", "r");

// 인덱스 정보
$idx = explode("|", dbmfetch($dbm, "idx"));

// 엑셀화일을 생성한다.
$excel_file = "../data/$_GET[code]/excel.csv";
@unlink($excel_file);
$fp = fopen($excel_file, "a");
fputs($fp, "아이디,번호,제목,글쓴이,비밀번호,이메일,홈페이지,내용,아이피,날짜,조회수,글깊이,첨부화일정보,HTML사용\n");
fclose($fp);

// 데이터 변환
for($i = 0, $cnt = count($idx) ; $i < $cnt ; $i++) {
	if($idx[$i]) {
		$tmp = dbmfetch($dbm, $idx[$i]);
		$tmp = str_replace(",", "", $tmp);
		$tmp = str_replace("\r", "", $tmp);
		$tmp = str_replace("\n", "<BR>", $tmp);
		$tmp = str_replace("|", ",", $tmp);
		$fp = fopen($excel_file, "a");
		fputs($fp, $tmp."\n");
		fclose($fp);
	}
}

// 중간띄기
$fp = fopen($excel_file, "a");
fputs($fp, "\n\n\n\n\n\n여기서부터는의견글데이터입니다.\n");
fputs($fp, "부모글의아이디,글쓴이,글내용,비밀번호\n");
fclose($fp);


// 코멘트변환
for($i = 0, $cnt = count($idx) ; $i < $cnt ; $i++) {
	if($idx[$i]) {
		$data = dbmfetch($dbm2, $idx[$i]);
		if($data) {
			$oops = explode("\n", $data);
			for($j = 0 ; $j < count($oops) ; $j++) {
				$tmp = $oops[$j];
				$tmp = str_replace(",", "", $tmp);
				$tmp = str_replace("\r", "", $tmp);
				$tmp = str_replace("\n", "<BR>", $tmp);
				$tmp = str_replace("rlaeoguscjswo", ",", $tmp);

				$fp = fopen($excel_file, "a");
				fputs($fp, $idx[$i].",".$tmp."\n");
				fclose($fp);
			}
		}
	}
}


// 페이지 이동
Header("Location:$excel_file");
?>