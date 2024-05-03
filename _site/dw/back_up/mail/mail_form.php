<html>
<head>

<title> 대원산업(주)에 오신걸 환영합니다.     [ 상담문의 ]          </title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="global.css">

<script language="JavaScript" src="global.js"></script>

<script language="JavaScript">
<!--
function send_check() {
	var form = document.mail;
	
	if(!form.sender.value){
		alert('보내는 사람 이름을 입력하지 않았습니다.');
		form.sender.focus();
		return;
	}

	if(!form.sender_email.value){
		alert('보내는 사람 이메일을 입력하지 않았습니다.');
		form.sender_email.focus();
		return;
	}

	if(!form.subject.value){
		alert('메일 제목을 입력하지 않았습니다.');
		form.subject.focus();
		return;
	}

	if(!form.contents.value){
		alert('발송 내용을 입력하지 않았습니다.');
		form.contents.focus();
		return;
	}
	form.submit();
}
//-->
</script>
</head>



<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" background="../images/Bg_green.GIF" bgproperties="fixed">
<form method='post' name='mail' action='mail_form_send.php' enctype="multipart/form-data">
<table cellpadding="0" cellspacing="0" width="960" bgcolor="white" align="center" height="10">
    <tr>
        <td width="960" height="10">
            <p align="center"><?include("../public/menu.inc")?></p>
        </td>
    </tr>
</table>
    <table width="960" cellpadding="0" cellspacing="0" bgcolor="white" align="center" height="70">
        <tr>
            <td width="175" bordercolor="black" height="70">
                <p align="center"><img src="img/sub_title.gif" width="134" height="32" border="0"></p>
            </td>
            <td width="50" bordercolor="black" height="70">&nbsp;</td>
            <td width="735" bordercolor="black" height="70">
                <p><font size="3">◈&nbsp;&nbsp;&nbsp;상 담 문 의</font></p>
            </td>
        </tr>
    </table>
    <table cellpadding="0" cellspacing="0" width="960" bgcolor="white" align="center" height="497">
        <tr>
            <td width="175" height="497">
                <p align="center"><img src="img/mail_sub_bg.gif" width="160" height="577" border="0"></p>
            </td>
            <td width="5" height="497" bgcolor="#F0F0F0">&nbsp;</td>
            <td width="45" height="497">&nbsp;</td>
            <td width="685" height="497">
                <table width="657" align="center" height="541" cellpadding="0" cellspacing="0" bgcolor="white">
                    <tr>
                        <td width="651" height="537">
                            <table width="101%" border="1" cellspacing="0" cellpadding="3" bordercolordark="#FFFFFF" align="center" height="600" bgcolor="white">
                                <tr>
                                    <td align=center width="654" height="568">
                                        <table width="98%" border="0" cellspacing="0" cellpadding="0" height="102%" align="center" bgcolor="white">
                                            <tr>
                                                <td width="635" height="272" bgcolor="white">
                                                    <table width="94%" border="0" cellspacing="1" cellpadding="4" height="472" align="center">
                                                        <tr>
                                                            <td bgcolor="#ebe9f5" width="119"  align="center" height="48">
                                                                <p align="center"><b><font size="3">보내는 사람</font></b></p>
                                                            </td>
                                                            <td bgcolor="#FFFFFF" width="462"  align="left" height="48">
		 <input type='text' size="27" name="sender">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#ebe9f5" width="119"  align="center" height="48">
                                                                <p align="center"><b><font size="3">E - m a i l</font></b></p>
                                                            </td>
                                                            <td bgcolor="#FFFFFF" width="462"  align="left" height="48">
		 <input type='text' size="64" name="sender_email">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#ebe9f5" width="119"  align="center" height="48">
                                                                <p align="center"><b><font size="3">첨 부 파 일</font></b></p>
                                                            </td>
                                                            <td bgcolor="#FFFFFF" width="462"  align="left" height="48">
		   <input type='file' size="51" name="userfile">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#ebe9f5" width="119"  align="center" height="48">
                                                                <p align="center"><b><font size="3">메 일 제 목</font></b></p>
                                                            </td>
                                                            <td bgcolor="#FFFFFF" width="462"  align="left" height="48">
		   <input type='text' size="64" name="subject">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td bgcolor="#ebe9f5" width="119"  align="center" height="274">
                                                                <p align="center"><b><font size="3">발 송 내 용</font></b></p>
                                                            </td>
                                                            <td bgcolor="#FFFFFF" width="462"  align="left" height="274">
                                                                <p align="left">		  <textarea name="contents" cols="64" rows="17"></textarea>
</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr bgcolor='#FFFFFF'>
                                    <td align='right' width="654" height="12">
                                        <p align="right">     <input type='button' value=" 메 일 발 송 " onclick="javascript:send_check()">
&nbsp;&nbsp;&nbsp;	 <input type='reset' value=" 다 시 작 성 ">
 &nbsp;</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="50" height="497"><font size="2">&nbsp;</font></td>
        </tr>
    </table>
<table cellpadding="0" cellspacing="0" width="960" bgcolor="white" align="center" height="10">
    <tr>
        <td width="960" height="10">
            <p align="center"><?include("../public/bottom.inc")?></p>
        </td>
    </tr>
</table>
</form>
</body>
</html>