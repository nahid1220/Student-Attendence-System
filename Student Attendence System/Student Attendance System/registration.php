<?php
require 'connection.php';
	if(isset($_POST['submit'])){
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$fullname = trim($_POST['fullname']);
		$age = trim($_POST['age']);
		$created = date('Y-m-d H:i:s');
		if($user->isExistUserByEmail($email)){
			echo "Already there is a user with this email";
		}
		else{
			$user->addUser($email,$password,$fullname,$age,$created);

		   echo "Successfully Registered";
       header('location:login.php');
		
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



	<div class="container" style="width:100% ;height: 20px">
  <div class="row">
    <div class="col-md-4">

    </div>
    <div class="col-md-4" style="margin-top:20px">
      <div class="card" style="width:100% ">
        <div class="card-header" style="text-align: center">Registration Form </div>
        <div class="card-body">

	     <form method="POST" >

		    <div class="form-group">
              <label>Email Address</label>
              <input type="email" class="form-control" name="email" placeholder="Enter email address">
              <span id="error_teacher_emailid" class="text-danger"></span>
         </div>

         <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter password">
              <span id="error_teacher_emailid" class="text-danger"></span>
         </div>

         <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="fullname" placeholder="Enter your full name">
              <span id="error_teacher_emailid" class="text-danger"></span>
         </div>

          <div class="form-group">
              <label>Age</label>
              <input type="number" class="form-control" name="age" placeholder="Enter your age">
              <span id="error_teacher_emailid" class="text-danger"></span>
         </div>

         <div class="form-group">
              <input type="submit" name="submit" id="submit" class="btn btn-info" value="Register" />
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





	<!-- <script type="text/javascript" src="bootstrap-3/js/bootstrap.min.js"></script>
</body>
</html>



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
</html> -->