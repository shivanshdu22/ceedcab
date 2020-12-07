<?php
    session_start();
    
    if(isset($_SESSION['userdata'])&& $_SESSION['userdata']['isAdmin']==1){
        include "dbc.php";
        include "uci.php";
        $user= new User();
        $ud=$user->userdetails($_SESSION['userdata']['username']); 
        $cost=$user->totalspent();
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
                
                $("#<?php echo $ud['user_id']?>result").click(function(){	
                    var name="<?php echo $ud['name']?>";
                    var mob= "<?php echo $ud['mobile']?>";
                    var password= document.getElementById("cpassword").value;
                    var newpassword= document.getElementById("newpassword").value;
                    var renewpassword= document.getElementById("renewpassword").value;
                    var user_id=<?php echo $ud['user_id']?>;
                    if( newpassword=="" ){
                        $("#message").html("Please enter data in all fields");
                    }
                    else if( password=="" ){
                        $("#message").html("Please enter data in all fields");
                    }
                    else if(newpassword==renewpassword){
                    $.ajax({
                        url:'ajax.php',
                        type:'POST',
                        data:{name:name , mobile:mob , password:password, newpassword:newpassword, action:"update",user_id:user_id },
                        success: function(result){
                            if(result!=""){
                            $("#message").html("Password Changed");
                            window.location.replace("signout.php");
                            }
                        },
                        error:function(){
                            alert ('error');
                        }
                    });
                    }
                    else{
                        $("#message").html("Entered password not same");
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
        <div id="userdetails">
        <img id='acc' src='pass.png' alt='Logo' >
            <p><span id="heading" >Change Password:</span></p>  
            <input type='text' class="pass" id='cpassword' placeholder='Current password' value='' required> <br>
            <input type='text' class="pass" placeholder='New password' id='newpassword' value='' required><br>
            <input type='text' class="pass" placeholder='Re Enter New password' id='renewpassword' value='' required><br>
            <div id="seperation"><a class="btn passbut" id="<?php echo $ud['user_id']?>result" href="#">Update</a>    </div>
                <div id="message">
					
                </div>
          </div>       
      
            
        </div>
    </body>
</html>
    <?php } 
    else{
        header('Location:login.php');
    }?>