function getlistpage(page_no){
	console.log("getlistpage:start");
	var req = new XMLHttpRequest();
	req.onreadystatechange = function handler_getlistpage(){
		if(req.readyState==4 && req.status==200){
			document.getElementById("bottom_menu").innerHTML = req.responseText;
		}
	};
	req.open("GET",ref_getlistpage_php+"?page_no="+page_no,true);
	req.send();
}
