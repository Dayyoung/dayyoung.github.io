<?php

    include('include/common.inc.php');          
    include('include/func.inc.php');                        
    $dbconn = mysql_connect($db_server, $db_user, $db_pass) or die('디비연결실패');
    mysql_select_db($db_name, $dbconn) or die('디비 선택 실패');      

    $scale = 15;
    
    if( $this_page=="") {
        $this_page = 1;
    }
    #echo $mode;
    if($mode=="" || $mode=="list"){				
      
      $mode = "list";
      $qry1="select count(*) from $db " ;				
      
      $rst1=mysql_query($qry1, $dbconn) or die('qry1:'.mysql_error());
      
      $total_rows=mysql_result($rst1, 0 ,0);
      #echo $total_rows;
      $total_page=ceil($total_rows/$scale);      
      
      #### limit 의 순서변경 - 전체 페이지의 반을 넘을경우 뒤페이지 부터 fetch
      if(ceil($total_page/2) > $this_page){		// 일반...
          $order="m_v_id asc, m_r_id asc";
          $start=($this_page-1)*$scale;
          $t_scale=$scale;
        }else{
          $ef="rev";
          $order="v_id asc, r_id asc";						// 뒤페이지부터 찾기
          $start=$total_rows - $this_page*$scale;
          $t_scale=$scale;
          if($start<0){
            $t_scale=$scale + $start;
            $start =0;
            
          }
          
      }
      
      $qry2="select *, date_format(reg_date, '%Y.%m.%d') as date from $db order by $order limit $start, $t_scale";		
      
      $rst2=mysql_query($qry2, $dbconn) or die('qry2:'.mysql_error());
      $ttl2=mysql_num_rows($rst2);
      
      $add_str="Total: <b>$total_rows</b>&nbsp;&nbsp;&nbsp;Page: <b>$this_page / $total_page</b>";
     
     #####################################
     ####   검색시 
     }else if($mode=="search"){			
      
      $where_str=getSafeSearchArgs();		// 게시물이 많을 경우 제한.
      #$where_str = "";
      $t_value=ereg_replace("_","\_", $value);
      $t_value=ereg_replace("%","\%", $t_value);
      $arr_value=split(" ",$t_value);
      
      for($i=0; $i<count($arr_value); $i++){
        if($i==0) $where_str.=" and ($key like '%$arr_value[$i]%'";
          else $where_str.=" or $key like '%$arr_value[$i]%'";
      }
      $where_str.=")";
     
     ####### quick search
     if($quick_mode=="Y"){
              $order="m_v_id asc, m_r_id asc";
              $start=($this_page-1)*$scale;
              $t_scale=$scale;
     
     ####### 일반검색 
       }else{
       
  	    if(($this_page>1 && $SEARCH[KEY]==$key && $SEARCH[VALUE]==$value)){	// 검색 2페이지 이상에서는 저장해논 쿠키사용. 
  	       $total_rows=$SEARCH[COUNT];
   	      }else{								// 카운트 쿼리를 다시 던지지 않는다.
     	       $qry1="select count(*) from $db $where_str" ;				
     	       #echo $qry1;
     	       $rst1=mysql_query($qry1, $dbconn) or die('qry1:'.mysql_error());
      	       $total_rows=mysql_result($rst1, 0 ,0);
    	    }
     
            $total_page=ceil($total_rows/$scale);
        
            /*if($this_page == 1){		//  검색건수를 쿠키로 구워 2페이지부터 참조
               setcookie("SEARCH[COUNT]", $total_rows);
               setcookie("SEARCH[KEY]", $key);
               setcookie("SEARCH[VALUE]", $value);
      
      	    }*/
      
            ############ 디비 검색 order
           if($ef != "rev"){		// 일반... - 전체 페이지를 반으로 나눠 앞페이지면 앞에서 뒤페이지면 뒤에서 부터 찾기.
              $order="m_v_id asc, m_r_id asc";
              $start=($this_page-1)*$scale;
              $t_scale=$scale;
            }else{						// 뒤페이지부터 찾기
              $order="v_id asc, r_id asc";	
              $start=$total_rows - $this_page*$scale;
              $t_scale=$scale;
              if($start<0){
                 $t_scale=$scale + $start;
                 $start =0;
              }
          }
        if($total_rows<$scale) $t_scale=$total_rows;
      }
      
      $qry2="select *, date_format(reg_date, '%Y.%m.%d') as date from $db $where_str order by $order limit $start, $t_scale";		
      $rst2=mysql_query($qry2, $dbconn) or die('qry2:'.mysql_error());
      $ttl2=mysql_num_rows($rst2);
      if($quick_mode=="Y") $add_str="Quick Search 입니다. 총 검색 건수를 계산하지 않습니다."; 
        else $add_str="검색 결과  Total: <b>$total_rows</b>&nbsp;&nbsp;&nbsp;Page: <b>$this_page / $total_page</b>";
    }
    
    
