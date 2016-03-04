

$(document).ready(function() {
	//jQuery code goes here
	$('#user_id').on('input', function() {
		var input=$(this);
		var re = /^[a-z]{1}\w{2,19}$/g; //20자 영소문자
		var is_id=re.test(input.val());
		if(is_id){input.removeClass("invalid").addClass("valid");}
		else{input.removeClass("valid").addClass("invalid");}
	});

	$('#user_name').on('input', function() {
		var input=$(this);
		var re = /^[가-힣]{2,5}$/g; //2~5자 한글
		var is_name=re.test(input.val());
		if(is_name){input.removeClass("invalid").addClass("valid");}
		else{input.removeClass("valid").addClass("invalid");}
	});

	// Email must be an email
	$('#user_email').on('input', function() {
		var input=$(this);
		var re =/^([A-Z|a-z|0-9](\.|_){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$/gm;
		var is_email=re.test(input.val()); //가능한문자@주소.주소 형식
		if(is_email){input.removeClass("invalid").addClass("valid");}
		else{input.removeClass("valid").addClass("invalid");}
	});

	$('#user_pass').on('input', function() {
		var input=$(this);
		var re = /^(?=.*\d)(?=.*[a-z])(?=.*[a-zA-Z]).{8,}$/gm;
		var is_pass=re.test(input.val()); 
		if(is_pass)
			{input.removeClass("invalid").addClass("valid");}
		else{input.removeClass("valid").addClass("invalid");}
	});

	$('#user_pass2').on('input', function() {
		var input=$(this);
		var re = /^(?=.*\d)(?=.*[a-z])(?=.*[a-zA-Z]).{8,}$/gm;
		var is_pass2=re.test(input.val());
		var pass2 = $('#user_pass2').val();
		var pass1 = $('#user_pass').val();
		//console.log("pass2 : "+pass2 +"pass1:"+pass1);
		if(is_pass2 && (pass2 == pass1))
			{input.removeClass("invalid").addClass("valid");}
		else{input.removeClass("valid").addClass("invalid");}
	});
	$('#user_tel').on('input', function() {
		var input=$(this);
		var re = /^([0]{1}[0-9]{9,12})$/gm;
		var is_tel=re.test(input.val()); 
		if(is_tel)
			{input.removeClass("invalid").addClass("valid");}
		else{input.removeClass("valid").addClass("invalid");}
	});


	$('#contact_website').on('input', function() {
		var input=$(this); //www->자동으로 http://www로 치환
		if (input.val().substring(0,4)=='www.'){input.val('http://www.'+input.val().substring(4));}
		var re = /(http|ftp|https):\/\/[\w-]+(\.[\w-]+)+([\w.,@?^=%&:\/~+#-]*[\w@?^=%&\/~+#-])?/;
		var is_url=re.test(input.val()); //프로토콜://주소.주소
		if(is_url){input.removeClass("invalid").addClass("valid");}
		else{input.removeClass("valid").addClass("invalid");}
	});

	$('#contact_message').keyup(function(event) {
		var input=$(this);
		var message=$(this).val();
		console.log(message);
		if(message){input.removeClass("invalid").addClass("valid");}
		else{input.removeClass("valid").addClass("invalid");}	
	});

	// After Form Submitted Validation
	/*$("#join_submit_button").click(function(event){
		var form_data=$("#form_signup").serializeArray();
		var error_free=true;
		for (var input in form_data){
			var element=$("form_signup_"+form_data[input]['name']);
			var valid=element.hasClass("valid");
			var error_element=$("span", element.parent());
			if (!valid){error_element.removeClass("error").addClass("error_show"); error_free=false;}
			else{error_element.removeClass("error_show").addClass("error");}
		}
		if (!error_free){
			event.preventDefault(); 
		}
		else{
			alert('No errors: Form will be submitted');
		}
	});*/

});