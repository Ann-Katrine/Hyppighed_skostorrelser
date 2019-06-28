function opret_bruger(){
	let navn = $("#navn").val();
	let mail = $("#mail").val();
	let alder = $("#alder").val();
	let storrelse = $("#storrelse").val();
		
	$.post("PHP/nybruger.php", {"navn": navn, "mail": mail, "alder": alder, "storrelse": storrelse}, function(data){
		alert(data);
	})
	
	document.location.reload();
}

function get_sko_storrelse(){
	$.get("PHP/shoe_size.php", function(data){
		let dat = JSON.parse(data);
		$.each(dat, function(key, value){
			$("#storrelse").append("<option value='"+ value.storrelseId +"'>"+ value.storrelse +"</option>");
		});
	})
}