<?php
	session_start();
	require 'connection.php';
	if(isset($_POST['submit'])){
		$allowed = array('jpg','jpeg','png');
		$fileExt = explode('.',$_FILES['file']['name']);
		if(in_array($fileExt[1], $allowed)){
			if($_FILES['file']['error'] == 0){
				if($_FILES['file']['size'] <= 100000){
					$directory = 'images/'.$_FILES['file']['name'];
					move_uploaded_file($_FILES['file']['tmp_name'], $directory);
					$user->uploadImage($directory,$_SESSION['userId']);
					header("location:profile.php");
					echo "Successfully Uploaded";
				}else{
					echo "This file is too large.";
				}
			}else{
				echo 'There is some problem in the image file';
			}
		}else{
			echo 'This type of file is not allowed';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload Image</title>
</head>
<body>
	<form method="POST" enctype="multipart/form-data">
		Choose Image : <input type="file" name="file">
		<input type="submit" name="submit" value="Upload">
	</form>
</body>
</html>