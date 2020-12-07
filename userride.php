<?php
	session_start();
	if(!isset($_SESSION['userdata']) || $_SESSION['userdata']['isAdmin']==1){
		header('Location:signout.php');
	}
	else{
		include "dbc.php";
		include "rideclass.php";
		$ride= new Ride();
		$rd= $ride->ridedetails($_SESSION['userdata']['userid']); 
		$cost=$ride->totalspent($_SESSION['userdata']['userid']); 
		$ride= new Ride();
	
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
            $('#filter').hide();
                $(document).on( "click","#filterbutton",function() {
                    $('#filter').show();
                    $(this).hide();
                });    
                    
                $('#userride').DataTable({"paging":   false,});
    
            });
        </script>
    </head>
    <body>
       <?php include "indexheader.php";?>
		<!-- Fare Calculator-->
		<div class="jumbotron">
			<div class="container pt-5 tablecon">
			<div id="total-income">
					<table id="userride" class="table rounded">
							
							<p class="h1 cyan-text "><img id='acc' src='ride.png' alt='Logo' >YOUR RIDES</p> 
							<thead class=" border-0">
							<tr>
								<th>Ride ID</th>
								<th><img id='resicon' src='date.png' alt='Logo' >Ride Date</th>
								<th><img id='resicon' src='location.png' alt='Logo' >From</th>
								<th><img id='resicon' src='pendloc.png' alt='Logo' >To</th>
								<th><img id='resicon' src='taxi.png' alt='Logo' >Cab Type</th>
								<th><img id='resicon' src='dis.png' alt='Logo' >Total Distance</th> 
								<th><img id='resicon' src='luggage.png' alt='Logo' >Luggage</th>
								<th><img id='resicon' src='rupee.png' alt='Logo' >Fare</th>
								<th>Status</th>
							</tr>
							</thead>
							<tbody class="border-0">
							<?php
							foreach($rd as $key=> $udd){?>
							<tr>
								<td><?php echo $udd['ride_id'];?></td>
								<td><?php  $date=date_create($udd['ride_date']); echo date_format($date,"D,M d h:i:s ");?></td>
								<td><?php echo $udd['from_loc'];?></td>
								<td><?php echo $udd['to_loc'];?></td>
								<td><?php echo $udd['Cab_type'];?></td>
								<td><?php echo $udd['total_distance']." Km";?></td>
								<td><?php echo $udd['luggage']." Kg";?></td>
								<td><?php echo $udd['total_fare'];?></td>
								<td class="cyan-text h6"><?php if($udd['status']==1){ echo "Pending <img id= 'resicon' src='pendingride.png' alt='Logo' >";} elseif($udd['status']==0){echo "Canceled <img id= 'resicon' src='cancel.png' alt='Logo' >";}  else{echo "Completed <img id= 'resicon' src='tick.png' alt='Logo' > ";}?></td>
							</tr>
							<?php }?>
							</tbody>
					</table>
					<span id="userheading">Total spent made till <?php echo date("Y/m/d");?></span> : Rs <?php foreach($cost as $key=> $udd){echo $udd;}?> 
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