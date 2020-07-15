$(document).ready(function(){
	
	updateList(1, "", "", "", 1);
	
	$("#search").click(function(){
		
		updateList(1, $("#title").val(), $("#year").val(), $("#director").val(), 1);
	});
});