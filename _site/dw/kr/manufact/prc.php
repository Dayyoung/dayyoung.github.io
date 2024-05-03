<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>대원산업(주)에 오신걸 환영합니다.</title>
<script src="../contact/Scripts/swfobject_modified.js" type="text/javascript"></script>
<link href="/include/style_default.css?<?=filemtime('/include/style_default.css')?>" rel="stylesheet" type="text/css">
<link href="../default.css" rel="stylesheet" type="text/css" />
<script language='javascript' type='text/javascript'>
//<![CDATA[


// 타이머 핸들
var thd;
// 현재 선택된 탭
var cur = 0;


// 선택된 탭 이미지
var imgSrcOv = new Array();
imgSrcOv.push('../img/33_kr_img01.jpg');
imgSrcOv.push('../img/33_kr_img011.jpg');
//imgSrcOv.push('../img/33_kr_img0111.jpg');


// 기본 탭 이미지
var imgSrcOt = new Array();
imgSrcOt.push('../img/33_kr_img01.jpg');
imgSrcOt.push('../img/33_kr_img011.jpg');
//imgSrcOt.push('../img/33_kr_img0111.jpg');




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
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
</script>
</head>
<body>
<tr>
  <td colspan="2"><object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="920" height="243">
      <param name="movie" value="../img/sub_main_kr3.swf" />
      <param name="quality" value="high" />
      <param name="wmode" value="opaque" />
      <param name="swfversion" value="8.0.35.0" />
      <!-- 이 param 태그는 Flash Player 6.0 r65 이후 버전 사용자에게 최신 버전의 Flash Player를 다운로드하라는 메시지를 표시합니다. 사용자에게 이러한 메시지를 표시하지 않으려면 이 태그를 삭제하십시오. -->
      <param name="expressinstall" value="../contact/Scripts/expressInstall.swf" />
      <!-- 다음 객체 태그는 IE 이외의 브라우저에 사용됩니다. IECC를 사용하여 IE에서 이 태그를 숨기십시오. -->
      <!--[if !IE]>-->
      <object type="application/x-shockwave-flash" data="../img/sub_main_kr3.swf" width="920" height="243">
        <!--<![endif]-->
        <param name="quality" value="high" />
        <param name="wmode" value="opaque" />
        <param name="swfversion" value="8.0.35.0" />
        <param name="expressinstall" value="../contact/Scripts/expressInstall.swf" />
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
    <td id="leftmenu_img"><img src="../img/letf_44.jpg" /></td>
    <td id="title"><img src="../img/title_33_kr.jpg" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td id="line"><img src="../img/title_line.gif" /></td>
  </tr>
  <tr>
    <td id="leftmenu"><p><a href="prc_progress.php" target="_self">제조 공정도</a></p>
      <p><a href="prc_facility.php" target="_self">생산설비</a></p>
      <p><a href="prc.php" target="_self">제조공정</a></p></td>
    <td><table width="710" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="24">&nbsp;</td>
        </tr>
        <tr>
          <td height="53" align="center"><table width="651" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="../img/33_prc_kr_01ov.jpg" /></td>
                <td><a href="prc2.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image7','','../img/33_prc_kr_02ov.jpg',1)"><img src="../img/33_prc_kr_02.jpg" border="0" id="Image7" /></a></td>
                <td><a href="prc3.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','../img/33_prc_kr_03ov.jpg',1)"><img src="../img/33_prc_kr_03.jpg" border="0" id="Image8" /></a></td>
                <td><a href="prc4.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','../img/33_prc_kr_04ov.jpg',1)"><img src="../img/33_prc_kr_04.jpg" border="0" id="Image9" /></a></td>
                <td><a href="prc5.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image10','','../img/33_prc_kr_05ov.jpg',1)"><img src="../img/33_prc_kr_05.jpg" border="0" id="Image10" /></a></td>
                <td><a href="prc6.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image11','','../img/33_prc_kr_06ov.jpg',1)"><img src="../img/33_prc_kr_06.jpg" border="0" id="Image11" /></a></td>
                <td><a href="prc7.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image12','','../img/33_prc_kr_07ov.jpg',1)"><img src="../img/33_prc_kr_07.jpg" border="0" id="Image12" /></a></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="111" align="center"><img src="../img/33_prc_kr_01c.jpg" width="640" height="111"></td>
        </tr>
        <tr>
          <td align="center"><table width="640" border="0" cellspacing="0" cellpadding="0">
              <tr align="center">
                <td colspan="11" height="399"><img id='img0' src='../img/33_kr_img01_on.jpg'><img id='img1' style='display:none' src='../img/33_kr_img011_on.jpg'>
                  <!--<img id='img2' style='display:none' src='../img/33_kr_img0111_on.jpg'>--></td>
              </tr>
              <tr>
                <td colspan="11" height="10"></td>
              </tr>
              <tr>
                <td width="100"><img id='menu0' name='menu0' src='../img/33_kr_img01.jpg' style='cursor:hand;' onMouseOver='javascript_:fncClk(0);' width="100" height="72"></td>
                <td width="8">&nbsp;</td>
                <td width="100"><img id='menu0' name='menu1' src='../img/33_kr_img011.jpg' style='cursor:hand;' onMouseOver='javascript_:fncClk(1);' width="100" height="72"></td>
                <td width="8">&nbsp;</td>
                <td width="100"><!--<img id='menu0' name='menu2' src='../img/33_kr_img0111.jpg' style='cursor:hand;' onMouseOver='javascript_:fncClk(2);' width="100" height="72">--></td>
                <td width="8">&nbsp;</td>
                <td width="100">&nbsp;</td>
                <td width="8">&nbsp;</td>
                <td width="100">&nbsp;</td>
                <td width="8">&nbsp;</td>
                <td width="100">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2" id="footer">&nbsp;</td>
  </tr>
</table>
<img src="../img/foot.gif" />
<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>
</body>
</html>
