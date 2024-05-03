<?php
/*

	글목록보기 모듈 화일

*/


//
// 직접 Access 체크
//
if($HTTP_GET_VARS[p] != "detail") include ("./include/direct.inc");


//
// 변수 설정및 체킹.
//
if(!$HTTP_GET_VARS[page]) $HTTP_GET_VARS[page] = 1;


//
// 템플릿 생성
//
//$tpl = & new Template("./template"); // php 4.0.0 으로 내려 오면서 바뀐것
$tpl = new Template("./template");
$tpl -> define (
	array(
		all => "list.tpl",
	)
);


//
// 리스트 모듈 실행!!!
//
Main();




/*------------------------------------------------------------
	# 리스트 모듈용 함수 모음
*/
//
// 메인함수
//
function Main() // void
{
	global $HTTP_GET_VARS, $tpl, $config;

	/* 해당 게시판의 인덱스 뽑아오기 */
	$idx = get_idx();

	/* 뽑아온 인덱스 정보를 가지고 페이지 정보를 생성한다 */
	$info = get_info($idx);

	/* 게시물, 페이지 정보, 타이틀등... */
	if($HTTP_GET_VARS[mode] == "srch") {
		$tpl_str_info = "전체 ".$info[total_article]."개의 게시물이 검색되었습니다 - 현재 ".$info[current_page]."/".$info[total_page]."페이지";
	} else {
		$tpl_str_info = "전체 ".$info[total_article]."개의 게시물이있습니다.  - 현재 ".$info[current_page]."/".$info[total_page]."페이지";
	}

	/* 페이지 분할 */
	$page_nav = get_page_nav($info);

	/* 템플릿 적용 */
	if($HTTP_GET_VARS[p] != "list") {
		$board_title = "";
	}
	$write = "<a href=\"./?p=new&code=$HTTP_GET_VARS[code]\">[새글]</a>";
	$tpl -> assign(
		array(
			INFO => $tpl_str_info,
			CODE => $HTTP_GET_VARS[code],
			PAGE_NAV => $page_nav,
			BOARD_TITLE => "jboard : 게시물관리($HTTP_GET_VARS[code])",
			WRITE => $write,
		)
	);

	/* 게시판별 공지사항 출력 */
	if($HTTP_GET_VARS[page] == 1) prt_gonggi();

	/* 현제 페이지에서 $config[9]만큼 리스팅 출력 */
	prt_list($info, $idx);

	/* 템플릿 assign 및 출력 */
	$tpl -> parse(ALL, "all");
	$tpl -> FastPrint();
}


//
// 공지사항 출력 
//
function prt_gonggi()
{
	global $HTTP_GET_VARS, $tpl, $config, $db_file;
	$dbm = dbm_open($db_file[data], "r");
	if(dbmexists($dbm, "G_num")) {
		$G_num = dbm_fetch($dbm, "G_num");
		for($i = $G_num ; $i >= 0 ; $i--) {
			$unique = "G_".$i;
			if(dbmexists($dbm, $unique)) {
				$data = explode("|", dbm_fetch($dbm, $unique));
				$subject = detail_link($data);
				$name = email_link($data);
				$reg_date = explode(" ", $data[9]);
				$tpl -> assign(
					array(
						HIT => $data[10],
						DATE => $reg_date[0],
						NUMBER => "†",
						SUBJECT => "<B>$subject</B>",
						NAME => $name,
						NOTICE => "[N]",
					)
				);
				$tpl -> parse(GONGGI, ".gonggi");
			}
		}
	}
}


//
// 리스트 출력
//
function prt_list($info, $idx) // void
{
	global $HTTP_GET_VARS, $tpl, $config, $db_file;

	$dbm = dbm_open($db_file[data], "r");

	for($i = $info[s_point] ; $i < $info[e_point] ; $i++) {
		$article = $idx[$i];
		$data = explode("|", dbm_fetch($dbm, $article));
		for($j = 0 ; $j < count($data) ; $j++) {
			$data[$j] = str_replace("rhkdvk", "|", $data[$j]);
		}
		$tpl_subject = detail_link($data);
		$tpl_name = email_link($data);
		$reg_date = explode(" ", $data[9]);
		if($HTTP_GET_VARS[id] == $data[0]) {
			$number = "☞";
		} else {
			$number = $data[1];
		}
		if($HTTP_GET_VARS[p] == "detail") $G_mode = "sublist";
		$attache = get_attache($data[12], $G_mode);
		$tpl -> assign(
			array(
				NUMBER => $number,
				SUBJECT => $tpl_subject,
				NAME => $tpl_name,
				DATE => $reg_date[0],
				HIT => $data[10],
				ATTACHE => $attache,
				ID => $data[0],
			)
		);
		$tpl -> parse(CONTENTS, ".contents");
	}

	dbm_close($dbm);
}


