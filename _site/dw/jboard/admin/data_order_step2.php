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

<pre>
<?php
$date = date("ymd", time());
@set_time_limit(180000);

$file_path = "../data/$code/data_change.gdbm";
if(is_file($file_path)) {
	unlink($file_path);
}

$dbm_id = dbmopen("../data/$code/data.gdbm", "r");
$dbm_id2 = dbmopen("../data/$code/data_change.gdbm", "w");

$idx = dbmfetch($dbm_id, "idx");
dbminsert($dbm_id2, "idx", $idx);
$idxr = explode("|", $idx);
$cnt = count($idxr);

for($i = 0 ; $i < $cnt ; $i++) {
        $data = dbmfetch($dbm_id, $idxr[$i]);
        dbminsert($dbm_id2, $idxr[$i], $data);
}

$G_num = dbmfetch($dbm_id, "G_num");

if(!dbmexists($dbm_id2, "G_num")) {
	dbminsert($dbm_id2, "G_num", $G_num);
} else {
	dbmreplace($dbm_id2, "G_num", $G_num);
}
f($G_num == '') $G_num = 0;
for($i = $G_num ; $i >= 0 ; $i--) {
	$unique = "G_".$i;
	$data2 = dbmfetch($dbm_id, $unique);
	
	if(dbmexists($dbm_id, $unique)) {
		dbminsert($dbm_id2, $unique, $data2); // 데이터 삽입
	}
}


$data = dbmfetch($dbm_id, "config");
dbminsert($dbm_id2, "config", $data);
$data = dbmfetch($dbm_id, "number");
dbminsert($dbm_id2, "number", $data);

?>
</pre>


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
                <td height="34" class="title" align="left">2단계 : Jboard 테이타 정리작업 완료</td>
              </tr>
              
              <tr>
                <td height="34" class="standard" align="left">
                데이타 정리 작업이 완료 되었습니다.<br><br> 아래 테스트 게시판을 클릭하시고 <font color=red>테스트 게시판 안에 게시물이 정상적으로 모두 있는지 확인</font>하시고 실제 적용하기를 클릭하시면 됩니다.</td>
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
          <td class="btn_7char"><a onClick="open_win2('./contents_test/?code=<?echo $code;?>')" style=cursor:hand;>테스트게시판</a></td>
          <td width="5"></td>
          <td class="btn_7char"><a href="data_order_step3.php?code=<?echo $code;?>" class="btn_txt">실제적용하기</a></td>
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

function open_win2(URL)
{
	window.open(URL, 'manage_win2','');
}

function close_form()
{
	var vConfirm = confirm('데이타 정리작업을 종료합니다.');
	if (vConfirm) {
		window.close();
	}
}

-->
</script>
