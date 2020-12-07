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
                $("#<?php echo $ud['user_id']?>result").hide();
                $("#<?php echo $ud['user_id']?>").click(function(){	
                    $("#Name").html("<input type='text' id='<?php echo $ud['name']?>'value='<?php echo $ud['name']?>'>");
                    $("#mobile").html("<input type='number' id='<?php echo $ud['mobile']?>'value='<?php echo $ud['mobile']?>'>");
                    $("#password").html("Password : <input type='text' id='cpassword' placeholder='current password' value=''> <input type='text' placeholder='New password' id='newpassword' value=''>");
                    $("#<?php echo $ud['user_id']?>result").show();
                    $("#<?php echo $ud['user_id']?>").hide();
                });
                $("#<?php echo $ud['user_id']?>result").click(function(){	
                    var name=document.getElementById("<?php echo $ud['name']?>").value;
                    var mob= document.getElementById("<?php echo $ud['mobile']?>").value;
                    var password= document.getElementById("cpassword").value;
                    var newpassword= document.getElementById("newpassword").value;
                    var user_id=<?php echo $ud['user_id']?>;
                    
                   if(name==""||mob==""){
                    $("#message").html("<strong>Name or Mobile Number can't be empty</strong>");
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
                <img class="mb-2" src="logo2.png" style="width:150px;" alt="Logo" >
                <div id="welcome">
                    Welcome <?php echo "<b>".$_SESSION['userdata']['username']."</b>";?>,
                    <a href="signout.php"><span id="userheading">Sign Out</span></a> || <a href="index.php"><span id="userheading">Go To Main Page</span></a> 
                </div>    
            </div>	
            <ul>
                <li><a href="admin.php">DASHBOARD</a></li>
                <li><a href="rides.php">RIDES</a></li>
                <!--<li><a href="invoice.php">INVOICES</a></li>-->
                <li><a href="users.php">BLOCK/UNBLOCK USER</a></li>
                <li><a href="data.php">ALL DATA</a></li>
                <li><a href="location.php">LOCATIONS</a></li>
                <li><a href="account.php">ACCOUNT</a></li>
            </ul>
        </header>
        <div id="content">
                   
         
    </body>
</html>
    <?php } 
    else{
        header('Location:login.php');
    }?>