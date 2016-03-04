<?php
$home = $_SERVER['DOCUMENT_ROOT'] . "/ajax_board/controller/";
include $home . "path_config.php";
//include "ChromePhp.php";
include $path_info_db;
include $path_jqupload."php/upload.php"; //including image and file upload php
include $path_password;

$email = strtolower($_POST['email']);
$email = mysqli_real_escape_string($conn, $email);

$query = "SELECT user_no FROM {$table_name_meber} WHERE user_email = '$email' LIMIT 1";
$result = mysqli_query($conn, $query);
$dupl_email= mysqli_num_rows($conn, $result);

$query = "SELECT user_no FROM {$table_name_meber} WHERE user_id = '$email' LIMIT 1";
$result = mysqli_query($conn, $query);
$dupl_id = mysqli_num_rows($conn, $result);

$array[] = $dupl_email;
$array[] = $dupl_id;


echo $array;
?>