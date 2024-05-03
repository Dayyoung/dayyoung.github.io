<?
# 웹 서버 접속자의 IP 주소 혹은 도메인명을 가져오는 함수
# license : OOPS_License (http://www.oops.org/OOPS_License)
# HTTP_X_FORWARDED_FOR - proxy server가 설정하는 환경 변수
# getenv        - 환경 변수값을 가져옴
#                 http://www.php.net/manual/function.getenv.php
# gethostbyaddr - IP 주소와 일치하는 호스트명을 가져옴
#                 http://www.php.net/manual/function.gethostbyaddr.php
function get_hostname_lib($reverse = 0,$addr = 0) {
  if(!$addr) {
    # proxy 를 통해서 들어올때 proxy 에서 제공하는 원 ip address 의 환경
    # 변수를 제공할때 원 ip address 를 받음
    $proxytype = array("HTTP_VIA","HTTP_X_COMING_FROM","HTTP_X_FORWARDED_FOR",
                       "HTTP_X_FORWARDED","HTTP_COMING_FROM","HTTP_FORWARDED_FOR",
                       "HTTP_FORWARDED");

    for($i=0;$i<sizeof($proxytype);$i++) {
      if($GLOBALS[$proxytype[$i]]) {
        $host = $GLOBALS[$proxytype[$i]];
        break;
      }
    }

    # proxy를 통하지 않고 접근 할때 아파치 환경 변수인
    # REMOTE_ADDR에서 접속자의 IP를 가져옴
    $host = $host ? $host : $GLOBALS[REMOTE_ADDR];
  } else $host = $addr;

  $check = $reverse ? @gethostbyaddr($host) : "";
  $host = $check ? $check : $host;

  return $host;
}

# 접속한 사람이 사용하는 브라우져를 알기 위해 사용되는 함수, 현재는 FORM
# 입력창의 크기가 브라우져마다 틀리게 설정되는 것을 보정하기 위해 사용됨
#
# getenv - 환경 변수값을 가져옴
#          http://www.php.net/manual/function.getenv.php
function get_agent_lib() {
  $agent_env = $GLOBALS[HTTP_USER_AGENT];

  # $agent 배열 정보 [br] 브라우져 종류
  #                  [os] 운영체제
  #                  [ln] 언어 (넷스케이프)
  #                  [vr] 브라우져 버젼
  #                  [co] 예외 정보
  if(ereg("MSIE", $agent_env)) {
    $agent[br] = "MSIE";
    # OS 별 구분
    if(ereg("NT", $agent_env)) $agent[os] = "NT";
    else if(ereg("Win", $agent_env)) $agent[os] = "WIN";
    else $agent[os] = "OTHER";
    # version 정보
    $agent[vr] = trim(eregi_replace("Mo.+MSIE ([^;]+);.+","\\1",$agent_env));
    $agent[vr] = eregi_replace("[a-z]","",$agent[vr]);
  } else if(eregi("Gecko|Galeon",$agent_env) && !eregi("Netscape",$agent_env)) {
    $agent[br] = "MOZL";
    # client OS 구분
    if(ereg("NT", $agent_env)) $agent[os] = "NT";
    else if(ereg("Win", $agent_env)) $agent[os] = "WIN";
    else if(ereg("Linux", $agent_env)) $agent[os] = "LINUX";
    else $agent[os] = "OTHER";
    # version 정보
    $agent[vr] = eregi_replace("Mozi[^(]+\([^;]+;[^;]+;[^;]+;[^;]+;([^)]+)\).*","\\1",$agent_env);
    $agent[vr] = str_replace("rv:","",$agent[vr]);
    # NS 와의 공통 정보
    $agent[co] = "mozilla";
  } else if(ereg("Konqueror",$agent_env)) {
    $agent[br] = "KONQ";
  } else if(ereg("Lynx", $agent_env)) {
    $agent[br] = "LYNX";
  } else if(ereg("^Mozilla", $agent_env)) {
    $agent[br] = "NS";
    # client OS 구분
    if(ereg("NT", $agent_env)) {
      $agent[os] = "NT";
      if(ereg("\[ko\]", $agent_env)) $agent[ln] = "KO";
    } else if(ereg("Win", $agent_env)) {
      $agent[os] = "WIN";
      if(ereg("\[ko\]", $agent_env)) $agent[ln] = "KO";
    } else if(ereg("Linux", $agent_env)) {
      $agent[os] = "LINUX";
      if(ereg("\[ko\]", $agent_env)) $agent[ln] = "KO";
    } else $agent[os] = "OTHER";
    # version 정보
    if(eregi("Gecko",$agent_env)) $agent[vr] = "6";
    else $agent[vr] = "4";
    # Mozilla 와의 공통 정보
    $agent[co] = "mozilla";
  } else $agent[br] = "OTHER";

  return $agent;
}

