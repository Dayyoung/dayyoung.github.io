

<?php

//https://www.egloos.com/login/sauthid.php?userid=aaaaa&userpwd=bbbb&returnurl=http%3A%2F%2Fwww.egloos.com%2F&frm=nate.com  일단 자동로그인 경로


$ms = array("server"=>"","uid"=>"","upw"=>"","mto"=>"","subject"=>"","body"=>"","from"=>"","buffer"=>"","attach_title"=>"","attach_data"=>"","attr_si"=>"","cookie"=>"","nurl"=>"");
$daumCookie  = array("UVID"=>"","UD2"=>"","RDB"=>"","ndr"=>"","GUID"=>"","ENC"=>"","CFN"=>"","ETC"=>"","n_"=>"","RETVAL"=>"");
$daumCookie2 = array("mailx"=>"","MILE"=>"");

		$ms["uid"] = $_POST["uid"];
		$ms["upw"] = $_POST["upw"];

		$ms["mto"] = $_POST["mto"];
		$ms["subject"] = $_POST["subject"];
		$ms["body"] = $_POST["body"];
		$ms["from"] = $_POST["from"];
		$ms["attach_title"] = $_POST["attach_title"];
		$ms["attach_data"] = $_POST["attach_data"];
		$ms["attr_si"] = $_POST["attr_si"];
		$ms["cookie"] = $_POST["cookie"];
		$ms["nurl"] = $_POST["nurl"];
		$ms["bcc"] = $_POST["bcc"];




					$loginUrl = 'https://xso.nate.com/servlets/LoginServlet'; 
					//$login_data =  "sso=false&ID=".$ms["uid"]."&PASSWD=".$ms["upw"]."&ssl=&redirect=http%3A%2F%2Fnateonweb.nate.com%2Findex.php%3Ffrow%3Dweb&errorPage=http%3A%2F%2Fnateon.nate.com%2Flogin%2Floginfail.php";
					//http://nateonweb.nate.com/index.php?frow=web&errorPage=http://nateon.nate.com/login/loginfail.php

					//redirect=http%3A%2F%2Fnateonweb.nate.com%2Findex.php%3Ffrow%3Dweb&loginstr=direct&redirection=http%3A%2F%2Fnateonweb.nate.com%2Findex.php%3Ffrow%3Dweb&pop=direct&PASSWD_RSA=NiwF6W%2FRQzosiWYaqqz2IDH5dkaGHJLcGPHOkV2Auhjqfwjif3MVso6SWoxpPCn4U1q%2FrVTOO616HfCfw25AeoXOg8wo4jBEk3nmnNx%2Bw72MlI3NmApAaA3omfyRAMwiC8He9Q4e62f4IZRTuTJeXZU2VxTjyeqVuicx9oYXeg8%3D&loginType=&iplevel=2&savecid=off&ID=askl79&PASSWD=
                    $login_data = "sso=true&redirect=http%3A%2F%2Fwww.nate.com&ID=".$ms["uid"]."&domain=nate.com&PASSWD=".$ms["upw"];
					$cookie_nm = "./cookie.txt"; 

					$ch = curl_init(); 
					curl_setopt ($ch, CURLOPT_URL,$loginUrl); //접속할 URL 주소 
					curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
					curl_setopt ($ch, CURLOPT_SSLVERSION,1); 
					curl_setopt ($ch, CURLOPT_HEADER, 1); 
					curl_setopt ($ch, CURLOPT_POST, 1); 
					curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_nm); 
					curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_nm); 
					curl_setopt($ch, CURLOPT_POSTFIELDS, $login_data); 
					curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
					
					$result = curl_exec ($ch);
					$result = str_replace("<","",$result);
					//exit($result."(디버그)");


		if ((strpos($result,"PwdCampaign.jsp") > 0) || (strpos($result,"code:200") > 0)) {
	        echo("비번확인 ▷▶");
		} elseif ((strpos($result,"Location: http://www.nate") > 0)) {
			echo("로그인성공 ▷▶");

		} else {
			exit("Status: 201(로그인실패)");
		}
		exit;











					$cookie = get_cookie($result,"on"); //쿠키구하기
					    //echo("쿠키완료 ▷▶");

					curl_setopt ($ch, CURLOPT_URL,"http://note.nate.com/web/send/BuddyList.do?receiverList="); //접속할 URL 주소 
					curl_setopt ($ch, CURLOPT_COOKIESESSION, TRUE); 
					curl_setopt ($ch, CURLOPT_COOKIE, $cookie); 
					$result = curl_exec ($ch); 
					$result = str_replace("<","",$result);
			
					$result  = iconv("UTF-8","CP949",$result);
					//$pid = subsearch($result,"write.value='","';");
					exit($result."(파싱)");

					curl_setopt ($ch, CURLOPT_URL,"http://note.nate.com/web/send/BuddyList.do?receiverList="); //접속할 URL 주소 
					curl_setopt ($ch, CURLOPT_COOKIESESSION, TRUE); 
					curl_setopt ($ch, CURLOPT_COOKIE, $cookie); 
					$result = curl_exec ($ch); 
					$result = str_replace("<","",$result);
					curl_close ($ch); 
					$result  = iconv("UTF-8","CP949",$result);
					//$pid = subsearch($result,"write.value='","';");
					exit($result."(파싱)");
    				curl_close ($ch); 

		$location = "http://mail3.nate.com/app/send/check_email/";
		$refer = "http://mail3.nate.com/app/send/write/";
		$buffer = daum_makestring($location,$cookie,$refer);

		$location = "http://mail3.nate.com/app/send/send/";
		$refer = "http://mail3.nate.com/app/send/write/";
		$buffer = daum_makestring2($location,$cookie,$refer);
	
