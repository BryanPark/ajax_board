<?
//데이터 베이스 연결하기
$home = $_SERVER['DOCUMENT_ROOT'] . "/ajax_board/controller/";
include $home . "path_config.php";
include $path_info_db;
include $path_password;

$seq = $_GET[seq];
$passwd = $_POST[passwd];

$result=mysqli_query($conn, "SELECT passwd FROM {$table_name_board} WHERE seq=$seq"
);
$row=mysqli_fetch_array($result);


$query ="DELETE FROM {$table_name_board} WHERE seq=$seq"; //데이터 삭제하는 쿼리문
$result=mysqli_query($conn, $query);

?>
<center>
<meta http-equiv='Refresh' content='0.001; URL=<?=$ref_list?>'>
</center>