?>
<html>
<head>
<title> 대원산업(주)에 오신걸 환영합니다.     [ 게시판 ]          </title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<link rel="stylesheet" href="../style/style_1.css" type="text/css">
</head>


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
                        <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                                <td width="600" height="80">
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
                                <td height="70" width="600">
                                    <table width="500" border="0" cellspacing="0" cellpadding="0" align="center">
                                        <tr>
                                            <td colspan="5" height="30">
                                                <form name='search_mode' method='post' action='<?php echo "$PHP_SELF?db=$db"; ?>' onSubmit="return sendIt(this)">
                                                    <table width="400" border="0" cellspacing="0" cellpadding="0" align="right">
                                                        <input type='hidden' name='mode' value='search'>
                                                        <tr>
                                                            <td width="269">
                                                                <div align="right">
                          <select name='key' style="background-color:#ECECEC; border-style:1; font-size: 11; color: #000000; font-family: arial, verdana, geneva, 돋음">
                                                                        <option selected value="title">제 목</option>
                                                                        <option value="contents">내 용</option>
                                                                        <option value="name">글쓴이</option>
                          </select>
                                                                </div>
                                                            </td>
                                                            <td width="81">
                                                                <div align="right">
                          <input type="text" name="value"  style="background-color:#ECECEC; border-style:1; font-size: 11; color: #000000; font-family: arial, verdana, geneva, 돋음" size="10" onKeyDown="if (event.keyCode == 13) {Check(this.form)};">
                                                                </div>
                                                            </td>
                                                            <td width="50">
                                                                <div align="center">
<input type="image" src="images/bu_find.gif" width="42" height="17" border='0'>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </form>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" height="1" bgcolor="#5E5E5E"></td>
                                        </tr>
                                        <tr>
                                            <td height="20" width="35" bgcolor="#EBEBEB">
                                                <div align="center"><font face="Arial, Helvetica, sans-serif"><b>No</b></font></div>
                                            </td>
                                            <td height="20" bgcolor="#EBEBEB" width="262">
                                                <div align="center"><font face="Arial, Helvetica, sans-serif"><b>Tilte</b></font></div>
                                            </td>
                                            <td height="20" width="70" bgcolor="#EBEBEB">
                                                <div align="center"><font face="Arial, Helvetica, sans-serif"><b>Write</b></font></div>
                                            </td>
                                            <td height="20" width="90" bgcolor="#EBEBEB">
                                                <div align="center"><font face="Arial, Helvetica, sans-serif"><b>Date</b></font></div>
                                            </td>
                                            <td height="20" width="45" bgcolor="#EBEBEB">
                                                <div align="center"><font face="Arial, Helvetica, sans-serif"><b>Read</b></font></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="3" width="35" bgcolor="#EBEBEB">
                                                <div align="center">
<img src="images/point.gif" width="30" height="3">
                                                </div>
                                            </td>
                                            <td height="3" bgcolor="#EBEBEB" width="262">
                                                <div align="center">
<img src="images/point.gif" width="120" height="3">
                                                </div>
                                            </td>
                                            <td height="3" width="70" bgcolor="#EBEBEB">
                                                <div align="center">
<img src="images/point.gif" width="50" height="3">
                                                </div>
                                            </td>
                                            <td height="3" width="90" bgcolor="#EBEBEB">
                                                <div align="center">
<img src="images/point.gif" width="50" height="3">
                                                </div>
                                            </td>
                                            <td height="3" width="45" bgcolor="#EBEBEB">
                                                <div align="center">
<img src="images/point.gif" width="30" height="3">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" height="1" bgcolor="#5E5E5E"></td>
                                        </tr>
                                        <script language="JavaScript">