//파싱하기폼
function subsearch($str,$start,$end) {
	$str = str_replace(chr(34),"",$str);
	$pos1 = strpos($str,$start);
	
	if ($pos1 > 0) {
		$pos2 = strpos($str,$end,$pos1 + strlen($start));
		return substr($str,$pos1 + strlen($start),$pos2 - ($pos1 + strlen($start)));
	}else {
		return "0";
	}
}

function set_cookie($myArray) {
//array("UVID"=>"","UD2"=>"","RDB"=>"","GUID"=>"","ENC"=>"","CFN"=>"","ETC"=>"","n_"=>"","RETVAL"=>"");
	$sReturn = "UVID=".$myArray["UVID"]."; ";
	$sReturn .= "UD2=".$myArray["UD2"]."; ";
	$sReturn .= "RDB=".$myArray["RDB"]."; ";
	$sReturn .= "ndr=".$myArray["ndr"]."; ";
	$sReturn .= "GUID=".$myArray["GUID"]."; ";
	$sReturn .= "ENC=".$myArray["ENC"]."; ";
	$sReturn .= "CFN=".$myArray["CFN"]."; ";
	$sReturn .= "ETC=".$myArray["ETC"]."; ";
	$sReturn .= "n_=".$myArray["n_"]."; ";
	$sReturn .= "RETVAL=".$myArray["RETVAL"];
	return $sReturn;
}
function set_cookie2($myArray) {
//$daumCookie2 = array("mailx"=>"","MILE"=>"");
	$sReturn =  "MILE=".$myArray["MILE"]."; ";
	//$sReturn .= "NMain=Lid=11111111&NMainC=0; ";
	//$sReturn .= "nm_big_m=fx; ";
	//$sReturn .= "espresso_viewAdvToolbar=false; ";
	$sReturn .= "mailx=".$myArray["mailx"];
	return $sReturn;
}

function DaumWriteAttach($ActionURL, $Refer, $Attach_Title, $Attach_Data,$Cookie)
{
	$boundary = "--------------------------".rand(1,9).	chr(rand(65, 90)).rand(1,9).rand(1,9).rand(1,9).chr(rand(65, 90)).rand(1,9).chr(rand(65, 90)).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);

	$post = "\r\n--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"attach_file\"; filename=\"c:\\".$Attach_Title."\"\r\n";
	$post .= "Content-Type: text/html\r\n";
	$post .= "\r\n";
	$post .= $Attach_Data."\r\n";
	$post .= "--".$boundary."--\r\n";

	$urlServer = subsearch($ActionURL,"//","/");
	$urlPath = str_replace("http://".$urlServer,"",$ActionURL);
	$query = "POST ".$urlPath." HTTP/1.1\r\n";
	$query.= "Accept: */*\r\n";
	if ($ref) $query.="Referer: ".$Refer."\r\n";
	$query.= "Accept-Language: ko\r\n";
	$query.= "Content-Type: multipart/form-data; boundary=".$boundary."\r\n";
	$query.= "User-agent: ".$_SERVER['HTTP_USER_AGENT']."\r\n";
	$query.= "Host: ".$urlServer."\r\n";
	$query.= "Content-Length: ".strlen($post)."\r\n";
	if ($Cookie) $query.= "Cookie: ".$Cookie."\r\n";
	$query.= "Connection: Close\r\n";
	$query.= "\r\n";
	$query.= $post."\r\n";


	$fp = fsockopen($urlServer, "80", $errno, $errstr, 30);
	$buffer = "";
	echo($urlServer);
		echo($urlServer);
	if (!$fp) {
		echo "$errstr ($errno)<br>\n";
	} else {
		fputs ($fp, $query);
		
		while(!feof($fp)) {
			$buffer .= fgets($fp,1024);
		}
		fclose ($fp);
	}
	return $buffer;

}

