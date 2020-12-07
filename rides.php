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
                        if(confirm("Are you sure you want to confirm this?")){
                            var rideid =$(this).attr('data-id');
                            var action="approveRide";
                            console.log(rideid);
                            $.ajax({
                                url:'ajax.php',
                                type:'POST',
                                data:{ rideid:rideid , action:action},
                                success: function(result){
                                    alert('You Have Approved ride number '+rideid);
                                    location.reload();
                                },
                                error:function(){
                                    alert ('error');
                                }
                            });
                        }
                    else{
                        return false;
                    }    
                });	
                $('#cancel').click(function(){
                    if(confirm("Are you sure you want to confirm this?")){
                        var rideid =$(this).attr('data-id');
                        var action="cancelRide";
                        $.ajax({
                            url:'ajax.php',
                            type:'POST',
                            data:{ rideid:rideid , action:action},
                            success: function(result){
                                alert('You Have disaproved ride number '+rideid);
                                location.reload();
                            },
                            error:function(){
                                alert ('error');
                            }
                        });
                }
                else{
                    return false;
                }
                });	
                $('.delete').click(function(){
                    if(confirm("Are you sure you want to confirm this?")){
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
                    }
                    else{
                         return false;
                    }    
                });	
                $('#pendingride').DataTable({"paging":   false,});
                $('#allride').DataTable({"paging":   false,});
            });
        </script>
    </head>
    <body>
       <?php include "header.php" ?>
        <div id="content">         
            <div id="userdetails">
                <table id="pendingride">
                <img id='acc' src='pending.png' alt='Logo' >
                    <p id="heading">Pending</p>
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
                        <th>Option</th>
                    </tr>
                    </thead> 
                    <tbody>
                    <?php
                        foreach($rd as $key=> $udd){
                            if($udd['status']==1){?>
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
                            <td><?php if($udd['status']==1){ echo "Pending <img id= 'resicon' src='pendingride.png' title='Pending' alt='Logo' >";} elseif($udd['status']==2){echo "Canceled <img id= 'resicon' src='cancel.png' alt='Logo' >";}  else{echo " <img id= 'resicon' src='tick.png' alt='Completed' > ";}?></td>
							<td>
								<!-- Icons -->
								<a href="#" data-id="<?php echo $udd['ride_id'];?>" class="edit"id="approve" title="Approve"><img id= 'resicon' src='tick.png' title='Approve' alt='Logo' ></a>
								<a href="#" data-id="<?php echo $udd['ride_id'];?>" class="delete"id="cancel"title="Cancel"><img id= 'resicon' src='delete.png' title='Delete' alt='Logo' ></a> 
							</td>
						</tr>
                            <?php } 
                        }?>
                    <tbody>
                </table>
            </div>
            <div id="total-income">
                <table id="allride" >
                <img id='acc' src='ride.png' alt='Logo' >
                    <p id="heading">Ride History</p> 
                    <thead >
                    <tr>
                        <th>Ride ID</th>
                        <th>Ride Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Cab Type</th>
                        <th>Total Distance</th>
                        <th>Luggage</th>
                        <th>Total Fare</th>
                        <th>Customer NAme</th>
                        <th>Status</th>
                       <!-- <th>Option</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($rd as $key=> $udd){?>
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
                            <td><?php if($udd['status']==1){ echo " Pending<img id= 'resicon' src='pendingride.png' title='Pending' alt='Logo' >";} elseif($udd['status']==0){echo "Canceled <img id='resicon' src='cancel.png' title='Canceled' alt='Logo' >";}  else{echo "Completed <img id= 'resicon' src='tick.png' title='Completed' alt='Completed' > ";}?></td>
							<!--<td>
								
								<a href="#" data-id="<?php echo $udd['ride_id'];?>" class="delete" title="Delete"> <img id= 'resicon' src='delete.png' title='Delete' alt='Logo' ></a> 
							</td>-->
						</tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>