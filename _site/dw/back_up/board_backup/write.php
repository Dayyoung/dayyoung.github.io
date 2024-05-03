<?php
	include('include/common.inc.php');
	include('include/db.inc.php'); 
    $dbconn = mysql_connect($db_server, $db_user, $db_pass) or die('디비연결실패');
    mysql_select_db($db_name, $dbconn) or die('디비 선택 실패');  
    
    if ( $act == "edit" ) {
		$qry="select *, date_format(reg_date, '%Y.%m.%d') as date from $db where id = $id " ;                          
		$rst=mysql_query($qry, $dbconn) or die('qry:'.mysql_error());
		$count_row = @mysql_num_rows($rst);
		$row = mysql_fetch_array($rst);    
		$s_id = $row[id];
		$s_v_id = $row[v_id];
		$s_r_id = $row[r_id];
        $s_contents = $row[contents];		
		$s_name = $row[name];
		$s_title = $row[title];
		$s_file = $row[attach_file_name];
		$s_size = $row[attach_file_size];
		$s_email = $row[email];
    } else if ( $act == "reply" ) {
		$qry="select *, date_format(reg_date, '%Y.%m.%d') as date from $db where id = $id " ;                          
		$rst=mysql_query($qry, $dbconn) or die('qry:'.mysql_error());
		$count_row = @mysql_num_rows($rst);
		$row = mysql_fetch_array($rst);    
		$s_id = $row[id];
 
   		if($row1[html]=="Y") $html_nl="<br>";
  			$name=$row[name];
  
  		$s_title=ereg_replace("^", "RE:",$row[title]);
  		$s_contents=ereg_replace("\r\n", "\n", $row[contents]);
  		$div = "--------------------------------------------\n";
  		$s_contents=ereg_replace("^", " \n $html_nl$div $html_nl:: $name wrote :: $html_nl\n ",$s_contents);
  
  		if($row[html]=="Y") $html_y="checked";
    		else $html_n="checked";
    
		  $s_v_id=$row[v_id];
		  $s_r_id=$row[r_id];
		  $s_depth=$row[depth];   
    }
         
?>
<html>
<head>
<title> 대원산업(주)에 오신걸 환영합니다.     [ 게시판 ]          </title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../style/style_1.css" type="text/css">
</head>
<SCRIPT language=javascript>
function sendIt(){
var sf=document.write;
if(!sf.name.value){
            alert('이름을 입력해 주세요.');
            sf.name.focus();
            return;
}  

 if(!sf.password.value){
            alert('패스워드를 입력해 주세요. \r\n수정, 삭제시 필요합니다.');
            sf.password.focus();
            return;
}

 if(!sf.title.value){
            alert('제목을 입력해 주세요.');
            sf.title.focus();
            return;
}
sf.submit();
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
                    <td width="50">&nbsp;</td>
                    <td width="636">
                        <table width="259" border="0" cellspacing="0" cellpadding="0" height="460" align="center">
                            <tr>
                                <td width="259">
                                    <div align="center">
                                        <?
            	if ($db == "tblNews") {
             		echo("<img src='images/news_title.gif' width='544' height='51'><br>");
             	} else if ($db == "tblBoard") {
              		echo("<img src='images/board_title.gif' width='544' height='51'><br>");
              	} else if ($db == "tblPds") {
              		echo("<img src='images/data_title.gif' width='544' height='51'>");
              	}
			?>            
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td height="70" width="259">
                                    <form name="write" method="post" action="./action.php" enctype="multipart/form-data">
        	
                                        <p><input type="hidden" name='act' value='<? echo $act; ?>'>
			<input type='hidden' name='db' value='<? echo $db; ?>'>
			<input type='hidden' name='key' value='<? echo $key; ?>'>
			<input type='hidden' name='value' value='<? echo $value; ?>'>
			<input type='hidden' name='this_page' value='<? echo $this_page; ?>'>
			<input type='hidden' name='id' value='<? echo $s_id; ?>'>
			<input type='hidden' name='v_id' value='<? echo $s_v_id; ?>'>
			<input type='hidden' name='r_id' value='<? echo $s_r_id; ?>'>
			<input type='hidden' name='delete_file' value='<? echo $s_file; ?>'>
			<input type='hidden' name='delete_file_size' value='<? echo $s_size; ?>'>
			<input type='hidden' name='depth' value='<? echo $s_depth; ?>'>          </p>
                                        <p>&nbsp;</p>
                                        <table width="560" align="center" border="1">
                                            <tr>
                                                <td bgcolor="#E9E9E9" width="104" height="30">
                                                    <div align="right">
                                                        <p align="center">보내는 사람</p>
                                                    </div>
                                                </td>
                                                <td width="440" height="30"> 
                  <input type="text" name="name" style=border-style:1; font-size: 12; color: #000000; font-family: arial, verdana, geneva, 돋음" size="16" maxlength="12" value=<? echo $s_name;?>>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#E9E9E9" width="104" height="30">
                                                    <div align="right">
                                                        <p align="center"><span style="font-size:11pt;">E - m a i l</span></p>
                                                    </div>
                                                </td>
                                                <td width="440" height="30"> 
                  <input type="text" name="email" style=border-style:1; font-size: 12; color: #000000; font-family: arial, verdana, geneva, 돋음" size="60" value=<? echo $s_email;?>>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#E9E9E9" width="104" height="30">
                                                    <div align="right">
                                                        <p align="center"><span style="font-size:11pt;">제 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;목</span></p>
                                                    </div>
                                                </td>
                                                <td width="440" height="30"> 
                  <input type="text" name="title" style=border-style:1; font-size: 12; color: #000000; font-family: arial, verdana, geneva, 돋음" size="60" value=<? echo $s_title;?>>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#E9E9E9" width="104" height="158">
                                                    <div align="right">
                                                        <p align="center"><span style="font-size:11pt;">글 &nbsp;&nbsp;내 &nbsp;&nbsp;용</span></p>
                                                    </div>
                                                </td>
                                                <td height="150" width="440"> 
                  <textarea name="contents" style=border-style:1; font-size: 12; color: #000000; font-family: arial, verdana, geneva, 돋음" cols="60" rows="10"><? echo $s_contents;?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#E9E9E9" width="104" height="30">
                                                    <div align="right">
                                                        <p align="center"><span style="font-size:11pt;">첨 부 파 일</span></p>
                                                    </div>
                                                </td>
                                                <td width="440" height="30"> 
                  <input type="file" name="upfile" style=border-style:1; font-size: 12; color: #000000; font-family: arial, verdana, geneva, 돋음" size="46">
                  &nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="#E9E9E9" width="104" height="30">
                                                    <div align="right">
                                                        <p align="center"><font size="2">Pass Word</font></p>
                                                    </div>
                                                </td>
                                                <td width="440" height="30"> 
                  <input type="password" name="password" style=border-style:1; font-size: 12; color: #000000; font-family: arial, verdana, geneva, 돋음" size="16" maxlength="6">

                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td height="24" width="259">
                                    <div align="center"><a href="javascript:sendIt('new')"><img src="images/bu_write.gif" width="67" height="20" border="0"></a><font color="#FFFFFF">.....</font><a href="list.php?db=<? echo $db; ?>"><img src="images/bu_can.gif" width="67" height="20" border="0"></a></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="50">&nbsp;</td>
                </tr>
                <tr>
                    <td width="50">&nbsp;</td>
                    <td width="636">&nbsp;</td>
                    <td width="50">&nbsp;</td>
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
