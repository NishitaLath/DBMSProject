<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="Login.css">
	<title>TPO Login</title>
</head>

<body>
	<form action="tpo.php" method="post">
		<div class="login-box">
			<h1>Login</h1>

			<div class="textbox">
				<i class="fa fa-id-card" aria-hidden="true"></i>
				<input type="text" placeholder="Username" name="tpoUsername" value="">
			</div>

			<div class="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="Password" name="tpoPwd" value="">
			</div>

			<input class="button" type="submit" name="login" value="Sign In">
		</div>
	</form>
</body>
</html>

<?php
// Connect to the database
require_once 'dbconfig.php';
if(!empty($_GET['status'])){
    echo '<div>You have been logged out!</div>';
}
function test_input($data) {
	
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$tpoUsername = test_input($_POST["tpoUsername"]);
	$tpoPwd = test_input($_POST["tpoPwd"]);
	$stmt = $conn->prepare("SELECT * FROM tpologin");
	$stmt->execute();
	$result = $stmt->get_result();
	$users = $result->fetch_all(MYSQLI_ASSOC);
	
	foreach($users as $user) {
		
		if(($user['tpoUsername'] == $tpoUsername) &&
			($user['tpoPwd'] == $tpoPwd)) {
				header("location: tpoPage.php");
		}
		else {
			echo "<script language='javascript'>";
			echo "alert('WRONG INFORMATION')";
			echo "</script>";
			die();
		}
	}
}
?>