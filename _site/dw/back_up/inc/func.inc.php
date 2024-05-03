<?php

  
 ## 앨러트
 Function jvAlert($alert_str, $add_commend=''){
  
  echo "<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
  	<Script Language='JavaScript'>
  	alert(\"$alert_str\");
  	$add_commend;
  	</Script> \n";
 }
 
  if(empty($db)){
    jvAlert("디비명을 입력해 주세요.(../board/list.php?db=$db)", "history.go(-1);");
    exit;
  }

  /*if($FILE_UPLOAD != "Y") { 
    session_start();
    if (!(session_is_registered('SESSION_LOGIN') && $SESSION_LOGIN == md5($admin_pass))) {
   	 	$file_h_tag="<!-- ";
    	$file_e_tag="-->";
    }	
  }*/
  if($TABLE_WIDTH<=100) $TABLE_WIDTH="$TABLE_WIDTH%";

  $dbconn = mysql_connect($db_server, $db_user, $db_pass) or die('디비연결실패');
  mysql_select_db($db_name, $dbconn) or die('디비 선택 실패');
 
  
  ## 새게시물 글번호 정하기. 
  Function getThisId($db){
    
    global $dbconn;
    
    $qry1="select max(v_id) from $db";
    $rst1=mysql_query($qry1, $dbconn) or die('qry1:'.mysql_error());
    $v_id=mysql_result($rst1, 0,0);
    if($v_id) $v_id++; else $v_id=1;
    return($v_id);
  }
  
  
   Function getSafeSearchArgs(){
    global $dbconn, $db, $SEARCH, $scale, $this_page, $SAFE_SEARCH_MAX_ROWS, $s_start, $ef;
    
    if($this_page==1){
      $qry1="select max(v_id) from $db";
      $rst1=mysql_query($qry1, $dbconn);
      $max_v_id=mysql_result($rst1, 0, 0);
     }else{
              #### limit 의 순서변경 - 전체 페이지의 반을 넘을경우 뒤페이지 부터 fetch
      $total_rows=$SEARCH[COUNT];
      $total_page=ceil($total_rows/$scale);
      if(ceil($total_page/2) > $this_page) $ef="for";
        else $ef="rev";
    }
     
      if($ef=="rev"){	// 앞에서 부터 검색
        $range="where v_id>$s_start-$SAFE_SEARCH_MAX_ROWS and v_id <=$s_start";
       }else{		// 최근 게시물부터 검색
        if(!$s_start) $s_start=$max_v_id;
        $t_start=-$s_start;
        $range="where m_v_id >= $t_start and m_v_id < $t_start + $SAFE_SEARCH_MAX_ROWS";
      }
    return $range;
  } 
  


 
 
 
 ## 문자열 자르기
 Function shortLongString($str, $lenth, $dot=''){
   
   if(strlen($str) <= $lenth){
     return $str;
    }else{
     $k=0;
     for($i=0; $i<$lenth*2; $i++){
     
       if(ord(substr($str,$i,1))>127){		## 한글포함
        $i++;
         $k++;
        }else{
         $k++;
       }
       if($k>=$lenth)
         break;
     }
    if($dot=="NoDot")
       return substr($str, 0,$i+1);
     else 
      return substr($str, 0,$i+1)." ...";
   }
 }
 
 
 ## 홈페이지 체크
 
 Function checkUrl($url){
    if (!eregi("[a-zA-Z0-9\-\.]+\.[a-zA-Z0-9\-\.]+.*", $url)) {
	return;
    }
    /* 한글이 포함되었는지 체크 */
    for($i = 1; $i <= strlen($url); $i++) {
	if ((Ord(substr("$url", $i - 1, $i)) & 0x80)) {
	    return;
	}
    }
    $url = eregi_replace("^http.*://", "", $url);
    $url = eregi_replace("^", "http://", $url);

    return $url;
 }
  
 
 ## 파일업로드
 
 Function uploadFile(){
   
   global $ATTACH_FILE_MAX_SIZE, $ATTACH_FILE_DIR, $attach_file, $attach_file_name, $attach_file_size;
      
     $save_file_name=$attach_file_name.".".date("YmdHis");
     $attc[size]=$attach_file_size;		//byte 
     $attc[name]=$save_file_name;		// 저장되는 파일 이름
     $attc[real_name]=$attach_file_name;	// 업로드시 파일네임
     if($attc[size]>$ATTACH_FILE_MAX_SIZE*1024){
       jvAlert("파일업로드는 ".round($ATTACH_FILE_MAX_SIZE/1024, 2)."M 이하입니다.",'history.go(-1);');
       exit;
     }
     jvAlert($ATTACH_FILE_DIR,'');
     if(!is_dir($ATTACH_FILE_DIR)){	// 파일 저장디렉토리가 존재하지 않으면
       mkdir($ATTACH_FILE_DIR,0755);
     }
 
      move_uploaded_file($attach_file, "$ATTACH_FILE_DIR/$save_file_name");
     return $attc;
 }  
  
 
 ## 이전 다음 페이지
 
 Function getPreNext($rst, $id, $v_id){
 
   global $dbconn, $db, $mode, $key, $value, $SEARCH, $SAFE_SEARCH_MAX_ROWS;
   
   $flag=false;
        
   if($mode=='search'){

     if($SEARCH[COUNT]==1) return ;	// 검색 결과가 하나일 경우 이전 다음 없다.
     
     $t_value=ereg_replace("_","\_", $value);
     $t_value=ereg_replace("%","\%", $t_value);
     $arr_value=split(" ",$t_value);
   
     for($i=0; $i<count($arr_value); $i++){
       if($i==0){
          if($key=="name" ||$key=="email") $where_str="and ($key like '$arr_value[$i]%'";
           else $where_str="and ($key like '%$arr_value[$i]%'";
        }else{ $where_str.=" or $key like '%$arr_value[$i]%'"; }
    
     }
     $where_str.=")";
   }
   
   while($row=mysql_fetch_array($rst)){
       if($row[id]==$id){		// 현재글의 전후를 이전 다음글로 ...
         $go[prev]=$prev;
         $flag=true;
        }else if($flag){
         $go[next]=$row[id];
         break;
       }
       $prev=$row[id];

   }
   if(!$go[prev] || !isset($go[prev])){
     $qry1="select id from $db where v_id>$v_id $where_str  and v_id<$v_id+$SAFE_SEARCH_MAX_ROWS order by v_id asc, r_id asc limit 1";
     $rst1=mysql_query($qry1, $dbconn);
     $go[prev]=@mysql_result($rst1, 0, 0);
   }



   if(!$go[next] || !isset($go[next])){
        $qry2="select id from $db where m_v_id>-$v_id $where_str and m_v_id<-$v_id+$SAFE_SEARCH_MAX_ROWS order by m_v_id asc, m_r_id asc limit 1";
        $rst2=mysql_query($qry2, $dbconn);
        $go[next]=@mysql_result($rst2, 0, 0);
   }
   
   return $go;
   
} 


// 다음글을 가져오는 ...
 Function getNextId($nid){
     global $dbconn, $db, $mode, $key, $value;
       if($nid<1) return false;
       $qry1="select id from $db where v_id=$nid and r_id=0";
       $rst1=mysql_query($qry1, $dbconn);
       $id=@mysql_result($rst1, 0, 0);
       if($id) return $id;
         else return getNextId(--$nid);
 }
 
 
 ## 리스트 출력
 
 Function printList($row1,$c_dir, $id=0){ 
   
   global $dbconn, $BOARD_COMMENT, $key, $value, $mode,$quick_mode, $this_page, $db, $s_start, $cookie_email,$TITLE_LENGTH, $NAME_LENGTH, $SKIN;
   
      
   $title=shortLongString($row1[title],$TITLE_LENGTH-$row1[depth]); 
   $title=str_replace('"', "&quot;", str_replace("'","&#039;",$title));
   
   if($id==$row1[id]) $title="<b>$title</b>";
   $name=shortLongString($row1[name],$NAME_LENGTH,'NoDot');
   $depth=$row1[depth]*10;
   if($depth==0) $top_id=$row1[v_id];
     else $top_id="";
     
   if($row1[attach_file_size]!=0)
     $file="<a href='$c_dir"."download.php?db=$db&id=$row1[id]&file_name=$row1[attach_file_name]&real_file_name=$row1[real_attach_file_name]'><img src='$c_dir"."/skin/$SKIN/img/check.gif' border='0'></a>";
    else
     $file="<img src='$c_dir"."skin/$SKIN/img/dot.gif' width='24' border='0'>";
    
   $qry1="select count(*) from  $BOARD_COMMENT where t_table='$db' and t_id='{$row1[id]}'";
   $rst1=mysql_query($qry1, $dbconn);
   $comment_cnt=mysql_result($rst1, 0, 0);	//메모갯수
   if($comment_cnt) $comment_str="<font size='1'> [$comment_cnt]</font>";
     else $comment_str="";
/*   if($row1[date]==date("Y.m.d")) $new="<img src='$c_dir"."img2/new.gif' width='36' height='19' border='0'>";
     else $new="<img src='$c_dir"."img2/nothing.gif' width='36' height='19' border='0'>";
*/
    include("./skin/$SKIN/html/list_tr.html");
 
 }
  
  ## 페이지 출력 
 Function printPage(){
  global $total_page, $scale, $key, $value, $mode, $this_page, $PHP_SELF, $db, $ef, $s_start, $continue_search,$quick_mode, $new_start;
    
    $url_value=urlencode($value);
    
    $rt_str="<a href='$PHP_SELF?db=$db&key=$key&value=$url_value&mode=$mode&this_page=1&quick_mode=$quick_mode'>&lt;&lt;Pre&nbsp;</a>\n";
    
      if($quick_mode=="Y"){
          $ii=-10;
          $total_page=$this_page; 
        }else {$ii=-4;}
  
      for($i = $ii; $i <= 4; $i++) {
	  if($i){
	      $tmp = $this_page + $i;
	      if($tmp >= 1 && $tmp <= $total_page) {
          	$rt_str.="<a href=$PHP_SELF?db=$db&key=$key&value=$url_value&mode=$mode&this_page=$tmp&s_start=$s_start&quick_mode=$quick_mode>[$tmp]</a>\n";
	      }
	  } else {
	      $rt_str.="<b>$this_page</b>\n";
	      if($quick_mode=="Y" && !$continue_search && $new_start>0){
	          $n_page=$this_page+1;
	          $rt_str.="<a href=$PHP_SELF?db=$db&key=$key&value=$url_value&mode=$mode&this_page=$n_page&s_start=$s_start&quick_mode=$quick_mode>다음페이지[$n_page]</a>  \n";
	          break;
	      }  
	      
	  }
      }
  
  
     if($continue_search && $new_start>0) $rt_str.=$continue_search;	// 다음 xxx 건에서 검색
       else if($quick_mode !="Y") $rt_str.="<a href=$PHP_SELF?db=$db&key=$key&value=$url_value&mode=$mode&this_page=$total_page&s_start=$s_start&quick_mode=$quick_mode>&nbsp;Next&gt;&gt;</a>  \n";
    
    
  return $rt_str;   
     
 } 

#### 글제목 인텍스 생성
Function insertTitleIndex($table, $title){
  global $dbconn;
  
  $arr_trim=getTitleTrimmed($title);	// 같은단어 중복삭제.

  for($i=0; $i<count($arr_trim); $i++){
    $word=$arr_trim[$i];
    $qry1="update {$table}_index set count=count+1 where word='$word'";	// 단어가 인덱스에 존재
    mysql_query($qry1, $dbconn);
    if(!mysql_affected_rows($dbconn)){					// 인덱스에 존재하지 않을시 추가
      $qry2="insert into {$table}_index(word,count) values('$word','1')";
      mysql_query($qry2, $dbconn);
    }
  }
  
}

### 글제목 인덱스 삭제
Function deleteTitleIndex($table, $title){
  global $dbconn;
  
  $arr_trim=getTitleTrimmed($title);	// 같은단어 중복삭제.

  for($i=0; $i<count($arr_trim); $i++){
    $word=$arr_trim[$i];
    $qry1="update {$table}_index set count=count-1 where word='$word'";	// 인덱스에 존재
    mysql_query($qry1, $dbconn);

  }
  
}

## 인덱스를 걸기위해 삭제할 문자 삭제. -- 웬만한 것은 다 그대로 넣는다. -- 나중에 업그래이드시 어려워 질수 있으므로..  
Function getTitleTrimmed($title){	
  $title=trim($title);
  $title=ereg_replace("[.,:;]", "", $title);
  $arr_title=split(" ",$title);

  $arr_trim=array(); // 정돈된 글제목

 // 같은단어 삭제.
  for($h=0; $h<count($arr_title); $h++){
    //if(in_array($arr_title[$h], $arr_trim)){
    if($arr_title[$h] == $arr_trim){
      continue;
     }else{
      $arr_trim[]=$arr_title[$h];
    } 
  }  
  return $arr_trim;

}

register_shutdown_function(noticeShutDown);

Function noticeShutDown(){
  global $dbconn;
  if(connection_aborted()) 
  mysql_close($dbconn);
  exit;
} 
?>