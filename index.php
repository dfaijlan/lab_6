<!DOCTYPE html>
<html>
    <head>
        
    </head>
    
    
    <body>
        <?php
        
        // connec tto our mysql database server

        $sername = 'localhost';
        $username = 'dfajilan';
        $password = 'E11ipsis';
        $dbname = 'tech_devices_app';
        
        $conn = new mysqli($sername, $username, $password, $dbname);
        
        if($conn->connect_error)
        {
            die("Connection failed: ".$conn->connect_error);
        }
        echo"Connection Successful";
        
        
        // make a query
        $sql = "SELECT id, name, college FROM Departments";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc())
            {
                echo "department id: ".$row['id']. "name: " .$row['name']. " ". $row['college']."<br />";
            }
        }
        else{
            echo "0 results";
        }
        
        
       $conn->close();
        ?>
        
    </body>
</html>