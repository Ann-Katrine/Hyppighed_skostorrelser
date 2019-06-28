function show_bruger(){
	$.get("PHP/listinfo.php", function(data){
		var dat = JSON.parse(data);
		$.each(dat, function(key, value){
			$(".list1").append("<p>" + value.Navn +"</p>");
		});
		$.each(dat, function(key, value){
			$(".list2").append("<p>" + value.Email +"</p>");
		});
		$.each(dat, function(key, value){
			$(".list3").append("<p>" + value.Brugerage +"</p>");
		});
		$.each(dat, function(key, value){
			$(".list4").append("<p>" + value.storrelse +"</p>");
		});
	})
}