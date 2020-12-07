<?php
    session_start();
    include "dbc.php";
    include "disclass.php";
    include "rideclass.php";
    $user= new Distance();
    $ud=$user->alllocation();
    $ride= new Ride();
    
if (isset($_POST))
{   
    $d=0;
    $p=0;
    $action=0;
    $luggage=0;
    $pickup = isset($_POST['pick']) ? $_POST['pick'] : '';
    $drop = isset($_POST['drop']) ? $_POST['drop'] : '';
    $cabtype = isset($_POST['car']) ? $_POST['car'] : '';
    $luggage = isset($_POST['luggage']) ? $_POST['luggage'] : '';
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    if($luggage==''){
        $luggage=0;
    }
    foreach ($ud as $key => $dis)
    {
        if ($dis['name'] == $pickup)
        {
            $p = $dis['distance'];
        }
        if ($dis['name'] == $drop)
        {
            $d = $dis['distance'];
        }
    }
    $measure = abs($d - $p);
    if ($measure != 0)
    {   
        $distance=$measure;
        if ($cabtype == "CedMicro")
        {
            $luggage=0;
            $amount = 0;
            $amount = $amount + 50;
            if ($measure <= 10)
            {
                $amount = $amount + ($measure * 13.5);
            }
            if ($measure > 10 && $measure <= 60)
            {
                $amount = $amount + (10 * 13.5);
                $measure = $measure - 10;
                $amount = $amount + ($measure * 12);
            }
            if ($measure > 60 && $measure <= 160)
            {
                $amount = $amount + (10 * 13.5);
                $amount = $amount + (50 * 12);
                $measure = $measure - 60;
                $amount = $amount + ($measure * 10.20);
            }
            if ($measure > 160)
            {
                $amount = $amount + (10 * 13.5);
                $amount = $amount + (50 * 12);
                $amount = $amount + (100 * 10.20);
                $measure = $measure - 160;
                $amount = $amount + ($measure * 8.5);

            }
            
        }
        else if ($cabtype == "CedMini")
        {
            $amount = 0;
            $amount = $amount + 150;
            if ($measure <= 10)
            {
                $amount = $amount + ($measure * 14.50);
            }
            if ($measure > 10 && $measure <= 60)
            {
                $amount = $amount + (10 * 14.5);
                $measure = $measure - 10;
                $amount = $amount + ($measure * 13);
            }
            if ($measure > 60 && $measure <= 160)
            {
                $amount = $amount + (10 * 14.5);
                $amount = $amount + (50 * 13);
                $measure = $measure - 60;
                $amount = $amount + ($measure * 11.20);
            }
            if ($measure > 160)
            {
                $amount = $amount + (10 * 14.5);
                $amount = $amount + (50 * 13);
                $amount = $amount + (100 * 11.20);
                $measure = $measure - 160;
                $amount = $amount + ($measure * 9.5);
            }
            if ($luggage > 0 && $luggage <= 10)
            {
                $amount = $amount + 50;
            }
            if ($luggage > 10 && $luggage <= 20)
            {
                $amount = $amount + 100;
            }
            if ($luggage > 20)
            {
                $amount = $amount + 200;
            }
           
        }
        else if ($cabtype == "CedRoyal")
        {
            $amount = 0;
            $amount = $amount + 200;
            if ($measure <= 10)
            {
                $amount = $amount + ($measure * 15.5);
            }
            if ($measure > 10 && $measure <= 60)
            {
                $amount = $amount + (10 * 15.5);
                $measure = $measure - 10;
                $amount = $amount + ($measure * 14);
            }
            if ($measure > 60 && $measure <= 160)
            {
                $amount = $amount + (10 * 15.5);
                $amount = $amount + (50 * 14);
                $measure = $measure - 60;
                $amount = $amount + ($measure * 12.20);
            }
            if ($measure > 160)
            {
                $amount = $amount + (10 * 15.5);
                $amount = $amount + (50 * 14);
                $amount = $amount + (100 * 12.20);
                $measure = $measure - 160;
                $amount = $amount + ($measure * 10.5);

            }
            if ($luggage > 0 && $luggage <= 10)
            {
                $amount = $amount + 50;
            }
            if ($luggage > 10 && $luggage <= 20)
            {
                $amount = $amount + 100;
            }
            if ($luggage > 20)
            {
                $amount = $amount + 200;
            }
            
        }
        else if ($cabtype == "CedSUV")
        {
            $amount = 0;
            $amount = $amount + 250;
            if ($measure <= 10)
            {
                $amount = $amount + ($measure * 16.5);
            }
            if ($measure > 10 && $measure <= 60)
            {
                $amount = $amount + (10 * 16.5);
                $measure = $measure - 10;
                $amount = $amount + ($measure * 15);
            }
            if ($measure > 60 && $measure <= 160)
            {
                $amount = $amount + (10 * 16.5);
                $amount = $amount + (50 * 15);
                $measure = $measure - 60;
                $amount = $amount + ($measure * 13.20);
            }
            if ($measure > 160)
            {
                $amount = $amount + (10 * 16.5);

                $amount = $amount + (50 * 15);

                $amount = $amount + (100 * 13.20);
                $measure = $measure - 160;
                $amount = $amount + ($measure * 11.5);
            }
            if ($luggage > 0 && $luggage <= 10)
            {
                $amount = $amount + (50 * 2);
            }
            if ($luggage > 10 && $luggage <= 20)
            {
                $amount = $amount + (100 * 2);
            }
            if ($luggage > 20)
            {
                $amount = $amount + (200 * 2);
            }
           
        }
        if($action==1){
            echo ("<strong>You will travel ". $distance."Km in: Rs".$amount."</strong>");
        }
        if($action==0){
                $msg=$ride->addride($pickup, $drop, $cabtype ,$distance, $amount, $luggage, $_SESSION['userdata']['userid']);
                echo("<strong>You will travel ". $distance." Km in : Rs".$amount."<br>".$msg."</strong>");
           
        }    
        if($action==2){
                $msg=$ride->storeride($pickup, $drop, $cabtype ,$distance, $amount, $luggage);
                echo("<strong>You will travel ". $distance." Km in : Rs".$amount."<br>".$msg."</strong>");
        }
        
    }
}
?>
