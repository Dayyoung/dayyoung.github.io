<script>
<!--
function move_focus()
{
	document.form.passwd.focus();
}

function chk_form()
{
	if(!document.form.passwd.value) {
		alert('비밀번호를 입력하세요');
		document.form.passwd.focus();
		return false;
	}
	document.form.submit();
}
-->
</script>
<table width="267" border="0" cellspacing="0" cellpadding="0" align="center" height="140" onLoad="move_focus();">
  <form method="post" action="./?p=act&code=<?=$HTTP_GET_VARS[code]?>" name="form" onSubmit="return chk_form();" onLoad="document.form.passwd.focus();">
  <input type="hidden" name="id" value="<?=$HTTP_GET_VARS[id]?>">
  <input type="hidden" name="seq" value="<?=$HTTP_GET_VARS[seq]?>">
  <input type="hidden" name="mode" value="c_del">
  <tr> 
    <td height="39" colspan="4"> 
      <div align="left"><img src="img/basic02/del-icon.gif" width="126" height="39" border="0"></div>
    </td>
  </tr>
  <tr> 
    <td height="16" colspan="4" align="center">
      글을 삭제하려 합니다. <br>
      비밀번호를 입력하여 주십시오.
    </td>
  </tr>
  <tr> 
    <td height="13" colspan="4"> 
      <div align="center"> 
        <input type="password" name="passwd" size="16">
      </div>
    </td>
  </tr>
  <tr> 
    <td height="14" width="130"></td>
    <td height="14" width="72"></td>
    <td height="14" width="63"><div align="center"><img src="img/i-pack/<?=$config[18]?>/del.gif" border=0 value="삭제" onClick="chk_form();" style="cursor:hand"></div></td>
    <td height="14" width="49"></td>
  </tr>
  </form>
</table>