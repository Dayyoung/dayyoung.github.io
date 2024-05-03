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

$path1 = "../data/$code/data_change.gdbm";
$path2 = "../data/$code/data.gdbm";
$path3 = "../data/$code/data.gdbm";

unlink($path3);
copy($path1,$path2);
?>

<html>
<head>
<title></title>
<link href="css/blue.css" rel="stylesheet" type="text/css">
</head>
<body>

<table width="350" border="0" cellpadding="0" cellspacing="0" align="center">
  <form name="form" action="jb_patch_act.php" method="post">
  <tr>
    <td>
      <table width="100%" border="0" cellpadding="0" cellspacing="1" class="line_color" >
        <tr align="center">
          <td height="36" colspan="4" valign="top">
            <table width="100%" height="36"  border="0" cellpadding="10" cellspacing="0">
              <tr><td height="1" class="main_color1"></td></tr>
              <tr><td height="1" class="main_color2"></td></tr>
              <tr>
                <td height="34" class="title" align="left">3단계 : Jboard 정리된 파일 실제 적용완료 </td>
              </tr>
              
              <tr>
                <td height="34" class="standard" align="left">
                정리작업이 완료 되었습니다.<br><br>
                <font color='red'>게시판 사용에 문제가 발생시</font> 백업해 두신 파일을 /jboard/data/<?echo $code;?>/ 폴더에 복구해 주십시요.</td>
              </tr>
            </table>
          </td>
        </tr>

      </table>
    </td>
  </tr>
</table>
<table width="350" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr><td height="5"></td></tr>
  <tr>
    <td align="center">
      <table border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td class="btn_3char"><a href="javascript:void(window.close())" class="btn_txt">완료</a></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

</body>
</html>