# PHP의 microtime 함수로 얻어지는 값을 비교하여 경과 시간을 가져오는 함수
#
# explode - 구분 문자열을 기준으로 문자열을 나눔
#           http://www.php.net/manual/function.explode.php
function get_microtime_lib($old, $new) {
  # 주어진 문자열을 나눔 (sec, msec으로 나누어짐)
  $old = explode(" ", $old);
  $new = explode(" ", $new);

  $time[msec] = $new[0] - $old[0];
  $time[sec]  = $new[1] - $old[1];

  if($time[msec] < 0) {
    $time[msec] = 1.0 + $time[msec];
    $time[sec]--;
  }

  $time = sprintf("%.2f", $time[sec] + $time[msec]);

  return $time;
}

# 파일 크기 출력 함수 by 김칠봉 <san2@linuxchannel.net>
# $bfsize 변수는 bytes 단위의 크기임
#
# number_formant() - 3자리를 기준으로 컴마를 사용
function human_fsize_lib($bfsize, $sub = "0") {
  $bfsize_Bytes = number_format($bfsize);

  if ($bfsize >= 1024 && $bfsize < 1048576) { # KBytes 범위
    $bfsize_KB = round($bfsize/1024);
    $bfsize_KB = number_format($bfsize_KB);

    if ($sub) $bfsize = "$bfsize_KB KB($bfsize_Bytes Bytes)";
    else $bfsize = "$bfsize_KB Kb";

  } elseif ($bfsize >= 1048576) { # MB 범위
    $bfsize_MB = round($bfsize/1048576);
    $bfsize_MB = number_format($bfsize_MB);

    if ($sub) $bfsize = "$bfsize_MB MB($bfsize_Bytes Bytes)";
    else $bfsize = "$bfsize_MB Mb";

  } else
    $bfsize = "$bfsize_Bytes Bytes";

  return $bfsize;
}

# http socket 으로 연결을 하여 html source 를 가져오는 함수
# 비고 : HTTP/1.1 지원 가능
#
# $url -> 해당 서버의 주소 (http:// 는 생략)
# $size -> 해당 문서의 size
# $file -> 행당 문서의 URI
# $type -> socket(0) 방식 또는 fopen(1)
# $arr -> 해당 변수를 한줄씩 변수로 받을지(1) 변수 하나에 다 받을지(0) 결정
function get_html_src_lib($url,$size=5000,$file="",$type="",$arr="") {
  if(!$type) {
    $p = @fsockopen($url,80,&$errno,&$errstr);
    if($p) fputs($p,"GET /$file HTTP/1.1\r\nhost: $url\r\n\r\n");
  } else $p = @fopen("http://$url/$file","rb");

  if($p) {
    $f = fread($p,$size);
    fclose($p);
  }

  if($arr) {
    $s = explode("\n",$f);
    return $s;
  } else return $f;
}

