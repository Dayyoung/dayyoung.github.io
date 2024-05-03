<html>
<head>
<title>jboard :: 이미지보기</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<script>
<!--
function Loading_img()
{
	var Img = document.IMG;
	var window_width = Img.width + 30;
	var window_height = Img.height + 53;
	if(window_width > 640 && window_height > 480) {
		window_width = 640;
		window_height = 480;
	} else if(window_width > 640) {
		window_width = 640;
	} else if(window_height > 480) {
		window_width = 480;
	}

	var sw = screen.availWidth;
	var sh = screen.availHeight;
	var wx = ( sw - window_width ) / 2;
	var wy = ( sh - window_height ) / 2;
	
	window.resizeTo(window_width, window_height)
	window.moveTo(wx, wy);
}
-->
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0"  onLoad="Loading_img()">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="middle" align="center">
      <img src="<?=$img?>" name="IMG" style="cursor:hand" onClick="self.close();" alt="클릭하시면 닫힙니다.이미지 저장을 원하시면 마우스 오른쪽클릭후 '다른이름으로 저장'을 하세요">
    </td>
  </tr>
</table>
</body>
</html>