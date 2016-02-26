<?
session_start();
$home = $_SERVER[DOCUMENT_ROOT] . "/ajax_board/controller/";
include $home . "path_config.php";
echo $home;
include $path_info_db;

$login_ok = $_SESSION['login_ok'];
$id = $login_ok[0];
$name = $login_ok[1];

$seq = $_GET[seq];
$title = $_POST[title];
$content = $_POST[content];
$REMOTE_ADDR = $_SERVER[REMOTE_ADDR];

#Single Quotation 및 특문 처리
echo $title;
echo $content;
$title = mysqli_real_escape_string($conn,$title);
$content=  mysqli_real_escape_string($conn,$content);
echo $title;
echo $content;
$query = "insert into {$table_name_board} 
(seq, title,	date,	content,	name,	id,   view, ip)
values
('', '$title',	now(),	'$content',	'$name','$id',  0, '$REMOTE_ADDR')";

$result=mysqli_query($conn,$query)or die(mysql_error());

mysqli_close($conn);

//echo ("<script>window.location.href='$ref_list';</script>");
?>
