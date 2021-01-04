<?php
    session_start();
   
    include "dbc.php";
    include "uci.php";
    $error= array();
    $msg="";
        if(isset($_POST['submit'])){
            $_SESSION['mobile']=$_POST['number'];
            $number= $_POST['number'];
           
            $otp = rand(100000, 999999);
            $_SESSION['session_otp'] = $otp;
            $message = rawurlencode("Your One Time Password is ".$otp);
            $fields = array(
                "sender_id" => "FSTSMS",
                "message" => ".$message.",
                "language" => "english",
                "route" => "p",
                "numbers" => "$number",
                "flash" => "1"
            );

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization: FQX6EumkalqYcx9KBI5pGjhenswDo1i8WTbHRJMCS47tPZOv3zoQHgJ3jRhVcW7TDFZG1np0trEImfza",
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
           
            } else {
            
            } 
        
    }
    if(isset($_POST['verify'])){
        $number= $_POST['otp'];
        if($_SESSION['session_otp']==$number){
           
            header('Location:signup.php');
        }
        else{
            echo "<script type='text/javascript'>alert('OTP Dosen't Match');</script>";
            unset( $_SESSION['mobile']);
        }
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
                /*$("#sign-up").click(function(e) {
    			    e.preventDefault();
                });*/
               
        	}); 
		
        </script>    
    </head>
    <body>
        <div>
            <form action="mobile.php" method="POST" class="login-form" >
                <img class="mb-2" src="logo2.png" style="width:150px;" alt="Logo" >
                <h1><sign-up>Let's start</sign-up></h1>
                <div class="form-input-material">
                    <input type="number" name="number" id="mobile" maxlength = "10" minlength = "10" placeholder="Please Enter your Mobile Number" autocomplete="off"  required />
                </div>
                <button type="submit" name="submit" id="sign-up" class="btn btn-primary btn-ghost">Send OTP</button>
                <div id="val" class="pt-3 cyan-text"><?php echo "<b>".$msg."</b>" ?></div>
                <a>OR<a>
                <a class="btn btn-primary btn-ghost" href="index.php">Back To Main Page</a>
            </form>
            <?php if(isset($_POST['submit'])){?>
            <form action="mobile.php" method="POST" class="login-form1" >
                <h1><sign-up>Enter OTP HERE</sign-up></h1>
                <div class="form-input-material">
                        <input type="number" name="otp" id="mobile" maxlength = "10" minlength = "10" placeholder="OTP" autocomplete="off"  />
                </div>
                <button type="submit" name="verify" id="sign-up" class="btn btn-primary btn-ghost">Enter OTP</button>
            </form> 
            <?php } ?>   
       </div>
    </body>
</html>            