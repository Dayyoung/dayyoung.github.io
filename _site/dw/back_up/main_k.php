<?php
	include("inc/common.inc.php");
	include("inc/db.inc.php");  

	$dbconn = mysql_connect($db_server, $db_user, $db_pass) or die('디비연결실패');
	mysql_select_db($db_name, $dbconn) or die('디비 선택 실패');
  
	$qry="select count(*) from tblNews " ;                          
	$rst=mysql_query($qry, $dbconn) or die('qry:'.mysql_error());
	$total_rows=mysql_result($rst, 0 ,0);
	$start_rows=ceil($total_rows - 2 );  
	if ($start_rows < 0 ) {
		$start_rows = 0;
	}
	$qry="select *, date_format(reg_date, '%Y.%m.%d') as reg_date  from tblNews LIMIT $start_rows,$total_rows" ;
	                          
	$rst=mysql_query($qry, $dbconn) or die('qry:'.mysql_error());
	$count_row = @mysql_num_rows($rst);
 
	
?>



<html>

<head>
<meta http-equiv="content-type" content="text/html; charset=euc-kr">
<title> 대원산업(주)에 오신걸 환영합니다.          </title>
<meta name="generator" content="Namo WebEditor">
</head>

<body bgcolor="white" text="black" link="blue" vlink="purple" alink="red" background="images/Bg_Pint.GIF" bgproperties="fixed">
<table cellpadding="0" cellspacing="0" width="960" bgcolor="white" align="center" height="10">
    <tr>
        <td width="960" height="10">
            <p align="center"><?include("public/menu.inc")?>
</p>
        </td>
    </tr>
</table>
<table border="0" width="960" align="center" bgcolor="white" height="586">
    <tr>
        <td width="571" height="582" background="images/product_pack.jpg">
            <p align="center">&nbsp;</p>
        </td>
        <td width="379" height="582">
            <p>&nbsp;</p>
            <table cellpadding="0" cellspacing="0" width="340" align="center">
                <tr>
                    <td width="340">
                        <p align="center"><font size="2">&nbsp;대원산업(주)는 1971년 설립 이후 고품질 및</font></p>
                        <p align="center"><font size="2">차별화된 제품으로 고객만족을 통해 &nbsp;포장산업의</font></p>
                        <p align="center"><font size="2">미래를 열어나가는&nbsp;선도적 기업입니다.</font></p>
                    </td>
                </tr>
            </table>
            <p>&nbsp;</p>
			
			
			
			
            <table width="339" height="79" align="center" bgcolor="white" border="1">
                <tr>
                    <td width="329" height="73">
                        <table width="260" border="0" cellspacing="0" cellpadding="0" align="center" height="34">
                            <tr>
                                <td valign="top" width="1" height="34">
                                    <div align="center">
                                        <p>&nbsp;</p>
                                        <p>&nbsp;</p>
                                    </div>
                                </td>
                                <td width="250" bgcolor="white" height="34">
                                    <table width="216" border="0" cellspacing="0" cellpadding="0" align="center">
                                        <?
	if($count_row!=0){
		for($i=$count_row-1; $i>=0; $i--){
			mysql_data_seek($rst, $i);
			$row=mysql_fetch_array($rst);
		#while($row = mysql_fetch_array($rst)) {
			echo("                    <tr> 
                      <td width='25' height='25'> 
                        <div align='right'><img src='images/news_point.gif' width='16' height='19'></div>
                      </td>
                      <td width='227'><a href='board/read.php?db=tblNews&id=$row[id]' target='_self'>$row[title]</a></td>
                      <td width='100'> 
                        <div align='right'>[ $row[reg_date] ]</div>
                      </td>
                    </tr>
                    <tr> 
                      <td colspan='3'><img src='img/point_line.gif' width='320' height='1'></td>
                    </tr>
	    	
			");
		
		}	//while문 닫기    
	}	//if문 닫기
	else{
		echo("	
                    <tr> 
                      <td width='25' height='25'> 
                        <div align='right'><img src='img/news_point.gif' width='16' height='19'></div>
                      </td>
                      <td colspan='2' width='227'><div align='center'>자료가 없습니다.</div></td>
                    </tr>
                    <tr> 
                      <td colspan='3'><img src='img/point_line.gif' width='320' height='1'></td>
                    </tr>

		");
	}        		

?>
                                        <tr>
                                            <td colspan="3" width="216">
                                                <p align="center"><img src="img/point_line.gif" width="320" height="1"></p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>



            <p>&nbsp;</p>
            <p> </p>
            <table width="340" height="260" cellpadding="0" cellspacing="0" align="center">
                <tr>
                    <td width="170" height="130">
                        <p align="center"><img src="images/main_img1.gif" border="0" width="151" height="120"></p>
                    </td>
                    <td width="170" height="130">
                        <p align="center"><img src="images/main_img2.gif" border="0" width="151" height="120"></p>
                    </td>
                </tr>
                <tr>
                    <td width="170" height="130">
                        <p align="center"><img src="images/main_img3.gif" border="0" width="151" height="120"></p>
                    </td>
                    <td width="170" height="130">
                        <p align="center"><img src="images/main_img4.gif" border="0" width="151" height="117"></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table cellpadding="0" cellspacing="0" width="960" bgcolor="white" align="center" height="15">
    <tr>
        <td width="960" height="15">
            <p align="center"><?include("public/bottom.inc")?></p>
        </td>
    </tr>
</table>
</body>

</html>