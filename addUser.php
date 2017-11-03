<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}

include 'database.php';
$conn = getDatabaseConnection();
function departmentList() {
    
     global $conn;
     
     $sql = "SELECT * FROM Departments ORDER BY name";
     
     $stmt = $conn->prepare($sql);
     $stmt->execute();
     $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
     return $records;
}

function addUser() {
    global $conn;
    if (isset($_GET['addUser'])) {
        
        $sql = "INSERT INTO User
                    (firstName, lastName, email, phone, role, deptId)
                VALUES
                    (:fName, :lName, :email, :phone, :role, :deptId)";
        $np = array();
        
        $np[':fName'] = $_GET["firstName"];
        $np[':lName'] = $_GET["lastName"];
        $np[':email'] = $_GET["email"];
        $np[':role'] = $_GET["role"];
        $np[':phone'] = $_GET['phone'];
        $np[':deptId'] = $_GET["deptId"];
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($np);
        
        echo "User was added!";
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
    <body>
        <h1> Add a New User</h1>
                <form method="GET" id="userChange">
                    <p><label>First Name:</label><input type="text" name="firstName" required/></p>
                    <br />
                    <p><label>Last Name:</label><input type="text" name="lastName" required/></p>
                    <br/>
                    <p><label>Email:</label> <input type= "email" name ="email" required/></p>
                    <br/>
                    <p><label>Phone Number:</label> <input type ="text" name= "phone" required/></p>
                    <br />
                   <p><label>Role:</label> 
                   <select name="role" required>
                        <option value=""> - Select One - </option>
                        <option value="staff">Staff</option>
                        <option value="student">Student</option>
                        <option value="faculty">Faculty</option>
                    </select></p>
                    <br />
                    <p><label>Department:</label>
                    <select name="deptId" required>
                        <option value="" > Select One </option>
                        
                        <?php
                        $departments = departmentList();
                        
                        foreach ($departments as $department) {
                            echo "<option value='" . $department['id'] . "'> " . $department['name'] . "</option>";
                        }
                        ?>
                    </select></p> <br>
                    <p>
                        <label></label><input type="submit" value="Add User" name="addUser">
                    </p>
                </form>
                <form action="admin.php">
                   <br><input type=submit value="Go Back"><br><br>
                </form>
                
                <?=addUser();?>
    </body>
</html>