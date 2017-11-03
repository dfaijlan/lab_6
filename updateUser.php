<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

include 'database.php';
$conn = getDatabaseConnection();

function departmentList() {
    
     global $conn;
     
     $sql = "SELECT * FROM departments ORDER BY name";
     
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
     return $records;
}

function getUserInfo() {
    global $conn;
    
    $sql = "SELECT *
            FROM user
            WHERE id = " . $_GET['userId'];
            
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $record;
}

function updateUser() {
    global $conn;
    if(isset($_GET['updateUser'])) {
        
        //echo "Form has been submitted!";
        
        $sql = "UPDATE User
                SET firstName = :fName,
                    lastName = :lName,
                    email = :email,
                    phone = :phone,
                    deptId = :deptId
                WHERE id = :id";
        
        $np = array();
        $np[':fName'] = $_GET['firstName'];
        $np[':lName'] = $_GET['lastName'];
        $np[':email'] = $_GET['email'];
        $np[':phone'] = $_GET['phone'];
        $np[':deptId'] = $_GET['deptId'];
        $np[':id'] = $_GET['userId'];
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        
        echo "User has been updated!";
    }
}


    if (isset($_GET['userId'])) {
        $userInfo = getUserInfo();
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
    <body>
        <h1>Update User's Info</h1>
        <form method="GET" id="userChange">
            <input type="hidden" name="userId" value="<?=$userInfo['id']?>" />
            <p><label>First Name:</label><input type="text" name="firstName" value="<?=$userInfo['firstName']?>" required/></p>
            <br />
            <p><label>Last Name:</label><input type="text" name="lastName" value="<?=$userInfo['lastName']?>" required/></p>
            <br/>
            <p><label>Email:</label> <input type= "email" name ="email" value="<?=$userInfo['email']?>" required/></p>
            <br/>
            <p><label>Phone Number:</label> <input type ="text" name= "phone" value="<?=$userInfo['phone']?>" required/></p>
            <br />
            <p><label>Role:</label> 
            <select name="role" required>
                <option value=""> - Select One - </option>
                <option value="Staff" <?=($userInfo['role'] == 'Staff') ? " selected" : ""?> >Staff</option>
                <option value="Student" <?=($userInfo['role'] == 'Student') ? " selected" : ""?> >Student</option>
                <option value="Faculty" <?=($userInfo['role'] == 'Faculty') ? " selected" : ""?> >Faculty</option>
            </select></p>
            <br />
            <p><label>Department:</label> 
            <select name="deptId" required>
                <option value="" > Select One </option>
                <?php
                    $departments = departmentList();
                    foreach ($departments as $department) {
                        echo "<option value='" . $department['id'] . "' ";
                        echo ($userInfo['deptId'] == $department['id']) ? " selected" : "";
                        echo ">" . $department['name'] . "</option>";
                    }
                ?>
            </select></p><br>
            <p><label></label><input type="submit" value="Update User" name="updateUser"></p>
        </form>
        <form action="admin.php">
            <br><input type=submit value="Go Back"><br><br>
        </form>
        
        <?=updateUser()?>
    </body>
</html>