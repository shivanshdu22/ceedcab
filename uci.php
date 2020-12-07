<?php

class User extends DatabaseClass  
{  
   
    public function register($username,$name,$mobile,$pass)  
    {  
        date_default_timezone_set('Asia/Kolkata');
        $sql= "SELECT * FROM tbl_user where user_name='".$username."'";
        $result= $this->conn->query($sql);
        if($result->num_rows > 0){
            return "User Name Already Present";
            }
        else{    
            $password= md5($pass);
            $sql = "INSERT INTO tbl_user (user_name,name, Date_of_signup, mobile, password,isAdmin) VALUES ('".$username."', '".$name."',  '".date("Y/m/d h:i:s")."','".$mobile."','".$password."', '0')";
            $result= $this->conn->query($sql);
            return "Registered Successfully. Please wait for approval!";
        }
    }  
    public function login($username,$pass,$check)  
    {  
        
        $password= md5($pass);
        $sql= "SELECT * FROM tbl_user where user_name='".$username."'AND password='".$password."'";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                if($row['is_block']==0){
                    $_SESSION['userdata']=array('userid'=>$row['user_id'],'username'=>$row['user_name'],'isAdmin'=>$row['isAdmin']);	
                   if($check=="A"){
                    setcookie ("member_login",$username,time()+ (10 * 365 * 24 * 60 * 60));
                   }
                    //print_r($_SESSION);
                    if($row['isAdmin']==1){
                        header('Location:admin.php');
                        return "Valid Login Details";
                    } 
                    else{
                        header('Location:userdash.php');
                        return "Valid Login Details"; 
                    }  
                }
                else{
                    return "Confirmation Pending";
                }       
			}
		} 
        else{    
            return "Invalid Login Details";
        }
    }  
    public function userdetails($username)  
    {  
        $sql= "SELECT * FROM tbl_user where user_name='".$username."'";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
            return $row;
            }
		} 
    }  
    public function alluserdetails()  
    {  
        $a=array();
        $sql= "SELECT * FROM tbl_user";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                
                array_push($a,$row);      
            }
              return $a;     
                   
		} 
    } 
    public function admindetails()  
    {  
        $a=array();
        $sql= "SELECT * FROM tbl_user where isAdmin='1'";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                
                array_push($a,$row);      
            }
              return $a;     
                   
		} 
    } 
    public function namedetails()  
    {  
        $a=array();
        $sql= "SELECT * FROM tbl_user ORDER BY name;";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
                
                array_push($a,$row);      
            }
              return $a;     
                   
		} 
    } 
    public function totalspent()  
    {  
        $sql= "SELECT sum(total_fare) FROM tbl_ride where status='0'";
        $result= $this->conn->query($sql);
        if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {     
                return $row;
            }
        } 
        else{
            return '0';
        }   
    }  

    public function updatepersonal($name,$mobile,$pass,$newpas,$userid){
        
        if($pass==""||$newpas==""){
            $sql= "UPDATE `tbl_user` SET `name`='".$name."', `mobile`='".$mobile."' WHERE user_id='".$userid."'";
            $result= $this->conn->query($sql);
            return "Update Done";
        }    
        else{
            $sql= "SELECT * FROM tbl_user WHERE user_id='".$userid."'";
            $result= $this->conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($row['password']==md5($pass)){
                        $sql= "UPDATE `tbl_user` SET `name`='".$name."', `mobile`='".$mobile."', `password`='".md5($newpas)."' WHERE user_id='".$userid."'";
                        $result= $this->conn->query($sql);
                        return "Update Done";
                    }
                }
            } 
        }    
    }
    public function approveuser($userid){
        if($userid!=""){
            $sql= "UPDATE `tbl_user` SET `is_block`='0' WHERE `user_id`='".$userid."'";
            $result= $this->conn->query($sql);
            return $sql;
        }    
        else{
            return "Not being able to update1";
        }    
    }
    public function disapproveUser($userid){
        if($userid!=""){
            $sql= "UPDATE `tbl_user` SET `is_block`='1' WHERE `user_id`='".$userid."'";
            $sqli= "UPDATE `tbl_ride` SET `status`='0' WHERE `status`='1' AND `customer_user_id`='".$userid."'";
            $result= $this->conn->query($sqli);
            $result= $this->conn->query($sql);
            return $sql;
        }    
        else{
            return "Not being able to update2";
        }    
    }
    public function deleteUser($userid){
        if($userid!=""){
            $sql= "DELETE FROM `tbl_user` WHERE `user_id`='".$userid."'";
            $result= $this->conn->query($sql);
            return $sql;
        }    
        else{
            return "Not being able to update3";
        }    
    }
    public function namedetail($username)  
    {  
        $a=array();
        $sql= "SELECT * FROM tbl_user where name='".$username."'";
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
    public function datesign($from,$to){
        $a=array();
        if($from!="" && $to!=""){
        $sql="SELECT * FROM tbl_user WHERE cast(Date_of_signup as date) BETWEEN '".$from."' AND '".$to."'";
        }
        if($from!="" && $to==""){
            $sql="SELECT * FROM tbl_user WHERE cast(Date_of_signup as date) BETWEEN '".$from."' AND '".date("Y/m/d")."'";
        }
        if($from=="" && $to!=""){
            $sql="SELECT * FROM tbl_user WHERE cast(Date_of_signup as date) BETWEEN '2010/01/01' AND '".$to."'";
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