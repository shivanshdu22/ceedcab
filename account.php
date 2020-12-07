<?php
    session_start();
    
    if(isset($_SESSION['userdata'])&& $_SESSION['userdata']['isAdmin']==1){
        include "dbc.php";
        include "uci.php";
        include "rideclass.php";
        include "disclass.php";
        $user= new User();
        $ud=$user->userdetails($_SESSION['userdata']['username']); 
        $cost=$user->totalspent();
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
           $(document).ready(function(){
                $("#<?php echo $ud['user_id']?>result").hide();
                $("#<?php echo $ud['user_id']?>").click(function(){	
                    $("#Name").html("<input type='text' id='<?php echo $ud['name']?>'value='<?php echo $ud['name']?>'>");
                    $("#mobile").html("<input type='number' id='<?php echo $ud['mobile']?>'value='<?php echo $ud['mobile']?>'>");
                    
                    $("#<?php echo $ud['user_id']?>result").show();
                    $("#<?php echo $ud['user_id']?>").hide();
                });
                $("#<?php echo $ud['user_id']?>result").click(function(){	
                    var name=document.getElementById("<?php echo $ud['name']?>").value;
                    var mob= document.getElementById("<?php echo $ud['mobile']?>").value;
                    //var password= document.getElementById("cpassword").value;
					var password="";
					var newpassword="";
                    //var newpassword= document.getElementById("newpassword").value;
                    var user_id=<?php echo $ud['user_id']?>;
                    if(name==""||mob==""){
							$("#message").html("<strong>Please check Name or Mobile Number </strong>");
						}
						else if(/[0-9]/g.test(name) != false) {
							alert('Numbers not allowed in name');
						}
						else if(/[$-/:-?{-~!"^_`\[\]]/.test(name) != false) {
							alert('Your name contains illegal characters.');
						}
						else if(mob.length<10 || mob.length>10){
							alert('Enter 10 digit mobile number.');
						}	
						else if(/[.]/.test(mob) != false) {
							alert('Your mobile contains illegal characters.');
						}
                    else{
                        $.ajax({
                            url:'ajax.php',
                            type:'POST',
                            data:{name:name , mobile:mob , password:password, newpassword:newpassword, action:"update",user_id:user_id },
                            success: function(result){
                                location.reload();
                            },
                            error:function(){
                                alert ('error');
                            }
                        });
                   }
                });
            });
        </script>
    </head>
    <body>
        <header>
            <div class = "logo">
                <img class="mb-2" src="logo2.png" alt="Logo" >
                <div id="welcome">
                    <div class="dropdown noti">
                                <button class="dropbtn notibtn"><img class="notification" src='notification.png' title='Active' alt='Logo' ></button>
                                <div class="dropdown-content">
                                    <a href="allpending.php"><p id="value"><h1><?php $i=0; foreach($rdnoti as $key=>$rdd){ if($rdd['status']==1){$i+=1;}} echo $i;?></h1></p>Total Pending Rides</a>
                                    <a href="pendinguser.php"><h1 id="value"><?php $u=0; foreach($usnoti as $key=>$rdd){ if($rdd['is_block']==1){$u+=1;}} echo $u;?></h1>Total Pending Users</a>
                                 </div>
                    </div>
                <div class="dropdown">
                        <button class="dropbtn">Welcome <?php echo "<b>".$_SESSION['userdata']['username']."</b>";?></button>
                        <div class="dropdown-content">
                            <a href="admin.php">Go To Main Page</a>
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
                   
            <div id="userdetails">
                    <p><h3><span id="heading" >User Details</span></h3><img id='acc' src='ID.png' alt='Logo' ></p>
                    <p><span id="userheading userid">User Id : </span><div class="details" id="UserID"><?php echo $ud['user_id'];?></div></p>
                    <p><span id="userheading username">Username : </span> <div class="details" id="UserName"> <?php echo $ud['user_name'];?></div></p>
                    <p><span id="userheading name">Name : </span><div class="details" id="Name"> <?php echo $ud['name'];?></div></p> 
                    <p><span id="userheading dos">Date of Sign-Up : </span><div class="details" id="DOS"> <?php echo $ud['Date_of_signup'];?></div></p>
                    <p><span id="userheading mob">Mobile : </span><div class="details" id="mobile"><?php echo $ud['mobile'];?></div></p>
                
                    <div id="message"></div>
                        <a class="btn change" id="<?php echo $ud['user_id']?>"  href="#">Change Details</a>
                        <a class="btn password" id="<?php echo $ud['user_id']?>"  href="adminpass.php">Change Password</a>
                        <a class="btn password " id="<?php echo $ud['user_id']?>result" href="#">Update</a>
            </div>
            
                
        </div>
    </body>
</html>
    <?php } 
    else{
        header('Location:login.php');
    }?>