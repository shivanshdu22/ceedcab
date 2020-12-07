<?php

class DatabaseClass  
{  
    
    protected $host = "localhost"; // your host name  
    protected $username = "root"; // your user name  
    protected $password = ""; // your password  
    protected $db = "cedcab"; // your database name  
    
    public $conn=null;

    public function __construct(){
        $this->conn = new mysqli( $this->host, $this->username, $this->password, $this->db); 
        
    }
    
}    
?>