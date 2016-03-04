<?



#### path는 주로 절대경로, ref는 href, form action용 상대경로 
## 순서 바꾸면에러남
#root 기준으로 작성, 서비스의 위치
$path_root = $_SERVER['DOCUMENT_ROOT'] . "/ajax_board/";
#수정불필요
$ref_root = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path_root);
$m = "model/";
$v = "view/";
$c = "controller/";

$ref_jqupload = $ref_root."jquery-upload-file/";
$path_jqupload = $path_root."jquery-upload-file/";

$ref_model = $ref_root .$m;
$ref_view = $ref_root . $v;
$ref_controller = $ref_root . $c;


$path_model = $path_root . $m;
$path_view = $path_root . $v;
$path_controller = $path_root . $c;


$path_info_db = $path_controller . "db_conn.php";
$path_variables = $path_controller . "variables.php";
$path_password = $path_controller . "password.php";

$path_list = $path_view . "listview.php";
$path_read =$path_view . "read.php";
$path_edit = $path_view . "edit_doc.php";
$path_write =$path_view .  "write_doc.php";
$path_search = $path_view . "search.php";
$path_login_view=$path_view . "login_view.php";

$path_logincheck_js = $path_controller . "logincheck.js";
$path_form_validation_js = $path_controller . "form_validation.js";

$path_update =$path_model . "update.php";
$path_delete =$path_model . "delete.php";
$path_predel =$path_model . "predel.php";
$path_insert =$path_model . "insert_db.php";
$path_login_ok =$path_model ."login_ok.php";
$path_logout =$path_model . "logout.php";
$path_back_delete =$path_model . "back_delete.php";
################# 상대경로 목록 ################

$ref_info_db = $ref_controller . "db_conn.php";
$ref_variables = $ref_controller . "variables.php";
$ref_password = $ref_controller . "password.php";

$ref_css = $ref_view. "style.css";
$ref_list = $ref_view . "listview.php";
$ref_read =$ref_view . "read.php";
$ref_edit = $ref_view . "edit_doc.php";
$ref_write =$ref_view .  "write_doc.php";
$ref_search = $ref_view . "search.php";
$ref_login_view=$ref_view . "login_view.php";


$ref_logincheck_js = $ref_controller . "logincheck.js";
$ref_form_validation_js = $ref_controller . "form_validation.js";


$ref_update =$ref_model . "update.php";
$ref_delete =$ref_model . "delete.php";
$ref_predel =$ref_model . "predel.php";
$ref_login_ok =$ref_model ."login_ok.php";
$ref_logout =$ref_model . "logout.php";
$ref_insert =$ref_model . "insert_db.php";
$ref_back_delete =$ref_model . "back_delete.php";
$ref_join_insert =$ref_model . "join_insert_db.php";
$ref_join_view = $ref_view . "join_view.php";

$ref_getlist_js = $ref_controller . "getlist.js";
$ref_getlist_php = $ref_model . "getlist.php";
$ref_getlistpage_js = $ref_controller . "getlistpage.js";
$ref_getlistpage_php = $ref_model . "getlistpage.php";
$ref_getarticle_js = $ref_controller . "getarticle.js";
$ref_getarticle_php = $ref_model . "getarticle.php";
/*echo "
<script>
//ref_getlist_js에서 getlist.php의 주소를 참조하기 위해서 필요한 변수 설정
var ref_getlist_php = '<?=$ref_getlist_php?>';
var ref_getlistpage_php = '<?=$ref_getlistpage_php?>';
var ref_getarticle_php = '<?=$ref_getarticle_php?>';
var ref_list_php = '<?=$ref_list?>';
</script>
<script src=<?=$ref_getlist_js?>></script>
<script src=<?=$ref_getlistpage_js?>></script>
<script src=<?=$ref_getarticle_js?>></script>
";*/
?>


