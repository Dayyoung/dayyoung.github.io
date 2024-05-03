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
?>


<html>
<head>
<title>Jboard 데이타정리</title>
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
                <td height="34" class="title" align="left">1단계 : 파일백업하기</td>
              </tr>
              
              <tr>
                <td height="34" class="standard" align="left">
                데이타 정리란 데이타 안에 있는 쓰레기파일들을 정리하는 작업으로 실제 데이타용량(하드)을 줄일수가 있습니다.<br><br><font color=red>정리작업전에 FTP로 아래 파일을 반드시 백업 받으시길 바랍니다.</font>
                <br><br>
                
                파일명 : <br>
                /jboard/data/<?echo $code;?>/data.gdbm<br>/jboard/data/<?echo $code;?>/data.gdbm.lck<br><br></td>
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
          <td class="btn_7char"><a href="data_order_step2.php?code=<?echo $code;?>&step=2" class="btn_txt">데이타 정리</a></td>
          <td width="5"></td>
          <td class="btn_3char"><a onclick='close_form()'; style=cursor:hand; class="btn_txt">취소</a></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

</body>
</html>

<script>
<!--

function close_form()
{
	var vConfirm = confirm('데이타 정리작업을 종료합니다.');
	if (vConfirm) {
		window.close();
	}
}

-->
</script>

