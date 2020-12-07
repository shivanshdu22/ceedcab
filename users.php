<?php
     include "dbc.php";
     include "uci.php";
     include "rideclass.php";
     include "disclass.php";
    $user= new User();
    $ud=$user->alluserdetails();
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
               
                $('.approve').click(function(){
                    if(confirm("Are you sure you want to confirm this?")){
                        var userid =$(this).attr('data-id');
                        var action="approveUser";
                        $.ajax({
                            url:'ajax.php',
                            type:'POST',
                            data:{ user_id:userid , action:action},
                            success: function(result){
                                alert('You have disapproved user number '+userid);
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
                $('.disapprove').click(function(){
                    if(confirm("Are you sure you want to confirm this?")){
                    var userid =$(this).attr('data-id');
                    var action="disapproveUser";
                    $.ajax({
                        url:'ajax.php',
                        type:'POST',
                        data:{ user_id:userid , action:action},
                        success: function(result){
                            alert("You have disapproved user number "+ userid);
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
                    if(confirm("Are you sure you want to delete this?")){ 
                        var userid =$(this).attr('data-id');
                        var action="deleteUser";
                        $.ajax({
                            url:'ajax.php',
                            type:'POST',
                            data:{ user_id:userid , action:action},
                            success: function(result){
                                location.reload();
                                alert('You Have deleted a ride!');
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
                $('#pendinguser').DataTable({"paging":   false,});
                $('#alluser').DataTable({"paging":   false,});
            });
        </script>
    </head>
    <body>
       <?php include "header.php"; ?>
       <div id="content">
            <div id="userdetails">
                <table id="pendinguser"border="1">
                <img id='acc' src='pendinguser.png' alt='Logo' >
                    <p id="heading" >Pending</p> 
                    <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User name</th>
                        <th>Name</th>
                        <th>Date of Sign UP</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Option</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($ud as $key=> $udd) {
                            if($udd['is_block']==1){?>
                                   <tr>
                                    <td><?php echo $udd['user_id'];?></td>
                                    <td><?php echo $udd['user_name'];?></td>
                                    <td><?php echo $udd['name'];?></td>
                                    <td><?php echo $udd['Date_of_signup'];?></td>
                                    <td><?php echo $udd['mobile'];?></td>
                                    <td><?php if($udd['is_block']==0){echo "Active <img id='resicon' src='tick.png' title='Active' alt='Logo' >";} else{echo "Blocked <img id='resicon' title='Blocked' src='cancel.png' alt='Logo' >";}?></td>
                                    <td>
                                        <!-- Icons -->
                                        <a href="#" data-id="<?php echo $udd['user_id'];?>" class="approve" title="Allow"><img id='resicon' src='tick.png' alt='Logo' ></a>
                                       
                                    </td>
                                </tr>
                            <?php } 
                        }?>
                        </tbody>
                </table>
            </div>
            <div id="total-income">
                <table id="alluser" border="1">
                        <img id='acc' src='userbase.png' alt='Logo'>
                        <p id="heading">All Users</p> 
                        <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User name</th>
                            <th>Name</th>
                            <th>Date of Sign UP</th>
                            <th>Mobile</th> 
                            <th>Status</th>
                            <th>Is Admin</th>
                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($ud as $key=> $udd) {?>
						<tr>
							<td><?php echo $udd['user_id'];?></td>
							<td><?php echo $udd['user_name'];?></td>
                            <td><?php echo $udd['name'];?></td>
                            <td><?php echo $udd['Date_of_signup'];?></td>
                            <td><?php echo $udd['mobile'];?></td>
                            
                            <td><?php if($udd['is_block']==0){echo "Active<img id='resicon' src='tick.png' title='Active' alt='Logo' >";} else{echo "Blocked <img id='resicon' title='Blocked' src='cancel.png' alt='Logo' >";}?></td>
							<td><?php if($udd['isAdmin']==0){echo "User";} else{echo "Admin";}?></td>
							<td>
                                <!-- Icons -->
                                <?php if($udd['is_block']==0){?>
                                    <a href="#" data-id="<?php echo $udd['user_id'];?>" id ="disapprove" class="disapprove" title="Disapprove"><img id='resicon' src='cancel.png' alt='Disapprove'></a> 
                                <?php } else{ ?>    
                                    <a href="#" data-id="<?php echo $udd['user_id'];?>" class="approve" title="Allow"><img id='resicon' src='tick.png' alt='Logo' ></a>
                                <?php } ?>
								<!--<a href="#" data-id="<?php echo $udd['user_id'];?>" id="delete" class="delete" title="Delete"> <img id='resicon' src='delete.png' alt='Logo' ></a> -->
							</td>
						</tr>
                        <?php }?>
                        </tbody>
                    </table>
            </div>
        </div>
    </body>
</html>