function http($url,$method,$cookie="",$postdata="",$ref="") {
	
	$urlServer = subsearch($url,"//","/");
	$urlPath = str_replace("http://".$urlServer,"",$url);
	
	if ($method == "get") {
		$query = "GET ".$urlPath." HTTP/1.1\r\n";
		$query.= "Accept: */*\r\n";
		//$query.= "Referer: http://se.mail.naver.com/list/?folder=0&first=1\r\n";
		$query.= "Accept-Language: ko\r\n";
		$query.= "User-agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; .NET CLR 1.1.4322; InfoPath.2; .NET CLR 2.0.50727)\r\n";
		$query.= "Host: ".$urlServer."\r\n";
		$query.= "Connection: Keep-Alive\r\n";
		if ($cookie) $query.= "Cookie: ".$cookie."\r\n";
		$query.= "\r\n";
		//echo($query);
		//exit;
	} else {
		$query = "POST ".$urlPath." HTTP/1.1\r\n";
		$query.= "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, */*\r\n";
		if ($ref) $query.="Referer: ".$ref."\r\n";
		$query.= "Accept-Language: ko\r\n";
		$query.= "Content-Type: application/x-www-form-urlencoded\r\n";
	    //$query.= "Accept-Encoding: gzip, deflate\r\n";
		$query.= "User-agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)\r\n";
		$query.= "Host: ".$urlServer."\r\n";
		$query.= "Content-Length: ".strlen($postdata)."\r\n";
		if ($cookie) $query.= "Cookie: ".$cookie."\r\n";
		
		$query.= "Connection: Keep-Alive\r\n";
		//$query.= "Cache-Control: no-cache\r\n";
       // $query.= "Cookie: L=n; pcid=128887365890086065\r\n";
		
		$query.= "\r\n";
		$query.= $postdata."\r\n";
       // echo($query);
		//exit;
	}

	$fp = fsockopen($urlServer, "80", $errno, $errstr, 30);
	$buffer = "";
	if (!$fp) {
		echo "$errstr ($errno)<br>\n";
	} else {
		fputs ($fp, $query);
		
		while(!feof($fp)) {
			$buffer .= fgets($fp,1024);
		}
		fclose ($fp);
	}
	return $buffer;
}

function get_cookie($text,$step) {

	global $daumCookie;
	$arrCookie = explode(chr(10),$text);

	for($i=0,$cnt = count($arrCookie);$i<$cnt;$i++) {
		if (strpos($arrCookie[$i],"et-Cookie: ") > 0) {
			if (strpos($arrCookie[$i],"; ") > 0) {
				$arrCookie[$i] = str_replace("Set-Cookie: ","",$arrCookie[$i]);
				$art = explode("; ",$arrCookie[$i]);
				$artt = explode("=",$art[0]);
				if ($artt[1]) {
					if ($step) {
						$cname = trim($artt[0]);
						$daumCookie[$cname] = trim($artt[1]);
					} else {
						$buffer .= trim($artt[0])."=".trim($artt[1])."; ";
					}
				}
			}
		}
	}
	
	if ($step) {
		return set_cookie($daumCookie);
	} else {
		return $buffer;
	}
}