//
// 이메일링크 생성
//
function email_link($data) // string
{
	$GwangPa = new StringSize();
	$data[3] = $GwangPa -> cut($data[3], 75);

	if($data[5]) {
		$value = "<a href=\"mailto:$data[5]\">$data[3]</a>";
	} else {
		$value = $data[3];
	}

	return $value;
}


//
// 상세보기 링크 생성
//
function detail_link($data) // string
{
	global $HTTP_GET_VARS;

	if($data[11] >= 1) {
		$temp = "";
		$gp = "";
		for($a = 0 ; $a < $data[11] ; $a++) {
			$blank .= "&nbsp;&nbsp;";
			$gp .= "1";
		}
		$gpp = $gp."-Re: ".$data[2];
		$GwangPa = new StringSize();
		$temp2 = $GwangPa -> cut($gpp, 275);
		$temp2 = explode("-", $temp2);
		$str = $temp2[1];
	} else {
		$GwangPa = new StringSize();
		$temp = $GwangPa -> cut($data[2], 275);
		$str = $temp;
	}
	if($HTTP_GET_VARS[what] || $HTTP_GET_VARS[request]) {
		$val = $blank."<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$data[0]&page=$HTTP_GET_VARS[page]&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">$str</a>";
	} else {
		$val = $blank."<a href=\"./?p=detail&code=$HTTP_GET_VARS[code]&id=$data[0]&page=$HTTP_GET_VARS[page]\">$str</a>";
	}

	return $val;
}


//
// 페이지 정보
//
function get_info($idx) // array
{
	global $HTTP_GET_VARS, $config;

	$info[total_article] = count($idx);
	$info[total_page] = ceil($info[total_article] / $config[9]);
	if($info[total_page] <= 0) $info[total_page] = 1;
	$info[s_point] = ($HTTP_GET_VARS[page] - 1) * $config[9];
	$info[e_point] = $HTTP_GET_VARS[page] * $config[9];
	if($info[e_point] > $info[total_article]) $info[e_point] = $info[total_article];
	$info[current_page] = $HTTP_GET_VARS[page];

	return $info;
}


