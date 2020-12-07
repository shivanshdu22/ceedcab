<?php 
    include "dbc.php";
    include "rideclass.php";
    include "uci.php";
    $ride= new Ride();
    $rd= $ride->allrides(); 
    if(isset($_POST['download'])){
        $id=isset($_POST['id'])?$_POST['id']:'';
        $ud=$ride->nameridedetail($id);
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="MyMsDocFile.doc');
        echo "<html>";
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
        echo "<body>";
        echo "<h1><center>CEDCAB<center></h1>";
        echo "<hr>";
        echo "<h3><center><b>Invoice for Ride ID: ".$ud[0]['ride_id']."</b></center></h3><br/>";
        echo "<b>Customer Name:</b>".$ud[0]['name']."<br/>";
        echo "<b>Mobile:</b>".$ud[0]['mobile']."<br />";
        echo "<b>Ride Date:</b>".$ud[0]['ride_date']."<br />";
        echo "<b>From:</b>".$ud[0]['from_loc']."";
        echo "<b>To:</b>".$ud[0]['to_loc']."<br />";
        echo "<b>Total Fare:</b>Rs".$ud[0]['total_fare']."<br />";
        echo "<b>CAB type:</b>".$ud[0]['Cab_type']."<br />";
        echo "<b>Luggage:</b>".$ud[0]['luggage']."<br />";
        echo "<b>Total Distance Covered(in Km):</b>".$ud[0]['total_distance']."<br />";
        echo "</body>";
        echo "</html>";
    }
        ?>