<?php
    
    include "disclass.php";
    $user= new Distance();
    $ud=$user->approvedlocation();
?>
<?php if(isset($_SESSION['userdata'])){ ?>
        <div class="row justify-content-center" id ="signupbanner">		  	
                            <div class=" col-md-auto col-lg-4 col-md-8 col-12 text-center col-sm-12 justify-content-center mt-4 pt-4 pb-4" id="signform">
                                        <img class="mb-2" src="logo2.png" style="width:150px;" alt="Logo" ><hr>
                                        <h4 class=" m-0">Your everyday travel partner</h4>
                                        <p class=" m-0">Choose from the range of categories and prices </p>
                                        <form id ="farecal" action="index.php" method="POST" class=" justify-content-center pt-4">
                                            <select id="pick"  name="picklist"  required>
                                                <option class="place" value="" disabled selected>PICK-UP</option>
                                                <?php
                                                    foreach($ud as $key=> $udd) {?>  
                                                       <option value="<?php echo $udd['name'];?>"><?php echo $udd['name'];?></option> 
					                            <?php }?>
                                            </select>
                                            <select id="drop"  name="droplist" required>
                                                <option class="place" value="" disabled selected>DESTINATION</option>
                                                <?php
                                                    foreach($ud as $key=> $udd) {?>  
                                                       <option value="<?php echo $udd['name'];?>"><?php echo $udd['name'];?></option> 
					                            <?php }?>
                                            </select>
                                            <select id="car"  name="carlist" onchange="cab()"  required>
                                                <option class="place" value="" disabled selected>CAB-TYPE</option>
                                                <option value="CedMicro">CedMicro</option>
                                                <option value="CedMini">CedMini</option>
                                                <option value="CedSUV">CedSUV</option>
                                                <option value="CedRoyal">CedRoyal</option>
                                            </select>
                                            <input type="number" step="0.01" id="luggage" placeholder="LUGGAGE(In Kg)" name="luggage" ><br>
                                            <button id="cal" class="mt-4">Calculate Fare</button>
                                            <div id="fare" class="pt-3 cyan-text"></div>
                                            <div id="book"></div>
                                        </form>	
                                        	
                                        			 
                            </div>
                            <div class="col-md-auto col-12 col-lg-8 col-sm-12 justify-content-center " >	
                            </div>			
                    </div>  
<?php }       
 else { ?>
    <div class="row justify-content-center" id ="signupbanner">		  	
                            <div class=" col-md-auto col-lg-4 col-md-8 col-12 text-center col-sm-12 justify-content-center mt-4 pt-4 pb-4" id="signform">
                                        <img class="mb-2" src="logo2.png" style="width:150px;" alt="Logo" ><hr>
                                        <h4 class=" m-0">Your everyday travel partner</h4>
                                        <p class=" m-0">Choose from the range of categories and prices </p>
                                        <form id ="farecal" class=" justify-content-center pt-4">
                                            <select id="pick"  name="picklist"  required>
                                                <option class="place" value="" disabled selected>PICK-UP</option>
                                                <?php
                                                    foreach($ud as $key=> $udd) {?>  
                                                       <option value="<?php echo $udd['name'];?>"><?php echo $udd['name'];?></option> 
					                            <?php }?>
                                            </select>
                                            <select id="drop"  name="droplist" required>
                                                <option class="place" value="" disabled selected>DESTINATION</option>
                                                <?php
                                                    foreach($ud as $key=> $udd) {?>  
                                                       <option value="<?php echo $udd['name'];?>"><?php echo $udd['name'];?></option> 
					                            <?php }?>
                                            </select>
                                            <select id="car"  name="carlist" onchange="cab()"  required>
                                                <option class="place" value="" disabled selected>CAB-TYPE</option>
                                                <option value="CedMicro">CedMicro</option>
                                                <option value="CedMini">CedMini</option>
                                                <option value="CedSUV">CedSUV</option>
                                                <option value="CedRoyal">CedRoyal</option>
                                            </select>
                                            <input type="number" step="0.01" id="luggage"  placeholder="LUGGAGE(In Kg)" name="luggage" ><br>
                                            <button  id="cal" class="mt-4">Calculate Fare</button>
                                            <div id="book"></div>
                                        </form>	
                                            <div id="fare" class="pt-3 cyan-text"></div>					 
                            </div>
                            <div class="col-md-auto col-12 col-lg-8 col-sm-12 justify-content-center">	
                            </div>			
                    </div>  
 <?php }?> 
