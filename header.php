<header>
    <?php session_start();
    if(isset($_SESSION['userdata']) && $_SESSION['userdata']['isAdmin']==1){ 
        $ridenoti= new Ride();
        $rdnoti= $ridenoti->allrides(); 
        $usernoti= new User();
        $usnoti= $usernoti->alluserdetails();
    ?>
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
        <?php } else {  header('Location:signout.php'); } ?>
       
              