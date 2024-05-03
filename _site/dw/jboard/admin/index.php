<?php
/*
	관리자 인덱싱(?) 페이지
*/

/*
	세션시작
*/
session_start();

/*
	버전정보
*/
$fp = fopen("./version.txt", "r");
$ver = fgets($fp, filesize("./version.txt"));
fclose($fp);

/* 실치된 게시판인가? */
if(!file_exists("./login/admin.gdbm")) {
	Header("Location:./install.php");
	exit;
}

/* 어드민 콘트롤 화일 */
include ("./include/control.inc");

/* 생성되어 있는 게시판 구하기 */
$d_list = get_directory("../data");

/* 관리자 정보 */
$dbm = dbmopen("./login/admin.gdbm", "r");
$admin[url] = dbmfetch($dbm, "url");
$admin[email] = dbmfetch($dbm, "admin_email");
dbmclose($dbm);
?>
<html>
<head>
<title>jboard :: 관리자페이지</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
A:link, A:visited, A:active, A:hover { text-decoration:none; }
td {  font-size: 9pt; border: #CCCCCC none}
.b {  border: 1px #999999 solid; background-color: #E1E1E1; font-size: 9pt}
.c {  border: 1px #999999 solid; background-color: #FFFFFF; font-size: 9pt}
.del {  background-color: #F5F5F5; border: #333333; border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; color: #FF0000; font-size: 9pt}
.fil {  border:1 solid #000000; background-color:#FFFFFF; color:#000000; }
-->
</style>
<script>
<!--
function chk_del(code)
{
	if(confirm('정말 삭제 하시겠습니까?\n\n주의 : 게시판의 모든데이터(업로드된것 포함)가 삭제 됩니다.!!')) {
		document.del_form.code.value=code;
		document.del_form.submit();
	} else {
		return false;
	}
}

function open_win(URL)
{
	window.open(URL, 'manage_win', 'width=720, height=500, scrollbars=yes');
}

function open_win2(URL)
{
	window.open(URL, 'manage_win','');
}

function open_win3(URL)
{
	window.open(URL, 'manage_win', 'width=400, height=245, scrollbars=yes');
}

function new_board()
{
	var F = document.new_form;

	if(!F.board_code.value) {
		alert('생성하려는 게시판 코드를 입력해 주세요');
		F.board_code.focus();
		return false;
	} else {
		var url = './admin_new.php?code=' + F.board_code.value;
		open_win(url);
	}
}

function disp_url(val)
{
	tr_url.style.display = 'inline';
	url_info.innerHTML = val;
}

function chk_pw()
{
	var F = document.pw_form;
	if(!F.pw1.value) {
		alert('변경하실 비밀번호를 입력해 주세요');
		F.pw1.focus();
		return false;
	}
	if(!F.pw2.value) {
		alert('한번더 입력해 주세요');
		F.pw2.focus();
		return false;
	}
	if(F.pw1.value != F.pw2.value) {
		alert('비밀번호가 일치하지 않습니다. 확인후 다시 입력해 주세요!');
		F.pw2.value='';
		F.pw2.focus();
		return false;
	}
	F.submit();
}

function chk_email()
{
	var F = document.email_form;

	if(!F.email.value) {
		alert('이메일주소를 입력해 주세요');
		return false;
	}
	F.submit();
}

function chk_url()
{
	var F = document.url_form;

	if(!F.url.value) {
		alert('게시판 주소를 입력해 주세요');
		return false;
	}
	F.submit();
}
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#000000" link='#000000' vlink='#000000'>
  <table width="800" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <font color="red" style="cursor:help" onClick="window.open('http://www.jungbo.net/jbnm/','help_window','width=720, height=510, resizable=yes')"><B>[도움말]</B></font>
        <a href='http://www.jungbo.net/jboard/jboard/?code=faq' target='_new'><B>[FAQ]</B></font></a>
        <a href='http://www.jungbo.net/jboard/jboard/?code=notice' target='_new'><B>[공지사항]</B></font></a>
        <font color="blue">Ver 0.8</font>
      </td>
      <td align="right">
        <span style="cursor:hand" onClick="this.document.location.href='./admin_login_process.php'"><B>로그아웃</B></span>
      </td>
    </tr>
  </table>
  <table width="800" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>
        <table width="100%" border="0" cellspacing="1" cellpadding="1" bgcolor="#000000" align="center">
          <tr bgcolor="#D6D6EB"> 
            <td colspan="7" height="25">
              <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td>
                    <div align="center"><b>jboard 관리 페이지</b></div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr bgcolor="#FFFFFF"> 
            <td width="98" height="35"> 
              <div align="center">게시판명(DB명)</div>
            </td>
            <td width="50" height="29"> 
              <div align="center">게시물</div>
            </td>
            <td width="125" height="29"> 
              <div align="center">사용량(전체/업로드)</div>
            </td>
            <td height="29" width="*"> 
              <div align="center">게시판 세부 설정</div>
            </td>
            <td width="90">
              <div align="center">게시판주소</div>
            </td>
            <td width="49" height="29" bgcolor="#F3F3F3"> 
              <div align="center"><font color="#FF0000"><b>삭제</b></font></div>
            </td>
          </tr>
<?php
$cnt = count($d_list);
$host = str_replace("www.", "", $HTTP_HOST);
if(!$cnt) {
	echo "
          <tr bgcolor=\"#FFFFFF\">
            <td colspan=\"7\" align=\"center\">
              <BR><h3>생성된 게시판이 없습니다.</h4>
            </td>
          </tr>";
}
for($i = 0 ; $i < $cnt ; $i++) {
	$q = $i + 1;
	$base_path = "../data/$d_list[$i]";
	$dbm = dbmopen("$base_path/data.gdbm", "r");
	$config = dbmfetch($dbm, "config");
	$config = explode("|", $config);
	//$idx = @file("$base_path/idx");
	$idx = dbmfetch($dbm, "idx");
	dbmclose($dbm);
	$usage_article = exec("du -sH $base_path");
	$usage_article = explode("\t", $usage_article);
	$usage_binary = exec("du -sH $base_path/binary");
	$usage_binary = explode("\t", $usage_binary);
	$usage[article] = $usage_article[0];
	$usage[binary] = $usage_binary[0];
	//$all = count(explode("|", $idx[0])) - 2;
	$all = count(explode("|", $idx)) - 2;
	$all = ($all <= 0) ? 0 : $all;
	$tong_article = $tong_article + $all;
	$tong_size = $tong_size + $usage[article];
	$url = "<a href='http://고객님의 게시판주소/?code=$d_list[$i]'>test</a>";
	if(!$admin[url]) {
		$admin[url] = "http://귀하의게시판주소";
	}

	echo "
          <tr bgcolor=\"#FFFFFF\"> 
            <td height=\"31\" >&nbsp;<a href=\"../?code=$d_list[$i]\" target=\"_new\">$d_list[$i] ($config[0])</a></td>
            <td align=\"right\">$all 건&nbsp;</td>
            <td align=\"right\">$usage[article] / $usage[binary]&nbsp;</td>
            <td width=\"350\" align=\"center\">
              <input type='button' value='게시물관리' onClick=\"open_win2('./contents/?code=$d_list[$i]')\" class=\"b\">
              <input type='button' value='새공지' onClick=\"open_win('./admin_gonggi.php?code=$d_list[$i]')\" class=\"b\">
              <input type='button' value='설정변경' onClick=\"open_win('./admin_modify.php?code=$d_list[$i]')\" class=\"b\">
              <input type='button' value='데이타정리' onClick=\"open_win3('./data_order.php?code=$d_list[$i]')\" class=\"c\">
            </td>
            <td>
              <div align=\"center\"><input type=\"button\" value=\"확인하기\" class=\"b\" onClick=\"disp_url('$admin[url]/?code=$d_list[$i]');\"></div>
            </td>
            <td bgcolor=\"#F3F3F3\"> 
              <div align=\"center\"> 
                <input type='button' value='삭제' onClick=\"chk_del('$d_list[$i]')\" class=\"del\">
              </div>
            </td>
          </tr>";
}
?>
          <tr bgcolor="#FFFFFF">
            <td height="31" colspan="7">
              &nbsp;<span style="cursor:hand" onClick="open_win('./admin_ban.php');">등록거부자관리</span> <input type="button" value="확인" class="b" onClick="open_win('./admin_ban.php');">
              &nbsp;<font style="font-size:8pt">등록거부자의 리스트, 삭제를 하실수 있습니다.(등록거부자는 게시물관리에서 하실수 있습니다.)</font>
            </td>
          </tr>
        </table>
        <br>
        <!-- ===== 게시판 생성 폼 ===== -->
        <table width="100%" border="0" cellspacing="1" cellpadding="3" bgcolor="#000000" align="center">
          <form method="" action="" name="new_form" onSubmit="return false;">
          <tr bgcolor="#D6D6EB"> 
            <td width="100" height="30" valign="middle"> 
              <div align="center"><b>게시판 생성</b></div>
            </td>
            <td bgcolor="#FFFFFF" valign="middle">
              &nbsp;&nbsp;<input type="text" name="board_code" size="12" class="fil" onKeyPress="if(event.keyCode == 13) { new_board(); }">
              &nbsp;&nbsp;<input type="button" value="생성" class="b" onClick="new_board();">&nbsp;&nbsp;
              <font style="font-size:8pt">생성하실 게시판의 아이디를 입력하시고 "생성" 버튼을 클릭 하세요</font>
            </td>
          </tr>
          </form>
        </table>
        <!-- ===== 게시판 생성 폼 ===== -->
        <BR>
        <!-- ===== 관리자 정보 수정 ===== -->
        <table width="100%" border="0" cellspacing="1" cellpadding="3" bgcolor="#000000" align="center">
          <tr bgcolor="#D6D6EB"> 
            <td colspan="2" height="30" valign="middle"> 
              <div align="center"><b>관리자 정보 수정</b></div>
            </td>
          </tr>
          <!-- ===== 관리자 비밀번호 변경 ===== -->
          <form method="post" action="admin_act.php" name="pw_form" onSubmit="return chk_pw();">
          <input type="hidden" name="mode" value="modify_pw">
          <tr bgcolor="#D6D6EB">
            <td width="100" height="30" valign="middle">
              <div align="center"><b>비밀번호 변경</b></div>
            </td>
            <td bgcolor="#FFFFFF" height="30" valign="middle">
              &nbsp;&nbsp;비밀번호 : <input type="password" name="pw1" size="8" class="fil">
              &nbsp;&nbsp;비밀번호확인 : <input type="password" name="pw2" size="8" class="fil">
              <input type="button" value="변경" class="b" onClick="chk_pw();">
              &nbsp;&nbsp;<font style="font-size:8pt">변경하실 비밀번호를 입력하시고 변경 버튼을 눌러 주세요</font>
            </td>
          </tr>
          </form>
          <!-- ===== 관리자 비밀번호 변경 ===== -->
          <!-- ===== 관리자 이메일 변경 ===== -->
          <form method="post" action="admin_act.php" name="email_form" onSubmit="return chk_email();">
          <input type="hidden" name="mode" value="modify_email">
          <tr bgcolor="#D6D6EB">
            <td width="80" height="30" valign="middle">
              <div align="center"><b>이메일 변경</b></div>
            </td>
            <td bgcolor="#FFFFFF">
              &nbsp;&nbsp;<input type="text" name="email" size="25" class="fil" value="<?=$admin[email]?>">
              <input type="button" value="변경" class="b" onClick="chk_email();">
            </td>
          </td>
          </form>
          <!-- ===== 관리자 이메일 변경 ===== -->
        </table>
        <!-- ===== 관리자 정보 수정 ===== -->
        <!-- ===== 데이터 내보내기 ===== -->
        <BR>
        <table width="100%" border="0" cellspacing="1" cellpadding="3" bgcolor="#000000" align="center" style="display:<?=$export_view?>">
          <tr bgcolor="#D6D6EB">
            <td width="100" height="30" valign="middle"> 
              <div align="center"><b>엑셀데이터 변환</b></div>
            </td>
            <td bgcolor="#FFFFFF">
              &nbsp;
              <select name="code" onChange="go_export(this.value, this);">
                <option value='0'>게시판을 선택해 주세요.</option>

<?php
for($i = 0 ; $i < $cnt ; $i++) {
	echo "
		<option value='$d_list[$i]'>$d_list[$i]</option>
	";
}
?>

              </select>
              <iframe name="export_gura" src="" width="0" height="0"></iframe>
              <span id="excel_link"></span>
            </td>
          </tr>
        </table>
<script>
<!--
function go_export(code, obj)
{
	if(code != 0) {
		if(confirm('게시판 코드 "'+code+'" 를 엑셀데이터로 변환 하시겠습니까?')) {
			export_gura.location.href = './admin_export2.php?code='+code;
		} else {
			obj.selectedIndex = 0;
		}
	}
}
-->
</script>
        <!-- ===== 데이터 내보내기 ===== -->
      </td>
    </tr>
    <tr> 
      <td id="tr_url" colspan="2" style="font-size:12pt; color:blue; display:none"><BR>
        <B><span id='url_info'></span></B>
      </td>
    </tr>
  </table>
<!-- 게시판 삭제 폼 -->
<form method="post" action="./admin_act.php" name="del_form">
<input type="hidden" name="mode" value="del">
<input type="hidden" name="code" value="">
</form>
<!-- 게시판 삭제 폼 -->
<font color="#FFFFFF">ver - <?=$ver?> </font>
<?php
if(!$HTTP_SESSION_VARS[stat_info]) {
	echo "<iframe src=\"http://www.jungbo.net/GwangPa/jboard/?host=$host&cnt=$cnt&total_article=$tong_article&total_size=$tong_size&version=$ver\" width=\"0\" height=\"0\" frameborder=\"0\"></iframe>\n";
	$stat_info = 1;
	session_register(stat_info);
}
?>
</body>
</html>
<!-- ##### copyright (c) 2002 by jungbo.net all rights reserved #####-->
