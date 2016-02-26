<?
	session_start();
	$home = $_SERVER['DOCUMENT_ROOT'] . "/ajax_board/controller/";
	include $home . "path_config.php";
	include $path_info_db;

    $login_ok = $_SESSION['login_ok'];
	//데이터 베이스 연결하기
	

    $seq = $_GET[seq];
    $name = $_POST[name];
    $passwd = $_POST[passwd];
    $title = $_POST[title];
    $content = $_POST[content];

	//특문처리
	$title = mysqli_real_escape_string($conn,$title);
	$content=  mysqli_real_escape_string($conn,$content);
    // 회원정보와 글의 회원정보를 가져와서 비교
    $query = "SELECT id FROM {$table_name_board} WHERE seq=$seq";
    $result=mysqli_query($conn,$query);
    $row=mysqli_fetch_array($result);
	

    //입력된 값과 비교한다.
    if (!empty($_SESSION['login_ok'])&($row[id] == $login_ok[0] )) { //로그인 되어 있고 해당 사용자인경우
        $query = "UPDATE {$table_name_board} SET
        title='$title', content='$content' WHERE seq=$seq";//업데이트 쿼리문
        $result=mysqli_query($conn,$query);
		//echo ("<script>alert('$title 타이틀 $content');</script>");
		echo ("<script>alert('정상적으로 수정되었습니다');</script>");
    }
    else { // 해당 사용자가 아닌 경우
        
		echo ("
        <script>
        //alert('해당 사용자가 아닙니다.');
        //history.go(-1);
        </script>
        ");
		//echo "값" . $path_info_db;
        exit;//반드시 exit를 써줘야됨. 안그러면 아래의 코드가 실행이됨.
    }

    //데이터베이스와의 연결 종료
    mysqli_close($conn);
	
    //수정하기인 경우 수정된 글로.. => 글목록으로
    echo ("<meta http-equiv='Refresh' content='0.5; URL=$ref_list?seq=$seq'>");
?>