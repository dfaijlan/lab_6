<!DOCTYPE html>
<html>
    <head>
        <title>Database Search</title>
    </head>
    <body>
        <?php
        
        // connec tto our mysql database server

        $sername = 'us-cdbr-iron-east-05.cleardb.net';
        $username = 'b05742e5500b2b';
        $password = 'a2d90cd8';
        $dbname = 'heroku_e11c5f3d0a9fe08';
        
        $conn = new mysqli($sername, $username, $password, $dbname);
        
        // if($conn->connect_error)
        // {
        //     die("Connection failed: ".$conn->connect_error);
        // }
        // echo"Connection Successful";
        
        
        // make a query
        $sql = "SELECT * FROM device ORDER BY deviceName";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc())
            {
                echo "Id: " . $row['id'] . " Device: ". $row['deviceName'] . " / Type: " . $row['deviceType'] . " / Availability: " . $row['status'] . "<br />";
            }
        }
        else{
            echo "0 results";
        }
        ?>
        
        <form>
            <br>Filter by: 
            <select name="filter">
                <option value="">Select One</option>
                <option value="name">Name</option>
                <option value="type">Type</option>
                <option value="availability">Availability</option>
            </select>
            Sort by: 
            <select name="sort">
                <option value="">Select One</option>
                <option value="name">Name</option>
                <option value="price">Price</option>
            </select>
            <input type="submit">
        </form>
        
        <?php
       $conn->close();
        ?>
        
    </body>
</html>