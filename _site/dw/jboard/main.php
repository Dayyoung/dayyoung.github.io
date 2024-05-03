<?php
/*

	최근글 뽑아오기

*/



/* 함수정의 */
function get_main($path=".", $code, $width, $count, $skin="default", $mode)
{
	$lwidth = $width - 90;

	echo "
<script>
<!--
function open_win(url, win_name, conf)
{
	window.open(url, win_name, conf);
}
-->
</script>
<table width='$width' border='0' cellpadding='3' cellspacing='0'>";

	$base_path = "$path/data/$code";
	if(!is_dir($base_path)) {
		echo "존재하지 않는 게시판 코드 입니다";
		exit;
	}
	$dbm = dbmopen("$base_path/data.gdbm", "r");
	$idx = file("$base_path/idx");
	$idx = explode("|", $idx[0]);
	for($i = 0 ; $i < $count ; $i++) {
		unset($main);
		$data = explode("|", dbmfetch($dbm, $idx[($i + 1)]));
		if($data) {
			$tmp = explode(" ", $data[9]);
			$main[reg_date] = $tmp[0];
			$main[subject] = $data[2];
			if($mode == "1") {
				$str = "<a href='$path/?p=detail&code=$code&id=$data[0]'>$main[subject]</a>";
			} else {
				$str = "<a href=\"javascript:open_win('$path/?p=gonggi&code=$code&id=$data[0]&skin=$skin','gonggi_win','width=416, height=410, scrollbars=yes')\">$main[subject]</a>";
			}
			echo "
  <tr height='25'>
    <td width='70'>$main[reg_date]</td>
    <td width='*'><nobr style='width:$lwidth; overflow:hidden' title='$main[subject]'>$str</nobr></td>
  </tr>
  <tr height='1' bgcolor='#999999'><td colspan='10'></td></tr>";
		}
	}
	dbmclose($dbm);

	echo "
</table>\n";
}
?>