<?php

echo '<meta charset="UTF-8"/>';
require 'connect_DB.php';

	/*-- Ενέργεις των Υπαλλήλων Γραμματείας  --*/

	/*-- Ενημέρωση στοιχείων  --*/
	if ($_GET['action'] == "Ενημέρωση") {
	
	/*-- Ενημέρωση στοιχείων Προσωπικού Γραμματείας  --*/
	if ($_GET['role']  == "Γραμματεία") {
		$sql = "UPDATE users SET 
				name=  ' $_GET[name] ',last_name=  ' $_GET[lastName] ', email=  ' $_GET[email] ', password=  ' $_GET[password] ', mobile=  ' $_GET[mobile] ', address=  ' $_GET[address] ', registry=  ' $_GET[registry] '
				WHERE user_id = '$_GET[id]'";
	/*-- Ενημέρωση στοιχείων Καθηγητών και φοιτητών --*/
	} else {	
		$sql = "UPDATE users SET 
				name=  ' $_GET[name] ',last_name=  ' $_GET[lastName] ', email=  ' $_GET[email] '
				WHERE user_id = '$_GET[id]'";
	
	/*-- Ενημέρωση εξαμήνου Φοιτητών  --*/
	if ($_GET['role']  == "Φοιτητής")	{	
		$sql_sem = "UPDATE semester SET 
				semester_id=  ' $_GET[semester] ',semester=  ' $_GET[semester] '
				WHERE user_fk = '$_GET[id]'";
		 mysqli_query($con, $sql_sem);
	}
	}
		/*-- Εκτέλεση ερωτήματος όπως έχει οριστεί --*/
	 mysqli_query($con, $sql);
	 echo '<script type="text/javascript">alert("Νέα Στοιχεία: '.$_GET['id'].','.$_GET['role'].','.$_GET['name'].','.$_GET['lastName'].','.$_GET['email'].','.$_GET['password'].','.$_GET['mobile'].','.$_GET['address'].','.$_GET['registry'].'"); window.history.go(-1)</script>';
	
}
	/*-- Εισαγωγή Νέου Χρήστη  --*/
