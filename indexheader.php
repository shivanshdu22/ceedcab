
<?php if(isset($_SESSION['userdata'])){ ?>
    <nav class="navbar navbar-expand-lg darken-3">
                <a class="navbar-brand" href="#"><img src="logo2.png" style="width:150px;" alt="Logo" ></a>
                <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link cyan-text" href="userdash.php"><strong>HOME<span class="sr-only">(current)</span></strong></a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link cyan-text" href="index.php"><img id='resicon' src='taxi.png' alt='Logo' ><strong>BOOK CAB<span class="sr-only">(current)</span></strong></a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class=" dropdown-toggle cyan-text mt-2" type="button" data-toggle="dropdown"style="background-color:transparent"><img id='resicon' src='ridehis.png' alt='Logo' >RIDE HISTORY
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                            <li><a href="userride.php"><img id='resicon' src='ride.png' alt='Logo' > All RIDES</a></li>
                            <li><a href="pendingride.php"><img id='resicon' src='pending.png' alt='Logo' > PENDING</a></li>
                            <li><a href="completeride.php"><img id='resicon' src='completed.png' alt='Logo' > COMPLETED</a></li>
                            <li><a href="canceled.php"><img id='resicon' src='canceled.png' alt='Logo' > CANCELED</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                   
                    <div class="dropdown">
                            <button class=" dropdown-toggle cyan-text mt-2" type="button"  data-toggle="dropdown"style="background-color:transparent"><img id='resicon' src='user.png' alt='Logo' > ACCOUNT
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                            <li><a href="userdetails.php">UPDATE DETAILS</a></li>
                            <li><a href="changepass.php">Change Password</a></li>
                            </ul>
                    </div>
                    </li>
                    <li class="nav-item">
                  
                    <div class="dropdown">
                            <button class=" dropdown-toggle cyan-text mt-2" type="button"  data-toggle="dropdown"style="background-color:transparent">Welcome <?php echo "<b>".$_SESSION['userdata']['username']."</b>";?>
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                            <li><a href="signout.php">Sign Out</a></li>
                            </ul>
                    </div>
                    </li>
                </ul>
                </div>
            </nav>
   
<?php }       
 else { ?>
     <nav class="navbar navbar-expand-lg darken-3">
                <a class="navbar-brand" href="#"><img src="logo2.png" style="width:150px;" alt="Logo" ></a>
                <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "></span>
                </button>
                <div class="collapse navbar-collapse" id="menu">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                    <a class="nav-link cyan-text" href="#"><strong>Home<span class="sr-only">(current)</span></strong></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link cyan-text" href="#"><strong>Fare Calculator</strong></a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link cyan-text" href="login.php"><sign-up>LOGIN</sign-up></a>
                    </li>
                </ul>
                </div>
            </nav>
<?php }?>            