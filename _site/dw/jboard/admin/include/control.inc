<?php
/* 새션시작 */
session_start();


/* 외부화일 */
include ("./include/incinfo.inc");


/* 로그인 체크 */
if(!admin_chk_login()) {
	Header("Location:./admin_login.php");
}
?>
