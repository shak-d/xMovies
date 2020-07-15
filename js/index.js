$(document).ready(function(){
	
  	$("#register").click(function(){
    	location.assign("/signup.php");
  	});
	
	$("#signguest").click(function(){
		
				$.post("/users/validatelogin.php",
			{
			email: "guest@guest.com",
			password: "guest"
			},
			function(data, status){
    			if(status == "success"){
					if(data == "valid"){
						location.assign("/explore.php");
					}
					else if(data == "nodata"){
						
						createAlert("Fill all input spaces.", false, 3000);
					}
					else if (data == "email"){
						createAlert("Enter a valid email.", false, 3000);
					}
					else{
						createAlert("Wrong email or password.",false, 3000);
					}
				}
				else{
					createAlert("Something went wrong.", false, 3000);
				}
			
  			});
		
	});
	
	$("#signin").click(function(){

		if($("#signinemail").val() == "" ||
		  $("#signinpassword").val() == ""){
			createAlert("Fill all input spaces.", false, 3000);
			return;
		}
		if(!ValidateEmail($("#signinemail").val())){
			createAlert("Enter a valid email.", false, 3000);
			return;
		}
		
		$.post("/users/validatelogin.php",
			{
			email: ($("#signinemail").val()),
			password: ($("#signinpassword").val())
			},
			function(data, status){
    			if(status == "success"){
					if(data == "valid"){
						location.assign("/explore.php");
					}
					else if(data == "nodata"){
						
						createAlert("Fill all input spaces.", false, 3000);
					}
					else if (data == "email"){
						createAlert("Enter a valid email.", false, 3000);
					}
					else{
						createAlert("Wrong email or password.",false, 3000);
					}
				}
				else{
					createAlert("Something went wrong.", false, 3000);
				}
			
  			});
	});
});