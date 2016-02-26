
function getlist(page_no){
	var req = new XMLHttpRequest();
	console.log("_C/getlist.js 목록번호 : " + page_no);
	req.onreadystatechange = function handler(){
		if(req.readyState==4 && req.status==200){
		document.getElementById("listview").innerHTML = req.responseText;
		}
	};
	req.open("GET",ref_getlist_php+"?page_no="+page_no,true);
	req.send();
}


