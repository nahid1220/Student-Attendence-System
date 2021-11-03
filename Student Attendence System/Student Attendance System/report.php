<?php
  require 'session_required.php';
  require 'connection.php';
  $userDetails = $user->getUserById($_SESSION['userId']);
  $sessions = $user->getSessions();
  $courses = $user->getCourses();
  $check = 0;
  if(isset($_POST['submit'])){
    $courseId = $_POST['cid'][0];
    $session = $_POST['session'][0];
    if($user->isExistAttendanceByCourse($courseId)){
      $attendanceDetails = $user->getAttendanceByCourse($courseId);
      $resultArr = array();
      $dateArr = array();
      $presentCountArr = array();
      $i = 0;
      foreach ($attendanceDetails as $singleAttendance) {
        $studentDetails = $user->getStudentByStudentId($singleAttendance['studentId']);
        if($studentDetails['session'] == $session){
          if(!in_array($singleAttendance['date'], $dateArr)){
            $dateArr[] = $singleAttendance['date'];
          }
          if(array_key_exists($singleAttendance['studentId'], $resultArr)){
            $resultArr[$singleAttendance['studentId']] .= $singleAttendance['date'].':'.$singleAttendance['status'].',';
          }else{
            $resultArr[$singleAttendance['studentId']] = $singleAttendance['date'].':'.$singleAttendance['status'].',';
          }
          if(array_key_exists($singleAttendance['studentId'], $presentCountArr)){
            if($singleAttendance['status'] == 'Present'){
              $presentCountArr[$singleAttendance['studentId']]['P']++;
            }else{
              $presentCountArr[$singleAttendance['studentId']]['A']++;
            }
          }else{
            $presentCountArr[$singleAttendance['studentId']] = array('P'=>0,'A'=>0);
            if($singleAttendance['status'] == 'Present'){
              $presentCountArr[$singleAttendance['studentId']]['P']++;
            }else{
              $presentCountArr[$singleAttendance['studentId']]['A']++;
            }
          }
        }
        $i++;
      }
     #die('died'.'<pre>'.print_r($presentCountArr,true));
      $check = 1;
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
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
      <form method="POST" action="" onsubmit="return validate()">
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

        <div>
          <input type="submit" name="submit" class="btn btn-info" value="GO">
        </div>
        </form><br>


</div>
<div class="container-fluid" style="width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;overflow-x: auto;">
    <?php
    if($check == 1){?>
      <h3 class="text-center"> Total Class: <?php echo count($dateArr); ?></h3>
      <table class="table table-striped table-bordered" id="attendance_table">
        <thead>
          <tr>
            <th class="text-center">Student ID</th>
            <th class="text-center">Student Name</th>
            <th class="text-center" style="background-color: #ccfce5">Attendance (%)</th>
            <?php foreach ($dateArr as $singleDate) {?>
              <th class="text-center"><?php echo $singleDate; ?> </th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
            <?php foreach ($resultArr as $key => $value) {
              $details = substr($value, 0,-1);
              $details = explode(',', $details);
             ?>
              <tr>
                <td class="text-center"><?php echo $key; ?></td>
                <td class="text-center"><?php echo $user->getStudentByStudentId($key)['student_name']; ?></td>
                <?php
                    $value = $presentCountArr[$key];
                    $total = $value['P']+$value['A'];
                    $total = $value['P']/$total;
                    $total = $total*100;?>
                    <td class="text-center" style="background-color: #ccfce5"><?php echo number_format((float)$total, 2, '.', ''); ?></td>
                  <?php
                ?>
                <?php foreach ($details as $singleDetails) {
                    $singleDetails = explode(':', $singleDetails);?>
                    <td class="text-center">
                      <?php if($singleDetails[1] == 'Present'){?>
                          <p style="color: green" class="text-center">&#10004</p>
                      <?php }else{?>
                        <p style="color: red" class="text-center">&#10006</p>
                          <!-- absent -->
                      <?php } ?>
                    </td>
                  <?php }
                 ?>


              </tr>
            <?php } ?>
        </tbody>
      </table>
      <?php } ?>
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
    return true;
  }
</script>
</body>
</html>
