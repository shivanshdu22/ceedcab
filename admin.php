<?php
    session_start();
    
    if(isset($_SESSION['userdata'])&& $_SESSION['userdata']['isAdmin']==1){
        include "dbc.php";
        include "uci.php";
        include "rideclass.php";
        include "disclass.php";
        $ride= new Ride();
        $rd= $ride->allrides(); 
        $user= new User();
        $ud=$user->userdetails($_SESSION['userdata']['username']); 
        $ua=$user->alluserdetails();
        $cost=$user->totalspent();
        $loc= new Distance();
        $ld=$loc->alllocation();
        $ridenoti= new Ride();
        $rdnoti= $ridenoti->allrides(); 
        $usernoti= new User();
        $usnoti= $usernoti->alluserdetails();
       
?>
<html>
    <head>
        <title>CEDCAB</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="admin.css">
        <script>
         
        </script>
    </head>
    <body>
    <header>
            <div class = "logo">
                <img class="mb-2" src="logo2.png"  alt="Logo" >
                <div id="welcome">
                <div class="dropdown noti">
                                <button class="dropbtn notibtn"><img class="notification" src='notification.png' title='Active' alt='Logo' ></button>
                                <div class="dropdown-content">
                                    <a href="allpending.php"><p id="value"><h2><?php $i=0; foreach($rdnoti as $key=>$rdd){ if($rdd['status']==1){$i+=1;}} echo $i;?></h1></p>Total Pending Rides</a>
                                    <a href="pendinguser.php"><h2 id="value"><?php $u=0; foreach($usnoti as $key=>$rdd){ if($rdd['is_block']==1){$u+=1;}} echo $u;?></h1>Total Pending Users</a>
                                 </div>
                    </div>
                <div class="dropdown">
                        <button class="dropbtn">Welcome <?php echo "<b>".$_SESSION['userdata']['username']."</b>";?></button>
                        <div class="dropdown-content">
                        <a href="account.php">User Details</a>
                            <a href="signout.php">Sign Out</a>
                        </div>
                    </div>
                </div>    
            </div>	
            <ul>
                <li><div class="dropdownm">
                            <a href="admin.php"> 
                            <img class="resicon" src="dash.png" alt="Logo" ><button class="dropbtnm">HOME</button></a>
                    </div>
                </li>
                <li><div class="dropdownm">
                            <a href="rides.php"> 
                            <img class="resicon" src="taxi.png" alt="Logo" >
                            <button class="dropbtnm">RIDES</button></a>
                            <div class="dropdownm-content">
                                <a href="allpending.php">PENDING RIDES</a>
                                <a href="comride.php">COMPLETED RIDES</a>
                            </div>
                    </div></li>
                <li><div class="dropdownm">
                            <a href="invoice.php"> 
                            <img class="resicon" src="invoice.png" alt="Logo" >
                            <button class="dropbtnm">INVOICE</button></a>
                    </div></li>
                <li><div class="dropdownm">
                            <a href="users.php"> 
                            <img class="resicon" src="userbase.png" alt="Logo" >
                            <button class="dropbtnm">USERS</button></a>
                            <div class="dropdownm-content">
                                <a href="pendinguser.php">PENDING USER</a>
                                <a href="userbase.php">APPROVED USER</a>
                            </div>
                    </div>
                </li>
                <li><div class="dropdownm">
                            <a href="data.php"> 
                            <img class="resicon" src="data.png" alt="Logo" >
                            <button class="dropbtnm">ALL DATA</button></a>
                    </div></li>
                <li><div class="dropdownm">
                            <a href="location.php"> 
                            <img class="resicon" src="location.png" alt="Logo" >
                            <button class="dropbtnm">LOCATION</button></a>
                            <div class="dropdownm-content">
                                <a href="location.php">LOCATION LIST</a>
                                <a href="location.php#message">ADD NEW</a>
                            </div>
                    </div>
                </li>
                <li> <div class="dropdownm">
                            <a href="account.php"> 
                            <img class="resicon" src="user.png" alt="Logo" >
                            <button class="dropbtnm">ACCOUNT</button></a>
                            <div class="dropdownm-content">
                                <a href="account.php">User Details</a>
                                <a href="adminpass.php">CHANGE PASSWORD</a>
                                
                            </div>
                    </div>
                </li>
            </ul>
        </header>
        <div id="content">
            <div id="toprow">    
                <a href="Incomedata.php"><div id="left">
                <p id="value"><h1><?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['status']==2){$u+=$rdd['total_fare'];}} echo "Rs. ".$u;?></h1></p> 
                Total Income till today<br>    
                <img class="incomepie" src="bar.png" alt="Logo" >
                    <strong>View Income Data</strong>
                </div></a>
                <a href="locationtrend.php"><div id="center">
                    <img class="pie" src="loctrend.png"  alt="Logo" ><br>
                   <strong> Location Trends</strong>
                </div></a>         
                <a href="location.php"><div href="#" id="right">
                    <p id="value"><h1><?php $u=0; foreach($ld as $key=>$rdd){ if($rdd['is_available']==1){$u+=1;}} echo $u;?></h1></p>    
                    <img class="incomepie" src="loc.png" alt="Logo" ><br>
                    <strong>Total Locations We Offer </strong>
                </div> </a>
            </div>    
            <div id="ceneterrow">  
                <a href="allpending.php"><div id="left">
                    <p id="value"><h1><?php $i=0; foreach($rd as $key=>$rdd){ if($rdd['status']==1){$i+=1;}} echo $i;?></h1></p>
                    <img class="incomepie" src="pending.png" alt="Logo" ><br>
                    <strong>Pending Rides </strong>
                </div></a>
                <a href="pendinguser.php"><div id="center">
                    <h1 id="value"><?php $u=0; foreach($ua as $key=>$rdd){ if($rdd['is_block']==1){$u+=1;}} echo $u;?></h1>
                    <img class="incomepie" src="pendinguser.png" alt="Logo" ><br>
                    <strong>Pending Users </strong>
                </div>  </a>       
                <a href="userbase.php"><div id="right">
                    <h1 id="value"><?php $u=0; foreach($ua as $key=>$rdd){ if($rdd['isAdmin']==0&&$rdd['is_block']==0){$u+=1;}} echo $u;?></h1>
                    <img class="incomepie" src="userbase.png" alt="Logo" ><br>
                    <strong>User Base </strong>
                </div> </a>
            </div>   
            <div id="bottomrow">    
                <div id="left">
                <p id="value"><h1><?php $u=0; foreach($ua as $key=>$rdd){ if($rdd['Date_of_signup']<=date("Y/m/d")){$u+=1;}} echo $u;?></h1></p>
                <img class="incomepie" src="sign.png" alt="Logo" ><br>
                <strong>Number of Signup's till today  </strong>  
                </div>  
                <div id="center">
                    <p id="value"><h2><?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['status']==2){$u+=$rdd['total_distance'];}} echo $u." KM";?></h2></p>
                    <img class="incomepie" src="dis.png" alt="Logo" ><br>
                    <strong>Total Distance We've Travel </strong>
                </div>        
                <div id="right">
                    <p id="value"><h1><?php $u=0; foreach($rd as $key=>$rdd){ if($rdd['status']==2){$u+=1;}} echo $u;?></h1></p>
                    <img class="incomepie" src="todayride.png" alt="Logo" ><br>
                    <strong>Total Rides Till today </strong>
                </div> 
            </div>     
        </div>
    </body>
</html>
    <?php } 
    else{
        header('Location:login.php');
    }?>