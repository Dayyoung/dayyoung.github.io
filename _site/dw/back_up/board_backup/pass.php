<html>
<head>
<title> 대원산업(주)에 오신걸 환영합니다.     [ 게시판 ]          </title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../style/style_1.css" type="text/css">

</head>

<SCRIPT language=javascript>
<!--
  function sendIt(tf){
    if(!tf.password.value){
	  alert("패스워드를 입력해 주세요.");
	  tf.password.focus();
	  return false;
	 }else{
	  return true;
	}
	if(!tf.user_id.value) {
		alert("ID를 입력해 주십시요.");
		tf.user_id.focus();
		return false;
	} else {
		return true;
	}
  }
--> 
</SCRIPT>



<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" background="../images/Bg_green.GIF">

<table cellpadding="0" cellspacing="0" width="960" bgcolor="white" align="center" height="10">
    <tr>
        <td width="960" height="10">
            <p align="center"><?include("../public/menu.inc")?></p>
        </td>
    </tr>
</table>


<table border="0" width="966" align="center" bgcolor="white">
    <tr>
        <td width="960">
            <p>&nbsp;</p>
            <table border="0" width="750" align="center">
                <tr>
                    <td width="740">
                        <table width="64%" border="0" cellspacing="0" cellpadding="0" height="368" align="center">
                            <tr>
                                <td width="36" valign="top" height="368"></td>
                                <td height="368" valign="top" width="598">
                                    <? if($db == "tblUrl" || $db == "tblBox" || $db == "tblNews" || $db == "tblPds" ){     	
    	echo("<form name='write' method='post' action='./action_url.php'>");
    } else {
    	echo("<form name='write' method='post' action='./action.php'>");
    }
    ?>
			<input type="hidden" name='act' value='<? echo $act; ?>'>
			<input type='hidden' name='db' value='<? echo $db; ?>'>
			<input type='hidden' name='key' value='<? echo $key; ?>'>
			<input type='hidden' name='value' value='<? echo $value; ?>'>
			<input type='hidden' name='this_page' value='<? echo $this_page; ?>'>
	      	<input type='hidden' name='id' value='<? echo $id; ?>'>
	      	<input type='hidden' name='v_id' value='<? echo $v_id; ?>'>
	      	<input type='hidden' name='r_id' value='<? echo $r_id; ?>'>	    
                                    <table width="561" border="0" cellspacing="0" cellpadding="0" align="center">
                                        <tr>
                                            <td width="561" height="80">
                                                <div align="center">
<img src="images/admin_title.gif" width="544" height="52">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="187" width="561">
                                                <table width="300" border="0" align="center" cellpadding="0" cellspacing="0" height="52">
                                                    
<!--<tr> 
                <td height="30"><div align="right"><strong>I D</strong></div></td>
                <td></td>
                <td><input type="text" name="user_id" style="background-color:#ECECEC; border-style:1; font-size: 11;                     color: #000000; font-family: arial, verdana, geneva, 돋음" size="15" maxlength="12"></td>
                </tr>-->
                                                    <tr>
                                                        <td width="100" height="3">
                                                            <div align="right">
<img src="images/point.gif" width="80" height="3">
                                                            </div>
                                                        </td>
                                                        <td width="18" height="3"></td>
                                                        <td width="182" height="3"></td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td height="27">
                                                            <div align="right"><strong>Pass</strong></div>
                                                        </td>
                                                        <td height="27"></td>
                                                        <td height="27">
                                                            <form name="form1">
<input type="password" name="password" style="background-color:#ECECEC; border-style:1; font-size: 11; color: #000000; font-family: arial, verdana, geneva, 돋음" size="15" maxlength="12">
                                                            </form>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="11">
                                                            <div align="right">
<img src="images/point.gif" width="80" height="3">
                                                            </div>
                                                        </td>
                                                        <td height="11"></td>
                                                        <td height="11"></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="60" width="561">
                                                <div align="center">
<input type="image" src="images/bu_ok.gif" width="67" height="20" border="0">
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
			
                                    </form>        
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="740">
                        <p>&nbsp;</p>
                    </td>
                </tr>
            </table>
            <p>&nbsp;</p>
        </td>
    </tr>
</table>

<table cellpadding="0" cellspacing="0" width="960" bgcolor="white" align="center" height="10">
    <tr>
        <td width="960" height="10">
            <p align="center"><?include("../public/bottom.inc")?></p>
        </td>
    </tr>
</table>

</body>
</html>
