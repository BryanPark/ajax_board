<?

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
<meta charset="UTF-8">
<title></title>
</head>
<body>

	<form method="post">
	<!--글쓰기 버튼-->
	<div id="write_link" class="cell">
		<a href="<?=$ref_write?>">[글 쓰기]</a>
	</div>
	<!--글쓰기 버튼끝-->

	<!--[페이지 인덱싱]-->
	<div id="index" class="cell">
		<!--인덱싱 변수 초기화-->
		<div id ="configure" class="hidden configure">
			<?
			#페이지 인덱스의 시작 번호 ex) 페이지 인덱스 표시가 1~10, 11~20 이렇게 10개 단위인 경우
			#page_no이 2일때는 페이지 인덱스 표기가 1~10, 12일때는 11~20으로 되어야 함, 이렇게 하기 위해서는
			#내림으로 나눠주면 페이지의 시작 번호를 알 수 있음.
			$curr_page_start = floor($page_no/$page_arr_size)*$page_arr_size;
			#페이지의 끝번호는 = 시작 번호+크기-1
			$curr_page_end = $curr_page_start + $page_arr_size -1;

			#예외 처리;
			#페이지 총 갯수가 설정된 페이지 어레이 갯수보다 작을때;
			#페이지의 끝번호를 갯수로.
			#page count는 1부터, page_end는 0부터 센다.
			if($page_count-1 < $curr_page_end) $curr_page_end = $page_count-1;
			?>
		</div>
		<!--/인덱싱 변수 초기화-->
		<!--페이지 인덱스 좌향 화살표 출력부분-->
		<div id="rarrow" class="cell">
			<?
			#앞 페이지 인덱스 어레이로 이동하는 버튼.
			#현재 페이지 인덱스 시작 숫자가, 페이지 인덱스 어레이의 크기보다 크다면
			#$prev_list 링크를 생성한다.
			if($curr_page_start >= $page_arr_size){
			$prev_list = $page_no-10;
			$prev_page = $page_no-1;
			echo "<a href=$PHP_SELF?page_no=$prev_list onclick='getlist($prev_list); getlistpage($prev_list);return false;'>≪</a> ";
			echo "<a href=$PHP_SELF?page_no=$prev_page onclick='getlist($prev_page);getlistpage($prev_page); return false;'>＜</a>";
			}
			?>
		</div>
		<!--/페이지 인덱스 좌향 화살표 출력부분-->

		<!--페이지 인덱스 번호 출력부분-->
		<div id="number" class="cell">
			<?
			#페이지 인덱스 어레이를 하이퍼링크 텍스트로 출력한다. 시작~끝까지.
			#그리고 현재 인덱스와 일치하는 것은 일반 텍스트로 출력
			for ($i=$curr_page_start; $i <= $curr_page_end; $i++){
			$page = ($i);
			if($page_no!=$page){
			echo " <a href=$PHP_SELF?page_no=$page onclick='getlist($page); getlistpage($page); return false;'>";
			echo "$i"+1;
			echo "</a> ";
			}
			else{
			echo "<b>";
			echo "$i"+1;
			echo "</b>";
			}
			}
			?>
		</div>
		<!--/페이지 인덱스 번호 출력부분-->

		<!--페이지 인덱스 우향 화살표 출력부분-->
		<div id="rarrow" class="cell">
			<?
			#뒷 페이지 인덱스 어레이로 이동하는 버튼 생성
			#현재 페이지 인덱스 끝 숫자가, 페이지 인덱스 어레이의 크기보다 작으면
			#$next_list 링크를 생성한다.
			if($curr_page_end < $page_count-1){
			$next_page = $page_no +1;
			if($page_no+10 <=$page_count){
			$next_list = $page_no +10;
			}
			else $next_list=$page_count-1;
			echo "<a href=$PHP_SELF?page_no=$next_page onclick='getlist($next_page); getlistpage($next_page); return false;'>＞</a> ";
			echo "<a href=$PHP_SELF?page_no=$next_list onclick='getlist($next_list); getlistpage($next_list); return false;'>≫</a>";
			}

			?>
		</div>
		<!--/페이지 인덱스 우향 화살표 출력부분-->
	</div>
	<!--/[페이지 인덱싱]-->

	<!--검색 이후에 목록 새로고침용 새로고침 버튼-->
	<div id="to_list" class="cell">
		<?
		if($keyword!=NULL & $search_option!=NULL){
		echo "<a href='list.php'>[목록으로]</a>";
		}
		?>
	</div>
	<!--/검색 이후에 목록 새로고침용 새로고침 버튼-->

	<!-- 검색 드랍다운 메뉴와 입력박스 시작 -->
	<div id="search" class="cell">
		<select name="search_option" id="search_option">
		<option value="name">이름</option>
		<option value="title">제목</option>
		<option value="name_n_title">제목&이름</option>
		</select>
		<input type="text" name="keyword" id="keyword" size=10 required  value="<?=htmlspecialchars($keyword)?>"/>
		<input type="submit" value="검색" onclick="return confirm_submit('submit');"/>
	</div>
	<!-- 검색 드랍다운 메뉴와 입력박스 끝 -->
	</form>
</body>
</html>
