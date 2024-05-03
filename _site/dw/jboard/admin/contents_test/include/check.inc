<?
function check_language_lib($s,$ln='') {
  if($ln == "ko") {
    $ctable  = "TABLE 태그를 잘못 사용하였습니다.";
    $checktb = "TABLE 태그가 열리지 않았거나 닫히지 않았습니다.";
    $checkth = "TH 태그가 열리지 않았거나 닫히지 않았습니다.";
    $checktr = "TR 태그가 열리지 않았거나 닫히지 않았습니다.";
    $checktd = "TD 태그가 열리지 않았거나 닫히지 않았습니다.";
  } else {
    $ctable  = "Wrong usage of TABEL tag";
    $checktb = "Don't match number of open or close table tag";
    $checkth = "Don't open or close TH tag.";
    $checktr = "Don't open or close TR tag.";
    $checktd = "Don't open or close TD tag.";
  }

  return ${$s};
}

# 경로명이나 번수명에 보안에 취약한 meta character 이 있는지 체크
#
function check_meta_char_lib($s,$msg='can\'t use meta character') {
  if(eregi("[^\xA1-\xFEa-z0-9\._\-]|\.\.",trim($s))) {
    print_error_lib($msg);
    exit;
  }
}

# 문자열에 한글이 포함되어 있는지 검사하는 함수
#
# ord    - 문자의 ASCII 값을 가져옴
#          http://www.php.net/manual/function.ord.php
function is_hangul_lib($char) {
  # 특정 문자가 한글의 범위내(0xA1A1 - 0xFEFE)에 있는지 검사
  $char = ord($char);

  if($char >= 0xa1 && $char <= 0xfe)
    return 1;
}

# 알파벳인지 그리고 대문자(0x41 - 0x5a)인지 소문자(0x61 - 0x7a)인지
# 검사하는 함수
#
# ord - 문자의 ASCII 값을 가져옴
#       http://www.php.net/manual/function.ord.php
function is_alpha_lib($char) {
  $char = ord($char);

  if($char >= 0x61 && $char <= 0x7a)
    return 1; # 소문자를 의미
  if($char >= 0x41 && $char <= 0x5a)
    return 2; # 대문자를 의미
}

# URL이 정확한 것인지 검사하는 함수
#
# eregi         - 정규 표현식을 이용한 검사 (대소문자 무시)
#                 http://www.php.net/manual/function.eregi.php
# eregi_replace - 정규 표현식을 이용한 치환 (대소문자 무시)
#                 http://www.php.net/manual/function.eregi-replace.php
function check_url_lib($url) {
  $url = trim($url);

  # 프로토콜(http://, ftp://...)을 나타내는 부분이 없을 때 기본값으로
  # http://를 붙임
  if(!eregi("^(http://|https://|ftp://|telnet://|news://)", $url))
    $url = eregi_replace("^", "http://", $url);

  if(!eregi("(http|https|ftp|telnet|news):\/\/[\xA1-\xFEa-z0-9-]+\.[][\xA1-\xFEa-zA-Z0-9:&#@=_~%\?\/\.\+-]+$", $url))
    return;

  return $url;
}

# E-MAIL 주소가 정확한 것인지 검사하는 함수
#
# eregi - 정규 표현식을 이용한 검사 (대소문자 무시)
#         http://www.php.net/manual/function.eregi.php
function check_email_lib($email) {
  $url = trim($email);
  if(!eregi("^[\xA1-\xFEa-z0-9\._-]+@[\xA1-\xFEa-z0-9_-]+\.[a-z0-9\._-]+$", $url))
    return;

  return $email;
}

# IIS(isapi) 인지 아닌지 판단 함수
function check_iis_lib() {
  if(php_sapi_name() == "isapi") return 1;
  else return 0;
}

# 윈도우용 php 인지 아닌지를 판단.
# 윈도우용 php 일 경우 turn 를 반환
function check_windows_lib() {
  if(eregi("Windows",php_uname())) return 1;
  else return 0;
}

