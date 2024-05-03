<html>
<head>
<title>jboard :: 게시물관리</title>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<style type="text/css">
<!--
td {  font-family: "돋움"; font-size: 9pt}
a:link,a:visited{text-decoration:none}
a:hover {text-decoration:underline}
INPUT,SELECT,TEXTAREA { border:1 solid #999999; background-color: #FFFFFF; color: #333333; }
-->
</style>
<script>
<!--
//
// 입력내용 체크
//
function chk_form()
{
	var f = document.gwangpa_form;

	if(!f.subject.value.length) {
		alert('제목을 입력해 주세요');
		f.subject.focus();
		return false;
	}
	if(!f.name.value.length) {
		alert('이름을 입력해 주세요');
		f.name.focus();
		return false;
	}
	if(!f.passwd.value.length) {
		alert('비밀번호를 입력해 주세요');
		f.passwd.focus();
		return false;
	}
	if(!f.comment.value.length) {
		alert('내용을 입력해 주세요');
		f.comment.focus();
		return false;
	}
	
	f.submit();
}


//
// OnLoad 퍼커스 이동
//
function move_focus()
{
	document.gwangpa_form.subject.focus();
}
-->
</script>
</head>

<body bgcolor="#FFFFFF" text="#333333" link="#333333" vlink="#333333" alink="#333333" topmargin="10" marginwidth="0" marginheight="0" onLoad="move_focus();">
<table width="550" border="0" cellspacing="0" cellpadding="0">
  <tr height="10">
    <td>
      <table width="550" border="0" cellspacing="0" cellpadding="0" align="right">
      <form method="post" action="./?p=act&code={CODE}" enctype="multipart/form-data" name="gwangpa_form">
      <input type="hidden" name="mode" value="{MODE}">
      <input type="hidden" name="id" value="{ID}">
      <input type="hidden" name="depth" value="{DEPTH}">
      <input type="hidden" name="page" value="{PAGE}">
        <tr>
          <td colspan="5" height="35">
            <div align="center">
              <b>{BOARD_TITLE}</b>
            </div>
          </td>
        </tr>
        <tr bgcolor="#999999">
          <td>
            <table width="100%" border="0" cellspacing="1" cellpadding="3">
              <tr> 
                <td bgcolor="#E4E4E4"> 
                  <div align="right">제목 : </div>
                </td>
                <td bgcolor="#FFFFFF"> 
                  <input type="text" name="subject" size="40" value="{SUBJECT}">
                </td>
                <td bgcolor="#FFFFFF">
                  * 제목을 입력하세요.
                </td>
              </tr>
              <tr> 
                <td bgcolor="#E4E4E4"> 
                  <div align="right">글쓴이 : </div>
                </td>
                <td bgcolor="#FFFFFF"> 
                  <input type="text" name="name" size="12" value="{NAME}">
                </td>
                <td bgcolor="#FFFFFF">
                  * 이름을 입력하세요.
                </td>
              <!-- BEGIN DYNAMIC BLOCK: hpw -->
              <input type="hidden" name="passwd" value="nothing">
              <!-- END DYNAMIC BLOCK: hpw -->
              </tr>
              <!-- BEGIN DYNAMIC BLOCK: pw -->
              <tr> 
                <td bgcolor="#E4E4E4">
                  <div align="right">비밀번호 : </div>
                </td>
                <td bgcolor="#FFFFFF"> 
                  <input type="password" name="passwd" size="12">
                </td>
                <td bgcolor="#FFFFFF">
                  * 비밀번호를 입력하세요
                </td>
              </tr>
              <!-- END DYNAMIC BLOCK: pw -->
              <tr> 
                <td bgcolor="#E4E4E4"> 
                  <div align="right">홈페이지 : </div>
                </td>
                <td bgcolor="#FFFFFF"> 
                  <input type="text" name="url" size="35" value="{URL}">
                </td>
                <td bgcolor="#FFFFFF">
                  * 홈페이지 주소를 입력하세요.
                </td>
              </tr>
              <tr> 
                <td bgcolor="#E4E4E4"> 
                  <div align="right">이메일 : </div>
                </td>
                <td bgcolor="#FFFFFF"> 
                  <input type="text" name="email" size="35" value="{EMAIL}">
                </td>
                <td bgcolor="#FFFFFF">
                  * 이메일 주소를 입력하세요.
                </td>
              </tr>
              <tr> 
                <td bgcolor="#E4E4E4"> 
                  <div align="right">HTML : </div>
                </td>
                <td bgcolor="#FFFFFF"> 
                  <select name="html">
                  <option value=''>HTML 사용여부</option>
                  <option value='n'>사용안함</option>
                  <option value='br'>사용(줄바꿈허용)</option>
                  <option value='y'>사용(줄바꿈무시)</option>
                  </select>
                </td>
                <td bgcolor="#FFFFFF">
                  HTML 사용여부를 선택하세요
                </td>
              </tr>
              <tr> 
                <td bgcolor="#E4E4E4" valign="top"> 
                  <div align="right">내용 : </div>
                </td>
                <td bgcolor="#FFFFFF" colspan="2">
                  <textarea name="comment" cols="63" rows="15">{COMMENT}</textarea>
                </td>
              </tr>
              <!-- BEGIN DYNAMIC BLOCK: fileup -->
              <tr> 
                <td bgcolor="#E4E4E4"> 
                  <div align="right">{FIELD} : </div>
                </td>
                <td bgcolor="#FFFFFF" colspan="2"> 
                  <input type="file" name="{UPNAME}" size="50">
                </td>
              </tr>
              <!-- END DYNAMIC BLOCK: fileup -->
              <tr bgcolor="#FFFFFF"> 
                <td valign="top" colspan="3">
                  <div align="center">
                    <input type="button" value="확인" onClick="chk_form();">
                    <input type="button" value="취소(뒤로)" onClick="history.go(-1)">
                  </div>
                </td>
              </tr>
            </form>
            </table>
          </td>
        </tr>
        <tr><td height="30"></td></tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
