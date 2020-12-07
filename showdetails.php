<?php
    include "dbc.php";
    include "rideclass.php";
    include "uci.php";
    $ride= new Ride();
    $rd= $ride->allrides(); 
    $user= new User();
    if(isset($_POST['invoice'])){
        $id=isset($_POST['id'])?$_POST['id']:'';
        $ud=$ride->nameridedetail($id);
    }    
    
?>
<html>
    <head>
        <title>CEDCAB</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
       <?php include "header.php" ?>
        <div id="content">            
            <div id="total-income">
                <img id='acc' src='ride.png' alt='Logo' >
                <?php if(isset($_POST['invoice'])){?>
                <h1 id="heading">Ride Details of Ride Number <?php echo $ud[0]['ride_id'];?></h1>
                <b><?php  $date=date_create($ud[0]['ride_date']); echo date_format($date,"D,M d h:i:sa");?></b><br>
                <b>Customer Name : </b> <?php echo $ud[0]['name'];?>&nbsp;&nbsp;&nbsp;
                <b>Mobile: </b> <?php echo $ud[0]['mobile'];?><br>
                <b><img id='resicon' src='loc.png' title="cabtype"alt='Logo'>From:</b> <?php echo $ud[0]['from_loc'];?><br>
                <b><img id='resicon' src='pendloc.png' title="cabtype"alt='Logo'>To:</b> <?php echo $ud[0]['to_loc'];?><br>
                <b> <img id='resicon' src='taxi.png' title="cabtype"alt='Logo'>Cab Type:<?php echo "     ". $ud[0]['Cab_type'];?></b><br>
                <b><img id='resicon' src='luggage.png' title="cabtype"alt='Logo'>Luggage:</b> <?php echo $ud[0]['luggage'];?><br>
                <b><img id='resicon' src='dis.png' title="cabtype"alt='Logo'>Total Distance Covered(in Km):</b> <?php echo $ud[0]['total_distance'];?><br>
                <b><img id='resicon' src='rupee.png' title="cabtype"alt='Logo'>Total Fare:</b> <?php echo $ud[0]['total_fare'];?><br>
                <form id="locationform" action="doc.php" method="POST">
                        <input type="text" name="id" id="id" value="<?php  echo $ud[0]['ride_id'];?>" hidden></input>
                        <button id="add" type="submit" name="download">Download</button>
                </form>  
                <?php } ?>
            </div>
        </div>
    </body>
</html>