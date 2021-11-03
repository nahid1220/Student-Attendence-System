<?php
	/**
	 * All the functions goes here
	 */
	class User
	{
		public $db;
		function __construct($con)
		{
			if(!isset($this->db)){
				$this->db = $con;
			}
		}
		public function addUser($email,$password,$fullname,$age,$created){
			$st = $this->db->prepare("INSERT INTO user_table (email,password,fullname,age,created) VALUES(:email,:password,:fullname,:age,:created)");
			$st->bindParam(':email',$email);
			$st->bindParam(':password',$password);
			$st->bindParam(':fullname',$fullname);
			$st->bindParam(':age',$age);
			$st->bindParam(':created',$created);
			$st->execute();
			return true;
		}
		public function isExistUserByEmail($email){
			$st = $this->db->prepare("SELECT * FROM user_table WHERE email=:email");
			$st->bindParam(':email',$email);
			$st->execute();
			$resultSet = $st->fetch(PDO::FETCH_ASSOC);
			if($resultSet){
				return true;
			}
			return false;
		}
		public function getCourses(){
			$st = $this->db->prepare("SELECT * FROM course");
			$st->execute();
			$resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
			return $resultSet;
		}
		public function isExistAttendanceByCourseAndDate($courseId,$date){
			$st = $this->db->prepare("SELECT * FROM attendance WHERE courseId=:courseId AND date=:date");
			$st->bindParam(':courseId',$courseId);
			$st->bindParam(':date',$date);
			$st->execute();
			if($st->rowCount()){
				return true;
			}
			return false;
		}
		public function isExistAttendanceByCourse($courseId){
			$st = $this->db->prepare("SELECT * FROM attendance WHERE courseId=:courseId");
			$st->bindParam(':courseId',$courseId);
			$st->execute();
			if($st->rowCount()){
				return true;
			}
			return false;
		}

		public function getAttendanceByCourseAndDate($courseId,$date){
			$st = $this->db->prepare("SELECT * FROM attendance WHERE courseId=:courseId AND date=:date");
			$st->bindParam(':courseId',$courseId);
			$st->bindParam(':date',$date);
			$st->execute();
			$resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
			return $resultSet;
		}
		public function getAttendanceByCourse($courseId){
			$st = $this->db->prepare("SELECT * FROM attendance WHERE courseId=:courseId");
			$st->bindParam(':courseId',$courseId);
			$st->execute();
			$resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
			return $resultSet;
		}
		public function updateAttendance($status,$attendanceId){
			$st = $this->db->prepare("UPDATE attendance SET status=:status WHERE attendanceId=:attendanceId");
			$st->bindParam(':status',$status);
			$st->bindParam(':attendanceId',$attendanceId);
			$st->execute();
			return true;
		}
		public function getSessions(){
			$st = $this->db->prepare("SELECT DISTINCT session FROM student");
			$st->execute();
			$resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
			return $resultSet;
		}
		public function isExistUserByEmailAndPassword($email,$password){
			$st = $this->db->prepare("SELECT * FROM user_table WHERE email=:email AND password=:password");
			$st->bindParam(':email',$email);
			$st->bindParam(':password',$password);
			$st->execute();
			$resultSet = $st->fetch(PDO::FETCH_ASSOC);
			if($resultSet){
				return true;
			}
			return false;
		}
		public function getUserByEmailAndPassword($email,$password){
			$st = $this->db->prepare("SELECT * FROM user_table WHERE email=:email AND password=:password");
			$st->bindParam(':email',$email);
			$st->bindParam(':password',$password);
			$st->execute();
			$resultSet = $st->fetch(PDO::FETCH_ASSOC);
			return $resultSet;
		}
		public function getUserById($id){
			$st = $this->db->prepare("SELECT * FROM user_table WHERE id=:id");
			$st->bindParam(':id',$id);
			$st->execute();
			$resultSet = $st->fetch(PDO::FETCH_ASSOC);
			return $resultSet;
		}
		public function getAllUser(){
			$st = $this->db->prepare("SELECT * FROM user_table");
			$st->execute();
			$resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
			return $resultSet;
		}
		public function deleteUser($id){
			$st = $this->db->prepare("DELETE FROM user_table WHERE id=:id");
			$st->bindParam(':id',$id);
			$st->execute();
			return true;
		}
		public function updateProfileById($email,$password,$fullname,$age,$updated,$id){
			$st = $this->db->prepare("UPDATE user_table SET email=:email,password=:password,fullname=:fullname,age=:age,updated=:updated WHERE id=:id");
			$st->bindParam(':email',$email);
			$st->bindParam(':password',$password);
			$st->bindParam(':fullname',$fullname);
			$st->bindParam(':age',$age);
			$st->bindParam(':updated',$updated);
			$st->bindParam(':id',$id);
			$st->execute();
			return true;
		}
		public function uploadImage($image,$id){
			$st = $this->db->prepare("UPDATE user_table SET image=:image WHERE id=:id");
			$st->bindParam(':image',$image);
			$st->bindParam(':id',$id);
			$st->execute();
			return true;
		}
		public function getStudentsBySession($session){
			$st = $this->db->prepare("SELECT * FROM student WHERE session=:session");
			$st->bindParam(':session',$session);
			$st->execute();
			$resultSet = $st->fetchAll(PDO::FETCH_ASSOC);
			return $resultSet;
		}
		public function getStudentByStudentId($student_id){
			$st = $this->db->prepare("SELECT * FROM student WHERE student_id=:student_id");
			$st->bindParam(':student_id',$student_id);
			$st->execute();
			$resultSet = $st->fetch(PDO::FETCH_ASSOC);
			return $resultSet;
		}
		public function addAttendance($course_id,$student_id,$attendanceBy,$date,$status){
			$st = $this->db->prepare("INSERT INTO attendance(courseId,studentId,attendanceBy,date,status) VALUES(:courseId,:studentId,:attendanceBy,:date,:status)");
			$st->bindParam(':courseId',$course_id);
			$st->bindParam(':studentId',$student_id);
			$st->bindParam(':attendanceBy',$attendanceBy);
			$st->bindParam(':date',$date);
			$st->bindParam(':status',$status);
			$st->execute();
			return true;
		}
	}
?>