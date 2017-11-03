<?php
    function getDatabaseConnection()
    {
        $host = 'localhost';
        $username = 'dfajilan';
        $password = 'E11ipsis';
        $dbname = 'tech_devices_app';
        
        $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        return $conn;
    }

?>