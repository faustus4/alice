$(document).ready(function(){
	$('#loginBtn').click(function(){
		var username = $("#username").val();
		var password = $("#password").val();
		var data = {
			username : username,
			password : password
		}

		$.ajax({
		  type: "POST",
		  url: "controllers/login.php",
		  data: JSON.stringify(data),
		    contentType: "application/json; charset=utf-8",
		    dataType: "json",
		}).done(function(s){
			if(s=="1")
			{
				$("#showErrorLogin").hide();
				window.location.href = "index.php";
			} else {
				$("#showErrorLogin").show();
			}
		});
	
		//console.log('initiate login', username, password)
	})
})