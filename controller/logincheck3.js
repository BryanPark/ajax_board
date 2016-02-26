$(document).ready(function() {

  //로그인 트리거 눌렀을때
  $('#login-trigger').click(function(){
	$(this).next('#login-content').slideToggle();
	$(this).toggleClass('active');
	if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
	  else $(this).find('span').html('&#x25BC;')
	});
  //로그아웃 트리거 눌렀을때
  $('#logout-trigger').click(function(){
	$(this).next('#logout-content').slideToggle();
	$(this).toggleClass('active');
	if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
	  else $(this).find('span').html('&#x25BC;')
	});

	//로그인 서브밋 버튼 눌렀을때
	$('#loginform').submit(function() {
	   console.log("login_submit")
	   $('#login-content').hide();
	   $('#login, #logout').toggle();
	   $('#logout-trigger').removeClass('active');
	   $('#loginform').find('input:text').val('');
	   $('#loginform').find('input:password').val('');
	   var action = $("#loginform").attr('action');
		var form_data = {
			user_id: $("#user_id").val(),
			user_passwd: $("#user_passwd").val(),
			is_ajax: 1
		};
		$.ajax({
			type: "POST",
			url: action,
			data: form_data,
			success: function(response) {
				if($.trim(response) =='success') {
					$("#message").html("<p style='color:green;font-weight:bold'>로그인 성공!</p>");
					$("#login_form").slideUp('slow');
					$("#message").load("");
				}
				else if($.trim(response) == 'fail_id'){
					$("#message").html("<p style='color:red'>아이디가 잘못되었습니다.</p>");
				}else if($.trim(response) == 'fail_pw'){
					$("#message").html("<p style='color:red'>비밀번호가 잘못되었습니다.</p>");
				}
				else{
					$("#message").html("<p style='color:red'>아이디 또는 비밀번호가 잘못되었습니다.</p>"+response);
				}
			}
		});
		return false;
	});

	//로그아웃 서브밋 버튼 눌렀을때
	$('#logoutform').submit(function() {
	   console.log("logout_submit")
	   $('#login-content').hide();
	   $('#login, #logout').toggle();
	   $('#login-trigger').removeClass('active');
	});

	//로그인,아웃 메뉴에서 취소버튼 눌렀을때
	$('#incancel').click(function(){
		$(':input','#loginform')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		$('#login-content').slideToggle();
		$(this).toggleClass('active');

	});
	$('#outcancel').click(function(){
		$(':input','#loginform')
			.not(':button, :submit, :reset, :hidden')
			.val('');
		$('#logout-content').slideToggle();
		$(this).toggleClass('active');
	});
});