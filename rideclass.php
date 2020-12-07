<?php

class Ride extends DatabaseClass  
{  
   
    public function addride($pick,$drop,$cab,$distance,$fare,$luggage,$userid)  
    {      
        date_default_timezone_set('Asia/Kolkata');
        $i=0;
        $sql= "SELECT * FROM tbl_ride where customer_user_id='".$userid."'";
        $result= $this->conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                if($row['status']==1){
                    $i=1;
                    return "Already Pending Rides ";
                } 
            }
            if($i==0){
                $sqlii = "INSERT INTO `tbl_ride`(`ride_date`, `from_loc`, `to_loc`,`Cab_type` ,`total_distance`, `luggage`, `total_fare`, `customer_user_id`) VALUES ('".date("Y/m/d h:i:s")."', '".$pick."', '".$drop."', '".$cab."', '".$distance."', '".$luggage."','".$fare."', '".$userid."')";
                $result= $this->conn->query($sqlii);
                return "Ride added! Status: Pending";
            }
        }
        else{    
            $sqlii = "INSERT INTO `tbl_ride`(`ride_date`, `from_loc`, `to_loc`,`Cab_type`,`total_distance`, `luggage`, `total_fare`, `customer_user_id`) VALUES ('".date("Y/m/d h:i:s")."', '".$pick."', '".$drop."','".$cab."' ,'".$distance."', '".$luggage."','".$fare."', '".$userid."')";
            $result= $this->conn->query($sqlii);
            return "Ride added! Status: Pending";
        }
    }  
    public function storeride($pick,$drop,$cab,$distance,$fare,$luggage)  
    {      
        
        $_SESSION['CREATED'] = time();
        $_SESSION['currentride']=array('drop'=>$drop,'pick'=>$pick,'cab'=>$cab,'dis'=>$distance,'fare'=>$fare,'luggage'=>$luggage);
    }  
    public function ridedetails($userid)  
    {  
        $a=array();
        $sql= "SELECT * FROM tbl_ride where customer_user_id='".$userid."'";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                array_push($a,$row);
            }
            return $a;
        } 
        else {
            return $a;
        }
    }  
    public function totalspent($userid)  
    {  
       
        $sql= "SELECT sum(total_fare) FROM tbl_ride where customer_user_id='".$userid."' and status='2'";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {     
                return $row;
            }
        } 
        else{
            return null;
        }   
    }  
    public function allrides()  
    {  
        $a=array();
        $sql= "SELECT * FROM tbl_ride";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {     
                array_push($a,$row);      
            }
                return $a;    
                   
        } 
        else{
            return $a;
        }
    }  
    public function farerides()  
    {  
        $a=array();
        $sql= "SELECT * FROM tbl_ride ORDER BY total_fare";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {     
                array_push($a,$row);      
            }
                return $a;    
                   
        } 
        else{
            return $a;
        }
    }  
    public function invoice()  
    {  
        $a=array();
        $sql= "SELECT * FROM tbl_ride where ";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {     
                array_push($a,$row);      
            }
                return $a;    
                   
		} 
    }  
    public function updateride($rideid){
        if($rideid!=""){
            $sql= "UPDATE `tbl_ride` SET `status`='2' WHERE `ride_id`='".$rideid."'";
            $result= $this->conn->query($sql);
            return $sql;
        }    
        else{
            return "Not being able to update";
        }    
    }
    public function cancelride($rideid){
        if($rideid!=""){
            $sql= "UPDATE `tbl_ride` SET `status`='0' WHERE `ride_id`='".$rideid."'";
            $result= $this->conn->query($sql);
            return "Ride canceled";
        }    
        else{
            return "Not being able to update";
        }    
    }
    public function deleteride($rideid){
        if($rideid!=""){
            $sql= "DELETE FROM `tbl_ride` WHERE `ride_id`='".$rideid."'";
            $result= $this->conn->query($sql);
            return $sql;
        }    
        else{
            return "Not being able to update";
        }    
    }
    public function locfare(){
         $a=array();
         $sql="SELECT DISTINCT(from_loc),sum(total_fare) FROM `tbl_ride` where status='2' group by from_loc";
         $result= $this->conn->query($sql);
         if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {     
                array_push($a,$row);      
            }
                return $a;    
		} 
    }
    public function locride(){
        $a=array();
        $sql="SELECT DISTINCT(from_loc),count(ride_id) FROM `tbl_ride` where status='2' group by from_loc";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {     
               array_push($a,$row);      
           }
               return $a;    
       } 
    }
    public function nameride($name){
        $a=array();
        $sql="SELECT * FROM tbl_ride INNER JOIN tbl_user ON tbl_ride.customer_user_id=tbl_user.user_id";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {  
               if($row['name']==$name){
                    array_push($a,$row);   
               }      
           }
               return $a;    
       } 
       else{
        return $a;  
       }
   }
   public function namerides(){
        $a=array();
        $sql="SELECT * FROM tbl_ride INNER JOIN tbl_user ON tbl_ride.customer_user_id=tbl_user.user_id";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {  
                
                    array_push($a,$row);   
                        
            }
            return $a;    
        } 
        else{
            return $a;  
        }
    }
    public function nameridedetail($id){
        $a=array();
        $sql="SELECT * FROM tbl_ride INNER JOIN tbl_user ON tbl_ride.customer_user_id=tbl_user.user_id";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {  
                if($row['ride_id']==$id){
                        array_push($a,$row);   
                }      
        }
            return $a;    
        } 
        else{
            return $a;  
        }
    }
   public function dateride($from,$to){
        $a=array();
        if($from!="" && $to!=""){
        $sql="SELECT * FROM tbl_ride WHERE cast(ride_date as date) BETWEEN '".$from."' AND '".$to."'";
        }
        if($from!="" && $to==""){
            $sql="SELECT * FROM tbl_ride WHERE cast(ride_date as date) BETWEEN '".$from."' AND '".date("Y/m/d")."'";
        }
        if($from=="" && $to!=""){
            $sql="SELECT * FROM tbl_ride WHERE cast(ride_date as date) BETWEEN '2010/01/01' AND '".$to."'";
        }
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {  
                    array_push($a,$row);      
        }
            return $a;    
        } 
        else{
            return $a;
        }
    }
}  
?>