<?php
// GDBM 함수 사용 가능한가?
if(!function_exists('dbmopen')) {
	echo "<table width=\"100%\" cellpadding=\"\" border=\"0\" cellspacing=\"0\" height=\"100%\"><tr><td align=\"center\">GDBM사용이 불가능한 서버 입니다. 서버관리자에게 문의해 주세요!!</td></tr></table>";
	exit;
}
include ("./include/incinfo.inc");
if(file_exists("./login/admin.gdbm") || file_exists("./login/admin.gdbm.lck") || file_exists("./login/ban.gdbm") || file_exists("./login/ban.gdbm.lck") || file_exists("./login/login_session")) {
	$exists = 1;
	$step = 1;
}
if(!is_writeable("../data") || !is_writeable("./login") || !$step || $exists) {
	$step = 1;
}
?>
<html>
<head>
<title>jboard :: 설치하기</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td {  font-family: "돋움"; font-size: 9pt}
a:link,a:visited{text-decoration:none}
a:hover {text-decoration:underline}
INPUT,SELECT,TEXTAREA, CHECKBOX { border:1 solid #999999; background-color: #FFFFFF; color: #000000;}
-->
</style>
<script>
<!--
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" link="#333333" vlink="#333333" alink="#FF0033" topmargin="5" leftmargin="5" marginwidth="5" marginheight="5">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
<?php
if($step == 1) {
	if(!is_writeable("../data") || !is_writeable("./login") || !$step) {
		$perm_ok = "no";
	}
	echo "
<table width=\"520\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" height=\"215\" background=\"img/in1bg.gif\" align=\"center\">
  <tr>
    <td valign=\"top\" height=\"33\"><img src=\"img/in2.gif\" width=\"520\" height=\"43\"></td>
  </tr>
  <tr>
    <td height=\"100\"> 
      <p>&nbsp;</p>";
	if($exists == 1) {
		echo "
			&nbsp;<font color='red'>이미 설치된 게시판입니다!</font><BR><BR>
            &nbsp;재설치를 원하시면 <B>login</b> 디렉토리의<BR>&nbsp;<font color='blue'><b>admin.gdbm, admin.gdbm.lck, ban.gdbm, ban.gdbm.lck, login_session</b></font>을<BR>&nbsp;삭제 하시고 설치 과정을 진행해 주세요";
	} elseif($perm_ok == "no") {
		echo "
            &nbsp;<font color='red'>디렉토리 퍼미션이 맞지 않습니다!!</font><BR><BR>
            &nbsp;게시판 디렉토리의 <B>data</b> 디렉토리와 <b>admin/login</b> 디렉토리의 퍼미션을 <font color='blue'><b>777</b></font>로 맞춰 주세요";
	} else {
		echo "
            <p align=\"center\">
              <textarea name='lisence' style=\"width:450; height:150\">
jboard 사용 라이센스

프로그램명 : jboard
홈페이지 : http://www.jungbo.net
개발자 : 김대현, lightwave@jungbo.net

0. 개요 : 본 프로그램은 (주)정보넷이 제공하는 무료 게시판 프로그램입니다.

1. 배포 : 프로그램의 배포는 (주)정보넷(http://www.jungbo.net), (주)정보넷에서 허가한 곳에서만 재배포할 수 있으며,정보넷이 허가하지 않은 곳에서의 배포, 재배포는 불허합니다.

2. 사용제한 : (주)정보넷 고객을 포함한 모든 사용자가 개인, 상업적인 용도로 사용하실수 있습니다.단, 다음과 같은 용도로의 사용은 불허 합니다.
O 성인정보등의 정보를 제공하는 목적으로 사용되는 경우.
O 불법자료, 와레즈 정보를 제공하는 목적으로 사용되는경우.
O 링크 서비스를 위한 목적으로 사용되는 경우.
O 기타 미풍양속을 어기는 목적으로 사용되는 경우.

3. 데이터손실 훼손 : 프로그램사용으로 인한 데이터손실, 훼손 기타 손해등에 대해서는 (주)정보넷이 절대 책임을 지지 않습니다.

4. 유지보수 : (주)정보넷은 프로그램에 대한 유지, 보수를 하지 않습니다. 단, 웹호스팅 고객의 게시판 사용법등의 고객지원업무는 가능합니다.

5. 소스수정 : 개인적, 상업적으로 소스를 수정하여 사용할수 있습니다.(게시판 copyright 은 삭제 할수 없습니다) 수정된 프로그램으로 인한 데이터손실, 훼손 기타 손해는 (주)정보넷이 절대 책임을 지지 않습니다.수정된 프로그램의 재배포는 불허합니다.

6. 설치를 진행하는것은 라이센스에 동의 하는것으로 간주 합니다.</textarea><BR><BR>
              <input type='image' src='img/in1start.gif' onClick=\"this.document.location.href='$PHP_SELF?step=2'\" style=\"border:0\"></p>";
	}
	echo "
      <p>&nbsp;</p>
    </td>
  </tr>
  <tr>
    <td valign=\"bottom\"><img src=\"img/in3.gif\" width=\"520\" height=\"53\"></td>
  </tr>
</table>
</body>
</html>";
} elseif($step == 2) {
	$tmp = explode("/", $REQUEST_URI);
	for($i = 0 ; $i < count($tmp) ; $i++) {
		if($tmp[$i] != "admin") {
			if($i != 0) {
				$direc .= "/";
			}
			$direc .= "$tmp[$i]";
		} else {
			break;
		}
	}
	$url = "http://$HTTP_HOST$direc";
	echo "
<table width=\"520\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" height=\"215\" background=\"img/in1bg.gif\" align=\"center\">
<form method='post' action='$PHP_SELF?step=3' name='form'>
  <tr>
    <td valign=\"top\" height=\"33\"><img src=\"img/in4.gif\" width=\"520\" height=\"42\"></td>
  </tr>
  <tr>
    <td height=\"100\"> <br>
      <table width='399' cellpadding='2' cellspacing='0' border='0' bordercolordark='#FFFFFF' bordercolorlight='#000000' align='center' bgcolor=\"#000000\" height=\"190\">
        <tr bgcolor=\"#FFFFFF\"> 
          <td width='85' align='right'> 
            <div align=\"left\">아이디 </div>
          </td>
          <td colspan=\"3\"> 
            <input type='text' name='admin_id' size='12'>
          </td>
        </tr>
        <tr bgcolor=\"#FFFFFF\"> 
          <td width='85' align='right'> 
            <div align=\"left\">비밀번호 </div>
          </td>
          <td width=\"93\"> 
            <input type='password' name='admin_pw' size='12'>
          </td>
          <td width=\"62\"> 
            <p align=\"center\">재확인</p>
          </td>
          <td width=\"143\"> 
            <input type='password' name='admin_pw2' size='12'>
          </td>
        <tr bgcolor=\"#FFFFFF\"> 
          <td width='85' align='right'> 
            <div align=\"left\">이메일 </div>
          </td>
          <td colspan=\"3\"> 
            <input type='text' name='admin_email' size='30'>
          </td>
          <input type='hidden' name='url' size='36' value='$url'>
        </tr>
        <tr bgcolor=\"#FFFFFF\"> 
          <td colspan='4' align='center'> 
            <input type='image' img src=\"img/in5.gif\" border=\"0\" onClick='form.submit();' name=\"button\" width=\"105\" height=\"33\" style=\"border:0\">
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td valign=\"bottom\" height=\"53\"><img src=\"img/in3.gif\" width=\"520\" height=\"53\"></td>
  </tr>
</form>
</table>";
} elseif($step == 3) {
	if(!$HTTP_POST_VARS[admin_id]) {
		err("관리자 아이디를 입력해 주세요.");
		exit;
	}
	if(!$HTTP_POST_VARS[admin_pw] || !$HTTP_POST_VARS[admin_pw2]) {
		err("관리자 비밀번호를 입력해 주세요.");
		exit;
	}
	if($HTTP_POST_VARS[admin_pw] != $HTTP_POST_VARS[admin_pw2]) {
		err("관리자 비밀번호가 일치하지 않습니다.\\n\\n확인후 다시 시도해 주세요");
		exit;
	}
	if(!$HTTP_POST_VARS[admin_email]) {
		err("관리자 메일주소를 입력해 주세요");
		exit;
	}
	if(!$HTTP_POST_VARS[url]) {
		err("홈페이지 주소를 입력해 주세요");
		exit;
	}
	if(file_exists("./login/admin.gdbm")) {
		err("이미 관리자 설정 화일이 존재 합니다.\\n이전에 이미 설치된 게시판일수도 있습니다.\\n설치를 원하시면 admin.gdbm, admin.gdbm.lck, ban.gdbm, ban.gdbm.lck, login_session 화일을 삭제 하신후 설치를 새로 진행해 주시기 바랍니다");
		exit;
	}

	$dbm = dbmopen("./login/admin.gdbm", "n");
	dbminsert($dbm, "admin_id", $HTTP_POST_VARS[admin_id]);
	dbminsert($dbm, "admin_pw", get_pw($HTTP_POST_VARS[admin_pw]));
	dbminsert($dbm, "admin_email", $HTTP_POST_VARS[admin_email]);
	dbminsert($dbm, "url", $HTTP_POST_VARS[url]);
	dbmclose($dbm);
	$dbm = dbmopen("./login/ban.gdbm","n");
	dbmclose($dbm);
    @exec("touch ./login/login_session");
    @exec("chmod 666 login/login_session");
	echo "<script>alert('설치가 완료 되었습니다!!');this.document.location.href='./index.php'</script>";
}
?>
    </td>
  </tr>
</table>
</body>
</html>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->