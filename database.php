<?php
    function getDatabaseConnection()
    {
        $host = 'us-cdbr-iron-east-05.cleardb.net';
        $username = 'bea62a3a2d58d2';
        $password = 'c1130949';
        $dbname = 'tech_devices_app';
        
        $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        return $conn;
    }

?>