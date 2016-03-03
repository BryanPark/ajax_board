<?
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
session_start();
$home = $_SERVER['DOCUMENT_ROOT'] . "/ajax_board/controller/";
include $home . "path_config.php";
//include "ChromePhp.php";
include $path_info_db;
include $path_jqupload."php/upload.php"; //including image and file upload php

$login_ok = $_SESSION['login_ok'];
$id = $login_ok[0];
$name = $login_ok[1];
if (!empty($_SESSION['login_ok']))#------로그인 되었는지를 비교-------------#
{
}
else
{
	echo ("<script>alert('글을 작성하려면 먼저 로그인하세요');
		window.location.href=$_SERVER[DOCUMENT_ROOT]/ajax_board/;
	</script>");
	//header("Location:$_SERVER['DOCUMENT_ROOT'] ./ajax_board/");
//echo ("<script>window.location.href='login_page.php';</script>");
}

//$seq = $_GET['seq'];
$title = $_POST['title'];
$content = $_POST['content'];
$muf_string = isset($_POST['postabledata'])?$_POST['postabledata']:"";
$REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];

#Single Quotation 및 특문 처리
//echo "제목:" . $title;
//echo "컨텐츠:" . $content;
//echo "스트링:" . $muf_string;
$title = mysqli_real_escape_string($conn,$title);
$content=  mysqli_real_escape_string($conn,$content);
$sqlfilepath = str_replace($_SERVER['DOCUMENT_ROOT'], "", $muf_string);
$muf_string = mysqli_real_escape_string($conn,$muf_string);
$query = "insert into {$table_name_board} 
(seq, title,	date,	content,	name,	id,   view, ip, file)
values
('', '$title',	now(),	'$content',	'$name','$id',  0, '$REMOTE_ADDR', '$muf_string')";

$result=mysqli_query($conn,$query)or die(mysql_error());

#####################################################################
/*$output_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/";
if(isset($_FILES["myfile"]))
{
	$ret = array();
	
//	This is for custom errors;	
//	$custom_error= array();
//	$custom_error['jquery-upload-file-error']="File already exists";
//	echo json_encode($custom_error);
//	die();

	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	$timedir = $output_dir.$_SESSION['login_ok'][0]."/".date("Ym");
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
 	 	$fileName = $_FILES["myfile"]["name"];
		$ismkdir=mkdir($timedir,0777,true);
		//ChromePhp::log("mkdir success? :".$ismkdir ."timedir:".$timedir);
		$muf_string = $timedir."/".date("Ymd-Hms").$fileName;
 		//$isture = move_uploaded_file($_FILES["myfile"]["tmp_name"],$muf_string);
		//ChromePhp::log("files?" . $_FILES["myfile"]["name"]);
    	$ret[]= $fileName;
		//var_dump($istrue);
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["myfile"]["name"]);
	  $ismkdir=mkdir($timedir,0777,true);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	$fileName = $_FILES["myfile"]["name"][$i];
		move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$timedir."/".date("Ymd-Hms").$fileName);
	  	$ret[]= $fileName;
	  }
	
	}
    //echo json_encode($ret);
 }*/
#####################################################################





mysqli_close($conn);

echo ("<script>window.location.href='$ref_list';</script>");
?>
