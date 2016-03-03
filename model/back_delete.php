<?
$home = $_SERVER['DOCUMENT_ROOT'] . "/ajax_board/controller/";
include $home . "path_config.php";
include $path_info_db;
include $path_password;
include "ChromePhp.php";

//$result=mysqli_query($conn, "SELECT file FROM {$table_name_board} WHERE seq=$seq";
$muf_string = isset($_POST['path1'])?$_POST['path1']:"";
ChromePhp::log("data dump:". var_dump($_POST[postabledata]));
$filePath=str_replace("..",".",$muf_string); //required. if somebody is trying parent folder files	
$dir = dirname($filePath);
//ChromePhp::log("filePath:". $filePath);
ChromePhp::log("backdelete muf:" . $muf_string);
if (file_exists($filePath)) 
{
	unlink($muf_string);
	$fi = new FilesystemIterator($dir, FilesystemIterator::SKIP_DOTS);
	//ChromePhp::log("rmdir -> :" . $dir);
	//ChromePhp::log("There were :". iterator_count($fi) ."files");
	if(iterator_count($fi)==0 || iterator_count($fi)==null){
		ChromePhp::log("rmdir");
		rmdir($dir);
	}
	//ChromePhp::log("filePath unlinked");
}
echo "Deleted File ".$fileName."<br>";
?>