<?php
  require 'session_required.php';
  require 'connection.php';
  if(!isset($_GET['submit'])){
    header('location:home.php');
  }
  if(isset($_GET['submit'])){
    $check = 0;
    $session = $_GET['session'][0];
    $students = $user->getStudentsBySession($session);
    $date = $_GET['date'];
    $courseId = $_GET['cid'][0];
    if($user->isExistAttendanceByCourseAndDate($courseId,$date)){
      $attendanceDetails = $user->getAttendanceByCourseAndDate($courseId,$date);
      $check = 1;
    }
  }
  if(isset($_POST['attendanceSubmit'])){
    #die('died'.'<pre>'.print_r($courseId, true));
    foreach ($_POST as $key => $value) {
      if($key != 'attendanceSubmit'){
        $user->addAttendance($courseId,$key,$_SESSION['userId'],$date,$value);
      }
    }
    $_SESSION['message'] = 'Attendance taken successfully';
    header("Refresh:0");
  }
  if(isset($_POST['attendanceUpdate']))
  {
    foreach ($_POST as $key => $value) {
      $user->updateAttendance($value,$key);
      $_SESSION['message'] = 'Attendance updated successfully';
      header("Refresh:0");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Attendance System in PHP using Ajax</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap4.min.js"></script>
</head>
<body>

<div class="jumbotron-small text-center" style="margin-bottom:0">
  <h1>Student Attendance System</h1>
</div>

<nav>
  <div class="w3-bar w3-black">
  <a href="home.php" class="w3-bar-item w3-button w3-mobile">Home</a>
  <a href="attendance.php" class="w3-bar-item w3-button w3-mobile">Attendance</a>
  <a href="report.php" class="w3-bar-item w3-button w3-mobile">Report</a>
  <a href="logout.php" class="w3-bar-item w3-button w3-mobile">Logout</a>
</div>
</nav>

<div class="container" style="margin-top:30px">
  <div class="card">
  	<div class="card-header">
      <div class="row">
        <div class="col-md-9">Attendance List</div>
        <?php
        if(!empty($_SESSION['message'])){?>
            <h3 class="alert alert-success text-center"><?php echo $_SESSION['message']?></h3>
        <?php }
        unset($_SESSION['message']);
        ?>
        <!-- <div class="col-md-3" align="right">
          <button type="button" id="report_button" class="btn btn-danger btn-sm">Report</button>
          <button type="button" id="add_button" class="btn btn-info btn-sm">Add</button>
        </div> -->
      </div>
    </div>
  	<div class="card-body">
  		<div class="table-responsive">
        <span id="message_operation"></span>
          <?php if($check == 0){ ?>
            <table class="table table-striped table-bordered" id="attendance_table">
            <thead>
              <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Attendance Status</th>
              </tr>
            </thead>
            <tbody>
              <form method="POST">
                <?php
                  foreach ($students as $singleStudent) {?>
                    <tr>
                      <td><?php echo $singleStudent['student_id']; ?></td>
                      <td><?php echo $singleStudent['student_name']; ?></td>
                      <td>
                        <input type="radio" name="<?php echo $singleStudent['student_id']; ?>" value="Present" required checked> <span style="color: green">Present</span>
                        <input type="radio" name="<?php echo $singleStudent['student_id']; ?>" value="Absent"> <span style="color: red">Absent</span>
                      </td>
                    </tr>
                  <?php }
                ?>
            </tbody>
          </table>
          <input type="submit" name="attendanceSubmit" class="btn btn-success" value="Submit" style="float: right">
                </form>
          <?php } ?>
          <?php if($check == 1){ ?>
            <h3 class="text-center">Course: <?php echo $courseId; ?> | Session: <?php echo $session; ?> | Date: <?php echo $date; ?> </h3>
            <table class="table table-striped table-bordered" id="attendance_table">
            <thead>
              <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Attendance Status</th>
              </tr>
            </thead>
            <tbody>
              <form method="POST">
                <?php
                  foreach ($attendanceDetails as $singleAttendance) {
                    $singleStudent = $user->getStudentByStudentId($singleAttendance['studentId']);
                    if($singleStudent['session'] != $session){
                      continue;
                    }
                    ?>
                    <tr>
                      <td><?php echo $singleStudent['student_id']; ?></td>
                      <td><?php echo $singleStudent['student_name']; ?></td>
                      <td>
                        <input type="radio" name="<?php echo $singleAttendance['attendanceId']; ?>" value="Present" required <?php if($singleAttendance['status'] == 'Present'){ echo 'checked';} ?>> <span style="color: green">Present</span>
                        <input type="radio" name="<?php echo $singleAttendance['attendanceId']; ?>" value="Absent" <?php if($singleAttendance['status'] == 'Absent'){ echo 'checked';} ?>> <span style="color: red">Absent</span>
                      </td>
                    </tr>
                  <?php }
                ?>
            </tbody>
          </table>
          <input type="submit" name="attendanceUpdate" class="btn btn-success" value="Update Attendance" style="float: right">
                </form>
          <?php } ?>
  		</div>
  	</div>
  </div>
</div>

</body>
</html>


