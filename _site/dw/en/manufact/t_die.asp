<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>대원산업(주)에 오신걸 환영합니다.</title>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<link href="/include/style_default.css?<?=filemtime('/include/style_default.css')?>" rel="stylesheet" type="text/css">
<link href="../default.css" rel="stylesheet" type="text/css" />
<script language='javascript' type='text/javascript'>
//<![CDATA[


// 타이머 핸들
var thd;
// 현재 선택된 탭
var cur = 0;


// 선택된 탭 이미지
var tap1 = new Array();
tap1.push('../img/33_img01_ov.jpg');
tap1.push('../img/33_img02_ov.jpg');
tap1.push('../img/33_img03_ov.jpg');


// 기본 탭 이미지
var tap2 = new Array();
tap2.push('../img/33_img01.jpg');
tap2.push('../img/33_img02.jpg');
tap2.push('../img/33_img03.jpg');



function fncGoMore(obj)
{
    window.location.href = obj.link;
}


window.onload = function()
{
//    thd = setInterval(fncSetPos,1000);
}


function fncSetPos( /* optional */ pos )
{
    if(pos==undefined){ cur++; }
    else{ cur = pos; }


    if(cur>=tap1.length) cur=0;


    for( var i=0; i<tap1.length; i++ )
    {
        if(i==cur) // 선택된 탭
        {
            document.getElementById('menu'+i).src           = tap1[i]; // 선택된 이미지로 변경
            document.getElementById('img'+i).style.display = '';       // 선택된 컨텐츠 이미지 보여주기
        }
        else // 선택되지 않은 탭
        {
            document.getElementById('menu'+i).src           = tap2[i]; // 기본 이미지로 변경
            document.getElementById('img'+i).style.display  = 'none';  // 선택되지 않은 컨텐츠 이미지 감추기

        }
    }
}


function fncClk(pos)
{
//    clearInterval(thd);
    fncSetPos(pos);
//    thd = setInterval(fncSetPos,1000);
}


//]]>
</script>
</head>
<body>
<tr>
  <td colspan="2"><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="920" height="243">
      <param name="movie" value="../img/sub_main_en3.swf" />
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="8.0.35.0" />
      <!-- 이 param 태그는 Flash Player 6.0 r65 이후 버전 사용자에게 최신 버전의 Flash Player를 다운로드하라는 메시지를 표시합니다. 사용자에게 이러한 메시지를 표시하지 않으려면 이 태그를 삭제하십시오. -->
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- 다음 객체 태그는 IE 이외의 브라우저에 사용됩니다. IECC를 사용하여 IE에서 이 태그를 숨기십시오. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="../img/sub_main_en3.swf" width="920" height="243">
        <!--<![endif]-->
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="8.0.35.0" />
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- Flash Player 6.0 이전 버전 사용자의 브라우저에는 다음과 같은 대체 내용이 표시됩니다. -->
      <div>
        <h4>이 페이지의 내용을 보려면 최신 버전의 Adobe Flash Player가 필요합니다.</h4>
        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Adobe Flash Player 내려받기" width="112" height="33" /></a></p>
      </div>
      <!--[if !IE]>-->
      </object>
      <!--<![endif]-->
    </object></td>
</tr>
<table width="920" border="0" cellspacing="0" cellpadding="0" id="con_bg">
  <tr>
    <td id="leftmenu_img"><img src="../img/letf_33.jpg" /></td>
    <td id="title"><img src="../img/title_33_en.jpg" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td id="line"><img src="../img/title_line.gif" /></td>
  </tr>
  <tr>
    <td id="leftmenu"><p><a href="extrusion.asp" target="_self">Film Making</a></p>
      <p><a href="printing.asp" target="_self">Printing</a></p>
      <p class="br2"><a href="t_die.asp" target="_self">T-Die &<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dry Lamination</a></p>
      <p><a href="slitter.asp" target="_self">Slitting</a></p>
      <p><a href="automaticbag.asp" target="_self">Pouch Making</a></p>
      <p><a href="equipment.asp" target="_self">Equipment List</a></p></td>
    <td><table width="710" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center"><table width="640" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="221"><img id='menu0' name='menu0' src='../img/33_img01_ov.jpg' style='cursor:hand;' onclick='javascript_:fncClk(0);' width="221" height="53"></td>
                <td width="221"><img id='menu1' name='menu1' src='../img/33_img02.jpg' style='cursor:hand;' onclick='javascript_:fncClk(1);' width="221" height="53"></td>
                <td width="221"><img id='menu2' name='menu2' src='../img/33_img03.jpg' style='cursor:hand;' onclick='javascript_:fncClk(2);' width="221" height="53"></td>
              </tr>
              <tr>
                <td colspan="3" height="10"></td>
              </tr>
              <tr align="center">
                <td colspan="3" height="399"><img id='img0' src='../img/33_img01_on.jpg'><img id='img1' style='display:none' src='../img/33_img02_on.jpg'><img id='img2' style='display:none' src='../img/33_img03_on.jpg'></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2" id="footer"><img src="../img/foot.gif" /></td>
  </tr>
</table>
</body>
</html>