# file 의 확장자를 검사하여 file type 을 구함
# substr - 문자열의 일부분을 반환한다.
# strchr - 문자열이 마지막으로 나타나는 위치를 구한다
#
function get_filetype_lib($filetype) {
  $tail = substr(strrchr($filetype,"."),1);
  $tail = strtolower($tail);
  return $tail;
}

# file 내용을 변수로 받는 함수
#
function get_file_lib($filename,$size=0) {
  $fp = fopen($filename,"r");
  $size = trim($size) ? $size : filesize($filename);
  $getfile = fread($fp,$size);
  fclose($fp);

  return $getfile;
}

# 파일을 변수로 받고 쓰는 함수
# p -> 파일 경로
# m -> 파일 작동 모드(r-읽기,w-쓰기,a-파일끝부터 쓰기)
# msg -> 실패시 에러 메세지
# s -> 쓰기모드에서는 쓸내용
# t -> 읽기모드에서 사이즈 만큼 받을 것인지 아니면 배열로 파일
#      전체를 받을 것인지 결정
#
function file_operate_lib($p,$m,$msg='',$s='',$t=0) {
  if($m == "r" || $m == "w" || $m == "a") {
    $m .= "b";

    # file point 를 open
    if(!$t && $f=@fopen($p,$m)) {
      if(check_windows()) {
        $src = array("/\n/i","/\r*\n/i");
        $tar = array("\r\n","\r\n");
      } else {
        $src = array("//i","/\r\n/i");
        $tar = array("","\n");
      }
      $s = preg_replace($src,$tar,$s);
      if($m != "rb") @fwrite($f,$s);
      else $var = fread($f,filesize($p));
      @fclose($f);
    }
    elseif ($t && $m == "rb" && @file_exists($p)) $var = file($p);
    else { if(trim($msg)) print_error_lib($msg,250,150,1); }
  }

  if($m == "rb") return $var;
}

# 디렉토리의 파일 리스트를 받는 함수
# path  -> 파일리스트를 구할 디렉토리 경로
# t     -> 리스트를 받을 목록
#          f  : 지정한 디렉토리의 파일만 받음
#          d  : 지정한 디렉토리의 디렉토리만 받음
#          l  : 지정한 디렉토리의 링크만 받음
#          fd : 지정한 디렉토리의 파일과 디렉토리만 받음
#          fl : 지정한 디렉토리의 파일과 링크만 받음
#          dl : 지정한 디렉토리의 디렉토리와 링크만 받음
#          아무것도 지정하지 않았을 경우에는 fdl 모두 받음
# regex -> 표현식을 사용할 수 있으며, regex 를 정의하면 t 는
#          e 로 정의되어짐.
#
function get_filelist_lib($path='./',$t='',$regex='') {
  $t = $regex ? "e" : $t;
  if(is_dir($path)) {
    $p = opendir($path);
    while($i = readdir($p)) {
      switch($t) {
        case 'e'  :
          if($i != "." && $i != ".." && eregi("$regex",$i)) $file[] = $i;
          break;
        case 'f'  :
          if(is_file("$path/$i") && !is_link("$path/$i")) $file[] = $i;
          break;
        case 'd'  :
          if($i != "." && $i != ".." && is_dir("$path/$i")) $file[] = $i;
          break;
        case 'l'  :
          if(is_link("$path/$i")) $file[] = $i;
          break;
        case 'fd' :
          if($i != "." && $i != ".." && (is_dir("$path/$i") || is_file("$path/$i") && !is_link("$path/$i"))) $file[] = $i;
          break;
        case 'fl' :
          if(is_file("$path/$i")) $file[] = $i;
          break;
        case 'dl' :
          if($i != "." && $i != ".." && (is_dir("$path/$i") || is_link("$path/$i"))) $file[] = $i;
          break;
        default   :
          if($i != "." && $i != "..") $file[] = $i;
      }
    }
    closedir($p);
  } else {
    print_error_lib("$path is not directory");
    return 0;
  }

  return $file;
}
?>
