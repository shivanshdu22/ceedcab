<?php 
      session_start();
      if(!isset($_SESSION['userdata'])|| $_SESSION['userdata']['isAdmin']==1){
        header('Location:signout.php');
        }
        else{
            include "dbc.php";
            include "rideclass.php";
            $ride= new Ride();
            if(isset($_SESSION['currentride'])){
                $msg=$ride->addride($_SESSION['currentride']['pick'], $_SESSION['currentride']['drop'], $_SESSION['currentride']['cab'] ,$_SESSION['currentride']['dis'],$_SESSION['currentride']['fare'], $_SESSION['currentride']['luggage'], $_SESSION['userdata']['userid']);
                echo "<script type='text/javascript'>alert('$msg');</script>";
                header('Location:pendingride.php?Message='.$msg.'');
                unset($_SESSION['currentride']);
            }
           
     
      include "uci.php";
     
          $user= new User();
          $ud=$user->userdetails($_SESSION['userdata']['username']); 
          $ride= new Ride();
	    $rd= $ride->ridedetails($_SESSION['userdata']['userid']); 
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
		<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="style.css">
        <script>
             $(document).ready(function(){
                $('#cancel').click(function(){
                        var rideid =$(this).attr('data-id');
                        var action="cancelRide";
                        $.ajax({
                            url:'ajax.php',
                            type:'POST',
                            data:{ rideid:rideid , action:action},
                            success: function(result){
                                location.reload();
                            },
                            error:function(){
                                alert ('error');
                            }
                        });
                    });	
					$('#pendingride').DataTable({"paging":   false,});
             });        
        </script>
    </head>
    <body>
       <?php include "indexheader.php";?>
		<!-- Fare Calculator-->
		<div class="jumbotron">
		    <div class="row pl-5 pt-5 mt-4 tablecon">
               <div class="shadow-lg col-lg-4 ml-4 mb-5 pb-4 bg-dark text-white text-center">
                        <p><h3><span id="heading" class="cyan-text" >User Details</span></h3><img id='acc' src='ID.png' alt='Logo' ><hr class="white "></p>
                        <p><span class="h5" id=" userid">User Id </span><div class="details" id="UserID"><?php echo $ud['user_id'];?></div></p>
                        <p><span class="h5" id="userheading username">Username  </span> <div class="details" id="UserName"> <?php echo $ud['user_name'];?></div></p>
                        <p><span class="h5" id="userheading name">Name </span><div class="details" id="Name"> <?php echo $ud['name'];?></div></p> 
                        <p><span class="h5" id="userheading mob">Mobile </span><div class="details" id="mobile"><?php echo $ud['mobile'];?></div><hr class="white "></p>
                        <p><span class="btn h5" id="userheading mob"><a class="h4 nounderline cyan-text" href="signout.php">SIGN OUT</span></p>
                </div>  
                <div class="col-lg-6">
                    <div class="row p-3">
                        <div class="shadow-lg col-lg-10 ml-5 p-5 mb-5 bg-dark text-white text-center">
                                <a class="white-text" href="index.php">
                                    <img class="mb-2" src='logo2.png' style="width:150px;" alt='Logo' ><br><hr class="white">
                                    BOOK A CAB
                                </a>    
                        </div>  
                        <div class="shadow-lg col-lg-5 ml-5 mb-5 p-4 bg-dark text-white text-center">
                            <h3><?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['status']==2){$u+=$rdd['total_fare'];}} echo "<img id= 'resicon' src='rupee.png' alt='Logo' > ".$u;?></h3>
                            <img id= 'acc' src='spent.png' alt='Logo' >
                            <h4 class="pt-2">TOTAL SPENT</h4>
                        </div>  
                        <div class="shadow-lg col-lg-5 ml-5 p-5 mb-5 bg-dark text-white text-center">
                            <a class="white-text" href="userride.php">
                                <img id= 'acc' src='ridehis.png' alt='Logo' ><br>
                                RIDE HISTORY
                            </a>    
                        </div>  
                        <div class="shadow-lg col-lg-5 ml-5 p-5 mb-5 bg-dark text-white text-center">
                            <h3 class="pb-4"><?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['status']==2){$u+=$rdd['total_distance'];}} echo $u. " Km <img id='resicon' src='dis.png' alt='Logo' >";?> </h3>
                            
                             We've Traveled Side by Side
                        </div>  
                        <div class="shadow-lg col-lg-5 ml-5 p-5  mb-5 bg-dark text-white text-center">
                             <h3><?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['status']==2){$u+=1;}} echo $u." <img id= 'resicon' src='userride.png' alt='Logo' >";?></h3>
                             <a></a>       
                            <h4 class="pt-2">Times We've Rided together</h4>
                        </div>  
                    </div>    
                </div>
                
		    </div>		
		</div>
		<!-- Footer -->
		<footer class="page-footer font-small cyan darken-3 ">

			
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