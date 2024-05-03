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
  $agent = get_agent_lib();

  $regex[file] = "gz|tgz|tar|gzip|zip|rar|mpeg|mpg|exe|rpm|dep|rm|ram|asf|ace|viv|avi|mid|gif|jpg|png|bmp|eps|mov";
  $regex[file] = "(\.($regex[file])\") TARGET=\"_blank\"";
  $regex[http] = "(http|https|ftp|telnet|news|mms):\/\/(([\xA1-\xFEa-z0-9:_\-]+\.[\xA1-\xFEa-z0-9:;&#=_~%\[\]\?\/\.\,\+\-]+)([\.]*[\/a-z0-9\[\]]|=[\xA1-\xFE]+))";
  $regex[mail] = "([\xA1-\xFEa-z0-9_\.\-]+)@([\xA1-\xFEa-z0-9_\-]+\.[\xA1-\xFEa-z0-9\-\._\-]+[\.]*[a-z0-9]\??[\xA1-\xFEa-z0-9=]*)";

  # &lt; 로 시작해서 3줄뒤에 &gt; 가 나올 경우와
  # IMG tag 와 A tag 의 경우 링크가 여러줄에 걸쳐 이루어져 있을 경우
  # 이를 한줄로 합침 (합치면서 부가 옵션들은 모두 삭제함)
  $src[] = "/<([^<>\n]*)\n([^<>\n]+)\n([^<>\n]*)>/i";
  $tar[] = "<\\1\\2\\3>";
  $src[] = "/<([^<>\n]*)\n([^\n<>]*)>/i";
  $tar[] = "<\\1\\2>";
  $src[] = "/<(A|IMG)[^>]*(HREF|SRC)[^=]*=[ '\"\n]*($regex[http]|mailto:$regex[mail])[^>]*>/i";
  $tar[] = "<\\1 \\2=\"\\3\">";

  # email 형식이나 URL 에 포함될 경우 URL 보호를 위해 @ 을 치환
  $src[] = "/(http|https|ftp|telnet|news|mms):\/\/([^ \n@]+)@/i";
  $tar[] = "\\1://\\2_HTTPAT_\\3";

  # 특수 문자를 치환 및 html사용시 link 보호
  $src[] = "/&(quot|gt|lt)/i";
  $tar[] = "!\\1";
  $src[] = "/<a([^>]*)href=[\"' ]*($regex[http])[\"']*[^>]*>/i";
  $tar[] = "<A\\1HREF=\"\\3_orig://\\4\" TARGET=\"_blank\">";
  $src[] = "/href=[\"' ]*mailto:($regex[mail])[\"']*>/i";
  $tar[] = "HREF=\"mailto:\\2#-#\\3\">";
  $src[] = "/<([^>]*)(background|codebase|src)[ \n]*=[\n\"' ]*($regex[http])[\"']*/i";
  $tar[] = "<\\1\\2=\"\\4_orig://\\5\"";

  # 링크가 안된 url및 email address 자동링크
  $src[] = "/((SRC|HREF|BASE|GROUND)[ ]*=[ ]*|[^=]|^)($regex[http])/i";
  $tar[] = "\\1<A HREF=\"\\3\" TARGET=\"_blank\">\\3</a>";
  $src[] = "/($regex[mail])/i";
  $tar[] = "<A HREF=\"mailto:\\1\">\\1</a>";
  $src[] = "/<A HREF=[^>]+>(<A HREF=[^>]+>)/i";
  $tar[] = "\\1";
  $src[] = "/<\/A><\/A>/i";
  $tar[] = "</A>";

  # 보호를 위해 치환한 것들을 복구
  $src[] = "/!(quot|gt|lt)/i";
  $tar[] = "&\\1";
  $src[] = "/(http|https|ftp|telnet|news|mms)_orig/i";
  $tar[] = "\\1";
  $src[] = "'#-#'";
  $tar[] = "@";
  $src[] = "/$regex[file]/i";
  $tar[] = "\\1";

  # email 주소를 변형한 뒤 URL 속의 @ 을 복구
  $src[] = "/_HTTPAT_/";
  $tar[] = "@";

  # 이미지에 보더값 0 을 삽입
  $src[] = "/<(IMG SRC=\"[^\"]+\")>/i";
  $tar[] = "<\\1 BORDER=0>";

  # IE 가 아닌 경우 embed tag 를 삭제함
  if($agent[br] != "MSIE") {
    $src[] = "/<embed/i";
    $tar[] = "&lt;embed";
  }

  $str = preg_replace($src,$tar,$str);
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
