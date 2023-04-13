<!DOCTYPE html>
<html>
    <head>
        <title>Update Info</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>Update Information</h1>                
        <form action="st_update.php" method="get">
            Roll No: <input type="text" name="stRollno" maxlength="8"/><br>
            Name: <input type="text" name="stName" maxlength="50"/><br>
            Webmail: <input type="text" name="stWebmail" maxlength="100"/><br>
            Phone Number: <input type="text" name="stPhone" maxlength="10"/><br>
            Password: <input type="password" name="stPassword" maxlength="20"/><br>
            10th percentage: <input type="number" step="0.1" name="st10thPer" maxlength="4"/><br>
            12th percentage:<input type="number" step="0.1" name="st12thPer" maxlength="4"/><br>
            Current CPI: <input type="number" step="0.01" name="stcurrCpi" maxlength="5"/><br>
            Age: <input type="number" name="stAge"/><br>
            Specialisation: <input type="text" name="stSpec"/><br>
            Interest: <input type="text" name="stInterset"/><br>
            Batch: <input type="number" name="stBatch"/><br>
            Placed: <input type="text" name="stPlaced"/><br>
            Package recieved: <input type="number" name="stPack"/><br>

                <!-- <script>
                    document.querySelector("input[type=number]")
                    .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                </script><br>
            Marks Criteria: <input type="number" step="0.01" name="markcri" maxlength="5"/><br>
            Salary Package: <input type="number" name="stAge"/><br>
            stSpec of Interview [Online/Offline]: <input type="text" name="stSpec" maxlength="7"/><br>
            stSpec of Interview [Written/Interview]: <input type="text" name="stInterest" maxlength="9"/><br>
            Year since recruiting from IIT Patna: <input type="number" name="stBatch" placeholder="YYYY" min="2008" max="2023"> -->
                <!-- <script> -->
                    <!-- document.querySelector("input[type=number]")
                    .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
                </script><br> -->
            <input type="submit" name="submit" value="Update" />
        </form>
    </body>
</html>

<?php
session_start();
// error_reporting(0);
$errors = array();

// Check if the user is logged in
if(!isset($_SESSION["stRollno"]))
{
    header('Location: student.php');
    exit;
}

// Connect to the database
require_once 'dbconfig.php';

// Handle form submission
if(isset($_GET["submit"]))
{
    // Get the user's current information
    $currstRollno= $_SESSION['stRollno'];
    $sql = "SELECT * FROM student WHERE stRollno=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $currstRollno);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    // Get the user's updated information
    $stRollno=$_GET["stRollno"];
    $stName=$_GET["stName"];
    $stWebmail=$_GET["stWebmail"];
    $stPhone=$_GET["stPhone"];
    $stPwd=$_GET["stPassword"];
    $st10thPer=$_GET["st10thPer"];
    $st12thPer=$_GET["st12thPer"];
    $stcurrCpi=$_GET["stcurrCpi"];
    $stAge=$_GET["stAge"];
    $stSpec=$_GET["stSpec"];
    $stInterset=$_GET["stInterset"];
    $stBatch=$_GET["stBatch"];
    $stPlaced=$_GET["stPlaced"];
    $stPack=$_GET["stPack"];
    
    if(strlen(trim($stPwd))<8)
    {
        echo "Password should be at least 8 characters long.";
        exit;
    }
    
    // Update the user's information in the "users" table
    $sql = "UPDATE student SET stRollno=?, stName=?, stWebmail=?, stPhone=?, stPassword=?, st10thPer=?, st12thPer=?, stcurrCpi=?, stAge=?, stSpec=?, stInterset=?, stBatch=?, stPlaced=?, stPack=? WHERE stRollno=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssdddissisds", $stRollno, $stName, $stWebmail, $stPhone, $stPwd, $st10thPer, $st12thPer, $stcurrCpi, $stAge, $stSpec, $stInterset, $stBatch, $stPlaced, $stPack, $currstRollno);
    $stmt->execute();
    
    exit;
}
?>