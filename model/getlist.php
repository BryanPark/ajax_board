<?
session_start();

##include 할 php들 경로 정보 path_config.php file => $home / path_config.php
$controller = $_SERVER[DOCUMENT_ROOT] . "/ajax_board/controller/";
include $controller . "path_config.php";
##DB 관련 정보 저장된 php파일
include $path_info_db;
##관련 변수 저장된 php 파일
include $path_variables;


#echo "변수\n" . $path_variables;
#echo "루트\n" . $home;
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
<link rel="stylesheet" href="<?=$ref_css?>" type="text/css" />
<meta charset="UTF-8">
<title></title>

</head>
<body>
<div id="top_bar" class="row">
	<a class="cell">
	no.(글번호)
	</a>
	<a class="cell">
	title(제목)
	</a>
	<a class="cell">
	name(작성자id)
	</a>
	<a class="cell">
	date(게시일)
	</a>
	<a class="cell">
	view(조회수)
	</a>
</div>



</body>
</html>
<?


#######리스트 쿼리#############
$limit_start = $page_no*$page_size;
#검색어어와 옵션을 지정한 경우
if($keyword!=NULL & $search_option!=NULL){
#검색옵션이 2가지인 경우
if($search_option=="name_n_title"){
$search_query = "SELECT * FROM {$table_name_board} WHERE name like '%$keyword%' or title like '%$keyword%'";
}
#검색 옵션이 단일 옵션일때
else{
$search_query = "SELECT * FROM {$table_name_board} WHERE $search_option like '%$keyword%'";
}
$query_get_doc=$search_query ." ORDER BY seq DESC LIMIT $limit_start,$page_size";
}
#검색이 아닌 경우
else{

$query_get_doc = "SELECT * FROM {$table_name_board} ORDER BY seq DESC LIMIT $limit_start, $page_size";
}
#########리스트 쿼리
$result = mysqli_query($conn,$query_get_doc);
#with this while function we put doc array to list view of html.
#######리스트 쿼리#############
$limit_start = $page_no*$page_size;
#검색어어와 옵션을 지정한 경우
if($keyword!=NULL & $search_option!=NULL){
#검색옵션이 2가지인 경우
if($search_option=="name_n_title"){
$search_query = "SELECT * FROM {$table_name_board} WHERE name like '%$keyword%' or title like '%$keyword%'";

}
#검색 옵션이 단일 옵션일때
else{
$search_query = "SELECT * FROM {$table_name_board} WHERE $search_option like '%$keyword%'";
}

$query_get_doc=$search_query ." ORDER BY seq DESC LIMIT $limit_start,$page_size";
}
#검색이 아닌 경우
else{

$query_get_doc = "SELECT * FROM {$table_name_board} ORDER BY seq DESC LIMIT $limit_start, $page_size";
}
#########리스트 쿼리
$result = mysqli_query($conn,$query_get_doc);
#with this while function we put doc array to list view of html.


while($row=mysqli_fetch_array($result))
{
?>
<div id="docs" class="row">
	<!--FOR SEQ COUNT-->
	<a class="cell" id="doc_no" href=<?=$ref_getarticle_php?>?seq=<?=$row[seq]?> onclick='getarticle(<?=$row[seq]?>); return false;'>
	<?=$row[seq]?>
	</a>

	<!--FOR TITLE-->
	
	<a class="cell" id="doc_title" href=<?=$ref_getarticle_php?>?seq=<?=$row[seq]?> onclick='getarticle(<?=$row[seq]?>); return false;'>
	<?=htmlspecialchars($row[title])?>
	</a>
	
	<a class="cell" id="doc_name" >
	<?=htmlspecialchars($row[name])?> (<?=$row[id]?>)
	</a>

	<a class="cell" id="doc_date" >
	<?=$row[date]?>
	</a>

	<a class="cell" id="doc_viewcount">
	<?=$row[view]?>
	</a>
</div>
<?
}
//<!--/게시물 뿌려주는 부분-->
//SQL 연결 종료
mysqli_close($conn);
?>

