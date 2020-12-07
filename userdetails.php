<?php
	session_start();
	if(!isset($_SESSION['userdata']) || $_SESSION['userdata']['isAdmin']==1){
		header('Location:signout.php');
	}
	else{
    include "dbc.php";
    include "uci.php";
        $user= new User();
        $ud=$user->userdetails($_SESSION['userdata']['username']); 
?>
<!DOCTYPE html>
<html lang="zxx">
	<head>
        <title>OSLO Template</title>
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
            $(document).ready(function(){
                $("#<?php echo $ud['user_id']?>result").hide();
                $("#<?php echo $ud['user_id']?>").click(function(){	
                    $("#Name").html("<input type='text' id='<?php echo $ud['name']?>'value='<?php echo $ud['name']?>'>");
                    $("#mobile").html("<input type='number' id='<?php echo $ud['mobile']?>'value='<?php echo $ud['mobile']?>'>");
                    
                    $("#<?php echo $ud['user_id']?>result").show();
                    $("#<?php echo $ud['user_id']?>").hide();
                });
                $("#<?php echo $ud['user_id']?>result").click(function(){	
					if(confirm("Are you sure you want to confirm this?")){
						var name=document.getElementById("<?php echo $ud['name']?>").value;
						var mob= document.getElementById("<?php echo $ud['mobile']?>").value;
						//var password= document.getElementById("cpassword").value;
						var password="";
						var newpassword="";
						name=name.trim();
						//var newpassword= document.getElementById("newpassword").value;
						var user_id=<?php echo $ud['user_id']?>;
						if(name==""||mob==""){
							$("#message").html("<strong>Please check Name or Mobile Number </strong>");
						}
						else if(/[0-9]/g.test(name) != false) {
							alert('Numbers not allowed in name');
						}
						else if(/[$-/:-?{-~!"^_`\[\]]/.test(name) != false) {
							alert('Your name contains illegal characters.');
						}
						else if(mob.length<10 || mob.length>10){
							alert('Enter 10 digit mobile number.');
						}	
						else if(/[\.]/.test(mob) != false) {
							alert('Your mobile contains illegal characters.');
						}
						else{
							$.ajax({
								url:'ajax.php',
								type:'POST',
								data:{name:name , mobile:mob , password:password, newpassword:newpassword, action:"update",user_id:user_id },
								success: function(result){
									location.reload();
								},
								error:function(){
									alert ('error');
								}
							});
						}
					}	
				else{
					return false;
				}	
                });
            });
        </script>
    </head>
    <body>
       <?php include "indexheader.php";?>
		<!-- Fare Calculator-->
		<div class="jumbotron">
		<div id="userdetails " class="container text-center pb-4 pl-5 pt-5 tablecon">
                <p><h3><span id="userheading">User Details</span></h3><img id='acc' src='ID.png' alt='Logo' ></p>
                <p><span class="h5" id="userheading userid">User Id : </span><div id="UserID"><?php echo $ud['user_id'];?></div></p>
                <p><span class="h5" id="userheading username">Username : </span> <div id="UserName"> <?php echo $ud['user_name'];?></div></p>
                <p><span class="h5" id="userheading name">Name : </span><div id="Name"> <?php echo $ud['name'];?></div></p> 
                <p><span class="h5" id="userheading dos">Date of Sign-Up : </span><div id="DOS"><?php $date=date_create($ud['Date_of_signup']); echo date_format($date,"D,M d h:i:s ");?> </div></p>
                <p><span class="h5" id="userheading mob">Mobile : </span><div id="mobile"><?php echo $ud['mobile'];?></div></p>
               
                <div id="message"></div>
					<a class="btn cyan" id="<?php echo $ud['user_id']?>" href="#">Change Details</a>
					<a class="btn cyan " id="<?php echo $ud['user_id']?>result" href="#">Update</a>
            </div>
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