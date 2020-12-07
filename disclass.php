<?php

class Distance extends DatabaseClass  
{  
   
    public function addloc($location,$distance,$active)  
    {  
        $sql= "SELECT * FROM tbl_location where name='".$location."'";
        $result= $this->conn->query($sql);
        if($result->num_rows > 0){
            return "Location Already Present";
            }
        else{    
            $sql = "INSERT INTO tbl_location (name,distance,is_available) VALUES ('".$location."', '".$distance."', '".$active."')";
            $result= $this->conn->query($sql);
            header('Location:location.php');
            return "Location added!";
        }
    }  
  
    public function alllocation()  
    {  
        $a=array();
        $sql= "SELECT * FROM tbl_location";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                
                array_push($a,$row);      
            }
                return $a;    
                   
		} 
    }  
    public function namelocation()  
    {  
        $a=array();
        $sql= "SELECT * FROM tbl_location ORDER BY name;";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                
                array_push($a,$row);      
            }
                return $a;    
                   
		} 
    }  
    public function approvedlocation()  
    {  
        $a=array();
        $sql= "SELECT * FROM tbl_location where is_available='1'";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                
                array_push($a,$row);      
            }
                return $a;    
                   
		} 
    }  
    public function deleteloc($loc_id){
        if($loc_id!=""){
            $sql= "DELETE FROM `tbl_location` WHERE `id`='".$loc_id."'";
            $result= $this->conn->query($sql);
            return $sql;
        }    
        else{
            return "Not being able to update3";
        }    
    }
    public function updateloc($id,$name,$dis,$val){
        if($name!=""&&$dis!=""&&$val!=""){
            $sql= "SELECT * FROM tbl_location where name='".$name."' and distance='".$dis."' and is_available='".$val."'";
            $result= $this->conn->query($sql);
            if($result->num_rows > 0){
                return "No Updation Done";
                }
            else{    
                $sql= "UPDATE `tbl_location` SET `name`='".$name."', `distance`='".$dis."',`is_available`='".$val."' WHERE id='".$id."'";
                $result= $this->conn->query($sql);
                header('Location:location.php');
                return "Updation Complete";
            }   
        } 
       else{
           return "Empty Value Recieved";
       }  
    }
}
    ?>