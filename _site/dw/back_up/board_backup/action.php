<?php

  include('include/common.inc.php');
  include('include/db.inc.php');
  include('include/func.inc.php');
  include('include/FileClass.php');
  
    $name=ereg_replace(" ", "", trim($name));
    $remote_ip=getenv('REMOTE_ADDR');
    $title=preg_replace("/<.*>/U", "",$title);	//제목은 모든 태그를 제거한다.
    $home_url=checkUrl($home_url);
    if($db == "tblUrl"){
    	if($home_url == "")
    		jvAlert('URL이 올바르지 않습니다.', 'history.go(-1);'); 	
    }
    $c_time_stamp=time();
    if($html=="N"){
      $contents=htmlspecialchars($contents);
    }
    

  if($act=="new"){
    
    $password=crypt(trim($password));
    $n_id=getThisId($db);
    
    //jvAlert($upfile_name,'');
    if($upfile_name!='')	//파일 업로드시
    {
    	$path = "/home/daewon-ind/attach_files/$db/";
    	$upfile1 = filesave($path,$upfile,md5(uniqid(rand()*microtime())).".".getExt($upfile_name));
    	//jvAlert($upfile1,'');
    }
    
    $qry1="insert into $db (v_id,m_v_id,r_id,depth,name,password,email,home_url,remote_ip,title,contents,attach_file_name,real_attach_file_name, attach_file_size,html,reg_date) "
    	 ."values('$n_id','-$n_id',0,0,'$name','$password','$email','$home_url','$remote_ip','$title','$contents','$upfile_name','$upfile1','$upfile1_size','$html',now());";
    mysql_query($qry1, $dbconn) or die('qry1:'.mysql_error());   

    insertTitleIndex($db, $title);		//제목 인덱스 생성
	if ($db == "tblUrl" || $db=="tblBox" ) {
		echo "<meta http-equiv='Refresh' content='0;URL=site.php?db=$db'>";
	} else {
    	echo "<meta http-equiv='Refresh' content='0;URL=list.php?db=$db'>";
    }
    
   }else if($act=='reply'){
    
    if($upfile_name!='')	//파일 업로드시
    {
    	$path = "/home/daewon-ind/attach_files/$db/";
    	$upfile1 = filesave($path,$upfile,md5(uniqid(rand()*microtime())).".".getExt($upfile_name));
    	
    }
     
    $password=crypt(trim($password));
    
    
    // 2002.1.23 수정 r_id, v_id, depth 를 html 문에서 넘기는것 무시 새로 갱신  
    $qry1="select * from $db where id=$id";
  	$rst1=mysql_query($qry1, $dbconn) or die('qry1:'.mysql_error());
  	$row1=mysql_fetch_array($rst1) or die(jvAlert('게시물이 삭제되었거나 존재하지 않습니다.','history.go(-1);'));
    $r_id = $row1[r_id];
    $v_id = $row1[v_id];
    $depth = $row1[depth];
    
    // 여기까지. 2002.1.23
    
    
    $qry3="update $db set r_id=r_id-1, m_r_id=-r_id where v_id=$v_id and r_id<$r_id";
     mysql_query($qry3, $dbconn);
    
    $depth++;
    $r_id--;
    
//    $contents=ereg_replace("\r\n", "\n", $contents);
//    $contents=ereg_replace("\n>", "\n&gt;", $contents);
    $m_v_id=-$v_id;
    $m_r_id=-$r_id;
    $qry2="insert into $db (v_id,r_id,m_v_id,m_r_id,depth,name,password,email,home_url,remote_ip,title,contents,attach_file_name,real_attach_file_name, attach_file_size,html,reg_date) "
    		 ."values('$v_id',$r_id,'$m_v_id','$m_r_id',$depth,'$name','$password','$email','$home_url','$remote_ip','$title','$contents','$upfile_name','$upfile1','$upfile1_size','$html',now());";
    mysql_query($qry2, $dbconn) or die('qry2:'.mysql_error());   
     
    echo "<meta http-equiv='Refresh' content='0;URL=list.php?db=$db&mode=$mode&key=$key&value=$value&this_page=$this_page&s_start=$s_start&quick_mode=$quick_mode'>";
  
   }else if($act=='edit'){
   
    $qry1="select password, attach_file_name, attach_file_size from $db where id=$id";
    $rst1=mysql_query($qry1, $dbconn) or die('qry1:'.mysql_error());
    $db_password=mysql_result($rst1,0,0) or die('삭제되었거나 존재하지 않는 게시물입니다.');
    $delete_file=mysql_result($rst1,0,1);
    $delete_file_size=mysql_result($rst1,0,2);
    
//    $contents=ereg_replace("\r\n", "\n", $contents);
//    $contents=ereg_replace("\n>", "\n&gt;", $contents);
    
    if(crypt($password,$db_password)==$db_password || $password==$admin_pass){
      
       if($delete_file!='' && $delete_file_size!=0 ) //업로드파일이 있는 경우 삭제
         unlink("$ATTACH_FILE_DIR/$delete_file");
        
       if($attach_file!="none" && $attach_file_name!='' && $attach_file_size!=0)	//파일 업로드시
       		$save_file=uploadFile(); 
       
      $qry2="update $db set name='$name', email='$email', home_url='$home_url', title='$title', contents='$contents', "
      	  ."attach_file_name='$save_file[name]',real_attach_file_name='$save_file[real_name]', attach_file_size='$save_file[size]',html='$html', reg_date=now() where id=$id";
      mysql_query($qry2, $dbconn) or die(jvAlert('글 수정에 실패했습니다.','history.go(-1);'));
 	  if ($db == "tblUrl" || $db=="tblBox" ) {
 	  	echo "<meta http-equiv='Refresh' content='0;URL=site.php?db=$db&mode=$mode&key=$key&value=$value&this_page=$this_page'>";
 	  } else {
 	  	echo "<meta http-equiv='Refresh' content='0;URL=list.php?db=$db&mode=$mode&key=$key&value=$value&this_page=$this_page'>";
	  }
      
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
	   
      #echo "<meta http-equiv='Refresh' content='0;URL=list.php?db=$db'>";
    
     }else{
      jvAlert('패스워드가 일치하지 않습니다.', 'history.go(-1);'); 
    }
   
   
   }else if($act=="comment_delete"){	// comment 삭제.
     $qry1="select pass from $BOARD_COMMENT where id='$c_id'";
     $rst1=mysql_query($qry1, $dbconn);
     if(mysql_num_rows($rst1)==0){
       jvAlert("삭제되었거나 존재하지 않는 메모입니다.","location.href='./list.php?db=$db'");
       exit;
      }else{
       $db_pass=mysql_result($rst1, 0, 0);
       if(crypt($password,$db_pass)==$db_pass){
          $qry2="delete from $BOARD_COMMENT where id='$c_id'";
          mysql_query($qry2, $dbconn);
        }else{
         jvAlert('패스워드가 일치하지 않습니다.', 'history.go(-1);'); 
       }
      jvAlert('삭제되었습니다.');
      echo "<meta http-equiv='Refresh' content='0;URL=./view.php?db=$db&id=$id&mode=$mode&key=$key&value=$value&this_page=$this_page&s_start=$s_start&quick_mode=$quick_mode'>";
     }
     
  }
  

?>