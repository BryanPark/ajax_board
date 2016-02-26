$(document).ready(function() {
	var login_ok = jQuery.parseJSON($("#login_ok").val());
	if (login_ok != "" && login_ok != null )
	{
		$("#login_form").hide();
		$("#message").html("<p style='color:green;font-weight:bold'>"+login_ok[1]+"님 환영합니다</p>");
		$("#logout_form").slideDown('slow');
		$("#logout_link").click(function(event) {
			$("#login_form").slideDown('slow');
		});
	}
	else {
		$("#logout_form").hide();
		$("#login_button").click(function() {
			var action = $("#login_form").attr('action');
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
	}




});