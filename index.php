<?php
session_start();

function loginProcess() {
    if(isset($_POST['loginForm']))
    {
        include 'database.php';
        
        $conn = getDatabaseConnection();
        
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        
        $sql = "SELECT * 
                FROM admin 
                WHERE username = :username
                AND password = :password";
                
        $namedParameters = array();
        $namedParameters[':username'] = $username;
        $namedParameters[':password'] = $password;
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($namedParameters);
        $record = $stmt->fetch();
        
        if(empty($record))
        {
            echo"Wrong Username or Password";
            
        }
        else{
            $_SESSION['username'] = $record['username'];
            $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName'];
            //echo $record['firstName'];
            header("Location: admin.php");
        }
       // print_r($record);
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>User Database</title>
        <style>
            @import url("css/style.css");
        </style>
    </head>
    <body id=index>
        <h1>Admin Login</h1>
        <form method="post" id="indexForm">
            Username: <input type="text" name="username" required/> <br />
            Password: <input type="password" name="password" required/><br /><br />
            <input type="submit" name="loginForm" value="Login!"/>
        </form>

        <br />
        
        <?=loginProcess()?>
    </body>
</html>