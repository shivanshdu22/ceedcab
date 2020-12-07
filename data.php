<?php
    include "dbc.php";
    include "disclass.php";
    include "uci.php";
    include "rideclass.php";
    $ride= new Ride();
    if(!isset($_POST['id'])){
        $rd= $ride->namerides(); 
        $msg="";
        $dis= new Distance();
        $dd=$dis->alllocation();
        $user= new User();
        $ud=$user->alluserdetails();
    }
    if(isset($_POST['name'])){
        $rd= array(); 
        $msg="";
        $dis= new Distance();
        $dd=$dis->namelocation();
        $user= new User();
        $ud=$user->namedetails();
    }
    if(isset($_POST['admin'])){
        $user= new User();
        $ud=$user->admindetails();
    }
    if(isset($_POST['avail'])){
        $ud=array();
        $rd=array();
        $dis= new Distance();
        $dd=$dis->approvedlocation();
    }
    if(isset($_POST['filter'])){
        $ud=array();
        $rd=array();
        $dd=array();
        if($_POST['name']!=""){
            $name=isset($_POST['name'])?$_POST['name']:'';
            $rd= $ride->nameride($name); 
            $user= new User();
            $ud=$user->namedetail($name);
            $dis= new Distance();
            $dd=array();
            
        }
        if($_POST['from']!="" or $_POST['to']!=""){
            $from=isset($_POST['from'])?$_POST['from']:'';
            $to=isset($_POST['to'])?$_POST['to']:'';
            $rd= $ride->dateride($from,$to); 
            $user= new User();
            $ud=$user->datesign($from,$to); 
            $dis= new Distance();
            $dd=array();
        }
    }
    if(isset($_POST['fare'])){
        $ud=array();
        $dd=array();
        $rd= $ride->farerides(); 
    }
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
            $('#filter').hide();
                $(document).on( "click","#filterbutton",function() {
                    $('#filter').show();
                    $(this).hide();
                });    
                $('#Usertable').DataTable();
                $('#Ridetable').DataTable();
                $('#Locationtable').DataTable();
            });
           
        </script>
    </head>
    <body>
       <?php include "header.php"; ?>
        <div id="content">
            <div id="userdetails">
                <label>Sort:</label>  
                    <form id="sort" action="data.php" method="POST">
                        <button name="uid">Id</button>
                    </form>
                    <form id="sort" action="data.php" method="POST">
                        <button name="name">Name</button>
                    </form>
                    <form id="sort" action="data.php" method="POST">
                        <button name="fare">Fare</button>
                    </form>  
                    <form id="sort" action="data.php" method="POST">
                        <button name="uid">CLEAR</button>
                    </form>
                    <!--<form id="filter" action="data.php" method="POST">
                        <button name="admin">Admin</button>
                    </form>  
                    <form id="filter" action="data.php" method="POST">
                        <button name="avail">Available Locations</button>
                    </form>--> <a class="btn change" href="#" id="filterbutton">FILTER</a> <br>
                    
                    <form id="filter" action="data.php" method="POST">
                        <label>Name:</label>
                        <input type="text" name="name"><br>
                        <label>From Date:</label>
                        <input type="date" name="from"> <br>
                        <label>Till Date:</label>
                        <input type="date" name="to"><br>
                        <button  name="filter">Filter</button>
                    </form>
                   
            </div>        
            <div id="total-income"><!--User Details-->
                <table id="Usertable">
                    <p id="heading">All User </p>   
                    <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User name</th>
                        <th>Name</th>
                        <th>Date of Sign UP</th>
                        <th>Mobile</th>
                        <th>Is Blocked</th>
                        <th>Is Admin</th>
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
                            <td><?php if($udd['is_block']==0){echo " <img id='resicon' src='tick.png' title='Active' alt='Logo' >";} else{echo " <img id='resicon' src='cancel.png' title='Blocked' alt='Logo' >";}?></td>
							<td><?php if($udd['isAdmin']==0){echo "User";} else{echo "Admin";}?></td>
						</tr>
					    <?php }?>
                    </tbody>    
                </table>
            </div>
            <div id="total-income"><!--User Details-->
                <table id="Ridetable">
                    <thead>
                    <p id="heading">Ride History</p>
                    <tr>
                        <th>Ride ID</th>
                        <th>Ride Date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total Distance</th>
                        <th>Luggage</th>
                        <th>Total Fare</th>
                        <th>Customer ID</th>
                        <th>Status</th>  
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
                            <td><?php echo $udd['total_distance'];?></td>
                            <td><?php echo $udd['luggage'];?></td>
                            <td><?php echo $udd['total_fare'];?></td>
                            <td><?php echo $udd['customer_user_id'];?></td>
                            <td><?php if($udd['status']==1){ echo "<img id= 'resicon' src='pendingride.png' title='Pending' alt='Logo' >";} elseif($udd['status']==0){echo " <img id= 'resicon' src='cancel.png' title='Canceled' alt='Logo' >";}  else{echo " <img id= 'resicon' src='tick.png' title='Completed' alt='Logo' > ";}?></td>
							
						</tr>
					    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div id="total-income">
                <table id="Locationtable" >
                    <p id="heading">All Locations</p> 
                    <thead>
                    <tr>
                        <th>Location ID</th>
                        <th>Name</th>
                        <th>Distance</th>
                        <th>Is Available</th> 
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($dd as $key=> $udd) {?>
						<tr>
							<td><?php echo $udd['id'];?></td>
                            <td><?php echo $udd['name'];?></td>
                            <td><?php echo $udd['distance'];?></td>
                            <td><?php if($udd['is_available']==0){echo "<img id='resicon' title='Unavailable' src='unloc.png' alt='Logo' >";} else{echo "<img id='resicon' title='Available ' src='tick.png' alt='Logo' >";}?></td>

						</tr>

					<?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
 
  