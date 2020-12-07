<?php
    session_start();
    include "dbc.php";
    include "uci.php";
    include "rideclass.php";
    include "disclass.php";
    $user= new User();
    $ride= new Ride();
    $loc= new Distance();
if (isset($_POST))
{   
    $msg="oo";
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $pass = isset($_POST['password']) ? $_POST['password'] : '';
    $newpass = isset($_POST['newpassword']) ? $_POST['newpassword'] : '';
    $action= isset($_POST['action']) ? $_POST['action'] : '';
    $user_id= isset($_POST['user_id']) ? $_POST['user_id'] : '';
    $ride_id= isset($_POST['rideid']) ? $_POST['rideid'] : '';
    $loc_id= isset($_POST['loc_id']) ? $_POST['loc_id'] : '';
    if($action=="update")
    {
        $user->updatepersonal($name,$mobile,$pass,$newpass,$_SESSION['userdata']['userid']);
        echo "Changes Made";
    }
    if($action=="approveRide")
    {
        $msg=$ride->updateride($ride_id);
        echo $msg;
    }
    if($action=="cancelRide")
    {
        $msg=$ride->cancelride($ride_id);
    
    }
    if($action=="deleteRide")
    {
        $msg=$ride->deleteride($ride_id);
        echo $msg;
       
    }
    if($action=="approveUser")
    {
        $msg=$user->approveuser($user_id);
        echo $msg;
       
    }
    if($action=="disapproveUser")
    {
        $msg=$user->disapproveUser($user_id);
        echo $msg;
    
    }
    if($action=="deleteUser")
    {
        $msg=$user->deleteUser($user_id);
        echo $msg;
    }
    if($action=="deletelocation")
    {
        $msg=$loc->deleteloc($loc_id);
        echo $msg;
    }
}
?>