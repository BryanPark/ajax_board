<?
session_start();
$home = $_SERVER['DOCUMENT_ROOT'] . "/ajax_board/controller/";
include $home . "path_config.php";
include $path_info_db;
include "ChromePhp.php";

?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="<?=$ref_css?>" type="text/css" />
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src=<?=$ref_form_validation_js?>></script>
</head>
<body>
	<div id = "join">
		<form class="form-signup" name="form_signup" id="form_signup" method="post" action="<?=$ref_join_insert?>" >
			<h2 class="form-signup-heading">SIGN UP</h2>
			<div>
			<label>아이디</label>
			<input type="text" required name="user_id" id="user_id" placeholder="아이디">
			<span class="error">This field is required</span>
			</div>
			<br/>

			<div>
			<label>이름</label>
			<input type="text" required pattern="([가-힣]{2,6})" name="user_name" id="user_name"  placeholder="이름(2-6자)">
			<span class="error">This field is required</span>
			</div><br/>
			
			<div>
			<label>비밀번호</label>
			<input type="password" required name="user_pass" id="user_pass" placeholder="8자이상영문숫자대소구분됨)">
			<span class="error">This field is required</span>
			</div><br/>	
			
			<div>
			<label>비밀번호 확인</label>
			<input type="password" required name="user_pass2" id="user_pass2" placeholder="비밀번호 확인">
			<span class="error">This field is required</span>
			<br/></div>
			
			<div>
			<label>생년월일</label>
			<input type="date" required pattern="(?:19|20)(?:(?:[13579][26]|[02468][048])-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))|(?:[0-9]{2}-(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:29|30))|(?:(?:0[13578]|1[02])-31)))
" max=2016-12-31 min=1910-01-01 name="user_bdate" id="user_bdate"  placeholder="생년월일">
			<span class="error">This field is required</span>
			</div><br/>
			
			<div>
			<label>이메일주소</label>
			<input type="email" required name="user_email" id="user_email"  placeholder="이메일주소"
			pattern ="([A-Z|a-z|0-9](\.|_){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$">
			<span class="error">This field is required</span>
			</div><br/>
			
			<div>
			<label>핸드폰 번호</label>
			<input type="tel" required name="user_tel" id="user_tel"  placeholder="'-'없이 번호만 입력하세요" pattern="([0]{1}[0-9]{9,12})">
			<span class="error">This field is required</span>
			</div>

			<button type="submit" id="join_submit_button" >가입</button>

		</form>  
	</div>
</body>
</html>