<?php
/*

	다운로드 처리 화일
	
*/


//
// 외부화일
//
include ("./include/func.inc");


//
// 전달인수확인
//
if(!$file_name || !$file_size || !$code) {
	err("다운로드에 필요한 인수가 부족합니다");
	exit;
} else {
	$path = "../../data/$code/binary/$file_name";
}


//
// 시작!!
//

if (is_file("$path")) {
	$data = fread(fopen("$path", "rb"), $file_size);
} else { 
	err("해당 파일이나 경로가 존재하지 않습니다. \\n $path");
}
if(eregi("(MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT)) { 
	Header("Content-type: application/octet-stream");
	Header("Content-Length: $file_size");
	Header("Content-Disposition: attachment; filename=$file_name");
	Header("Content-Transfer-Encoding: binary");
	Header("Pragma: no-cache");
	Header("Expires: 0");
} else { 
	Header("Content-type: file/unknown");
	Header("Content-Length: $file_size");
	Header("Content-Disposition: attachment; filename=$file_name");
	Header("Content-Description: PHP Generated Data");
	Header("Pragma: no-cache");
	Header("Expires: 0");
}
echo $data;
?>