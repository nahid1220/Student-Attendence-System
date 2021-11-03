<?php
	session_start();
	require 'connection.php';
	$userDetails = $user->getUserById($_SESSION['userId']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile of <?php echo $userDetails['fullname'] ?></title>
</head>
<body>
	<img src="<?php echo $userDetails['image']; ?>"><br>
	Name: <?php echo $userDetails['fullname'] ?>
	<br>
	Email: <?php echo $userDetails['email'] ?>
	<br>
	Age: <?php echo $userDetails['age'] ?>
	<br>
	Registered On: <?php echo $userDetails['created']; ?>
	<br>
	<a href="edit_profile.php">Edit</a>
	<a href="upload_image.php">Upload your photo</a>
</body>
</html>