$(document).ready(function(){
		
	$("#wish1").click(function(event){
		event.preventDefault();
		var what = 1;
		var mov = $("#wish1").attr('href');
		$.get("/users/editwishlist.php",{
					id: mov,
					type: what},
					function(data, status){
			
						if(status == "success"){
							if(data == "already"){
								createAlert("Movie already in watchlist", false, 3000);
							}
							else if(data=="nodata"){
								createAlert("Something went wrong.", false, 3000);
							}
							else{
								if(what==1){
									$("#wish1").html("remove from watchlist");
									$("#wish1").attr("id", "wish2");
								}	
							}
						}
						else{
							createAlert("Something went terribly wrong.", false, 3000);
						}
					});
	});
	
	$("#wish2").click(function(event){
		event.preventDefault();
		var what = 2;
		var mov = $("#wish2").attr('href');
		$.get("/users/editwishlist.php",{
					id: mov,
					type: what},
					function(data, status){
			
						if(status == "success"){
							if(data == "already"){
								createAlert("Movie already in watchlist", false, 3000);
							}
							else if(data=="nodata"){
								createAlert("Something went wrong.", false, 3000);
							}
							else{
								if(what==2){
									$("#wish2").html("Add to watchlist");
									$("#wish2").attr("id", "wish1");
								}	
							}
						}
						else{
							createAlert("Something went terribly wrong.", false, 3000);
						}
					});
	});
});