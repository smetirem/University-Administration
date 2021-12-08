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

if ($_SESSION['role'] != 'Φοιτητής') {
header("Location:login.php?error=1");
}
# Αποθήκευση του μοναδικού κωδικού χρήστη σε μεταβλητή
$id = $_SESSION['id'];
?>

<br/><br/>

<h3 style= "text-align: center; color:#315597;">Στοιχεία Φοιτητή</h3>

	<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
	<table width= "96%" border= "1px solid black"  class= "table-info " >
					
			<tr><th>Ονομα</th>
            <th>Επώνυμο</th>
            <th>Ηλεκτρονική Διευθυνση</th>
            <th>Κωδικός</th>
            <th>Τηλέφωνο Επικοινωνίας</th>
			<th>Διευθυνση</th>
			<th>Αριθμός Μητρώου</th>
			<th>Ημερομηνία Εγγραφής</th>
			<th>Εξάμηνο</th>
			<th>Επεξεργασία</th>
			</tr>
			
		<!-- Ερώτημα για αναζήτηση του φοιτητή στη βάση και εμφάνιση στοιχείων σε κελιά του πίνακα   -->
		<?php
		$results = mysqli_query($con, "SELECT * FROM users JOIN semester ON users.user_id = semester.user_fk WHERE  user_id = $id");
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
                <td><?php echo $row['semester'];?></td>			
				<td><button id="id" value="<?php echo $id;?>" type="button" onclick="action(this);" >Αλλαγή Στοιχείων</button>		
            </tr>		
	</table>
	
	
	<br/><br/>
	
	<h3 style= "text-align: center; color:#315597;">Μαθήματα ολοκληρωμένα και σε εξέλιξη</h3>

	<table id="info" width= "96%" border= "1px solid black"  class= "table-info">	
	
	<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
			<tr>
			<th>Κωδικός Εγγραφής</th>
			<th>Τίτλος</th>
            <th>Τύπος</th>
            <th>Εξάμηνο</th>
			<th>Μονάδες ECP</th>
			<th>Διδάσκων</th>
			<th>Κατάσταση</th>
			<th>Βαθμός</th>
			<th>Επεξεργασία</th>
			</tr>
			
		<!-- Ερώτημα για αναζήτηση των μαθημάτων στα οποία είναι εγγεγραμμένος ο φοιτητής  και εμφάνιση στοιχείων σε κελιά του πίνακα   -->
		<?php
		$results = mysqli_query($con, "SELECT * FROM enrollment JOIN courses ON enrollment.course_fk = courses.course_id WHERE user_fk = $id");
		while($row = mysqli_fetch_array($results)):;?>
		
	        <tr>
				<td><?php echo $row['enrollment_id'];?></td>
                <td><?php echo $row['title'];?></td>			
                <td><?php echo $row['type'];?></td>
                <td><?php echo $row['semester'];?></td>
                <td><?php echo $row['ecp'];?></td>
				<td><?php echo $row['user_tc'];?></td>
				<td><?php echo $row['status'];?></td>
                <td><?php echo $row['grade'];?></td>
				<td><button type="button" onclick="action(this);" >Απεγγραφή</button>		
            </tr>			
	<?php endwhile;?>