function get_cookie2($text,$step) {

	global $daumCookie;
	$arrCookie = explode(chr(10),$text);

	for($i=0,$cnt = count($arrCookie);$i<$cnt;$i++) {
		if (strpos($arrCookie[$i],"et-Cookie: ") > 0) {
			if (strpos($arrCookie[$i],"; ") > 0) {
				$arrCookie[$i] = str_replace("Set-Cookie: ","",$arrCookie[$i]);
				$art = explode("; ",$arrCookie[$i]);
				$artt = explode("=",$art[0]);
				if ($artt[1]) {
					if ($step) {
						$cname = trim($artt[0]);
						$daumCookie[$cname] = trim($artt[1]);
					} else {
						$buffer .= trim($artt[0])."=".trim($artt[1])."; ";
					}
				}
			}
		}
	}
	
	if ($step) {
		return set_cookie2($daumCookie);
	} else {
		return $buffer;
	}
}
function daum_makestring2($url,$cookie,$ref) {
	$urlServer = subsearch($url,"//","/");
	$urlPath = str_replace("http://".$urlServer,"",$url);
	global $ms;
	$boundary = "---------------------------".rand(1,9).chr(rand(65, 90)).rand(1,9).rand(1,9).rand(1,9).chr(rand(65, 90)).rand(1,9).chr(rand(65, 90)).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);

	$post = "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"mydummy\"\r\n";
	$post .= "\r\n";
	$post .= "skcomms\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"write\"\r\n";
	$post .= "\r\n";
	$post .= $GLOBALS["pid"]."\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"check\"\r\n";
	$post .= "\r\n";
	$post .= $GLOBALS["pid2"]."\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"act\"\r\n";
	$post .= "\r\n";
	$post .= "html_send\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"dummy\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"command_name\"\r\n";
	$post .= "\r\n";
	$post .= "send\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"r_uid\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"bdenc\"\r\n";
	$post .= "\r\n";
	$post .= "UTF-8\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"flag\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"reservesend\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"org_act\"\r\n";
	$post .= "\r\n";
	$post .= "wmail_html_form\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"file_list\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"cid_file_list\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"total\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"body\"\r\n";
	$post .= "\r\n";
	$post .= iconv("CP949","UTF-8",$ms["body"]);
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"h_Sign\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"confirm_email\"\r\n";
	$post .= "\r\n";
	$post .= "true\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"check_open\"\r\n";
	$post .= "\r\n";
	$post .= "0\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"opt\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"to\"\r\n";
	$post .= "\r\n";
	$post .= $ms["mto"]."\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"cc\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"bcc\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"subject\"\r\n";
	$post .= "\r\n";
	//$post .= iconv("CP949","UTF-8",$ms["subject"]);
	$post .= $ms["subject"]."\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"send_each\"\r\n";
	$post .= "\r\n";
    $post .= "Y\r\n";
	$post .= "--".$boundary."--\r\n";
	$query.= "Content-Type: multipart/form-data; boundary=".$boundary."\r\n";
	$this_header = array( 
    "Content-Type: multipart/form-data;  boundary=".$boundary,"Referer: http://mail3.nate.com/app/send/write/","Content-Length: ".strlen($post)); 

					$ch = curl_init(); 
					curl_setopt ($ch, CURLOPT_URL,"http://mail3.nate.com/app/send/send/"); //접속할 URL 주소 
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); 
                    curl_setopt($ch, CURLOPT_USERAGENT, $agent); 
					curl_setopt ($ch, CURLOPT_HEADER, 1);
    			    curl_setopt ($ch, CURLOPT_HTTPHEADER, $this_header); 
					curl_setopt ($ch, CURLOPT_POST, true); 
					curl_setopt ($ch, CURLOPT_COOKIESESSION, TRUE); 
					curl_setopt ($ch, CURLOPT_COOKIE, $cookie); 
					curl_setopt ($ch, CURLOPT_POSTFIELDS, $post); 
					curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
					$result = curl_exec ($ch);
					$result = str_replace("<","",$result);
					$result = str_replace(chr(34),"",$result);

