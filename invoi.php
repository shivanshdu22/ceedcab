<?php
    include "dbc.php";
    include "rideclass.php";
    $ride= new Ride();
    $rd= $ride->allrides();

    if(isset($_POST["invoice"])){
        $id=isset($_POST['id'])?$_POST['id']:'';
        $user= new User();
        $ud=$user->namedetail($name);
        foreach($ud as $key=>$udd){
            if($udd["user_id"]==$id){
                header("Content-Type: application/vnd.ms-excel");
                header('Content-Disposition: attachment; filename="MyMsDocFile.doc');
            
                echo "<html>";
                echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
                echo "<body>";
                echo "<b>Invoice of Ride No.".$udd[ride_id]."</b><br/>";
                echo "  <p><span id='userheading userid'>User Id :".$udd['user_id']."</div></p>
                        <p><span id='userheading username'>Username : ".$udd['user_name']."</div></p>";
                echo "</body>";
                echo "</html>";
            }
        }
    }  
?>
<html>
    <head>
        <title>CEDCAB</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="admin.css">
        <script>
    </head>
    <body>
       <?php include "header.php" ?>
        <div id="content">            
            <div id="total-income">
                <table border="1">
                    <p>Invoice Corner</p> 
                    <tr>
                        <th>Ride_ID</th>
                        <th>Ride_date</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total Distance</th>
                        <th>Luggage</th>
                        <th>Total Fare</th>
                        <th>Customer ID</th>
                        <th>View Details</th>
                    </tr>
                    <?php
                        foreach($rd as $key=> $udd){
                            if($udd['status']==2){?>
						<tr>
							<td><?php echo $udd['ride_id'];?></td>
							<td><?php echo $udd['ride_date'];?></td>
                            <td><?php echo $udd['from_loc'];?></td>
                            <td><?php echo $udd['to_loc'];?></td>
                            <td><?php echo $udd['total_distance'];?></td>
                            <td><?php echo $udd['luggage'];?></td>
                            <td><?php echo $udd['total_fare'];?></td>
                            <td><?php echo $udd['customer_user_id'];?></td>
                            <td>
                                <form id="locationform" action="invoice.php" method="POST">
                                    <input type="text" name="id" id="id" value="<?php echo $udd['ride_id'];?>" hidden>
                                    <button id="invoice" type="submit" name="invoice">Invoice</button>
                                </form>  
                            </td>
						</tr>
                            <?php } 
                        }?>
                </table>
            </div>
            <div id="invoice">
            </div>
        </div>
    </body>
</html>