<!--
    function goadmin(theURL){
        window.open(theURL,"","toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=550");
    }
    function admin_insert(theURL){
        window.open(theURL,"","toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=550");
    }    
//-->
                                        
                            
                                        
                                        
                                        
                                        </script>
                                        <?
	if ($total_rows > 0 ) {               
		$page_str=printPage();
		if($ef=="rev"){                   
			for($i=$ttl2-1; $i>=0; $i--){
				mysql_data_seek($rst2, $i);
				$row2=mysql_fetch_array($rst2);
				//$title=shortLongString($row2[title],$TITLE_LENGTH-$row2[depth]); 
				$title=str_replace('"', "&quot;", str_replace("'","&#039;",$row2[title]));
				$depth=$row2[depth]*5;
				if($depth==0) $top_id=$row2[v_id];
				else $top_id="";
	
				echo ("     
					<tr> 
						<td width='35' height='28'> 
							<div align='center'>$top_id</div>
						</td>
						<td height='28' width='262'>
				");
	
				if($depth) {
					for($k=0; $k<=$depth; $k++){
						echo "&nbsp;";
					}
					echo "<img src='images/qna_re.gif' width='12' height='11'>";
				} 
				echo "<a href='read.php?db=$db&id=$row2[id]&key=&value=&mode=list&this_page=$this_page&s_start=&quick_mode=' target='_self'>";
				echo $title;
				echo "</a>";
				
				echo ("       
	
						</td>
						<td width='70' height='28'> 
							<div align='center'>$row2[name]</div>
						</td>
						<td width='90' height='28'> 
							<div align='center'>$row2[date]</div>
						</td>
						<td width='45' height='28'> 
							<div align='center'>$row2[hit]</div>
						</td>
					</tr>
					<tr> 
						<td colspan='5' height='1' bgcolor='#B6B5B5'></td>
					</tr>
				");	
			} # END FOR
		} else {
			for($i=0; $i<$ttl2; $i++){
				mysql_data_seek($rst2, $i);
				$row2=mysql_fetch_array($rst2);
				if($depth==0) $top_id=$row2[v_id];
				else $top_id="";				
				//$title=shortLongString($row2[title],$TITLE_LENGTH-$row2[depth]); 
				$title=str_replace('"', "&quot;", str_replace("'","&#039;",$row2[title]));		
				echo ("     
	
					<tr> 
						<td width='35' height='28'> 
							<div align='center'>$top_id</div>
						</td>
						<td height='28' width='262'>
				");
	
				if($depth) {
					for($k=0; $k<=$depth; $k++){
						echo "&nbsp;";
					}
					echo "<img src='images/qna_re.gif' width='12' height='11'>";
				} 
				echo "<a href='read.php?db=$db&id=$row2[id]&key=&value=&mode=list&this_page=$this_page&s_start=&quick_mode=' target='_self'>";
				echo $title;
				echo "</a>";
				echo ("       	
						</td>
						<td width='70' height='28'> 
							<div align='center'>$row2[name]</div>
						</td>
						<td width='90' height='28'> 
							<div align='center'>$row2[date]</div>
						</td>
						<td width='45' height='28'> 
							<div align='center'>$row2[hit]</div>
						</td>
					</tr>
					<tr> 
						<td colspan='5' height='1' bgcolor='#B6B5B5'></td>
					</tr>
				");	
			}
		}
	} else {
		echo("		
			<tr> 
				<td colspan='5' width='502' height='28'> 
					<div align='center'>자료가 없습니다.</div>
				</td>	
			</tr>
		");
	}             
	
	?>
                                        <tr>
                                            <td colspan='5' height='1' bgcolor='#B6B5B5'></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" height="1" bgcolor="#B6B5B5"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="5" height="30">
                                                <div align="center">
                                                    <? echo $page_str;?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="60" width="600"> 
                                    <?
          		if($db == "tblNews" || $db == "tblPds" ) {
          			echo("
            <div align='center'><a href='pass.php?db=$db&act=new' target='_self'><img src='images/bu_write.gif' width='67' height='20' border='0'></a></div>
            ");
            	} else {
          			echo("
            <div align='center'><a href='write.php?db=$db&act=new' target='_self'><img src='images/bu_write.gif' width='67' height='20' border='0'></a></div>
            ");
				}            		
			?>
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
            <p align="center">&nbsp;</p>
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
