<?php
    session_start();
if(isset($_SESSION['userdata'])){
	header('Location:signout.php');
}
else{
        if (!isset($_SESSION['CREATED'])) {
            $_SESSION['CREATED'] = time();
        } else if (time() - $_SESSION['CREATED'] > 180) {
                unset($_SESSION['currentride']);  
        }
        include "dbc.php";
        include "uci.php";
        $error= array();
        $msg="";
        if(isset($_POST["submit"])){
            $username=isset($_POST['username'])?$_POST['username']:'';
            $pass=isset($_POST['password'])?$_POST['password']:'';
            $check=isset($_POST['remember'])?$_POST['remember']:'';
           
            $user= new User();
            $msg=$user->login($username,$pass,$check);
            
        } 
?>

    <!DOCTYPE html>
    <html>
        <head>
            <title>CEDCAB</title>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <link rel="stylesheet" href="signstyle.css">
            <script>
                
                $(document).ready(function(){
                    $("#sign-up").click(function(e) {
                        e.preventDefault();
                    });
                    $("#sign-up").click(function(){		
                        var username = document.getElementById("username").value;
                        var password = document.getElementById("password").value;
                        
                        else{
                            $.ajax({
                                url:'ajax.php',
                                type:'POST',
                                data:{username:username , name:name , mobile:mobile , password:password },
                                success: function(result){
                                    $("#fare").html(result);
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
            <form  action="login.php" method="POST" class="login-form" >
                <img class="mb-2" src="logo2.png" style="width:150px;" alt="Logo" >
                <h1><sign-up>Login</sign-up></h1>
                <div class="form-input-material">
                    <input type="text" name="username" id="username" placeholder="Username" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" autocomplete="off"  required />
                </div>
                <div class="form-input-material">
                    <input type="password" name="password" id="password" placeholder="Password" autocomplete="off"  required />
                </div>
                <div class="form-input-material" id="rememberdiv">
                <input type="checkbox" name="remember" id="remember" value="A" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> />
                <label for="remember-me">Remember me</label>
                </div>
                <button type="submit" name="submit" id="sign-up" class="btn btn-primary btn-ghost">Login</button>
                <a>OR</a>
                <a href="mobile.php" id="login" class="btn btn-primary btn-ghost">SIGN-UP</a>
                <a>OR<a>
                <a  class="btn btn-primary btn-ghost" href="index.php">Back To Main Page</a>
                <div id="val"  class="pt-3 cyan-text"><?php echo "<b>".$msg."</b>" ?></div>
            </form>
        </body>
    </html>            
<?php } ?>