</table>
			

	<br/><br/>
	
	<h3 style= "text-align: center; color:#315597;">Μαθήματα στα οποία μπορείτε να εγγραφείτε</h3>

	<table id="info" width= "96%" border= "1px solid black"  class= "table-info">	

		<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
			<tr>
			<th>Κωδικός Μαθήματος</th>
			<th>Τίτλος</th>
            <th>Τύπος</th>
            <th>Εξάμηνο</th>
			<th>Μονάδες ECP</th>
			<th>Περιγραφή</th>	
			<th>Επεξεργασία</th>
			</tr>

		<!-- Ερώτημα για αναζήτηση των μαθημάτων στα οποία δεν είναι εγγεγραμμένος ο φοιτητής  και εμφάνιση στοιχείων σε κελιά του πίνακα   -->	
		<?php
		$results = mysqli_query($con, "SELECT * FROM courses 
										LEFT JOIN enrollment ON course_id = enrollment.course_fk AND enrollment.user_fk = $id
										WHERE user_fk IS NULL 
										");
		while($row = mysqli_fetch_array($results)):;?>
		
	        <tr>
				<td><?php echo $row['course_id'];?></td>
                <td><?php echo $row['title'];?></td>			
                <td><?php echo $row['type'];?></td>
                <td><?php echo $row['semester'];?></td>
                <td><?php echo $row['ecp'];?></td>
				<td><?php echo $row['description'];?></td>
				<td><button id="idenr" value="<?php echo $id;?>" type="button" onclick="action(this);" >Εγγραφή</button>		
            </tr>			
	<?php endwhile;?>
</table>
			
			
				<br/><br/>
	
	<h3 style= "text-align: center; color:#315597;">Στατιστικά Προόδου</h3>

	<table id="info" width= "96%" border= "1px solid black"  class= "table-info">	
		<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
			<tr>
			<th>Μάθημα</th>
			<th>Βαθμός</th>
            <th>Τύπος</th>
			<th>Μονάδες ECP</th>
			</tr>

		<!-- Ερώτημα για αναζήτηση των μαθημάτων τα οποία έχει ολοκληρ΄ψσει ο φοιτητής  και εμφάνιση συγκεντρωτικών στοιχείων   -->	
	<?php
		$results = mysqli_query($con, "SELECT * FROM enrollment JOIN courses ON enrollment.course_fk = courses.course_id WHERE user_fk = $id AND enrollment.status = 'Ολοκληρωμένο'");
		while($row = mysqli_fetch_array($results)):;?>
		
	        <tr>
				<td><?php echo $row['title'];?></td>
                <td><?php echo $row['grade'];?></td>			
                <td><?php echo $row['type'];?></td>
                <td><?php echo $row['ecp'];?></td>	
            </tr>			
	<?php endwhile;?>
	
			<tr><th>Μέσος Όρος Βαθμού</th><th></th><th></th><th></th></tr>
			<tr><th>Σύνολο Μονάδων ECP</th><th></th><th></th><th></th></tr>
	</table>
		<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
	
		<table id="info" width= "96%" border= "1px solid black"  class= "table-info">	
		<tr>
		<th>Μέσος Όρος Βαθμού</th>
		<th>Σύνολο Μονάδων ECP</th>
		</tr>
		
		<!-- Ερώτημα για αναζήτηση των μαθημάτων τα οποία έχει ολοκληρ΄ψσει ο φοιτητής  και εμφάνιση στατιστικών στοιχείων   -->	
	<?php
		$results1 = mysqli_query($con, "SELECT AVG(grade) AS value  FROM enrollment WHERE user_fk = $id AND status = 'Ολοκληρωμένο'");
		$row1 = mysqli_fetch_object($results1);
		$results2 = mysqli_query($con, "SELECT SUM(ecp) AS value FROM enrollment JOIN courses ON enrollment.course_fk = courses.course_id WHERE enrollment.user_fk = $id AND status = 'Ολοκληρωμένο'");
		$row2 = mysqli_fetch_object($results2);
		
		?>
		
	        <tr>
			<td><?php echo $row1->value;?></td>
			<td><?php echo $row2->value;?></td>
            </tr>			
		
		</table>
					
<br/><br/><br/>			
			
<?php 
include "footer.php"; 

?>
<!-- Η συνάρτηση αποστέλλει πληροφορίες στη updateDB.php για την εκτέλεση των ερωτημάτων για τις αλλαγές στη βάση δεδομένων. 
Η ενέργεια που εκτελείται ορίζεται από το περιεχόμενο του κουμπιού που πατήθηκε. Τα στοιχεία συλλέγονται από τη γραμμή του πίνακα στην οποία βρίσκεται το κουμπί  -->	
<script>

	function action(button){
	 var row = button.parentNode.parentNode; 


	if (button.innerHTML === "Αλλαγή Στοιχείων") {
		
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

	if (button.innerHTML === "Απεγγραφή") {
			
		if (row.cells.item(6).innerHTML.indexOf('Σε Εξέλιξη') >= 0) {
		location.href = "updateDB.php?id=" + row.cells.item(0).innerHTML 
		+ "&action=" + button.innerHTML;
		} else {
		alert("Δεν μπορείτε να απεγγραφείτε από μάθημα που έχετε ολοκληρώσει.");	
		}
	}
	
	if (button.innerHTML === "Εγγραφή") {
		location.href = "updateDB.php?id=" + document.getElementById("idenr").value
		 + "&course_id=" + row.cells.item(0).innerHTML 
		 + "&action=" + button.innerHTML;
		
	}
	}
</script>



</body>

</html>