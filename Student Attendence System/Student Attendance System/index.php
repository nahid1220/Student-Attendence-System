<?php
	session_start();
	require 'connection.php';
	if(isset($_POST['submit'])){
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		if($user->isExistUserByEmailAndPassword($email,$password)){
			$userDetails = $user->getUserByEmailAndPassword($email,$password);
			$_SESSION['userId'] = $userDetails['id'];
			header('location:home.php');
		}
		else{
		echo 'There is no such user';
	}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Attendance System in PHP using Ajax</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
 <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0" >
  <h1>Student Attendance System</h1>
</div>


<div class="container" style="width:100% ;height: 300px">
  <div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-4" style="margin-top:20px;">
      <div class="card">
        <div class="card-header">Teacher Login</div>
        <div class="card-body">
          <form method="post" >
            <div class="form-group">
              <label>Email Address</label>
              <input type="text" name="email" id="email" class="form-control" />
              <span id="error_teacher_emailid" class="text-danger"></span>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" id="password" class="form-control" />
              <span id="error_teacher_password" class="text-danger"></span>
            </div>
            <div class="form-group">
              <input type="submit" name="submit" id="submit" class="btn btn-info" value="Login" />
            </div> 
              <div class="form-group">
              <a href="registration.php" class="btn btn-info"> Registration </a>
          </div>
            


          </form>

          


        </div>
      </div>
    </div>
    <div class="col-md-4">



    </div>
  </div>
</div>

</body>
</html>







  <!-- <form method="POST">
    <label>Enter Your Email</label>
     <input type="email" name="email" placeholder="Enter email address"><br>

    Password: <input type="password" name="password" placeholder="Enter password"><br>

    <input type="submit" name="submit" value="Login">
  </form>
  <script type="text/javascript" src="bootstrap-3/js/bootstrap.min.js"></script>
</body>
</html>

</body>
</html>
 -->

