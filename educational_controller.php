<!DOCTYPE html>

<html>
<head>
<link href="/style.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Τίτλος  -->
	<title>Φοίτηση</title>
</head>
<body>

<?php 
require 'connect_DB.php';
include "header.php"; 
include "menu.php"; 

if ($_SESSION['role'] != 'Διδακτικό Προσωπικό') {
header("Location:login.php?error=1");
}

# Αποθήκευση του μοναδικού κωδικού χρήστη σε μεταβλητή
$id = $_SESSION['id'];
?>

<br/><br/>

<h3 style= "text-align: center; color:#315597;">Στοιχεία Καθηγητή</h3>

	<table width= "96%" border= "1px solid black"  class= "table-info " >

	<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->	
			<tr><th>Ονομα</th>
            <th>Επώνυμο</th>
            <th>Ηλεκτρονική Διευθυνση</th>
            <th>Κωδικός</th>
            <th>Τηλέφωνο Επικοινωνίας</th>
			<th>Διευθυνση</th>
			<th>Αριθμός Μητρώου</th>
			<th>Ημερομηνία Εγγραφής</th>
			<th>Επεξεργασία</th>
			</tr>
			
		<!-- Ερώτημα για αναζήτηση του καθηγητή στη βάση και  εμφάνιση στοιχείων σε κελιά του πίνακα   -->
		<?php
		$results = mysqli_query($con, "SELECT * FROM users WHERE  user_id = $id");
		$row = mysqli_fetch_assoc($results);?>
		
	        <tr>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['last_name'];?></td>
                <td><?php echo $row['email'];?></td>
				<td contenteditable='true'><?php echo $row['password'];?></td>
                <td contenteditable='true'><?php echo $row['mobile'];?></td>
                <td contenteditable='true'><?php echo $row['address'];?></td>
                <td><?php echo $row['registry'];?></td>
                <td><?php echo $row['registration_date'];?></td>	
				<td><button id="id" value="<?php echo $id;?>" type="button" onclick="action(this);" >Επιβεβαίωση Αλλαγών</button>		
            </tr>		
	</table>
	
	<br/><br/>

		<!-- Ερώτημα για αναζήτηση των μαθημάτων που διδάσκει ο καθηγητής και εμφάνιση στοιχείων σε κελιά του πίνακα   -->
			<?php
		$result = mysqli_query($con, "SELECT * FROM courses JOIN users ON courses.user_tc = users.user_id WHERE user_tc = $id");
		while($rows = mysqli_fetch_array($result)):;
		$course_id = $rows['course_id'];?>
		
			<h3 style= "text-align: center; color:#315597;">Μάθημα "<?php echo $rows['title'];?>" </h3>
			<h3 style= "color:#315597; padding: 20px;">Εγγεγραμμένοι Φοιτητές</h3>

		<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->	
			<table width= "96%" border= "1px solid black"  class= "table-info " >
			<tr><th>Αναγνωριστικό</th>
			<th>Ονομα</th>
            <th>Επώνυμο</th>
            <th>Ηλεκτρονική Διευθυνση</th>
            <th>Τηλέφωνο Επικοινωνίας</th>
			<th>Αριθμός Μητρώου</th>
			<th>Βαθμός</th>
			<th>Κατάσταση</th>
			<th>Επεξεργασία</th>
			</tr>
		<!-- Ερώτημα για αναζήτηση των φοιτητών που είναι εγγεγραμμένοι και δεν έχουν ολοκληρώσει το συγκεκριμένο μάθημα και εμφάνιση στοιχείων σε κελιά του πίνακα   -->
	<?php 
		$results = mysqli_query($con, "SELECT * FROM enrollment JOIN users ON enrollment.user_fk = users.user_id WHERE enrollment.course_fk = $course_id AND enrollment.status LIKE '%Σε Εξέλιξη%'");
		if(($results)):
		while($row = mysqli_fetch_array($results)):;?>
	        <tr>
                <td><?php echo $row['user_id'];?></td>	
                <td><?php echo $row['name'];?></td>			
                <td><?php echo $row['last_name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['mobile'];?></td>
				<td><?php echo $row['registry'];?></td>
                <td contenteditable='true'><?php echo $row['grade'];?></td>
				<td><select id="status">
				  <option value="Σε Εξέλιξη">Σε Εξέλιξη</option>
				  <option value="Ολοκληρωμένο">Ολοκληρωμένο</option>
				</select></td> 
				<td><button id="course_id" value="<?php echo $course_id;?>" type="button" onclick="action(this);" >Εισαγωγή Βαθμού</button>		
            </tr>	
			
	<?php endwhile;?>
	<?php endif; ?>	
	</table>
	<?php endwhile;?>
	
<br/><br/><br/>			
			
<?php 
include "footer.php"; 

?>

<!-- Η συνάρτηση αποστέλλει πληροφορίες στη updateDB.php για την εκτέλεση των ερωτημάτων για τις αλλαγές στη βάση δεδομένων. 
Η ενέργεια που εκτελείται ορίζεται από το περιεχόμενο του κουμπιού που πατήθηκε. Τα στοιχεία συλλέγονται από τη γραμμή του πίνακα στην οποία βρίσκεται το κουμπί  -->	
<script>

	function action(button){
	 var row = button.parentNode.parentNode; 


	if (button.innerHTML === "Επιβεβαίωση Αλλαγών") {
		
		if (((row.cells.item(3).innerHTML).length  > 7)) {
		location.href = "updateDB.php?id=" + document.getElementById("id").value
		+ "&password=" + row.cells.item(3).innerHTML 
		+ "&mobile=" + row.cells.item(4).innerHTML 
		+ "&address=" + row.cells.item(5).innerHTML  
		+ "&action=" + button.innerHTML;
		} else {
		alert("Ο κωδικός θα πρέπει να αποτελείται από τουλάχιστον 8 χαρακτήρες");	
		}
		
	}
	
	if (button.innerHTML === "Εισαγωγή Βαθμού") {
		if (row.cells.item(6).innerHTML >= 0 && row.cells.item(6).innerHTML <= 10 && (parseInt(row.cells.item(6).innerHTML , 10))) {
			
		var status = document.getElementById("status").value;
		location.href = "updateDB.php?id=" + row.cells.item(0).innerHTML 
		+ "&course_id=" + document.getElementById("course_id").value
		+ "&grade=" + row.cells.item(6).innerHTML 
		+ "&status=" + status
		+ "&action=" + button.innerHTML;
		} else {
		alert("Ο βαθμός θα πρέπει να είναι μεταξύ 0 και 10");	
		}
	}
	}
</script>



</body>

</html>