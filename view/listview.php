<?
session_start();
##include 할 php들 경로 정보 path_config.php file => $home / path_config.php
$controller = $_SERVER['DOCUMENT_ROOT'] . "/ajax_board/controller/";
include $controller . "path_config.php";
##DB 관련 정보 저장된 php파일
include $path_info_db;
##관련 변수 저장된 php 파일
include $path_variables;
#echo "변수\n" . $path_variables;
#echo "루트\n" . $home;

echo "this is fileupload_selfmade branch";

?>
<html>
<head>
<link rel="stylesheet" href="<?=$ref_css?>" type="text/css" ></link>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>

<script>
//ref_getlist_js에서 getlist.php의 주소를 참조하기 위해서 필요한 변수 설정
var ref_getlist_php = '<?=$ref_getlist_php?>';
var ref_getlistpage_php = '<?=$ref_getlistpage_php?>';
var ref_getarticle_php = '<?=$ref_getarticle_php?>';
var ref_list_php = '<?=$ref_list?>';

//검색 기능에서 검색어 입력을 확인 받는 기능 추후에 form에 require 넣고 삭제
//또는 검색 기능이 포함된 getlistpage.php, js로 옮겨갈 가능성
function confirm_submit(){
	if(document.getElementById('keyword').value==""||document.getElementById('keyword').value==undefined){
	alert("검색어를 입력하세요");
	return false;
	}
	return true;
};
//로그인아웃메뉴 표시
</script>
<script src=<?=$ref_getlist_js?>></script>
<script src=<?=$ref_getlistpage_js?>></script>
<script src=<?=$ref_getarticle_js?>></script>


<title>
테스트 게시판
</title>
</head>
<body>
<script>
$(document).ready(function(){
	$("#login_logout_menu").load("login_view.php");
});

</script>

<div id="login_logout_menu">
</div>
<!-- 게시물 클릭시 게시물이 표시될 공간 -->

<div id="article">
</div>

<div id="entire_board">
	<div id="configure" class="hidden configure">
		<?
		############### login session 정보 확인 ###########
		if (!empty($_SESSION['login_ok']))#------로그인 되었는지를 비교-------------#
		{
		#--------로그인된 회원인 경우에 실행-------#
		$login_ok = $_SESSION['login_ok'];
		$login_ok[4]  = 1;
		//echo "$login_ok[1]님 반갑습니다";
		//echo " <a href=$ref_logout>>[로그아웃] </a>";
		//exit;
		}
		else
		{
		//echo ("로그인하세요! <a href=$ref_login_view>[로그인]</a>");
		//echo ("<script>window.location.href='login_page.php';</script>");
		}
		#######################login####################
		?>
	</div>

	<div id="listview" class="table">
		<!-- 게시판 -->
	</div>
	<!--게시판 하단 페이징과 검색메뉴 -->
	<div id="bottom_menu" class="table">
	</div>
	<script type="text/javascript">
	getlist("<?=$page_no?>");
	getlistpage("<?=$page_no?>");
	</script>

</div>

</body>
</html>
