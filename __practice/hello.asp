<html>
<head>
<script>

//XMLHttpRequest 변수
var req;
var url = "gethint.php?q=";
function showHint(str) {
    //스트링 길이가 0 이면 txtHint에 아무것도 출력하지 않음
	if(str.length==0){
		document.getElementById("txtHint").innerHTML="";
	}
	//그렇지 않다면 (무언가 입력했다면) 새로운 리퀘스트를 주고
	else{
		set_request();
		open_n_send_by("GET",str);
	//gethint.php에 GET방식으로 q = str 파라메터를 줘서 문서를 열고 send한다.
	}
}
function set_request(){
	req = new XMLHttpRequest();
	req.onreadystatechange = handdler
}
function handdler(){
	if(req.readyState==4 && req.status==200){
		document.getElementById("txtHint").innerHTML = req.responseText;
	}
}
function open_n_send_by(option,str){
	req.open(option,url+str,true);
	req.send();
}
</script>
</head>
<body>
<p><b>Start typing a name in the input field below:</b></p>
<form> 
First name: <input type="text" onkeyup="showHint(this.value)">
</form>
<p>Suggestions: <span id="txtHint"></span></p>
</body>
</html>