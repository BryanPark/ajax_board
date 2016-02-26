<?
session_start();
$home = $_SERVER[DOCUMENT_ROOT] . "/ajax_board/controller/";
include $home . "path_config.php";
//echo "경로 " . $path_login_ok;
//echo $ref_login_ok;

?>
<!DOCTYPE html>
<meta charset="utf-8" />
<title>jQuery 로그인</title>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

<script type="text/javascript" src="<?=$ref_logincheck_js?>" ></script>
<body>
<form id="login_form" name="login_form" action="<?=$ref_login_ok?>" method="post">
<!--자바스크립트(jquery)에 세션값 전달-->
<input id="login_ok" name="login_ok" type="hidden" value='<?=json_encode($_SESSION['login_ok']);?>' />
<table id="login_table">
<tr>
	<td>아이디</td>
	<td><input type='text' id='user_id' name='user_id' tabindex='1'/></td>
	<td rowspan='2'><input type='button' id='login_button' tabindex='3' value='로그인' style='height:50px'/></td>
</tr>
<tr>
	<td>비밀번호</td>
	<td><input type='password' id='user_passwd' name='user_passwd' tabindex='2'/></td>
</tr>
</table>
</form>
<div id="message"></div>
<div id="logout_div">
<form id="logout_form">
<a href="<?=$ref_logout?>" id="logout_link" >[logout]</a>
</form>
</div>

</body>