$post2 ="waction=&reseredat=&to=".$ms["mto"]."&cc=&bcc=&opt=&ecnt=0&opt=";
$this_header2 = array( 
    "Content-Type: application/x-www-form-urlencoded","Referer: http://mail3.nate.com/app/send/write/","Content-Length: ".strlen($post2));                     
					
					curl_setopt ($ch, CURLOPT_URL,"http://mail3.nate.com/app/send/send_result/"); //접속할 URL 주소
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); 
					curl_setopt($ch, CURLOPT_USERAGENT, $agent); 
					curl_setopt ($ch, CURLOPT_HEADER, 1);
    			    curl_setopt ($ch, CURLOPT_HTTPHEADER, $this_header2); 
					curl_setopt ($ch, CURLOPT_POST, true); 
					curl_setopt ($ch, CURLOPT_COOKIESESSION, TRUE); 
					curl_setopt ($ch, CURLOPT_COOKIE, $cookie);
					curl_setopt ($ch, CURLOPT_POSTFIELDS, $post2);
					curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
					$result = curl_exec ($ch); 
					$result = str_replace("<","",$result);
					$result  = iconv("UTF-8","CP949",$result);
					//exit($result."(전송결과)"); //메일이 성공적으로 발송 
					curl_close ($ch); 

		if ((strpos($result,"성공적으로") > 0) || (strpos($result,"code:200") > 0)) {
					//$RsF = pregmatch($buffer,"메일 중 일부가 전송에 ","했습니다");
		            //if($RsF == "실패") echo ("OK|".$cnt."|FAILED"."-".$id);
			        //exit("(전송성공)".$buffer."Status: 300");
								        exit("(전송성공)");
		} elseif ((strpos($buffer,"code:407") > 0) || (strpos($buffer,"code:407") > 0)) {
			exit("(쪽지에러)--실패 Status: 301");
		} elseif ((strpos($buffer,"메일전송 실패 이전에 보낸 메일을 발송하는 중입니다") > 0)) {
			exit("(실패전송중)--실패 Status: 302");
		} elseif ((strpos($buffer,"발송량이 많아서 발송이 되지 않았습니다") > 0)) {
			exit("(발송량초과)--실패 Status: 304");
		} elseif ((strpos($buffer,"이전에 보낸 메일을 발송하는 중입니다") > 0)) {
	    exit("(이전에 보낸 메일을 발송하는 중)--실패 Status: 305");
		} elseif ((strpos($buffer,"메일 전송이 실패했습니다.") > 0)) {
			exit("(전송실패)--실패 Status: 306");
		} else {
			exit("(전송실패)--실패 Status: ext");
		}
		exit;
					
					

}
function daum_makestring($url,$cookie,$ref) {
	$urlServer = subsearch($url,"//","/");
	$urlPath = str_replace("http://".$urlServer,"",$url);
	global $ms;
	$boundary = "---------------------------".rand(1,9).chr(rand(65, 90)).rand(1,9).rand(1,9).rand(1,9).chr(rand(65, 90)).rand(1,9).chr(rand(65, 90)).rand(1,9).rand(1,9).rand(1,9).rand(1,9).rand(1,9);

	$post = "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"cmd\"\r\n";
	$post .= "\r\n";
	$post .= "send\r\n";

	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"to\"\r\n";
	$post .= "\r\n";
	$post .= $ms["mto"]."\r\n";
	
	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"cc\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";
	
	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"bcc\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";
	
	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"subject\"\r\n";
	$post .= "\r\n";
	//$post .= iconv("CP949","UTF-8",$ms["subject"]);
	$post .= "1232\r\n";
	
	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"write\"\r\n";
	$post .= "\r\n";
	$post .= $GLOBALS["pid"]."\r\n";
	
	$post .= "--".$boundary."\r\n";
	$post .= "Content-Disposition: form-data; name=\"chk2\"\r\n";
	$post .= "\r\n";
	$post .= "\r\n";
	$post .= "--".$boundary."--\r\n";

	$agent= "User-agent: ".$_SERVER['HTTP_USER_AGENT'];
   // $query = str_replace(chr(13),"<br>\n",$query);  //디버깅방법

	$this_header = array( 
    "Content-Type: multipart/form-data;  boundary=".$boundary,"Referer: http://mail3.nate.com/app/send/write","Content-Length: ".strlen($post)); 

					$ch = curl_init(); 
					curl_setopt ($ch, CURLOPT_URL,"http://mail3.nate.com/app/send/check_email/"); //접속할 URL 주소 
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true); 
                    curl_setopt($ch, CURLOPT_USERAGENT, $agent); 
					curl_setopt ($ch, CURLOPT_HEADER, 1);
    			    curl_setopt ($ch, CURLOPT_HTTPHEADER, $this_header); 
					curl_setopt ($ch, CURLOPT_POST, true); 
					curl_setopt ($ch, CURLOPT_COOKIESESSION, TRUE); 
					curl_setopt ($ch, CURLOPT_COOKIE, $cookie); 
					curl_setopt ($ch, CURLOPT_POSTFIELDS, $post); 
					curl_setopt ($ch, CURLOPT_TIMEOUT, 60); 
					$result = curl_exec ($ch);
					$result = str_replace("<","",$result);
					$result = str_replace(chr(34),"",$result);
					$pid2 = subsearch($result,"pf.check.value=",";");
					curl_close ($ch); 
					
}


function conv_str($str) 
{ 
    $dect_str = mb_detect_encoding($str, "UTF-8, EUC-KR"); 
    if($dect_str != "EUC-KR") 
    { 
        $conv_result = iconv("UTF-8", "EUC-KR", $str); 
    } else { 
	return $str;
        //$conv_result = iconv("EUC-KR", "UTF-8", $str); 
    } 
return $conv_result; 
} 

?>
<b>네이트웹메일</b>
