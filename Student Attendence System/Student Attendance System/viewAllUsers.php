<?php 
	require 'connection.php';
	$allUser = $user->getAllUser();
	#var_dump($allUser);
?>
<!DOCTYPE html>
<html>
<head>
	<title>All User</title>
</head>
<body>
	<table border="1">
		<tr>
			<td>Name</td>
			<td>Email</td>
			<td>Age</td>
			<td>Action</td>
		</tr>
		<?php 
		foreach ($allUser as $singleUser) {?>
			<tr>
				<td><?php echo $singleUser['fullname']; ?></td>
				<td><?php echo $singleUser['email']; ?></td>
				<td><?php echo $singleUser['age']; ?></td>
				<td><a href="remove_user.php?id=<?php echo $singleUser['id'] ?>">Remove User</a></td>
			</tr>
		<?php }
		?>
	</table>
</body>
</html>