<!---->

<!DOCTYPE html>
<html>
    <head>
        <title>Database Search</title>
        <style>
            @import url("styles.css");
        </style>
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
        if($_GET["sort"] == "price")
            $sort = "price";
        else
            $sort = "deviceName";
                
        if ($_GET["filter"] != "")
        {
            $filter = $_GET["filter"];
            if ($_GET["filter_choice"] == "name")
                $sql = "SELECT * FROM device WHERE deviceName = '$filter' ORDER BY $sort";
            elseif ($_GET["filter_choice"] == "type")
                $sql = "SELECT * FROM device WHERE deviceType = '$filter' ORDER BY $sort";   
            else
                $sql = "SELECT * FROM device WHERE status = '$filter' ORDER BY $sort";
        }
        else 
        {
             $sql = "SELECT * FROM device ORDER BY $sort";
        }
        $result = $conn->query($sql);
        if($result->num_rows > 0){
        ?>
        
        <table>
            <tr>
                <th>Id</th>
                <th>Device</th>
                <th>Type</th>
                <th>Price</th>
                <th>Availability</th>
            </tr>
        <?php
            while($row = $result->fetch_assoc())
            {
                echo "<tr><td>" . $row['id'] . "</td><td>". $row['deviceName'] . "</td><td>" . $row['deviceType'] . "</td><td>" . $row['price'] . "</td><td>" . $row['status'] . "</td></tr>";
            }
        }
        else{
            echo "0 results";
        }
        ?>
        </table>
        
        <form>
            <br>Filter by: 
            <select name="filter_choice">
                <option value="name">Name</option>
                <option value="type">Type</option>
                <option value="Availability">Availability</option>
            </select>
            <input type="text" name="filter" value = "">
            Sort by: 
            <select name="sort">
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