//
// 페이지 분할
//
function get_page_nav($info) // string
{
	global $HTTP_GET_VARS, $config;

	// Get Total Article
	$total = $info[total_article];

	// Setting Variable
	$page_last = $info[total_page];
	$page_prev = $info[current_page] - 1;
	if($page_prev < 1) { $page_prev = 1; }

	$page_next = $info[current_page] + 1;
	if($page_next > $page_last) { $page_next = $page_last; }

	$page_min_center = ceil($config[10] / 2);
	$page_term = $page_min_center - 1;
	$page_max_center = $page_last - $page_min_center;
	
	// First,Previous Page Link
	if($info[current_page] != 1) {
		if($HTTP_GET_VARS[mode] == "srch") {
			$plink[first]  = "<a href=\"./?p=list&page=1&code=$HTTP_GET_VARS[code]&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">[맨처음]</a>";
		} else {
			$plink[first]  = "<a href=\"./?p=list&page=1&code=$HTTP_GET_VARS[code]\">[맨처음]</a>";
		}

		if($HTTP_GET_VARS[mode] == "srch") {
			$plink[prev]  = "<a href=\"./?p=list&page=$page_prev&code=$HTTP_GET_VARS[code]&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">[이전]</a>";
		} else {
			$plink[prev]  = "<a href=\"./?p=list&page=$page_prev&code=$HTTP_GET_VARS[code]\">[이전]</a>";
		}
	} else {
		$plink[first] = "[맨처음]";
		$plink[prev] = "[이전]";
	}
	
	// Last,Next Page Link
	if($info[current_page] != $page_last) {
		if($HTTP_GET_VARS[mode] == "srch") {
			$plink[last]  = "<a href=\"./?p=list&page=$page_last&code=$HTTP_GET_VARS[code]&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">[마지막]</a>";
		} else {
			$plink[last]  = "<a href=\"./?p=list&page=$page_last&code=$HTTP_GET_VARS[code]\">[마지막]</a>";
		}

		if($HTTP_GET_VARS[mode] == "srch") {
			$plink[next]  = "<a href=\"./?p=list&page=$page_next&code=$HTTP_GET_VARS[code]&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">[다음]</a>";
		} else {
			$plink[next]  = "<a href=\"./?p=list&page=$page_next&code=$HTTP_GET_VARS[code]\">[다음]</a>";
		}
	} else {
		$plink[last] = "[마지막]";
		$plink[next] = "[다음]";
	}
	
	// Page Link(About $pp)
	$p = "";
	if($page_last <= $config[10]) {
		$page_start = 1;
		$page_end = $page_last;
	} else {
		if($info[current_page] <= $page_min_center) {
			$page_start = 1;
			$page_end = $config[10];
		} elseif($info[current_page] > $page_max_center) {
			$page_start = $page_last - $config[10] + 1;
			$page_end = $page_last;
		} else {
			$page_start = $info[current_page] - $page_term;
			$page_end = $info[current_page] + $page_term;
		}
	}

	for($i = $page_start ; $i <= $page_end ; $i++) {
		if($i == $info[current_page]) {
			$p .= " $i ";
		} else {
			if($HTTP_GET_VARS[mode] == "srch") {
				$p .= " <a href=\"./?p=list&page=$i&code=$HTTP_GET_VARS[code]&mode=srch&what=$HTTP_GET_VARS[what]&request=$HTTP_GET_VARS[request]\">[$i]</a>";
			} else {
				$p .= " <a href=\"./?p=list&page=$i&code=$HTTP_GET_VARS[code]\">[$i]</a>";
			}
		}
	}

	if($HTTP_GET_VARS[what] || $HTTP_GET_VARS[request]) {
		$plink[all]  = "<a href=\"./?p=list&code=$HTTP_GET_VARS[code]\">[전체글목록]<a>";
	}

	$page_nav  = "$plink[first] $plink[prev]$p $plink[next] $plink[last] $plink[all]";

    return $page_nav;
}


//
// 문자열 자르기
//
class StringSize
{
    /* 페이지 기본 폰트 : 굴림체, 9pt */
    var $SPECIAL = 6;   /* ASCII 문자중 특수문자(ASCII 코드 1~32) */
    var $MCHAR = 12;    /* 한글 문자 */
    var $BASE = 32;     /* ASCII 코드 하한값 */
    var $END =  127;    /* ASCII 코드 상한값 */
    var $ASCII = Array(
            4,4,4,6,6,10,8,4,5,5,6,6,4,6,4,6,6,6,6,6,6,6,6,6,6,6,
            4,4,8,6,8,6,12,8,8,9,8,8,7,9,8,3,6,8,7,11,9,9,8,9,8,8,
            8,8,8,10,8,8,8,6,11,6,6,6,4,7,7,7,7,7,3,7,7,3,3,6,3,11,
            7,7,7,7,4,7,3,7,6,10,7,7,7,6,6,6,9,6
    );
    function cut($str,$width){
        $str = strip_tags($str);
        $str = preg_replace("/ {2,}/"," ",$str);
        $str = preg_replace("/^ | $/","",$str);
        $len = strlen($str);
        if ($width < $len * $this->MCHAR){
            for($i=0;$i<$len;$i=$i+$charLen){
                $code = ord($str[$i]);
                if ($code <= $this->END){
                    $charSize   = $this->getAscSize($code);
                    $charLen    = 1;
                }
                else{
                    $charSize   = $this->MCHAR;
                    $charLen    = 2;
                }
                if ($charSize < $width) $width -= $charSize;
                else            break;
            }
            return substr($str,0,$i);
        }
        return $str;
    }
    function getAscSize($code){
        if ($code < $this->BASE)    return $this->SPECIAL;
        else{
            $idx = $code - $this->BASE;
            return $this->ASCII[$idx];
        }
    }
}
?>