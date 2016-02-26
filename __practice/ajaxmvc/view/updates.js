var updates = {

    writeContent: function (xmlhttp) {
        if (!xmlhttp.responseText) {
            alert("I got nothing from the server");
        }
        var data = eval(xmlhttp.responseText);
        var write_to = document.getElementById('content');
        write_to.innerHTML = ''; // yeah, I know
        
		var html2dom_root = write_to;
		var table = document.createElement("table");
		var table_1_tbody = document.createElement("tbody");
        for (var i in data) {
			table_1_tbody_2_tr = document.createElement("tr");
			table_1_tbody_2_tr_1_td = document.createElement("td");
			num = 1 + parseInt(i);
			table_1_tbody_2_tr_1_td_1_text = document.createTextNode(num);
			table_1_tbody_2_tr_1_td.appendChild(table_1_tbody_2_tr_1_td_1_text);
			table_1_tbody_2_tr.appendChild(table_1_tbody_2_tr_1_td);
			table_1_tbody_2_tr_2_td = document.createElement("td");
			table_1_tbody_2_tr_2_td_1_text = document.createTextNode(data[i]);
			table_1_tbody_2_tr_2_td.appendChild(table_1_tbody_2_tr_2_td_1_text);
			table_1_tbody_2_tr.appendChild(table_1_tbody_2_tr_2_td);
			table_1_tbody.appendChild(table_1_tbody_2_tr);
		}
		table.appendChild(table_1_tbody);
		html2dom_root.appendChild(table);
		
		behaviours.updateTableBehaviour();
    }
}