<?php 
  include "dbc.php";
  include "uci.php";
  include "rideclass.php";
  include "disclass.php";
  $ride= new Ride();
  $rd= $ride->allrides(); 
  $user= new User();
  
  $ua=$user->alluserdetails();
  $cost=$user->totalspent();
  $loc= new Distance();
  $ld=$loc->alllocation();
    $u=0; foreach($rd as $key=>$rdd){ if($rdd['Cab_type']=="CedMicro"){$u+=1;}} echo $u;?>