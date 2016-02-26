<?
session_start();
$home = $_SERVER[DOCUMENT_ROOT] . "/ajax_board/controller/";
include $home . "path_config.php";
############### login session 정보 확인 ###########
if (!empty($_SESSION['login_ok']))#------로그인 되었는지를 비교-------------#
{
 #--------로그인된 회원인 경우에 실행-------#
  $login_ok = $_SESSION['login_ok'];
  echo "$login_ok[1]님 반갑습니다";
  //echo " <a href=db_access/logout.php>[로그아웃] </a>";
 //exit;
}
else
{
}
#######################login####################
?>
<html>
<head>
<title>practice of board</title>
<link rel="stylesheet" href="<?=$ref_css?>" type="text/css" ></link>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/ajax_board/form_js/jquery.form.js"></script>
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
<span class="label label-default"><br/>Image Type allowed: Jpeg, Jpg, Png and Gif. | Maximum Size 1 MB</span>
<form action="/ajax_board/model/process_img.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
<input name="image_file" id="imageInput" type="file" />
<input type="submit"  id="submit-btn" value="Upload" />
<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
</form>

<!--<img src="images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>-->
</form>
<div id="output"></div>
<!-- /이미지 업로드 -->

<form id="write" name="write" action="<?=$ref_insert?>" method="post">
<table>
  <tr>
    <td width=50 algin=left >제목</td>
    <td>
      <input type="text" id="title" required  name="title" size=40 maxlength=40>
    </td>
  </tr>
  <tr>
    <td width=50 algin=left >본문</td>
    <td align=left height=500 >
     <textarea name="content" id="content" required cols=75 rows=30  maxlength=5000></textarea>
    </td>
  </tr>



  <tr>
   <td></td>
   <td>
	<input type=submit value="save(저장하기)" onclick="return confirm_submit()">
	<input type=button value="back(뒤로가기)" onclick="return confirm_return()">
   </td>

  </tr>
</table>
</form>

<!-- 이미지 업로드 -->

<script type="text/javascript">

//customize values to suit your needs.
var max_file_size 		= 8048576; //maximum allowed file size
var allowed_file_types 	= ['image/png', 'image/gif', 'image/jpeg', 'image/pjpeg']; //allowed file types
var message_output_el 	= 'output'; //ID of an element for response output
var loadin_image_el 	= 'loading-img'; //ID of an loading Image element

//You may edit below this line but not necessarily
var options = { 
	dataType:  'json', //expected content type
	target: '#' + message_output_el,   // target element(s) to be updated with server response 
	beforeSubmit: before_submit,  // pre-submit callback 
	success: after_success,  // post-submit callback 
	resetForm: true        // reset the form after successful submit 
}; 

$('#upload_form').submit(function(){
	console.log("submit");
	$(this).ajaxSubmit(options); //trigger ajax submit
	return false; //return false to prevent standard browser submit
}); 

function before_submit(formData, jqForm, options){
	var proceed = true;
	var error = [];
	
	/* validation ##iterate though each input field
	if you add extra text or email fields just add "required=true" attribute for validation. */
	$(formData).each(function(){ 
		
		//check any empty required file input
		if(this.type == "file" && this.required == true && !$.trim(this.value)){ //check empty text fields if available
			error.push( this.name + " is empty!");
			proceed = false;
		}
		
		//check any empty required text input
		if(this.type == "text" && this.required == true && !$.trim(this.value)){ //check empty text fields if available
			error.push( this.name + " is empty!");
			proceed = false;
		}
		
		//check any invalid email field
		var email_reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/; 
		if(this.type == "email" && !email_reg.test($.trim(this.value))){ 
			error.push( this.name + " contains invalid email!");
			proceed = false;          
		}
		
		//check invalid file types and maximum size of a file
		if(this.type == "file"){
			if(window.File && window.FileReader && window.FileList && window.Blob){
				if(this.value !== ""){
					if(allowed_file_types.indexOf(this.value.type) === -1){
						error.push( "<b>"+ this.value.type + "</b> is unsupported file type!");
						proceed = false;
					}
	
					//allowed file size. (1 MB = 1048576)
					if(this.value.size > max_file_size){ 
						error.push( "<b>"+ bytes_to_size(this.value.size) + "</b> is too big! Allowed size is " + bytes_to_size(max_file_size));
						proceed = false;
					}
				}
			}else{
				error.push( "Please upgrade your browser, because your current browser lacks some new features we need!");
				proceed = false;
			}
		}
		
	});	
	
	$(error).each(function(i){ //output any error to element
		$('#' + message_output_el).html('<div class="error">'+error[i]+"</div>");
	});	
	
	if(!proceed){
		return false;
	}
	
	$('#' + loadin_image_el).show();
}

//Callback function after success
function after_success(data){
	$('#' + message_output_el).html('');
	switch(data.type){ //We are expecting JSON output, hance "data" holds json data from server.
            case 'message':
				$(data.content.images).each(function(i){
					$('#' + message_output_el).append('<div class="message"><img src="uploads/'+this+'" /></div>');
				});
				$(data.content.thumbs).each(function(i){
					$('#' + message_output_el).append('<span class="message"><img src="uploads/thumbs/'+this+'" /></span>');
				});
				
                break;
            case 'error':
                $('#' + message_output_el).html('<div class="error">'+data.content+"</div>");
                break;
        }
	$('#' + loadin_image_el).hide();
}

//Callback function to format bites bit.ly/19yoIPO
function bytes_to_size(bytes){
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}
</script>
<!-- /이미지 업로드 -->




</body>




</html>
