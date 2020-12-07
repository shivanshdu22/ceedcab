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
        $lf=$ride->locride();
?>
<html>
    <head>
        <title>CEDCAB</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="admin.css">
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script type="text/javascript">
         $(document).ready(function(){
          var ctx = document.getElementById('myChart').getContext('2d');
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',

                // The data for our dataset
                data: {
                    labels: [<?php foreach($lf as $key=>$rdd){echo"'".$rdd['from_loc']."',";}?>],
                    datasets: [{
                        label: 'Rides per Location',
                        
                        borderColor: 'rgb(255, 99, 132)',
                        data: [<?php foreach($lf as $key=>$rdd){echo $rdd['count(ride_id)'].",";}?>]
                    }]
                },

                // Configuration options go here
                options: {}
            }); 
            
         });           
        </script>

    </head>
    <body>
    <header>
            <div class = "logo">
                <img class="mb-2" src="logo2.png"  alt="Logo" >
                <div id="welcome">
                <div class="dropdown">
                        <button class="dropbtn">Welcome <?php echo "<b>".$_SESSION['userdata']['username']."</b>";?></button>
                        <div class="dropdown-content">
                            <a href="index.php">Go To Main Page</a>
                            <a href="signout.php">Sign Out</a>
                        </div>
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
            <h1>Location Trends:</h1>
            <canvas id="myChart"></canvas>
        </div>
    </body>
</html>
    <?php } 
    else{
        header('Location:login.php');
    }?>