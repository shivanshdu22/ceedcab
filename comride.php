<?php

include "dbc.php";
include "uci.php";
include "rideclass.php";
include "disclass.php";
    $ride= new Ride();
    $rd= $ride->namerides(); 
?>
<html>
    <head>
        <title>CEDCAB</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="admin.css">
        <script>
            $(document).ready(function(){
                $('#approve').click(function(){
                    var rideid =$(this).attr('data-id');
                    var action="approveRide";
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
                $('#delete').click(function(){
                    var rideid =$(this).attr('data-id');
                    var action="deleteRide";
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
                $('#comride').DataTable({"paging":   false,});
            });
        </script>
    </head>
    <body>
       <?php include "header.php" ?>
        <div id="content">         
            <div id="userdetails">
                <table id="comride" border="1">
                <img id='acc' src='ride.png' alt='Logo' >
                    <p id="heading">Completed Rides</p> 
                    <thead>
                    <tr>
                    <th>Ride ID</th>
                        <th>Ride Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Cab Type</th>
                        <th>Total Distance</th>
                        <th>Luggage</th>
                        <th>Total Fare</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <!--<th>Option</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($rd as $key=> $udd){
                            if($udd['status']==2){?>
						<tr>
							<td><?php echo $udd['ride_id'];?></td>
							<td><?php echo $udd['ride_date'];?></td>
                            <td><?php echo $udd['from_loc'];?></td>
                            <td><?php echo $udd['to_loc'];?></td>
                            <td><?php echo $udd['Cab_type'];?></td>
                            <td><?php echo $udd['total_distance'];?></td>
                            <td><?php echo $udd['luggage'];?></td>
                            <td><?php echo $udd['total_fare'];?></td>
                            <td><?php echo $udd['name'];?></td>
							<td><?php if($udd['status']==1){ echo "Pending";} elseif($udd['status']==2){echo "Completed<img id= 'resicon' src='tick.png' title='Approved' alt='Logo' >";} else{echo "Completed<img id= 'resicon' src='tick.png' title='Completed' alt='Logo' >";}?></td>
							<!--<td>
								
								<a href="#" data-id="<?php echo $udd['ride_id'];?>" class="delete" id="cancel"title="Cancel"><img id= 'resicon' src='cancel.png' title='Cancel' alt='Logo' ></a> 
							</td>-->
						</tr>
                            <?php } 
                        }?>
                    </tbody>    
                </table>
            </div>
        </div>
    </body>
</html>