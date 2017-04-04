<?php

// session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
       <!-- Bootstrap -->   
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		 <!-- Style --> 
<link rel="stylesheet" type="text/css" href=istyle.css>
		 <!-- Jquery --> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  </head>
  <body>
  
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <p class="navbar-brand" href="#">KanBan Your Life</p>
      </div>
      <div class="nav navbar-nav">
         
</div>
	<button type="button" class="btn btn-primary " data-toggle="modal" 
  	data-target=".modal-example2">Login</button>
  	<button type="button" class="btn btn-primary" data-toggle="modal" 
  	data-target=".modal-example1">SignUp</button>
  
     
    </div>
</nav>

  <div class="cont" align="center">
  <!-- Carousel -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Slides img -->
    <div class="carousel-inner">
      <div class="item active">
        <div class="ops1"></div>
        <img src="x1.jpg" width="947" >
      </div>      
      <div class="item">
         <div class="ops1"></div>
        <img src="x3.jpg" width="1100" >
      </div>
      <div class="item">
        <div class="ops1"></div>
        <img src="x2.jpg" width="943" >
      </div>
    </div>
  </div>
  
</div> 

  	
<div class="container1">
	<div id="warning" class="modal fade modal-example1" tabindex="-1">
	  <div class="modal-dialog modal-md">
	    <div class="modal-content">	   
		    <div class="modal-body">
	           <form id="signup" method ="post" action="./api/signup.php">
			       <div class="header">
			            <h3>Sign up</h3>  
			       </div>
				   <div class="inputs">
					    <input class="form-control" id="fname" name="fname" type="text" placeholder="First name" required > 
					    <input class="form-control" id="lname" name="lname" type="text" placeholder="Last name" required> 
				        <input class="form-control" name="email" type="email"  placeholder="E-mail" required >
				        <input class="form-control" name="password" type="password" placeholder="Password" required>
				    </div>
			   		<div class="modal-footer">
		 			    <input type="submit" class="btn btn-primary" value="Submit Now">           
					</div>  
			 	</form>
		   	</div>
	    </div>
	  </div>
	</div>
</div>

<div class="container2">
	<div id="warning" class="modal fade modal-example2" tabindex="-1">
	  <div class="modal-dialog modal-md">
	    <div class="modal-content">	   
		  <div class="modal-body">
	        <form id="login" method ="post">
		        <div class="header">
		            <h3>Login</h3>  
		        </div>
	        	 <div class="inputs">
		            <input type="email" name="email"  placeholder="E-mail" required>
		            <input type="password" name="password" placeholder="Password" required> 
		         </div>   
	            <!-- <div class="checkboxy">
	                <input type="checkbox">
	                <label class="terms">remmber me</label>
	            </div>  -->   
		    	 
		   		<div class="modal-footer">
		   	 		<input type="submit" class="btn btn-primary "  value=" Submit Now"/>       
				</div>
		  	</form>
	 	</div>	
	   </div>
	  </div>
	</div>
</div>
	
	<script>

		jQuery(document).ready(function(){	
			
			$("#fname").on("keyup", function () {
			    if (!$(this).val().trim().match('^[a-zA-Z ]+$') && !$(this).val()=="") {
			      alert("please enter letters only"); 	
			    }
			});   
			
			$("#lname").on("keyup", function () {
				 if (!$(this).val().trim().match('^[a-zA-Z ]+$') && !$(this).val()=="") {
			      alert("please enter letters only"); 	
			    }
			});

			$("#login").on("submit", function(event){
				event.preventDefault();
				$.ajax({
					url: "./api/login.php",
					type: "POST",
					data: $(this).serialize(),
					success: function(response) {
						console.log(response);
						var data = JSON.parse(response);
						if (data.status) {
							window.location = data.url;
							
						}
					}
				});
			});

			$("#signup").on("submit", function(event){
				event.preventDefault();
				var formData = $(this).serialize();
				$.ajax({
					url: "./api/signup.php",
					method: "POST",
					data: formData,
					success: function(response){
						console.log(response);
						var data = JSON.parse(response);
						if (data.status) {
							window.location = data.url;
						}
					}
				});
			});
		});

		</script>
</body>
</html>
