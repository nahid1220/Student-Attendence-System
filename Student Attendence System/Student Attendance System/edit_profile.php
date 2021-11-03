<?php
	session_start();
	require 'connection.php';
	$userDetails = $user->getUserById($_SESSION['userId']);
	if(isset($_POST['submit'])){
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$fullname = trim($_POST['fullname']);
		$age = trim($_POST['age']);
		$updated = date('Y-m-d H:i:s');
		$user->updateProfileById($email,$password,$fullname,$age,$updated,$_SESSION['userId']);	
		echo "Successfully Updated";
		header("location:profile.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
</head>
<body>
	<h3>Edit your profile here..</h3>
	<form method="POST">
		Email: <input type="email" name="email" value="<?php echo $userDetails['email']; ?>"><br>

		Password: <input type="password" name="password" value="<?php echo $userDetails['password']; ?>"><br>

		Name: <input type="text" name="fullname" value="<?php echo $userDetails['fullname']; ?>"><br>

		Age: <input type="number" name="age" value="<?php echo $userDetails['age']; ?>"><br>

		<input type="submit" name="submit" value="Update">
	</form>
</body>
</html>