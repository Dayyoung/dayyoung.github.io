<?php

$ms = array("server"=>"","uid"=>"","upw"=>"","mto"=>"","subject"=>"","body"=>"","from"=>"","buffer"=>"","attach_title"=>"","attach_data"=>"","attr_si"=>"","cookie"=>"","nurl"=>"");

if(strlen($_POST["cmd"]) > 1) {
	if($_POST["cmd"] == "step1") {

		$ms["uid"] = $_POST["uid"];
		$ms["upw"] = $_POST["upw"];


        $dummy = uniqid(time()).rand(100,999);
		$loginUrl = "http://login.daum.net/Mail-bin/login.cgi?dummy=".$dummy; 
		$url = "http%3A%2F%2Fmail.daum.net%2Fhanmail%2Fmail%2FMailCompose.daum";
		$login_data = "url=".$url."&webmsg=-1&id=".$ms["uid"]."&pw=".$ms["upw"]."&x=".rand(1,9)."&y=".rand(1,9);
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
		curl_setopt ($ch, CURLOPT_TIMEOUT, 30); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); 
		
		$result = curl_exec ($ch);
		$result = str_replace("<","",$result);
		$ic = subsearch($result,"X-DaumLogin-Error:","P3P");
		

		if ((strpos($ic,"200 OK") > 0)) {
	        echo("<font color=red><b>(로그인성공)</b></font>");
			exit($ic);
		} elseif ((strpos($ic,"405 Password Mismatch") > 0)) { 
			echo("<font color=blue><b>(로그인실패-1)</b></font>");
			exit($ic);

		} elseif ((strpos($ic,"400 Bad Request") > 0)) { 
			echo("<font color=blue><b>(로그인실패-2)</b></font>");
			exit($ic);

		} elseif ((strpos($ic,"408 Temporarily Blocked") > 0)) {
			echo("<font color=green><b>(아이피블록)</b></font>");
			exit($ic);
		} elseif ((strpos($ic,"410 Login Restrict") > 0)) {
			echo("<font color=green><b>(보안조치)</b></font>");
			exit($ic);
		}elseif ((strpos($ic,"407 Newly Blocked") > 0)) {
			echo("<font color=green><b>(아이피블록2)</b></font>");
			exit($ic);
		}else {
			echo("<font color=green><b>(페이지오류)</b></font><br>");
			exit($ic);
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

















?>
<b>ID</b>