# TABLE 을 정확하게 사용했는지 체크하는 함수
# str  -> 체크할 문자열
# lang -> 에러메세지 언어 결정 (ko,en)
# rep  -> 1 일 경우 에러메시지 대신 결과를 echo 함
# repv -> rep 가 1 일 경우 바로 출력 할 것인지 아니면 변수로
#         받을 것인지를 결정. repv 가 1 이면 변수로 받음
#
function check_htmltable_lib(&$str,$lang,$rep='',$repv='') {
  # table tag 들만 나두고 모두 삭제
  $s[] = "/>[^<]*</i";
  $s[] = "/#|@/i";
  $s[] = "/<(\/?(TABLE|TR|TD|TH))[^>]*>/i";
  $s[] = "/^[^#]*/i";
  $s[] = "/(TABLEEMARK@)[^#]*(#TABLESMARK)/i";
  $s[] = "/<[^>]*>/i";
  $s[] = "/#TABLESMARK#/i";
  $s[] = "/@TABLEEMARK@/i";
  $s[] = "/(\r?\n)+/i";

  $d[] = ">\n<";
  $d[] = "";
  $d[] = "\n#TABLESMARK#\\1@TABLEEMARK@\n";
  $d[] = "";
  $d[] = "\\1\\2";
  $d[] = "";
  $d[] = "\n<";
  $d[] = ">\n";
  $d[] = "\n";

  $str = trim(preg_replace($s,$d,$str));

  # table tag 들만 남은 것을 \n 을 기준으로 배열로 받음
  $ary = explode("\n",$str);

  for($i=0;$i<sizeof($ary);$i++) {
    if(strtoupper($ary[$i]) == "<TABLE>") $opentable++;
    elseif(strtoupper($ary[$i]) == "</TABLE>") $clstable++;
    elseif(strtoupper($ary[$i]) == "<TH>") $openth++;
    elseif(strtoupper($ary[$i]) == "</TH>") $clsth++;
    elseif(strtoupper($ary[$i]) == "<TR>") $opentr++;
    elseif(strtoupper($ary[$i]) == "</TR>") $clstr++;
    elseif(strtoupper($ary[$i]) == "<TD>") $opentd++;
    elseif(strtoupper($ary[$i]) == "</TD>") $clstd++;
  }

  if(!$rep) {
    if($opentable != $clstable) $msg = check_language_lib("checktb",$lang)."\n";
    if($openth != $clsth) $msg .= check_language_lib("checkth",$lang)."\n";
    if($opentr != $clstr) $msg .= check_language_lib("checktr",$lang)."\n";
    if($opentd != $clstd) $msg .= check_language_lib("checktd",$lang)."\n";

    $msg = $msg ? check_language_lib("ctable",$lang)."\n\nError Check:\n".trim($msg)."\n" : "";

    if($msg) print_error_lib($msg);
  } else {
    $msg = "\n##  TABLE CHECK RESULT\n".
           "##  ----------------------------------------------------------------------\n".
           "##  OPEN  TABLE TAG : $opentable\n".
           "##  CLOSE TABLE TAG : $clstable\n##  \n".
  
           "##  OPEN  TH    TAG : $openth\n".
           "##  CLOSE TH    TAG : $clsth\n##  \n".
  
           "##  OPEN  TR    TAG : $opentr\n".
           "##  CLOSE TR    TAG : $clstr\n##  \n".
  
           "##  OPEN  TD    TAG : $opentd\n".
           "##  CLOSE TD    TAG : $clstd\n\n";

    if(!$repv) echo $msg;
    else return $msg;
  }
}

# PHP 의 버전을 체크하는 함수.
# version => 비교할 버전
# v       => 1 (현재 버젼이 version 보다 낮을 경우 참)
#            0 (현재 버젼이 version 보다 높을 경우 참)
#
function check_phpver_lib($version,$v=0) {
  $phpversion = phpversion();
  if(eregi("pl[0-9]",$version))
    $ver_pl = preg_replace("/[0-9\.]+pl([0-9]+).*/i","\\1",$version);
  $ver = explode(".",preg_replace("/([0-9\.]+)[^0-9\.].*/i","\\1",$version));

  if(eregi("pl[0-9]",$phpversion))
    $chk_pl = preg_replace("/[0-9\.]+pl([0-9]+).*/i","\\1",$phpversion);
  $chk = explode(".",preg_replace("/([0-9\.]+)[^0-9\.].*/i","\\1",$phpversion));

  if($v) {
    # 현재 버전이 비교할 버전보다 낮을 경우 참
    if($ver[0] > $chk[0]) return 1;
    elseif ($ver[0] == $chk[0]) {
      if($ver[1] > $chk[1]) return 1;
      elseif ($ver[1] == $chk[1]) {
        if($ver[2] > $chk[2]) return 1;
        elseif ($ver[2] == $chk[2]) {
          if($ver_pl > $chk_pl) return 1;
          else return 0;
        } else return 0;
      } else return 0;
    } else return 0;
  } else {
    # 현재 버전이 비교할 버젼보다 높을 경우 참
    if($ver[0] < $chk[0]) return 1;
    elseif ($ver[0] == $chk[0]) {
      if($ver[1] < $chk[1]) return 1;
      elseif ($ver[1] == $chk[1]) {
        if($ver[2] < $chk[2]) return 1;
        elseif ($ver[2] == $chk[2]) {
          if($ver_pl < $chk_pl) return 1;
          else return 0;
        } else return 0;
      } else return 0;
    } else return 0;
  }
}
?>