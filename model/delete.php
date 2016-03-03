<?
//데이터 베이스 연결하기
$home = $_SERVER['DOCUMENT_ROOT'] . "/ajax_board/controller/";
include $home . "path_config.php";
include $path_info_db;
include $path_password;
include "ChromePhp.php";

$seq = $_GET[seq];
$passwd = $_POST[passwd];

$result=mysqli_query($conn, "SELECT file FROM {$table_name_board} WHERE seq=$seq"
);
$row=mysqli_fetch_array($result);

#############################################
$filePath=str_replace("..",".",$row['file']); //required. if somebody is trying parent folder files	
$dir = dirname($filePath);
//ChromePhp::log("filePath:". $filePath);
ChromePhp::log("filePath unlink?");
if (file_exists($filePath)) 
{
	unlink($filePath);
	$fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);
	ChromePhp::log("rmdir -> :" . $dir);
	ChromePhp::log("There were :". iterator_count($fi) ."files");
	if(iterator_count($fi)==0 || iterator_count($fi)==null){
		ChromePhp::log("rmdir");
		rmdir($dir);
	}
	ChromePhp::log("filePath unlinked");
}
echo "Deleted File ".$fileName."<br>";
//추가적으로 필요한것 -> 이게 해당 폴더의 마지막 파일이면 해당 폴더까지 삭제하게끔 rmdir에 정규식사용
################################################
##########################
function rmdirAll($dir) {
   $dirs = dir($dir);
   while(false !== ($entry = $dirs->read())) {
      if(($entry != '.') && ($entry != '..')) {
         if(is_dir($dir.'/'.$entry)) {
            rmdirAll($dir.'/'.$entry);
         } else {
            @unlink($dir.'/'.$entry);
         }
       }
    }
    $dirs->close();
    @rmdir($dir);
}
##########################
$query ="DELETE FROM {$table_name_board} WHERE seq=$seq"; //데이터 삭제하는 쿼리문
$result=mysqli_query($conn, $query);

?>
<center>
<meta http-equiv='Refresh' content='0.001; URL=<?=$ref_list?>'>
</center>
