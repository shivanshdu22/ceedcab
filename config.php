<?php
class DatabaseClass  
{  
    private $host = "localhost"; // your host name  
    private $username = "root"; // your user name  
    private $password = "root"; // your password  
    private $db = "cedcab"; // your database name  
   
    protected function connect()  
    {  
        $conn = new mysqli( $this->host, $this->username, $this->password, $this->db); 
        return $conn;
    }  

    ?>