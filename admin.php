<?php
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: index.php");
}

function userList() {
     include 'database.php';
     $conn = getDatabaseConnection();
     
     $sql = "SELECT * FROM User ORDER BY firstName";
             
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
     return $records;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Database</title>
        <script>
            
            function confirmDelete() {
                return confirm("Are you sure you want to delete this user?");
            }
            
        </script>
        <style>
          @import url("css/style.css");
        </style>
    </head>
    <body>
        <h1> Admin Main Page</h1>
        <h2> Welcome <?=$_SESSION['adminName']?>!</h2>
        <br />
        
        <form action="addUser.php">
            <input type="submit" value="Add new user" /><br><br>
        </form>
        
        <form action="logout.php">
            <input type="submit" value="Logout" />
        </form>
        <br />
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Configure</th>
            </tr>
        <?php
            $users = userList();
            foreach ($users as $user) {
                echo "<tr><td>" . $user['firstName'] . "</td><td>" . $user['lastName'] . "</td>";
                
                echo "<td>[<a href='updateUser.php?userId=" . $user['id'] . "'> Update </a>]";
                echo "[<a onclick='return confirmDelete()' href='deleteUser.php?userId=" . $user['id'] . "'> Delete </a>] <br /></td></tr>";
            }
        ?>
        </table>
    </body>
</html>