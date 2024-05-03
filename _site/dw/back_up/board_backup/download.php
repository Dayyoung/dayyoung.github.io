<?php


   //include('include/func.inc.php');
   
     $download_file_name="/home/daewon-ind/attach_files/$db/$real_file_name";
     $download_file_size=filesize($download_file_name);

     $ie_v=ereg_replace("^.+MSIE ","",$HTTP_USER_AGENT);
     $ie_v=strtok($ie_v,';');
     
     if($ie_v<5.0){			// 5.0 이하 ... IE 가 아닌 브라우져는 고려하지 않았슴.
       $c_type="application/octet-stream";
       $c_disp="attachment;";
      }else{				
       $c_type="application/octet-stream";	
       $c_disp="inline";
     }
      
     $fp=fopen($download_file_name, 'r')or die("파일이 존재하지 않습니다.");
     $download_file=fread($fp,$download_file_size);
     
     header("Content-type: $c_type"); //파일 타입이 file/unknown 일경우 무조건 다운로드 
     header("Content-length: $download_file_size"); //파일의 크기 
     header("Content-Disposition: $c_disp;filename=$real_file_name"); //파일 이름에 원래 realname 을 적어주면 다운로드시 그 이름으로 다운 
     header("Content-Transfer-Encoding: binary"); 
  
     print $download_file; //파일의 실제 내용을 전송 
     
     $qry11="update $db set download_hit=download_hit+1 where id=$id";
     mysql_query($qry11, $dbconn);

?>