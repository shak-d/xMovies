$(document).ready(function(){

	updateList(1, "", "", "", 2);
	
	$("#search").click(function(){
		updateList(1, $("#title").val(), $("#year").val(), $("#director").val(), 2);
	});
	
});

