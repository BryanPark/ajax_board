
function getarticle(seq){
	var req = new XMLHttpRequest();
	console.log("_C/getarticle.js seq : " + seq);
	req.onreadystatechange = function handler(){
		if(req.readyState==4 && req.status==200){
			document.getElementById("article").innerHTML = req.responseText;
		}
	};
	req.open("GET",ref_getarticle_php+"?seq="+seq,true);
		console.log("_C/getarticle.js 목록번호 open 이후 :  " + seq);
	req.send();
}

function closearticle(){
	document.getElementById("article").innerHTML = "";
}

