<?php

  include('include/common.inc.php');
  include('include/db.inc.php');
  include('include/func.inc.php');

  if($act=="new"){
    if(crypt($password,$db_password)==$db_password || $password==$admin_pass){
		if ( $db == "tblBox" || $db == "tblUrl" ) {
	    	echo "<meta http-equiv='Refresh' content='0;URL=site_write.php?db=$db&act=new'>";
		} else {
			echo "<meta http-equiv='Refresh' content='0;URL=write.php?db=$db&act=new'>";
		}
    
     }else{
      jvAlert('패스워드가 일치하지 않습니다.', 'history.go(-1);'); 
    }

   }else if($act=='reply'){
   }else if($act=='edit'){
   	
    if(crypt($password,$db_password)==$db_password || $password==$admin_pass){
	
	    echo "<meta http-equiv='Refresh' content='0;URL=site_write.php?db=$db&act=$act&id=$id&this_page=$this_page&key=$key&value=$value&v_id=$v_id&r_id=$r_id'>";
    
     }else{
      jvAlert('패스워드가 일치하지 않습니다.', 'history.go(-1);'); 
    }
    
    
   }else if($act=='delete'){
    
    $qry10="select count(b.id) from $db as a, $db as b where a.id=$id and a.v_id=b.v_id and b.r_id=a.r_id-1 and b.depth=a.depth+1;";
    $rst10=mysql_query($qry10, $dbconn);
    if(mysql_result($rst10,0,0)>0){
      jvAlert('답변글이 있는 글은 삭제할 수 없습니다.','history.go(-1);');
      exit;
    }
    
    $qry1="select password,attach_file_name,attach_file_size, title,v_id,r_id from $db where id=$id";
    $rst1=mysql_query($qry1, $dbconn) or die('qry1:'.mysql_error());
    $db_password=mysql_result($rst1,0,0) or die('삭제되었거나 존재하지 않는 게시물입니다.');
    $delete_file=mysql_result($rst1,0,1);
    $delete_file_size=mysql_result($rst1,0,2);
    $title=mysql_result($rst1, 0, 3);
    $t_v_id=mysql_result($rst1, 0, 4);
    $t_r_id=mysql_result($rst1, 0, 5);
    
    if(crypt($password,$db_password)==$db_password || $password==$admin_pass){
      $qry2="delete from $db where id=$id";
      mysql_query($qry2, $dbconn) or die(jvAlert('글 삭제에 실패했습니다.','history.go(-1);'));
 
      if($delete_file!='' && $delete_file_size!=0 ) unlink("$ATTACH_FILE_DIR/$delete_file");
      ## 메모 삭제.
      $qry3="delete from $BOARD_COMMENT where t_table='$db' and t_id='$id'";	
      mysql_query($qry3, $dbconn);
      
      $qry3="update $db set r_id=r_id+1, m_r_id=-r_id where v_id=$t_v_id and r_id<$t_r_id";
      mysql_query($qry3);
      
      jvAlert('삭제되었습니다.');
 	  if ($db == "tblUrl" || $db=="tblBox" ) {
 	  	echo "<meta http-equiv='Refresh' content='0;URL=site.php?db=$db&mode=$mode&key=$key&value=$value&this_page=$this_page'>";
 	  } else {
 	  	echo "<meta http-equiv='Refresh' content='0;URL=list.php?db=$db&mode=$mode&key=$key&value=$value&this_page=$this_page'>";
	  }      
      #echo "<meta http-equiv='Refresh' content='0;URL=site.php?db=$db'>";
    
     }else{
      jvAlert('패스워드가 일치하지 않습니다.', 'history.go(-1);'); 
    }
   
   
   }else if($act=="comment_delete"){	// comment 삭제.

     
  }
  

?>