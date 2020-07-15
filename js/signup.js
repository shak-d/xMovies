$(document).ready(function(){
	
  	$("#signin").click(function(){
    	location.assign("/index.php");
  	});
	
	$("#signup").click(function(){

		if($("#signupEmail").val() == "" ||
		  $("#signupPassword").val() == "" ||
		  $("#signupName").val() == ""){
			createAlert("Fill all input spaces.", false, 3000);
			return;
		}
		if(!ValidateEmail($("#signupEmail").val())){
			createAlert("Enter a valid email.", false, 3000);
			return;
		}
		
		$.post("/users/validatesignup.php",
			{
			email: ($("#signupEmail").val()),
			password: ($("#signupPassword").val()),
			name: ($("#signupName").val())
			},
			function(data, status){
    			if(status == "success"){
					if(data == "valid"){
						createAlert("You can now ", true, 0);
					}
					else if(data == "nodata"){
						createAlert("Fill all input spaces.", false, 3000);
					}
					else if (data == "email"){
						createAlert("Enter a valid email.", false, 3000);
					}
					else{
						createAlert("Email already in use.", false, 3000);
					}
				}
				else{
					createAlert("Something went wrong.", false, 3000);
				}
			
  			});
	});
});
