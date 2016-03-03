<?
####this is fileupload branch#########
session_start();
$home = $_SERVER[DOCUMENT_ROOT] . "/ajax_board/controller/";
include $home . "path_config.php";
############### login session 정보 확인 ###########
if (!empty($_SESSION['login_ok']))#------로그인 되었는지를 비교-------------#
{
 #--------로그인된 회원인 경우에 실행-------#
  $login_ok = $_SESSION['login_ok'];
  echo "$login_ok[1]님 반갑습니다";
  echo "<br />";
  //echo " <a href=db_access/logout.php>[로그아웃] </a>";
 //exit;
}
else
{
	echo ("<script>alert('글을 작성하려면 먼저 로그인하세요');
		window.location.href='$ref_list';
	</script>");
	
//echo ("<script>window.location.href='login_page.php';</script>");
}
#######################login####################
?>
<html>
<head>
<title>practice of board</title>
<link href= "<?=$ref_jqupload?>css/uploadfile.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?=$ref_jqupload?>js/jquery.uploadfile.js"></script>
<style type="text/css">
div { float:left; clear : both;}
</style>
</head>
<script>
	function confirm_submit(){
		var is_ok_title=document.forms["write"]["title"].value;
		var is_ok_content=document.forms["write"]["content"].value;
		var warning_message = "";
		//alert("제목:"+is_ok_title);
		//alert("내용:"+is_ok_content);
		if(is_ok_title && is_ok_content){
			if(confirm("등록하시겠습니까?")){
				//$("input[id=postabledata]").val(postabledata);
				//alert("alert: "+$("#postabledata").val());
				return true;
			}
			else
				return false;
		}else{
			//타이틀, 내용 둘다 널일경우
			if(!is_ok_title && !is_ok_content){ warning_message = "내용과 제목";}
			//그렇지 않으면 내용만 널일때 
			else if(!is_ok_content){ warning_message = "내용";}
			//그렇지 않을때 -> 제목만 널일때 
			else {/*#if(!is_ok_title)*/ 
				warning_message = "제목";}
			alert(warning_message+"을 입력하세요");
			return false;
		}
	};
	function confirm_return(){ // 내용이 없으면 바로 돌아가고 있으면 confirm
		var is_ok_title=document.forms["write"]["title"].value;
		var is_ok_content=document.forms["write"]["content"].value;
		if(!is_ok_title & !is_ok_content) {history.back();}
		else if(confirm("작성중인 내용을 취소하고 되돌아가시겠습니까?")){
			history.back();
		}
	};
	
	
</script>


<body>
<!-- 이미지 업로드 -->

<!--
<form action="/ajax_board/model/process_img.php" method="post" enctype="multipart/form-data" id="upload_form">
<input name="image_file" type="file" required="true" />
<input type="submit" value="Upload" id="submit-btn" />
<img src="#" id="loading-img" style="display:none;" alt="Please Wait"/> -->


<div>
<form id="write" name="write" action="<?=$ref_insert?>" method="post">
<table>
  <tr>
    <td width=50 align=left >제목</td>
    <td>
      <input type="text" id="title" required  name="title" size=40 maxlength=40>
    </td>
  </tr>
  <tr>
    <td width=50 align=left >본문</td>
    <td align=left height=500 >
     <textarea name="content" id="content" required cols=75 rows=30  maxlength=5000></textarea>
	 <input type="hidden" id="postabledata" name="postabledata" value="">
    </td>
  </tr>
  <tr>
   <td></td>
   <td>
	<input id="doc_submit" type=submit value="save(저장하기)" onclick="return confirm_submit()">
	<input type=button value="back(뒤로가기)" onclick="return confirm_return()">
   </td>
  </tr>
</table>
   <div id="preview1upload">Upload</div>
</div>

<script>
var postabledata; 
$(document).ready(function() {
	$("#fileuploader").uploadFile({
		url:"<?=$ref_jqupload?>php/upload.php",
		fileName:"myfile"
	});
	var uploadObj = $("#preview1upload").uploadFile({
		url:"<?=$ref_jqupload?>php/upload.php",
		fileName:"myfile",
		acceptFiles:"image/*",
		showPreview:true,
		previewHeight: "100px",
		previewWidth: "100px",
		multiple:false,
		dragDrop:false,
		maxFileCount:1,
		formData : {
			
		},
		downloadCallback:function(filename,pd)
		{
			location.href= "<?=$ref_jqupload?>"+ "download.php?filename="+filename;
		},
		/*onLoad:function(obj)
		{
			console.log("onLoad start");
			$.ajax({
				cache: false,
				url:"<?=$ref_jqupload?>php/load.php",
				dataType: "json",
				success : function(data){
					for(var i = 0 ; i <data.length; i++)
					{
						//console.log("these are data : " + data[i]["name"] +"  path:" + data[i]["path"]);
						obj.createProgress(data[i]["name"], data[i]["path"], data[i]["size"]);
					}
				}
			});
		},*/
		onSuccess:function(files,data,xhr,pd)
		{
			//files: list of files
			//data: response from server
			//xhr : jquer xhr object
			console.log("success");
			postabledata = JSON.parse(data);
			$("input[id=postabledata]").val(postabledata);
			console.log("postabledata : " + $("#postabledata").val() + ", type : "+ typeof $("#postabledata").val());
		}
		
	});
	/*$("#doc_submit").click(function(){
		uploadObj.startUpload();
	});*/
});
</script>


</form>







</body>




</html>
