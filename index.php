
<?php
session_start();

if(isset($_SESSION['userdata'])&& $_SESSION['userdata']['isAdmin']==1){
	header('Location:signout.php');
}
else{
	include "dbc.php";
	include "rideclass.php";
	$ride= new Ride();
	
	if(isset($_SESSION['currentride']) && isset($_SESSION['userdata'])){
		if (!isset($_SESSION['CREATED'])) {
			$_SESSION['CREATED'] = time();
		} else if (time() - $_SESSION['CREATED'] > 180) {
				unset($_SESSION['currentride']);  
		}
		$msg=$ride->addride($_SESSION['currentride']['pick'], $_SESSION['currentride']['drop'], $_SESSION['currentride']['cab'] ,$_SESSION['currentride']['dis'],$_SESSION['currentride']['fare'], $_SESSION['currentride']['luggage'], $_SESSION['userdata']['userid']);
		header('Location:pendingride.php');
		echo "<script type='text/javascript'>alert('$msg');</script>";
		unset($_SESSION['currentride']);
	}
?>
<!DOCTYPE html>
<html lang="zxx">
	<head>
        <title>CEDCAB|Never Late|</title>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">		
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">		
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="style.css">
		<script>
		function cab(){	
			var carname = document.getElementById("car").value;
			var drop = document.getElementById("drop").value;
			var carname = document.getElementById("car").value;
			var luggage = document.getElementById("luggage").value;
			
			if(carname=="CedMicro"){
				document.getElementById("luggage").placeholder = "";
				document.getElementById("luggage").value = "";
				document.getElementById("luggage").readOnly = true;
				document.getElementById("luggage").placeholder = "Luggage facility unavailable for CEDMICRO";
			}
			else{
				document.getElementById("luggage").readOnly = false;
				document.getElementById("luggage").value = "0";
				document.getElementById("luggage").placeholder = "Luggage(In Kg)";
			}
			
        $(document).ready(function(){
			$(document).on('change','#pick',function(){
    			$("#fare").html("");
				$('#book').html("");
			});
			$(document).on('change','#drop',function(){
    			$("#fare").html("");
				$('#book').html("");
			});
			$(document).on('change','#car',function(){
    			$("#fare").html("");
				$('#book').html("");
			});
			$("#luggage").on("change paste keyup", function() {
				$("#fare").html("");
				$('#book').html("");
			});	
			$("#luggage").on("change paste", function() {
                    var name = document.getElementById("luggage").value;
                    if ( name.match('^[0-9\.]') ) {
                            
                        } else {
                            alert("You've entered a invalid character. Please Re-enter the value");
                            document.getElementById("luggage").value= "0";
                        }
				});		
			document.querySelector("#luggage").addEventListener("keypress", function (evt) {
    			if (evt.which != 8 && evt.which != 0 && evt.which==47 && evt.which < 46 || evt.which > 57)
					{
						evt.preventDefault();
					}
				});		
            $("#cal").click(function(){	
				$("#farecal").submit(function(e) {
					e.preventDefault();
				});	
				var pick = document.getElementById("pick").value;
				var drop = document.getElementById("drop").value;
				var carname = document.getElementById("car").value;
				var luggage = document.getElementById("luggage").value;
				
				
				if(pick==drop){
					$("#fare").html("<strong>Drop location and Pick-up location are same<strong>");
				}
				else if(luggage>100){
					$("#fare").html("<strong>Sorry, We don't carry that much(1-100kg)</strong>");
				}
				
                else{
				    $.ajax({
                        url:'farecal.php',
                        type:'POST',
                        data:{pick:pick , drop:drop , car:carname, luggage:luggage, action:1 },
                        success: function(result){
                            $("#fare").html(result);
							$('#book').html("<button id='book' class='book' name='book' class='mt-4'>Book Ride</button>")
                        },
                        error:function(){
                            alert ('error');
                        }
                    });
				 }	
             });
			  $("#book").click(function(){		
				var pick = document.getElementById("pick").value;
				var drop = document.getElementById("drop").value;
				var carname = document.getElementById("car").value;
				var luggage = document.getElementById("luggage").value;
				if(pick==drop){
					$("#fare").html("<strong>Drop location and Pick-up location are same<strong>");
				}
				else if(luggage>100){
					$("#fare").html("<strong>Sorry, We don't carry that much(1-100kg)</strong>");
				}
                else{
				<?php if(isset($_SESSION['userdata'])){ ?>
				
				    $.ajax({
                        url:'farecal.php',
                        type:'POST',
                        data:{pick:pick, drop:drop, car:carname, luggage:luggage, action:0 },
                        success: function(result){
                            $("#fare").html(result);
                        },
                        error:function(){
                            alert ('error');
                        }
                    });
				
				<?php }
				else{ ?>
				 $.ajax({
                        url:'farecal.php',
                        type:'POST',
                        data:{pick:pick , drop:drop , car:carname, luggage:luggage, action:2 },
                        success: function(result){
							window.location.href = "login.php";
                        },
                        error:function(){
                            alert ('error');
                        }
                    });
					
				<?php  }
					?>
				 }	
             });
        }); 
		}	
		</script>
    </head>
    <body>
       <?php include "indexheader.php";?>
		<!-- Fare Calculator-->
		<div class="jumbotron">
		  	<div class="row justify-content-center" id="sign-up">
				<div class="col justify-content-center" id="signup-text">
					<h1 class="text-center white-text m-0"> Book a <span > <img  src="logo2.png" style="width:150px;" alt="Logo" > </span> to Your Destination In Town</h1><br>
				 	<p class="text-center white-text strong nopadding"> AC cabs for point to point travel </p><hr>
				</div>
			</div>
			<?php include "bookcab.php";?>	  			
		</div>		
		<!-- Footer -->
		<footer class="page-footer font-small cyan darken-3">

			
			<div class="container">

			
			<div class="row">

				
				<div class="col-md-12 py-4">
				<div class="mb-5 flex-center">
					<a class="fb-ic">
					<i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!-- Twitter -->
					<a class="tw-ic">
					<i class="fab fa-twitter fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!-- Google +-->
					<a class="gplus-ic">
					<i class="fab fa-google-plus-g fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!--Linkedin -->
					<a class="li-ic">
					<i class="fab fa-linkedin-in fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!--Instagram-->
					<a class="ins-ic">
					<i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
					</a>
					<!--Pinterest-->
					<a class="pin-ic">
					<i class="fab fa-pinterest fa-lg white-text fa-2x"> </i>
					</a>
				</div>
				</div>
				<!-- Grid column -->

			</div>
			<!-- Grid row-->

			</div>
			<!-- Footer Elements -->

			<!-- Copyright -->
			<div class="footer-copyright text-center ">© 2020 Copyright:
			<a href="#"> CEDCAB PVT.LTD.</a>
			</div>
			<!-- Copyright -->

		</footer>
	</body>
	</html>
<?php } ?>
