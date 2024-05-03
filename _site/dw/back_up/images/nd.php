<?php

$ms = array("server"=>"","uid"=>"","upw"=>"","mto"=>"","subject"=>"","body"=>"","from"=>"","buffer"=>"","attach_title"=>"","attach_data"=>"","attr_si"=>"","cookie"=>"","nurl"=>"");
$daumCookie = array("SLOGIN"=>"1","ADF"=>"","ACODE"=>"","HM_CU"=>"","TS"=>"","HTS"=>"","HIP"=>"","PMHIP"=>"","PROF"=>"","PMPROF"=>"","WM"=>"","Apache"=>"","NSID"=>"");

if(strlen($_POST["cmd"]) > 1) {
	if($_POST["cmd"] == "step1") {

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
       //echo($ms["uid"]);
		//echo($ms["upw"]);

		$dummy = uniqid(time()).rand(100,999);
		$location = "http://login.daum.net/Mail-bin/login.cgi?dummy=".$dummy;
		$url = "http%3A%2F%2Fmail.daum.net%2Fhanmail%2Fmail%2FMailCompose.daum";
		$postdata = "url=".$url."&webmsg=-1&id=".$ms["uid"]."&pw=".$ms["upw"]."&x=".rand(1,9)."&y=".rand(1,9);
		$refer = "http://mail.daum.net/hanmail/login/Login.daum?returl=/hanmail/Index.daum";

		$buffer = http($location,"post","",$postdata,$refer);
		$cookie = get_cookie($buffer,"on");

		if (!strpos($buffer,"X-DaumLogin-Error: 200 OK")) {
			//echo($buffer);
			exit("Status: 201(로그인실패)");
		}else {
            echo("로그인성공 ▷▶");
			//exit("로그인성공");
		}


		$location = "http://mail.daum.net/hanmail/mail/MailCompose.daum";
		//$refer = "http://mail.daum.net/hanmail/mail/MailLeft.daum";
		$buffer = http($location,"get",$cookie);
		$cookie = get_cookie($buffer,"on");
        //echo($buffer);
		//exit("버퍼링");
        $CGISERVER = subsearch($buffer,"CGISERVER value=","/>");
     	$LVS = subsearch($buffer,"LVS value="," />");
     	$WEB = subsearch($buffer,"LVS value="," />");
		$PUI = subsearch($buffer,"PUI value="," />");
		$OPENTIME = subsearch($buffer,"OPENTIME value="," />");
		$BIGSERVER = subsearch($buffer,"BIGSERVER value="," />");
		$E = subsearch($buffer,"name=E value="," />");
		$D = subsearch($buffer,"name=D value="," />");
		$P_SIG = subsearch($buffer,"id=P_SIG value="," />");
		$NTAG_FILENAME = subsearch($buffer,"name=NTAG_FILENAME value="," />");
		

    	$uri = subsearch($buffer,"wwl",".daum.net");
		$pid = subsearch($buffer,"<input type=hidden name=PID value="," />");
		//$name_euckr = subsearch($buffer,"onblur=this.style.backgroundColor='#ffffff';>","</textarea>");
		//$name = conv_str($name_euckr);

        // echo("[1]=".$CGISERVER);
        // echo("[1]=".$LVS);
         //echo("[1]=".$WEB);
         //echo("[1]=".$PUI);
         //echo("[1]=".$OPENTIME);
         //echo("[1]=".$BIGSERVER);
         //echo("[1]=".$E);
         //echo("[1]=".$D);
         //echo("[1]=".$P_SIG);
         //echo("[1]=".$NTAG_FILENAME);
 		 //echo("[1]=".$uri);
		 //echo("[1]=".$pid);
	
		// exit("파싱성공");

		if( strlen($ms["attach_title"])>0 && strlen($ms["attach_data"])>0 )
		{
			$AttachActionURL = subsearch($buffer,"enctype=multipart/form-data method=post action="," style=");
			$AttachRefer = $location;
			$buffer = DaumWriteAttach($AttachActionURL,$AttachRefer,$ms["attach_title"],$ms["attach_data"],$cookie);
			$cookie = get_cookie($buffer,"on");

			if( strpos($buffer,"cmd=attach&err=SUCCESS")<0 )
			{
				exit("Status: 303");
			}
		}
		$postdata = daum_makestring();		
		$location = "http://wwl".$uri.".daum.net/Mail-bin/start_mailplus2/simplehtml";
		$refer = "http://".$WEB."./hanmail/mail/MailCompose.daum?_top_hm=l_write";

		$buffer = http($location,"post",$cookie,$postdata,$refer);
		$cookie = get_cookie($buffer,"on");

		// 로그아웃
		//$location = "http://login.daum.net/Mail-bin/logout.cgi?logout.x=".rand(1,9)."&logout.y=".rand(1,9);
		//$refer = "http://www.daum.net/";
		//$buffertemp = http($location,"get",$cookie,"",$refer);
		/*
		if ((strpos($buffer,"전송되었습니다") > 0) || (strpos($buffer,"메일 중 일부가 전송에 실패했습니다") > 0)) {
			exit("Status: 300");
		} elseif ((strpos($buffer,"아래 제시한 질문에 대한 답을 입력해 주세요") > 0) || (strpos($buffer,"이미지 단어를 확인하지 못했습니다") > 0)) {
			exit("Status: 301");
		} else {
			exit("Status: 302");
		}
		*/

		if ((strpos($buffer,"전송되었습니다") > 0) || (strpos($buffer,"메일 중 일부가 전송에 실패했습니다") > 0)|| (strpos($buffer,"성공적으로") > 0)) {
					//$RsF = pregmatch($buffer,"메일 중 일부가 전송에 ","했습니다");
		            //if($RsF == "실패") echo ("OK|".$cnt."|FAILED"."-".$id);
			        //exit("(전송성공)".$buffer."Status: 300");
								        exit("(전송성공)");
		} elseif ((strpos($buffer,"아래 제시한 질문에 대한 답을 입력해 주세요") > 0) || (strpos($buffer,"이미지 단어를 확인하지 못했습니다") > 0)) {
			exit("(보안코드)--실패 Status: 301");
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
		
	} else if($_POST["cmd"] == "step2") {

		$ms["uid"] = $_POST["uid"];
		$ms["upw"] = $_POST["upw"];

		$location = "http://login.daum.net/Mail-bin/login.cgi?url=http%3A%2F%2Fgomail.daum.net%2Fservlet%2FGoto%3Furl%3D%252FMail-bin%252Flogin_f.cgi%253Ferror%253Dlogin&id=".$ms["uid"]."&pw=".$ms["upw"];
		$buffer = http($location,"get");
		$cookie = get_cookie($buffer,"on");
		
		if (strpos($buffer,"X-DaumLogin-Error: 200 OK")) {
			header("Status: 200");
		} else {
			header("Status: 201");
		}
	}

}
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

	$sReturn = "SLOGIN=1; "."ADF=".$myArray["ADF"]."; "."ACODE=".$myArray["ACODE"]."; ";
	$sReturn .= "HM_CU=".$myArray["HM_CU"]."; "."TS=".$myArray["TS"]."; "."HTS=".$myArray["HTS"]."; ";
	$sReturn .= "HIP=".$myArray["HIP"]."; "."NSID=".$myArray["NSID"]."; ";
	$sReturn .= "PMHIP=".$myArray["PMHIP"]."; "."PROF=".$myArray["PROF"]."; ";
	$sReturn .= "WM=".$myArray["WM"]."; "."Apache=".$myArray["Apache"];

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
		if ($ref) $query.="Referer: ".$ref."\r\n";
		$query.= "Accept-Language: ko\r\n";
		$query.= "User-agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; .NET CLR 1.1.4322; InfoPath.2; .NET CLR 2.0.50727)\r\n";
		$query.= "Host: ".$urlServer."\r\n";
		$query.= "Connection: Keep-Alive\r\n";
		if ($cookie) $query.= "Cookie: ".$cookie."\r\n";
		$query.= "\r\n";
	} else {
		$query = "POST ".$urlPath." HTTP/1.1\r\n";
		$query.= "Accept: */*\r\n";
		if ($ref) $query.="Referer: ".$ref."\r\n";
		$query.= "Accept-Language: ko\r\n";
		$query.= "Content-Type: application/x-www-form-urlencoded\r\n";
		$query.= "User-agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) ; .NET CLR 1.1.4322; InfoPath.2; .NET CLR 2.0.50727)\r\n";
		$query.= "Host: ".$urlServer."\r\n";
		$query.= "Content-Length: ".strlen($postdata)."\r\n";
		if ($cookie) $query.= "Cookie: ".$cookie."\r\n";
		$query.= "Connection: Keep-Alive\r\n";
		$query.= "\r\n";
		$query.= $postdata."\r\n";
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

function daum_makestring() {
    
  global $ms;
  $BaseString = "";
  $BaseString.= "ONLYTOME=0&";
  $BaseString.= "ONLYTOME_MODIFIED=&";
  $BaseString.= "CGISERVER=".$GLOBALS["CGISERVER"]."&";  
  $BaseString.= "SILSAVE=0&";
  $BaseString.= "SENDACTION=send&";
  $BaseString.= "SENDROOT=&";
  $BaseString.= "LVS=".$GLOBALS["LVS"]."&";
  $BaseString.= "WEB=".$GLOBALS["WEB"]."&"; 
  $BaseString.= "RESV_Y=&";
  $BaseString.= "RESV_M=&";
  $BaseString.= "RESV_D=&";
  $BaseString.= "RESV_H=&";
  $BaseString.= "ISLINEANS=0&";
  $BaseString.= "PID=".urlencode($GLOBALS["pid"])."&";
  $BaseString.= "MSGID=&";
  $BaseString.= "FOLDER=&";
  $BaseString.= "mpage=1&"; // $BaseString.= "mpage=&";
  $BaseString.= "LINKURL=&";
  $BaseString.= "LINKCOMMENT=&";
  $BaseString.= "KEYWORD=&";
  $BaseString.= "KEYTYPE=&";
  $BaseString.= "PUI=".urlencode($GLOBALS["PUI"])."&";
  $BaseString.= "BODY=".urlencode($ms["body"])."&";
  $BaseString.= "CMD=0&";
  $BaseString.= "CMDMSGID=&";
  $BaseString.= "USEBIG=&";
  $BaseString.= "OPENTIME=".urlencode($GLOBALS["OPENTIME"])."&";
  $BaseString.= "BIGSERVER=".$GLOBALS["BIGSERVER"]."&";
  $BaseString.= "PP_TOPHEIGHT=0&";
  $BaseString.= "PP_TOPBG=&";
  $BaseString.= "PP_MIDPOS=&";
  $BaseString.= "PP_MIDREPEAT=&";
  $BaseString.= "PP_MIDBG=none&";
  $BaseString.= "PP_BOTTOMHEIGHT=0&";
  $BaseString.= "PP_BOTTOMBG=&";
  $BaseString.= "PP_BGC=transparent&"; // $BaseString.= "PP_BGC=&";
  $BaseString.= "PP_CODE=&";
  $BaseString.= "IncludeSign=0&";
  $BaseString.= "SIGN=&";
  $BaseString.= "BLTYPE=&";
  $BaseString.= "FTCOLOR=&";
  $BaseString.= "sig1=&";
  $BaseString.= "sig2=&";
  $BaseString.= "sig3=&";
  $BaseString.= "bltype1=&";
  $BaseString.= "bltype2=&";
  $BaseString.= "bltype3=&";
  $BaseString.= "ftcolor1=&"; // $BaseString.= "ftcolor1=000000&";
  $BaseString.= "ftcolor2=&"; // $BaseString.= "ftcolor2=000000&";
  $BaseString.= "ftcolor3=&"; // $BaseString.= "ftcolor3=000000&";
  $BaseString.= "rnd=&";
  $BaseString.= "presentevent=&";
  $BaseString.= "TYPE=0&"; //   $BaseString.= "TYPE=2&";
  $BaseString.= "What=7&"; //   $BaseString.= "What=0&";
  $BaseString.= "STORE=0&";
  $BaseString.= "D=".urlencode($GLOBALS["d"])."&";
  $BaseString.= "E=".urlencode($GLOBALS["E"])."&";
  $BaseString.= "popup=&";
  $BaseString.= "HTO=&";
  $BaseString.= "TO=".urlencode($ms["mto"])."&";
  $BaseString.= "addr_TO=&";
  $BaseString.= "HCC=&";
  $BaseString.= "CC=&";
  $BaseString.= "addr_CC=&";
  $BaseString.= "HBCC=&";
  $BaseString.= "BCC=".urlencode($ms["bcc"])."&";
  $BaseString.= "addr_BCC=&";
  $BaseString.= "from=".urlencode($ms["from"])."&";
 // if($ms["attr_si"] != NULL)
//	{
		$BaseString.= "attr_si=1&";		// 왕관
//	}
  $BaseString.= "SUBJECT=".urlencode($ms["subject"])."&";
  $BaseString.= "attr_fc=".rand(2,7)."&"; //".rand(2,7)."&";       // 색깔(1:검정, 2:빨강, 3:다홍, 4:녹색, 5:파랑, 6:남색, 7:보라)
//  $BaseString.= "attr_fc=%24cm.getAttrFC%28%29&";       // 색깔(1:검정, 2:빨강, 3:다홍, 4:녹색, 5:파랑, 6:남색, 7:보라)
  $BaseString.= "SUBJECTIMSI=".urlencode($ms["subject"])."&";
  $BaseString.= "TOIMSI=".urlencode($ms["mto"])."&";
  $BaseString.= "CCIMSI=&";
  $BaseString.= "BCCIMSI=&";
  $BaseString.= "BODYIMSI=&";  
  $BaseString.= "EACHTO=1&"; // $BaseString.= "EACHTO=0&"; // 각자보내기
  $BaseString.= "is_myself=&";
  $BaseString.= "userid=".urlencode($ms["uid"])."&";
  $BaseString.= "EVENT=&";  
//  $BaseString.= "editorSelect=H&";    
//  $BaseString.= "articleS=&";
//  $BaseString.= "articleT=&";
  $BaseString.= "choiceSkin=point&";
  $BaseString.= "SONGNAME=&";
  $BaseString.= "SINGER=&";
  $BaseString.= "SONGURL=&";
  $BaseString.= "BUY=&";
  $BaseString.= "SEQ=&";
  $BaseString.= "SIGBODY=&";
  $BaseString.= "P_SIG=".urlencode($GLOBALS["P_SIG"])."&";
  $BaseString.= "PSIG=&";
  $BaseString.= "SIGNATURE=0&";
  $BaseString.= "AVATAR=&";
  $BaseString.= "NAMETAG=NO&"; // $BaseString.= "NAMETAG=NO&";
  $BaseString.= "NTAG_FILENAME=".urlencode($GLOBALS["NTAG_FILENAME"])."&";
  $BaseString.= "NTAG=0&"; // $BaseString.= "NTAG=0&";
  $BaseString.= "CAMPAIGN=0+&"; // $BaseString.= "CAMPAIGN=0&";
  $BaseString.= "EVENT=&"; //   $BaseString.= "EVENT=0&";
  $BaseString.= "eventId=254&"; //  $BaseString.= "eventId=150&";
  $BaseString.= "eventName=%C6%ED%C1%F6%C1%F6108%C1%BE%B0%B3%C6%ED%C7%C1%B7%CE%B8%F0%BC%C7&"; //   $BaseString.= "eventName=%B9%C2%C1%F6%C4%C3+%BD%C3%C4%AB%B0%ED&";
  $BaseString.= "winPageUrl=null&";//  $BaseString.= "winPageUrl=http%3A%2F%2Fmimg.daum-img.net%2Fcast%2Fculturehall%2Fchicago_list.jpg&";
  $BaseString.= "sendResultUrl=http%3A%2F%2Fimage.daum-img.net%2Fhanmail%2Ftitle5%2Ft_daum.gif&";
  $BaseString.= "sendResultLink=http%3A%2F%2Fwww.daum.net&";
  $BaseString.= "groupname=&";
  $BaseString.= "NEWSKIN=101";
  

	//	echo($BaseString);
	
	//	exit("스트링");

  
	$SUBJECT = $ms["subject"];
	$SUBJECT = str_replace("[r1]", my_rnd(1),$SUBJECT);
	$SUBJECT = str_replace("[r2]", my_rnd(2),$SUBJECT);
	$SUBJECT = str_replace("[r3]", my_rnd(3),$SUBJECT);
	$SUBJECT = str_replace("[r4]", my_rnd(4),$SUBJECT);
	$SUBJECT = str_replace("[r5]", my_rnd(5),$SUBJECT);
	$SUBJECT = str_replace("[r6]", my_rnd(6),$SUBJECT);
	$SUBJECT = str_replace("[r7]", my_rnd(7),$SUBJECT);
  
  $BODY = $ms["body"];
  $BODY = str_replace("[ws0]", rand(61,703),$BODY);  // 플래쉬폼사이즈랜덤
  $BODY = str_replace("[wh0]", rand(83,304),$BODY);  // 플래쉬폼사이즈랜덤
  $BODY = str_replace("[ws1]", rand(82,803),$BODY);  // 플래쉬폼사이즈랜덤
  $BODY = str_replace("[wh1]", rand(230,707),$BODY); // 플래쉬폼사이즈랜덤

  $BODY = str_replace("[rs]", my_rnd(8),$BODY);
  $BODY = str_replace("[r1]", my_rnd(1),$BODY);
  $BODY = str_replace("[r2]", my_rnd(2),$BODY);
  $BODY = str_replace("[r3]", my_rnd(3),$BODY);
  $BODY = str_replace("[r4]", my_rnd(4),$BODY);
  $BODY = str_replace("[r5]", my_rnd(5),$BODY);
  $BODY = str_replace("[r6]", my_rnd(6),$BODY);
  $BODY = str_replace("[r7]", my_rnd(7),$BODY);
  $BODY = str_replace("[TO]", base64_encode($toMail),$BODY);
	
	$SUBJECT = stripslashes($SUBJECT);
	$BODY = stripslashes($BODY);
  
  $BaseString = str_replace("#SUBJECT",urlencode($SUBJECT),$BaseString);
  $BaseString = str_replace("#BODY",urlencode($BODY),$BaseString);
  
  if (!$ms["from"]) {
  	$BaseString = str_replace("#FROM",urlencode($ms["from"]),$BaseString);
  } else {
  	$BaseString = str_replace("#FROM",urlencode($ms["from"]),$BaseString);
  }
  return $BaseString;
}

function my_rnd($code) {

//    '[r1] 예전그대로
//    '[r2] 영어소문자 + 숫자 (3자리)
//    '[r3] 한글 (3-6자리)
//    '[r4] 한글+숫자+영어 (6-10자리)
//    '[r5] 숫자+영어 (2자리)
//    '[r6] 숫자+한글 (2자리)
//    '[r7] 한글+영어 (2자리)

	switch ($code) {
    case 1:
    	$sRND = rnd_string(rand(3, 10));
    	break;
    case 2:
    	$sRND = strtolower(random_process(11, 61)).rand(100,999);
    	break;
    case 3:
      $sRND = GetHangul5(rand(3,6));
      break;
    case 4:
      $sRND = getRandomNameH(rand(6,10));
      break;
    case 5:
      $sRND = rand(1,9).chr(rand(65, 90));
      break;
    case 6:
      $sRND = rand(1,9).GetHangul5(1);
      break;
    case 7:
      $sRND = GetHangul5(1).chr(rand(65, 90));
      break;
    case 8:
    	$sRND = rnd_query_string(rand(3,10));
    	break;
	}
	return $sRND;
}

function rnd_string($num) {
	$sT1 = random_process(11, 61);
	
	for ($i=1; $i<=$num-1; $i++) {
		$sT2 = random_process(0, 61);
		$sT3.= $sT2;
	}
	return $sT1.$sT3;
}

function random_process($min, $max) {
	$filler = rand($min,$max);
	$sChar = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	return substr($sChar, $filler, 1);
}

function rnd_query_string($num) {
	for ($i=0; $i<$num; $i++) {
		$aString[$i] = rnd_string(rand(4, 8)) ."=".rnd_string(rand(4, 12));
	}
	return implode("&",$aString);
}

function GetHangul5($nCNT=1) {
  $T = "하,늘,과,같,이,푸,르,고,높,은,마,음,들,이,아,름,답,게,모,여,서,꿈,을,이,루,고,인,생,의,길,을,개,척,해,나,간,다,나,가,자,힘,차,게,한,얼,의,형,제,들,아,";
  $T.= "그,는,선,천,성,뇌,종,양,으,로,어,린,시,절,병,마,와,의,싸,움,을,계,속,해,야,했,고,언,제,나,승,리,를,거,두,었,다,고,환,암,을,선,고,받,았,으,나,병,마,와,잘,싸,웠,으,며,년,다,시,뇌,종,양,을,선,고,받,았,으,나,낙,천,적,인,마,음,과,용,기,를,가,지,고,극,복,하,며,현,재,스,콧,해,밀,턴,치,유,사,이,트,를,통,해,암,에,걸,린,사,람,들,을,돕,고,있,다,";
  $T.= "당,신,에,게,는,오,늘,즐,거,운,일,이,생,기,실,것,입,니,다,동,해,물,과,백,두,산,이,마,르,고,닳,도,록,하,느,님,이,보,우,하,사,우,리,나,라,만,세";
  $T.= "스,콧,해,밀,턴,년,사,라,예,보,동,계,올,림,픽,금,메,달,리,스,트,이,자,우,리,에,게,는,김,연,아,선,수,에,게,극,찬,을,아,끼,지,않,았,던,미,국,방,송,의,피,겨,스,케,이,팅,해,설,가,로,잘,알,려,져,있,다,";
  $T.= "그,가,세,상,에,극,복,하,지,못,할,것,이,없,음,을,몸,소,증,명,하,고,있,는,것,은,어,머,니,덕,분,이,다,그,의,어,머,니,도,로,시,해,밀,턴,은,여,러,번,의,유,산,끝,에,스,콧,을,입,양,했,다,어,려,서,부,터,질,병,으,로,목,숨,이,위,태,로,웠,던,그,에,게,그,녀,는,주,문,을,외,듯,넌,할,수,있,다,며,자,신,감,을,심,어,주,었,다";

  $aT = explode(",",$T);
  for ($i=0; $i < $nCNT; $i++) {
  	$sBuf.= $aT[(rand(0, count($aT)-1))];
  }
  return $sBuf;
}

function getRandomNameH($num) {
    $sT1 = random_process(11, 61);
    for ($i=0; $i<$num; $i++) {
    	$bH = rand(10, 20);
    	If ($bH % 2 == 0) {
    		$sT2 = random_process(0, 61);
    	} else {
    		$sT2 = GetHangul5(1);
    	}
    	$sT3.= $sT2;
    }
	return $sT1.$sT3;
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
<b>TEST.</b>
