<?
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
session_start();
$home = $_SERVER['DOCUMENT_ROOT'] . "/ajax_board/controller/";
include $home . "path_config.php";
//include "ChromePhp.php";
include $path_info_db;
include $path_jqupload."php/upload.php"; //including image and file upload php
include $path_password;

$login_ok = $_SESSION['login_ok'];
$id = $login_ok[0];
$name = $login_ok[1];
$user_id= $_POST['user_id'];
$user_name = $_POST['user_name'];
$user_passwd = $_POST['user_pass'];
$user_email = $_POST['user_email'];
$user_bdate = $_POST['user_bdate'];
$user_tel = $_POST['user_tel'];
$hash = password_hash($user_passwd, PASSWORD_DEFAULT); 

$query = "SELECT * FROM {$table_name_member} WHERE user_email = '$user_email' LIMIT 1";
$result = mysqli_query($conn, $query);

$dupl_email= mysqli_num_rows($result);

$query = "SELECT * FROM {$table_name_member} WHERE user_id = '$user_id' LIMIT 1";
$result = mysqli_query($conn, $query);
$dupl_id = mysqli_num_rows($result);



#Single Quotation 및 특문 처리
//echo "제목:" . $title;
//echo "컨텐츠:" . $content;
//echo "스트링:" . $muf_string;
$query = "insert into {$table_name_member} 
(user_no, user_id,	user_passwd, user_name,	user_email , user_regdate)
values
('',	'$user_id',	'$hash',	'$user_name', '$user_email', now())";

echo ("쿼리 " . $query);

echo ("중복체크".$dupl_email."중복체크2".$dupl_id);

if (!empty($_SESSION['login_ok']))#------로그인 되었는지를 비교-------------#
{
	echo ("로그인되있다");
	echo ("<script>alert('이미 로그인되어있습니다.');
		window.location.href=$_SERVER[DOCUMENT_ROOT]/ajax_board/;
	</script>");
	exit;
}
if($dupl_email==0 & $dupl_id == 0){
	$result=mysqli_query($conn,$query);
	echo ( "success" . $result);
	echo ("<script>alert('회원가입이 정상적으로 완료되었습니다'); 
	window.location.href='$ref_list';</script>");
}
else if($dupl_email==1 & $dupl_id == 0){
	echo("email 중복");
	echo ("<script>alert('중복된 email입니다.');history.back();</script>");
}
else if($dupl_email==0 & $dupl_id == 1){
	echo("id 중복");
	echo ("<script>alert('중복된 id입니다.');history.back();</script>");
}
else{
	echo("email, id 모두 중복");
	echo ("<script>alert('이미 가입된 id, email입니다.');history.back();</script>");
}

//$seq = $_GET['seq'];



mysqli_close($conn);


?>
