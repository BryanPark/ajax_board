<?
session_start();

$home = $_SERVER[DOCUMENT_ROOT] . "/ajax_board/controller/";
include $home . "path_config.php";
include $path_info_db;


$seq = $_GET[seq];
$page_no = $_GET[page_no];

// 조회수 업데이트
$result=mysqli_query($conn,"update {$table_name_board} set view=view+1 where seq=$seq");

// 글 정보 가져오기
$result=mysqli_query($conn, "select * from {$table_name_board} where seq=$seq" );
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
if(!$row){ // seq 값이 잘못입력되어 쿼리가 없을땐 -> 가장 최신의 글 표시.
	$result=mysqli_query($conn, "select * from {$table_name_board} order by seq desc limit 0,1");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	//또는 스크립트로 뒤로가기도 가능하지만 스크립트 막아놓는 브라우저 대비
}
mysqli_close($conn);
?>

<html>
<head>
<title>테스트</title>
<style>
img:{
width : 50%;
height : 50%;
}
</style>


</head>

<body>
<center>
<?
############### login session 정보 확인 ###########
if (!empty($_SESSION['login_ok']))#------로그인 되었는지를 비교-------------#
{
 #--------로그인된 회원인 경우에 실행-------#
  $login_ok = $_SESSION['login_ok'];
  $login_ok[4]  = 1;
  //echo "$login_ok[1]님 반갑습니다";
  //echo " <a href=db_access/logout.php>[로그아웃] </a>";
 //exit;
}
else
{
 //echo ("로그인하세요! <a href=login_page.php>[로그인]</a>");
}
#######################login####################
?>
<table width=100% border=0 cellpadding=2 cellspacing=1
bgcolor=#777777>

	<!--글제목-->
	<tr>
		<td height=20 colspan=6 align=center bgcolor=#999999>
			<font color=white><B><?=htmlspecialchars($row[title])?></B></font>
		</td>
	</tr>
	<!--/글제목-->

	<!--글정보-->
	<tr>
		<td width=50 height=20 align=center bgcolor=#EEEEEE>글쓴이</td>
		<td width=240 bgcolor=white><?=$row[name]?></td>
		<td width=50 height=20 align=center bgcolor=#EEEEEE>
			날짜
		</td>
		<td width=240
			bgcolor=white><?=$row[date]?>
		</td>
		<td width=50 height=20 align=center bgcolor=#EEEEEE>조회수</td>
		<td width=240 bgcolor=white><?=$row['view']?></td>
	</tr>
	<!--/글정보-->

	<!--본문-->
	<tr height=100px>
		<td bgcolor=white colspan=6>
			<font color=black>
				<pre><?=htmlspecialchars($row['content'])?></pre>
			</font>
		</td>
	</tr>
	<!--/본문-->
	
	<!--첨부사진-->
	<?
	if($row['file']!= null&&$row['file']!= ""){
		echo "<tr height=100px>
			<td bgcolor=white colspan=6>
				<font color=black>
					<pre>첨부 이미지</pre>
					<img width='60%' src='".htmlspecialchars(str_replace($_SERVER['DOCUMENT_ROOT'],'',$row['file'])). "'>
				</font>
			</td>
		</tr>";
	}
	?>
	<!--첨부사진-->

	<!-- 기타 버튼 + 이전 다음 -->
	<tr>
		
		<td colspan=6 bgcolor=#999999>
			<table width=100%>
			<tr>
				<!-- 기타 버튼 -->
				<td align=left height=20>

					<a href=list.php?seq=<?=$seq?> onclick='closearticle(); return false;'><font color=white>
					[닫기]</font></a>
					<a href=write_doc.php><font color=white>
					[글쓰기]</font></a>
					<a href=edit_doc.php?seq=<?=$seq?>><font color=white>
					[수정]</font></a>
					<a href=<?=$ref_predel?>?seq=<?=$seq?>><font color=white>
					[삭제]</font></a>
					
				</td>
				<!-- /기타 버튼-->

				<!-- 이전 다음 -->
				<td align=right>
					<?
					// 현재 글보다 id 값이 큰 글 중 가장 작은 것을 가져온다. 삭제됬을때를 생각해서 이렇게 구현함
					// 즉 바로 이전 글 ORDER BY id ASC가 함축됨 즉 오름차순으로 정렬되있음
					$query=mysqli_query($conn,"SELECT seq FROM {$table_name_board} WHERE seq>$seq LIMIT 1");
					$prev_id=mysqli_fetch_array($query,MYSQLI_ASSOC);

					if ($prev_id[seq]) // 이전 글이 있을 경우
					{
					echo "<a href=read.php?seq=$prev_id[seq] onclick=' getarticle($prev_id[seq]); return false;'>
					<font color=white>[이전]</font></a>";
					}
					else
					{
					echo "[이전]";
					}

					//내림차순으로 정렬하고 작은 것 한개 가져옴
					$query=mysqli_query($conn,"SELECT seq FROM {$table_name_board} WHERE seq <$seq
					ORDER BY seq DESC LIMIT 1");
					$next_id=mysqli_fetch_array($query);

					if ($next_id[seq])
					{
					echo "<a href=read.php?seq=$next_id[seq] onclick=' getarticle($next_id[seq]); return false;'>
					<font color=white>[다음]</font></a>";
					}
					else
					{
					echo "[다음]";
					}
					?>
				</td>
				<!-- /이전 다음 -->
			</tr>
			</table>
			</b></font>
		</td>
	</tr>
	<!-- /기타 버튼 + 이전 다음 -->

</table>
</center>
</body>
</html>

