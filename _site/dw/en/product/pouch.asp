<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>대원산업(주)에 오신걸 환영합니다.</title>
<script src="Scripts/swfobject_modified.js" type="text/javascript"></script>
<script language='javascript' type='text/javascript'>
//<![CDATA[


// 타이머 핸들
var thd;
// 현재 선택된 탭
var cur = 0;


// 선택된 탭 이미지
var imgSrcOv = new Array();
imgSrcOv.push('../img/21_img01.jpg');
imgSrcOv.push('../img/21_img02.jpg');
imgSrcOv.push('../img/21_img03.jpg');
imgSrcOv.push('../img/21_img04.jpg');
imgSrcOv.push('../img/21_img05.jpg');
imgSrcOv.push('../img/21_img06.jpg');


// 기본 탭 이미지
var imgSrcOt = new Array();
imgSrcOt.push('../img/21_img01.jpg');
imgSrcOt.push('../img/21_img02.jpg');
imgSrcOt.push('../img/21_img03.jpg');
imgSrcOt.push('../img/21_img04.jpg');
imgSrcOt.push('../img/21_img05.jpg');
imgSrcOt.push('../img/21_img06.jpg');




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


    if(cur>=imgSrcOv.length) cur=0;


    for( var i=0; i<imgSrcOv.length; i++ )
    {
        if(i==cur) // 선택된 탭
        {
            document.getElementById('menu'+i).src           = imgSrcOv[i]; // 선택된 이미지로 변경
            document.getElementById('img'+i).style.display = '';       // 선택된 컨텐츠 이미지 보여주기
        }
        else // 선택되지 않은 탭
        {
            document.getElementById('menu'+i).src           = imgSrcOt[i]; // 기본 이미지로 변경
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
<link href="/include/style_default.css?<?=filemtime('/include/style_default.css')?>" rel="stylesheet" type="text/css">
<link href="../default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<tr>
  <td colspan="2"><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="920" height="243">
      <param name="movie" value="../img/sub_main_en2.swf" />
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="8.0.35.0" />
      <!-- 이 param 태그는 Flash Player 6.0 r65 이후 버전 사용자에게 최신 버전의 Flash Player를 다운로드하라는 메시지를 표시합니다. 사용자에게 이러한 메시지를 표시하지 않으려면 이 태그를 삭제하십시오. -->
      <param name="expressinstall" value="Scripts/expressInstall.swf" />
      <!-- 다음 객체 태그는 IE 이외의 브라우저에 사용됩니다. IECC를 사용하여 IE에서 이 태그를 숨기십시오. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="../img/sub_main_en2.swf" width="920" height="243">
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
    <td id="leftmenu_img"><img src="../img/letf_22.jpg" /></td>
    <td id="title"><img src="../img/title_21_en.jpg" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td id="line"><img src="../img/title_line.gif" /></td>
  </tr>
  <tr>
    <td id="leftmenu"><p class="br"><a href="pouch.asp" target="_self">Pouch & Roll<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Products</a></p>
      <p><a href="lldpe.asp" target="_self">Coextruded Films</a></p></td>
    <td><table width="710" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="24">&nbsp;</td>
        </tr>
        <tr>
          <td align="center"><table width="640" border="0" cellspacing="0" cellpadding="0">
              <tr align="center">
                <td colspan="11" height="399"><img id='img0' src='../img/21_img01_on.jpg'> <img id='img1' style='display:none' src='../img/21_img02_on.jpg'> <img id='img2' style='display:none' src='../img/21_img03_on.jpg'> <img id='img3' style='display:none' src='../img/21_img04_on.jpg'> <img id='img4' style='display:none' src='../img/21_img05_on.jpg'> <img id='img5' style='display:none' src='../img/21_img06_on.jpg'></td>
              </tr>
              <tr>
                <td colspan="11" height="10"></td>
              </tr>
              <tr>
                <td width="100"><img id='menu0' name='menu0' src='../img/21_img01.jpg' style='cursor:hand;' onMouseOver='javascript_:fncClk(0);' width="100" height="72"></td>
                <td width="8">&nbsp;</td>
                <td width="100"><img id='menu1' name='menu1' src='../img/21_img02.jpg' style='cursor:hand;' onMouseOver='javascript_:fncClk(1);' width="100" height="72"></td>
                <td width="8">&nbsp;</td>
                <td width="100"><img id='menu2' name='menu2' src='../img/21_img03.jpg' style='cursor:hand;' onMouseOver='javascript_:fncClk(2);' width="100" height="72"></td>
                <td width="8">&nbsp;</td>
                <td width="100"><img id='menu3' name='menu3' src='../img/21_img04.jpg' style='cursor:hand;' onMouseOver='javascript_:fncClk(3);' width="100" height="72"></td>
                <td width="8">&nbsp;</td>
                <td width="100"><img id='menu4' name='menu4' src='../img/21_img05.jpg' style='cursor:hand;' onMouseOver='javascript_:fncClk(4);' width="100" height="72"></td>
                <td width="8">&nbsp;</td>
                <td width="100"><img id='menu5' name='menu5' src='../img/21_img06.jpg' style='cursor:hand;' onMouseOver='javascript_:fncClk(5);' width="100" height="72"></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="27">&nbsp;</td>
        </tr>
        <tr>
          <td><img src="../img/21_PouchnRoll_Product_01.jpg" width="710" height="575"></td>
        </tr>
        <tr>
          <td><img src="../img/21_PouchnRoll_Product_02.jpg" width="710" height="609"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2" id="footer"><img src="../img/foot.gif" /></td>
  </tr>
</table>
</body>
</html>
