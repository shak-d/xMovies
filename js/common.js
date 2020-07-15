function ValidateEmail(mail){
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
    return (true)
  
 return (false)
}

function createAlert(message, isSignUp, showTime){
	
	var parent = document.getElementById("wrong");
	var child = parent.firstChild;
	if(child != null)
		parent.removeChild(child);
	
	var div = document.createElement("div");
	
	if(!isSignUp)
		div.className = "alert alert-danger";
	else
		div.className = "alert alert-success";
	div.id = "messagge";
	var text = document.createTextNode(message);

	div.appendChild(text);
		if(isSignUp){
		var goodlink = document.createElement("a");
		goodlink.className = "alert-link";
		goodlink.href = "/index.php";
		goodlink.appendChild(document.createTextNode("log in"));
		div.appendChild(goodlink);
	}

	parent.appendChild(div);
	
	$("#wrong").hide();
	$("#wrong").slideDown(300);
	if(!isSignUp)
		$("#wrong").delay(showTime).slideUp(300);
	
}