<?
# 문자열을 일정한 길이로 자르는 함수
#
# 한글을 한바이트 단위로 잘르는 경우를 막고 대문자가 많이 쓰인 경우
# 소문자와의 크기 비율 정도(1.5?)에 따라 문자열을 자름
#
# intval - 변수의 정수형 값을 가져옴
#          http://www.php.net/manual/function.intval.php
# substr - 문자열의 지정된 범위를 잘라서 가져옴
#          http://www.php.net/manual/function.substr.php
# chop   - 문자열 끝의 공백 문자을 없앰
#          http://www.php.net/manual/function.chop.php
function cut_string_lib(&$s,$l) {
  if(strlen($s) <= $l && !eregi("^[a-z]+$",$s)) return $s;

  for($i=$l;$i>=1;$i--) {
      # 끝에서부터 한글 byte수를 센다.
      if(is_hangul_lib($s[$i-1])) $hangul++;
      else break;
  }

  if ($hangul) {
      # byte수가 홀수이면, 한글의 첫번째 바이트이다.
      # 한글의 첫번째 바이트일 때 깨지는 것을 막기 위해 지정된 길이를 한
      # 바이트 줄임
      if ($hangul%2) $l--;

      $s = chop(substr($s,0,$l));
  }
  else { # 문자열의 끝이 한글이 아닐 경우
      for($i=1;$i<=$l;$i++) {
          # 대문자의 갯수를 기록
          if(is_alpha_lib($s[$i-1])==2) $alpha++;
          # 마지막 한글이 나타난 위치 기록
          if(is_hangul_lib($s[$i-1])) $last_han=$i;
      }

      # 지정된 길이로 문자열을 자르고 문자열 끝의 공백 문자를 삭제함
      # 대문자의 길이는 1.3으로 계산한다. 문자열 마지막의 영문 문자열이
      # 빼야할 전체 길이보다 크면 초과된 만큼 뺀다.
      $capitals = intval($alpha * 0.5);
      if (($l-$last_han)<=$capitals) $capitals=0;
      $s = chop(substr($s,0,$l-$capitals));
  }

  return $s;
}

# 문서 내용에 있는 URL들을 찾아내어 자동으로 링크를 구성해주는 함수
#
# preg_replace - 정규 표현식을 이용한 치환 (대소문자 무시)
#                http://www.php.net/manual/function.preg-replace.php
function auto_link_lib(&$str) {
	// URL 치환
	$str = "###! ".$str;
	$homepage_pattern = "/([^\"\'\=\>])(mms|http|HTTP|ftp|FTP|telnet|TELNET)\:\/\/(.[^ \n\<\"\']+)/";
	$str = preg_replace($homepage_pattern,"\\1<a href=\\2://\\3 target=_blank>\\2://\\3</a>", $str);

	// 메일 치환
	$email_pattern = "/([ \n]+)([a-z0-9\_\-\.]+)@([a-z0-9\_\-\.]+)/";
	$str = preg_replace($email_pattern,"\\1<a href=mailto:\\2@\\3>\\2@\\3</a>", $str);
	$str = ereg_replace("###! ","", $str);
	return $str;
}

# HTML entry를 특수 특수 문자로 변환
# (htmlspecialchars 함수의 역함수)
#
# get_html_translation_table - htmlspecialchars()와 htmlentities() 함수에서
#                              사용하는 변환 테이블을 배열로 반환
# array_flip                 - 배열 값들의 순서를 반대로
#
function unhtmlspecialchars_lib(&$t) {
  $tr = array_flip(get_html_translation_table(HTML_SPECIALCHARS));
  $t = strtr(str_replace("&#039;","'",$t),$tr);
  $t = strtr(str_replace("&amp;","&",$t),$tr);

  return $t;
}
?>
