<?
#################ROOT####################

#################list.php################
############################변수 설정#################################
#상수, 1 페이지에 들어가는 게시물 수 #CONSTANT;
#how many docs in the page.
$page_size=10;
#상수, 페이지 갯수를 몇개나 나열할 것인지 #CONSTANT;
#how may pages be shown in the below;
#usually 10;
$page_arr_size=10;

#변수, 보여질 page의 번호 ;
#variable what page will be shown.
$page_no = $_GET[page_no];
$seq = $_GET[seq];

#게시물 검색 옵션과 키워드 변수
$keyword = $_POST[keyword];
$search_option = $_POST[search_option];

#페이지 번호에 음수값 예외 처리.
#exception handling for the wrong input (neg number) from somewhere else.
if(!$page_no || $page_no < 0) $page_no=0;

#총 글 갯수 counting.
#count the total docs
$row_count_query = "SELECT count(*) FROM {$table_name_board}";
#query that counts rows in the table.
$row_count_resource = mysqli_query($conn,$row_count_query);
#a query and a connection information. give us resource.
$row_count = mysqli_fetch_row($row_count_resource)[0];
#fetch the count value AND put the item in the [0] index into a variable named row_count;

#필요 페이지 갯수 계산 -> ceil( 전체 글수 / 페이지 크기 )
#count how many pages will we have by ceil($row_count/$page_size);
if($row_count < 0 ) $row_count = 0;
#divide number of the content by page_size.
$page_count = ceil($row_count/$page_size);
#페이지 숫자를 주소창으로 입력할때 등, 범위 초과시 가장 최후의 목록으로
if($page_no>=$page_count) $page_no = $page_count-1;

#seq 넘버를 계산해서 해당 게시물이 속하는 page로 page_no 설정.
#문제점 게시물이 page_size 이상 지워지면 page_no 설정이 -로 되버리는 문제.
#해결 방안 -> page_size를 seq 대신에 seq를 쿼리에 날려서
#전체 DB에서 몇번째 게시물인지를 계산해서 real_seq라는 변수에 저장후
#real_seq로 page_no 계산
#calculate the order of the previous visited document
#by sending query with 'seq'
#store calculated real sequence in the $real_seq and
#use $real_seq instead of $seq to calculated $page_no
if($seq!=NULL){
$seq_count_query = "SELECT count(*) FROM {$table_name_board} WHERE seq<=$seq";
$seq_count_resource = mysqli_query($conn,$seq_count_query);
$real_seq = mysqli_fetch_row($seq_count_resource)[0];
$page_no = floor(($row_count-($real_seq))/$page_size);
}

################################/변수 설정###################################


#################/list.php###############

?>