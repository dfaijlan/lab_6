<?php
    function getDatabaseConnection()
    {
        // $host = 'localhost';
        // $username = 'dfajilan';
        // $password = 'E11ipsis';
        // $dbname = 'tech_devices_app';
        
        $host = 'us-cdbr-iron-east-05.cleardb.net';
        $username = 'bea62a3a2d58d2';
        $password = 'c1130949';
        $dbname = 'heroku_cb6e4441523d78c';
        
        $conn = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
        return $conn;
    }

?>