if ($_GET['action'] == "Εισαγωγή") {
	
$name = $_GET['name'];
$lastName = $_GET['lastName'];
$email = $_GET['email'];
$password = $_GET['password'];
$role = $_GET['role'];
$registry = $_GET['registry'];

		
		$sql = "INSERT INTO users ( name, last_name, role, email, password, registration_date, registry) 
				VALUES ('$name', '$lastName', '$role', '$email', '$password', DATE(NOW()), '$registry')" ;		 					
		mysqli_query($con, $sql);
		
			if (isset($_GET['semester'])) {
			$semester = $_GET['semester'];	
			$temp = $con->insert_id;
			$sql_sem = "INSERT INTO semester ( semester_id, semester, user_fk) 
			VALUES ('$semester', '$semester', $temp)" ;
			mysqli_query($con, $sql_sem);	
		}

		echo '<script type="text/javascript">alert("Νέος Χρήστης: '.$_GET['role'].','.$_GET['name'].','.$_GET['lastName'].','.$_GET['email'].','.$_GET['password'].','.$_GET['registry'].'"); window.history.go(-1)</script>';
	}

	/*-- Εισαγωγή Νέου Μαθήματος  --*/

	if ($_GET['action'] == "Νέο Μάθημα") {
		
$title = $_GET['title'];
$type = $_GET['type'];
$description = $_GET['description'];
$semester = $_GET['semester'];
$ecp = $_GET['ecp'];
$user_tc = $_GET['teacher_id'];
		
		
		$results = mysqli_query($con, "SELECT course_id FROM courses ORDER BY course_id DESC LIMIT 1");
		$row = (mysqli_fetch_assoc($results));
		$id =  $row['course_id']+1;
		
		$sql = "INSERT INTO courses (course_id, title, type, description, semester, ecp, user_tc) 
		VALUES ('$id', '$title', '$type', '$description', '$semester', $ecp, '$user_tc')" ;		 					
		mysqli_query($con, $sql);
		echo '<script type="text/javascript">alert("Νέο Μάθημα: '.$_GET['title'].','.$_GET['type'].','.$_GET['description'].','.$_GET['semester'].','.$_GET['ecp'].','.$_GET['teacher_id'].'"); window.history.go(-1)</script>';
	}
	
	/*-- Τροποποίηση Μαθήματος  --*/
	if ($_GET['action'] == "Διαμόρφωση") {
		$sql = "UPDATE courses SET 
				title=  ' $_GET[title] ', description=  ' $_GET[description] ', ecp=  ' $_GET[ecp] '
				WHERE course_id = '$_GET[id]'";		 					
		mysqli_query($con, $sql);
		echo '<script type="text/javascript">alert("Νέα στοιχεία μαθήματος: '.$_GET['id'].','.$_GET['title'].','.$_GET['type'].','.$_GET['description'].','.$_GET['semester'].','.$_GET['ecp'].','.$_GET['teacher_id'].'"); window.history.go(-1)</script>';
	}
	
	/*-- Διαγραφή Μαθήματος  --*/
	if ($_GET['action'] == "Διαγραφή") {
		$sql = "DELETE FROM courses WHERE course_id = '$_GET[id]'";
		mysqli_query($con, $sql);
		echo '<script type="text/javascript">alert("Διαγραφή μαθήματος επιτυχής"); window.history.go(-1)</script>';
	}
	
	/*-- Τέλος ενεργειών Υπαλλήλων Γραμματείας  --*/
	
	
	
	/*--Ενέργεις των  Φοιτητών --*/
	
	/*-- Τροποποίηση Στοιχείων Φοιτητή  --*/
	if ($_GET['action'] == "Αλλαγή Στοιχείων") {
		$sql = "UPDATE users SET mobile=  ' $_GET[mobile] ', address=  ' $_GET[address] ', password=  ' $_GET[password] '  WHERE user_id = '$_GET[id]'";		 					
		mysqli_query($con, $sql);
		echo '<script type="text/javascript">alert("Αλλαγή στοιχείων επιτυχής."); window.history.go(-1)</script>';
	}

	/*-- Απεγγραφή από μάθημα  --*/
	if ($_GET['action'] == "Απεγγραφή") {
		$sql = "DELETE FROM enrollment WHERE enrollment_id = '$_GET[id]'";
		mysqli_query($con, $sql);
		echo '<script type="text/javascript">alert("Διαγραφή από το μάθημα επιτυχής"); window.history.go(-1)</script>';
	}
	
	/*-- Εγγραφή σε μάθημα  --*/
	if ($_GET['action'] == "Εγγραφή") {
		
$id = $_GET['id'];
$course_id = $_GET['course_id'];
$status = "Σε Εξέλιξη";

		 $sql = "INSERT INTO enrollment (status,  user_fk, course_fk) 
				VALUES ('$status', '$id', '$course_id')" ;
		mysqli_query($con, $sql);
		 echo '<script type="text/javascript">alert("Εγγραφή στο μάθημα επιτυχής"); window.history.go(-1)</script>';
	}

	/*-- Τέλος ενεργειών Φοιτητών   --*/


	
	/*--Ενέργεις των Καθηγητών --*/
	
	/*-- Τροποποίηση Στοιχείων Καθηγητή  --*/
	if ($_GET['action'] == "Επιβεβαίωση Αλλαγών") {
		$sql = "UPDATE users SET mobile=  ' $_GET[mobile] ', address=  ' $_GET[address] ', password=  ' $_GET[password] '  WHERE user_id = '$_GET[id]'";		 					
		mysqli_query($con, $sql);
		echo '<script type="text/javascript">alert("Αλλαγή στοιχείων επιτυχής."); window.history.go(-1)</script>';
	}

	/*-- Εισαγωγή - Αλλαγή Βαθμού    --*/
	if ($_GET['action'] == "Εισαγωγή Βαθμού") {
		
		$sql = "UPDATE enrollment SET grade= ' $_GET[grade] ', status= ' $_GET[status] ' WHERE user_fk = '$_GET[id]' AND course_fk = '$_GET[course_id]'";		 					
		mysqli_query($con, $sql);
		echo '<script type="text/javascript">alert("Αλλαγή στοιχείων επιτυχής."); window.history.go(-1)</script>';
	}

	/*-- Τέλος ενεργειών Καθηγητών   --*/
?>