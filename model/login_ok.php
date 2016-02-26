<?
session_start();

$home = $_SERVER['DOCUMENT_ROOT'] . "/ajax_board/controller/";
include $home . "path_config.php";
//echo "경로 " . $path_login_ok;
include $path_info_db;
include $path_password;

if(!isset($_POST['is_ajax'])) exit;
if(!isset($_POST['user_id'])) exit;
if(!isset($_POST['user_passwd'])) exit;
$is_ajax=$_POST['is_ajax'];
$user_id = $_POST['user_id'];
$user_passwd = $_POST['user_passwd'];

$login_query = "select user_no, user_id, user_passwd, user_name, user_email, user_regdate from {$table_name_member} where user_id='$user_id'";
$result = mysqli_query($conn,$login_query);
$row = mysqli_fetch_row($result);

if(!$is_ajax) exit;
if($row[0]==NULL)
{
	session_destroy();
exit("fail_id");
//echo "rw" . $path_info_db;
}
else{
##아이디는 있음
if(password_verify($user_passwd, $row[2])){
if (empty($_SESSION['login_ok'])) {
$_SESSION['login_ok'] = array($row[1], $row[3], $row[4], $row[5]);
}
exit('success');
}
else {
	session_destroy();
	exit("fail_pw");
}
}
?>
