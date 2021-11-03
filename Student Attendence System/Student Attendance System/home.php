<?php
  require 'session_required.php';
  require 'connection.php';
  $userDetails = $user->getUserById($_SESSION['userId']);
  $sessions = $user->getSessions();
  $courses = $user->getCourses();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/datepicker.css" />
	<link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <style type="text/css">
    .warn
    {
      display: none;
    }
  </style>
</head>
<body>
  <div class="jumbotron-small text-center" style="margin-bottom:0;padding:1px; background-color:#eaedeb">
  <h1>Student Attendance System</h1>
</div>
  <nav>
	<!-- <nav class="navbar navbar-expand-sm bg-dark navbar-dark"> -->
  <!-- <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
    	 <li class="nav-item">
        <a class="navbar-brand" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="navbar-brand" href="attendance.php">Attendance</a>
      </li>

      <li class="nav-item">
        <a class="navbar-brand" href="profile.php">Report</a>
      </li>
      <li class="nav-item">
        <a class="navbar-brand" href="logout.php">Logout</a>
      </li>
    </ul>
  </div>   -->

  <div class="w3-bar w3-black">
  <a href="home.php" class="w3-bar-item w3-button w3-mobile navbar-dark">Home</a>
  <a href="attendance.php" class="w3-bar-item w3-button w3-mobile">Attendance</a>
  <a href="report.php" class="w3-bar-item w3-button w3-mobile">Report</a>
  <a href="logout.php" class="w3-bar-item w3-button w3-mobile">Logout</a>
</div>
</nav>

<div class="container ">
  <div class="alert alert-danger warn" id='output'>
    Please Enter the required fields
  </div>
<form method="GET" action="attendance.php" onsubmit="return validate()">
<div class="form-group">
  <label for="CID">Course ID</label>
  <select class="form-control" id="CID" name="cid[]">
    <option value="none">Select One</option>
    <?php
    foreach ($courses as $singleCourse) {?>
      <option value="<?php echo $singleCourse['course_id'] ?>"><?php echo $singleCourse['course_id'] ?></option>
    <?php }
    ?>
  </select>
</div>

	<div class="form-group">
  		<label for="session">Session</label>
  		<select class="form-control" id="session" name="session[]">
        <option value="none">Select One</option>
		    <?php
        foreach ($sessions as $singleSession) {?>
          <option value="<?php echo $singleSession['session'] ?>"><?php echo $singleSession['session'] ?></option>
        <?php }
        ?>

  		</select>
	</div>

	<div class="form-group">
  		<label for="date">Date</label>
  		<input type="date" class="form-control" id="date" name="date" required>
	</div>
	<div>
		<input type="submit" name="submit" class="btn btn-info" value="GO">
	</div>
  </form>
</div>
<script type="text/javascript">
  function validate(){
    if(document.getElementById('CID').value == 'none'){
      document.getElementById('output').style.display = 'block';
      return false;
    }
    if(document.getElementById('session').value == 'none'){
      document.getElementById('output').style.display = 'block';
      return false;
    }
    if(document.getElementById('date').value == ''){
      document.getElementById('output').style.display = 'block';
      return false;
    }
    return true;
  }
</script>
</body>
</html>
