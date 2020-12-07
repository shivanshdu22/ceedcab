<?php
     include "dbc.php";
     include "uci.php";
     include "rideclass.php";
     include "disclass.php";
    $msg="";
    $user= new Distance();
    $ud=$user->alllocation();
    if(isset($_POST["submit"])){
        $location=isset($_POST['location'])?$_POST['location']:'';
        $dis=isset($_POST['distance'])?$_POST['distance']:'';
        $active=isset($_POST['active'])?$_POST['active']:'';
        if(preg_match("/([%\$#\*]+)/", $location))
        {
            $msg='No Special Charaters allowed in Location';
            echo ( "<script type='text/javascript'>alert('".$msg."');</script>");
        }
        else{
            $msg=$user->addloc($location,$dis,$active); 
            echo ( "<script type='text/javascript'>alert('".$msg."');</script>");
        }  
    }  
    if(isset($_POST["update"])){
        
        $id=isset($_POST['id'])?$_POST['id']:'';
        $location=isset($_POST['location'])?$_POST['location']:'';
        $dis=isset($_POST['distance'])?$_POST['distance']:'';
        $active=isset($_POST['active'])?$_POST['active']:'';
        $msg=$user->updateloc($id,$location,$dis,$active);   
        echo ( "<script type='text/javascript'>alert('".$msg."');</script>");
    }             
?>
<html>
    <head>
        <title>CEDCAB</title>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="admin.css">
        <script>
             $(document).ready(function(){
                $('#update').hide();
                $(".edit").click(function(){
                    var hash="#";
                    var currentRow = $(this).closest('tr');
					var id = currentRow.find('id').text();
                    var location =currentRow.find('name').text();
                    var distance =currentRow.find('distance').text();
                    var av =currentRow.find('avail').text(); 
                    $('#id').val(id); 
                    $('#location').val(location);
                    $('#distance').val(distance);
                    $('[name=active]').val(av);
                    $('#add').hide();
                    $('#update').show();
                    $(this).closest('tr').remove();
                    $('html, body').animate({
                        'scrollTop' : $("#locationform").position().top
                    });
                });
                $('.delete').click(function(){
                    if(confirm("Are you sure you want to delete this?")){ 
                        var locationid =$(this).attr('data-id');
                        var action="deletelocation";
                        $.ajax({
                            url:'ajax.php',
                            type:'POST',
                            data:{ loc_id:locationid , action:action},
                            success: function(result){
                                alert('Location Deleted!');
                                location.reload();
                            },
                            error:function(){
                                alert ('error');
                            }
                        });
                    }
                    else{
                        return false;
                    }   
                    });	
                $('#allloc').DataTable({"paging":   false,});
                $('#pendloc').DataTable({"paging":   false,});    
                var loc = document.getElementById("location").value;
                $("#location").on("blur paste", function() {
                    var username = document.getElementById("location").value;
                    if ( username.match('^[a-zA-Z][a-zA-Z0-9\\s-]{3,80}$') ) {
                            
                        } else {
                            alert("Please enter a vaild location");
                            document.getElementById("location").value= loc;
                        }
                    if(/\s/.test(username) != false) {
                        username=username.trim();
                        document.getElementById("location").value= username;
					}
				});		
                document.querySelector("#distance").addEventListener("keypress", function (evt) {
    			if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
					{
						evt.preventDefault();
					}
				});		
             });      
        </script>
    </head>
    <body>
       <?php include "header.php" ?>
       <div id="content">
            <div id="total-income">
            <img id='acc' src='location.png' alt='Logo' >
                <table id="allloc" border="1">
                        <p id="heading">All Locations</p> 
                        <thead>
                        <tr>
                            <th>Location ID</th>
                            <th>Name</th>
                            <th>Distance</th>
                            <th>Available</th>
                            <th>Option</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($ud as $key=> $udd) {?>
						<tr>
							<td><id><?php echo $udd['id'];?></id></td>
                            <td><name><?php echo $udd['name'];?></name></td>
                            <td><distance><?php echo $udd['distance'];?></distance></td>
                            <td><avail><?php  if($udd['is_available']==0){echo "<img id= 'resicon' src='unloc.png' alt='Unavailable' >";} else{echo "<img id= 'resicon' src='tick.png' alt='available' >";}?></avail></td>
							<td>
								<!-- Icons -->
								<a href="#" data-id="<?php echo $udd['id'];?>" class="edit"  title="Edit"><img id= 'resicon' src='edit.png' alt='Logo' ></a>
								<a href="#" data-id="<?php echo $udd['id'];?>" class="delete"  title="Delete"><img id= 'resicon' src='delete.png' alt='Logo' ></a> 
							</td>
						</tr>
                        <?php }?>
                        </tbody>
                    </table>
            </div>
            <div id="total-income">
            
            <table id="pendloc" border="1">
                <img id='acc' src='pendloc.png' alt='Logo' ><br>
                    <p id="heading">Pending Locations</p> 
                    <thead>
                    <tr>
                        <th>Location ID</th>
                        <th>Name</th>
                        <th>Distance</th>
                        <th>Available</th>
                        <th>Option</th>
                    </tr>
                        </thead>
                        <tbody>
                    <?php
                    foreach($ud as $key=> $udd) {
                        if($udd['is_available']==0){?>
                    <tr>
                        <td><id><?php echo $udd['id'];?></id></td>
                        <td><name><?php echo $udd['name'];?></name></td>
                        <td><distance><?php echo $udd['distance'];?></distance></td>
                        <td><avail><?php  if($udd['is_available']==0){echo " <img id= 'resicon' src='unloc.png' alt='Unavailable' >";} else{echo "Available";}?></avail></td>
                        <td>
                            <!-- Icons -->
                            <a href="#" data-id="<?php echo $udd['id'];?>" class="edit"  title="Edit"><img id= 'resicon' src='edit.png' alt='Logo' ></a>
                            <a href="#" data-id="<?php echo $udd['id'];?>" class="delete"  title="Delete"><img id= 'resicon' src='delete.png' alt='Logo' ></a> 
                        </td>
                    </tr>
                    <?php }}?>
                    </tbody>
                </table>
        </div>
            <div id="total-income">
                <img id='acc' src='addloc.png' alt='Logo' >
                <h3 id="heading">Add Locations</h3>
                <form id="locationform"action="location.php" method="POST">
                    <input type="text" name="id" id="id" value="" hidden>
                    <input type="text" id ="location" name="location" placeholder="Location Name" required>
                    <input type="number" id ="distance" name="distance" placeholder="Distance" required>
                    <select id="car"  name="active"   required>
						<option class="place" value="" disabled selected>Availabilty</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                    <button href="location.php" id="add" type="submit" name="submit">Add</button>
                    <button name="update" id="update" value="Update Location">Update Location</button>
                </form>  
                <div id="message"><?php echo "<b>".$msg."</b>" ?></div>   
            </div>
        </div>
    </body>
</html>