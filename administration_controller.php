<!DOCTYPE html>

<html>
<head>
<link href="/style.css" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Τίτλος  -->
	<title>Γραμματειακή Διαχείρηση</title>
</head>
<body>


<?php 

include "header.php"; 
include "menu.php"; 

if ($_SESSION['role'] != 'Γραμματεία') {
header("Location:login.php?error=1");
}
?>
<!-- Υπομενού της σελίδας των Υπαλλήλων Γραμματείας -->	
	<table class= "sub-menu">
		<td ><a class="this" href="./administration_controller.php?print=1">Διδάσκοντες</a></td>
        <td ><a class="this" href="./administration_controller.php?print=2">Φοιτητές</a></td>
        <td ><a class="this" href="./administration_controller.php?print=3">Γραμματεία</a></td>
		<td ><a class="this" href="./administration_controller.php?print=4">Μαθήματα</a></td>
		<td ><a class="this" href="./administration_controller.php?print=5">Στατιστικά</a></td>
		<td ><a class="this" href="./administration_controller.php?print=6">Εξαγωγή</a></td>
	</table>

</br></br>


<?php if(isset($_GET['print'])):?>

<!-- Επεξεργασία Στοιχείων Καθηγητών -->	
	<table id="info" width= "96%" border= "1px solid black"  class= "table-info">
	<?php if($_GET['print']==1):?>
			
		<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
		    <tr><th>Κωδικός</th>
			<th>Ονομα</th>
            <th>Επώνυμο</th>
            <th>Ηλεκτρονική Διευθυνση</th>
            <th>Ρόλος</th>
            <th>Κωδικός</th>
            <th>Τηλέφωνο Επικοινωνίας</th>
			<th>Διευθυνση</th>
			<th>Αριθμός Μητρώου</th>
			<th>Ημερομηνία Εγγραφής</th>
			<th>Επεξεργασία</th>
			</tr>
			<tr> 
		<!-- Κενή γραμμή για την εισαγωγή νέου καθηγητή -->			
			<td></td>   
			<td contenteditable='true'></td>
			<td contenteditable='true'></td>  
			<td contenteditable='true'></td>  
			<td>Διδακτικό Προσωπικό</td>  
			<td contenteditable='true'></td>  
			<td></td>  
			<td></td>
			<td contenteditable='true'></td>
			<td></td>
			<td><button type="button" onclick="action(this);" >Εισαγωγή </button></td>
			</tr>

		<!-- Ερώτημα για αναζήτηση των καθηγητών στη βάση και βρόγχος για την εμφάνιση τους σε κελιά του πίνακα   -->
		<?php
		$results = mysqli_query($con, "SELECT * FROM users WHERE role = 'Διδακτικό Προσωπικό'");
		while($row = mysqli_fetch_array($results)):;?>
		
	        <tr>
                <td><?php echo $row['user_id'];?></td>			
                <td contenteditable='true'><?php echo $row['name'];?></td>
                <td contenteditable='true'><?php echo $row['last_name'];?></td>
                <td contenteditable='true'><?php echo $row['email'];?></td>
				<td>Διδ. Προσωπικό</td>
				<td><?php echo $row['password'];?></td>
                <td><?php echo $row['mobile'];?></td>
                <td><?php echo $row['address'];?></td>
                <td><?php echo $row['registry'];?></td>
                <td><?php echo $row['registration_date'];?></td>
				<td><button type="button" onclick="action(this);" >Ενημέρωση</button>		
            </tr>			
	<?php endwhile;?>
	</table>

<?php endif; ?>

</br></br>

	<?php if($_GET['print']==2):?>

		<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
		    <tr><th>Κωδικός</th>
			<th>Ονομα</th>
            <th>Επώνυμο</th>
            <th>Ηλεκτρονική Διευθυνση</th>
            <th>Ρόλος</th>
            <th>Κωδικός</th>
            <th>Τηλέφωνο Επικοινωνίας</th>
			<th>Διευθυνση</th>
			<th>Αριθμός Μητρώου</th>
			<th>Εξάμηνο</th>
			<th>Ημερομηνία Εγγραφής</th>
			<th>Επεξεργασία</th>
			</tr>
			<tr> 
		<!-- Κενή γραμμή για την εισαγωγή νέου φοιτητή -->				
			<td></td>   
			<td contenteditable='true'></td>
			<td contenteditable='true'></td>  
			<td contenteditable='true'></td>  
			<td>Φοιτητής</td>  
			<td contenteditable='true'></td>  
			<td></td>  
			<td></td>
			<td contenteditable='true'></td>
			<td contenteditable='true'></td>
			<td></td>
			<td><button type="button" onclick="action(this);" >Εισαγωγή </button></td>
			</tr>

		<!-- Ερώτημα για αναζήτηση των φοιτητών στη βάση και βρόγχος για την εμφάνιση τους σε κελιά του πίνακα   -->
		<?php
		$results = mysqli_query($con, "SELECT * FROM users JOIN semester ON users.user_id = semester.user_fk WHERE role = 'Φοιτητής'");
		while($row = mysqli_fetch_array($results)):;?>
		
	        <tr>
                <td><?php echo $row['user_id'];?></td>			
                <td contenteditable='true'><?php echo $row['name'];?></td>
                <td contenteditable='true'><?php echo $row['last_name'];?></td>
                <td contenteditable='true'><?php echo $row['email'];?></td>
				<td><?php echo $row['role'];?></td>
				<td><?php echo $row['password'];?></td>
                <td><?php echo $row['mobile'];?></td>
                <td><?php echo $row['address'];?></td>
                <td><?php echo $row['registry'];?></td>
                <td contenteditable='true'><?php echo $row['semester'];?></td>
                <td><?php echo $row['registration_date'];?></td>
				<td><button type="button" onclick="action(this);" >Ενημέρωση</button>		
            </tr>			
	<?php endwhile;?>
	</table>

<?php endif; ?>

	<?php if($_GET['print']==3):?>

		<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
		    <tr><th>Κωδικός</th>
			<th>Ονομα</th>
            <th>Επώνυμο</th>
            <th>Ηλεκτρονική Διευθυνση</th>
            <th>Ρόλος</th>
            <th>Κωδικός</th>
            <th>Τηλέφωνο Επικοινωνίας</th>
			<th>Διευθυνση</th>
			<th>Αριθμός Μητρώου</th>
			<th>Ημερομηνία Εγγραφής</th>
			<th>Επεξεργασία</th>
			</tr>
			<tr>  
			<td></td>   
		<!-- Κενή γραμμή για την εισαγωγή νέου υπαλλήλου γραμματείας -->	
			<td contenteditable='true'></td>
			<td contenteditable='true'></td>  
			<td contenteditable='true'></td>  
			<td>Γραμματεία</td>  
			<td contenteditable='true'></td>  
			<td></td>  
			<td></td>
			<td contenteditable='true'></td>
			<td></td>
			<td><button type="button" onclick="action(this);" >Εισαγωγή </button></td>
			</tr>

		<!-- Ερώτημα για αναζήτηση των υπαλλήλων γραμματείας στη βάση και βρόγχος για την εμφάνιση τους σε κελιά του πίνακα   -->
	<?php
		$results = mysqli_query($con, "SELECT * FROM users WHERE role = 'Γραμματεία'");
		while($row = mysqli_fetch_array($results)):;?>
		
	        <tr>
                <td><?php echo $row['user_id'];?></td>			
                <td contenteditable='true'><?php echo $row['name'];?></td>
                <td contenteditable='true'><?php echo $row['last_name'];?></td>
                <td contenteditable='true'><?php echo $row['email'];?></td>
				<td><?php echo $row['role'];?></td>
				<td contenteditable='true'><?php echo $row['password'];?></td>
                <td contenteditable='true'><?php echo $row['mobile'];?></td>
                <td contenteditable='true'><?php echo $row['address'];?></td>
                <td contenteditable='true'><?php echo $row['registry'];?></td>
                <td><?php echo $row['registration_date'];?></td> 
				<td><button type="button" onclick="action(this);" >Ενημέρωση</button>		
            </tr>			
	<?php endwhile;?>
	</table>

<?php endif; ?>

	<?php if($_GET['print']==4):?>
	
	<?php 	$res = mysqli_query($con, "SELECT * FROM users WHERE role = 'Διδακτικό Προσωπικό'");?>

		<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
			<tr><th>Κωδικός Μαθήματος</th>
			<th>Τίτλος</th>
            <th>Τύπος</th>
            <th>Περιγραφή</th>
            <th>Εξάμηνο</th>
			<th>Μονάδες ECP</th>
			<th>Διδάσκων</th>
			<th>Επεξεργασία</th>
			</tr>
			<tr> 
		<!-- Κενή γραμμή για την εισαγωγή νέου μαθημάτων  -->				
			<td></td>   
			<td contenteditable='true'></td>
			<td><select id="type">
			  <option value="Επιλογής">Επιλογής</option>
			  <option value="Υποχρεωτικό">Υποχρεωτικό</option>
			</select></td>  
			<td contenteditable='true'></td>  
			<td><select id="semester">
			  <option value="1">1</option>
			  <option value="2">2</option>
			  <option value="3">3</option>
			  <option value="4">4</option>
			</select></td> 
			<td contenteditable='true'></td>
			<td><select id="teacher_id">
			<?php while($row = mysqli_fetch_assoc($res)):;?>			
			 <option value="<?php  echo  $row["user_id"]; ?>"><?php echo $row['user_id'];?></option>
			<?php endwhile;?>
			</select></td> 
			<td><button type="button" onclick="action(this);" >Νέο Μάθημα</button></td>
			</tr>
			
		<!-- Ερώτημα για αναζήτηση των μαθημάτων στη βάση και βρόγχος για την εμφάνιση τους σε κελιά του πίνακα   -->
	<?php
		$results = mysqli_query($con, "SELECT * FROM courses");
		while($row = mysqli_fetch_array($results)):;?>
		
	        <tr>
                <td><?php echo $row['course_id'];?></td>			
                <td contenteditable='true'><?php echo $row['title'];?></td>
                <td><?php echo $row['type'];?></td>
                <td contenteditable='true'><?php echo $row['description'];?></td>
                <td><?php echo $row['semester'];?></td>
                <td contenteditable='true'><?php echo $row['ecp'];?></td>
                <td><?php echo $row['user_tc'];?></td>
				<td><button type="button" onclick="action(this);" >Διαμόρφωση</button>
				</br><button type="button" onclick="action(this);" >Διαγραφή</button></td>
            </tr>			
	<?php endwhile;?>
	</table>

<?php endif; ?>


		<!-- Εμφάνιση προ'οδου φοιτητών -->	
<?php if($_GET['print']==5):?>


		<!-- Ερώτημα για αναζήτηση των εξαμήνων και βρόγχος για την εμφάνιση  στο πίνακα   -->
	<?php
		$results = mysqli_query($con, "SELECT semester FROM semester GROUP BY semester ORDER BY semester_id ASC");
		while($row = mysqli_fetch_array($results)):;
		$sem_id = $row['semester'];?>

		<!-- Ερώτημα για αναζήτηση των φοιτητών ανά εξάμηνο και βρόγχος για την αλαφαβητική εμφάνιση  στο πίνακα   -->
	        <tr>
                <td style = "font-size: 25px; border: 0px;">Εξάμηνο <?php echo $sem_id;?></td>
					<?php $result = mysqli_query($con, "SELECT * FROM semester JOIN users ON semester.user_fk = users.user_id WHERE semester = $sem_id ORDER BY users.last_name ASC");
					 while($rows = mysqli_fetch_array($result)):;?>
					 <tr>
					 <td id = "<?php echo $rows['user_id']?>" onclick = "action(this)" style = "cursor: pointer; border: 0px;"><?php echo $rows['last_name']?> <?php echo $rows['name'];?>
					 </td>	
					 </tr>	
					 <tr><td style = "border: 0px;"></tr></td>
					<?php endwhile;?>
					
		<?php endwhile;?>
		</table>
<?php endif; ?>


</br></br>

<!-- Επιλογή για την εξαγωγή δεδομένων -->	
	<?php if($_GET['print']==6):?>
		
		<div align= "center" style= "font-size: 120%;  color: #315597;">
		<h3>Επιλογή Εξαμήνου για εξαγωγή Δεδομένων</h3>

		  
		<!-- Ανακατεύθυνση στη σελίδα fetchData.php με τα στοιχεία που έχει εισάγει ο χρήστης -->	

		  <?php
		  $results = mysqli_query($con, "SELECT semester FROM semester GROUP BY semester_id ORDER BY semester_id ASC");
		  ?>
		  <select id="semester">
			<?php while($row = mysqli_fetch_assoc($results)):;?>			
			 <option value="<?php  echo  $row["semester"]; ?>"><?php echo $row['semester'];?></option>
			<?php endwhile;?>			
			</select>
		  <button type="button" onclick="action(this);" >Εξαγωγή</button>
		  </div>
</br></br>  

		  
		  
		<!-- Στη περίπτωση λανθασμένων στοιχείων γίνεται εμφάνιση κατάλληλου μηνύματος. Η μεταβλητή $_GET['error'] αρχικοποιείται στη σελίδα loginProcess.php-->		  


	<?php endif; ?>
	<?php endif; ?>

<?php 
include "footer.php"; 

?>

<!-- Η συνάρτηση αποστέλλει πληροφορίες στη updateDB.php για την εκτέλεση των ερωτημάτων για τις αλλαγές στη βάση δεδομένων. 
Η ενέργεια που εκτελείται ορίζεται από το περιεχόμενο του κουμπιού που πατήθηκε. Τα στοιχεία συλλέγονται από τη γραμμή του πίνακα στην οποία βρίσκεται το κουμπί 
Για τα στατιστικά των φοιτητών η ανακατεύθυνση γίνεται στη student_progress.php -->	
<script>

	function action(button){

	var row = button.parentNode.parentNode; 

	if (window.location.href.indexOf("print=4") > -1) {
			
	 var semester = document.getElementById("semester").value;
	 var type = document.getElementById("type").value;
	 var teacher_id = document.getElementById("teacher_id").value;
	
	location.href = "updateDB.php?id=" + row.cells.item(0).innerHTML 
	+ "&title=" + row.cells.item(1).innerHTML 
	+ "&type=" + type
	+ "&description=" + row.cells.item(3).innerHTML 
	+ "&semester=" + semester 
	+ "&ecp=" + row.cells.item(5).innerHTML  
	+ "&teacher_id=" + teacher_id 
	+ "&action=" + button.innerHTML;
	
	} else if (window.location.href.indexOf("print=5") > -1) {
		
		location.href = "student_progress.php?id=" + button.id;

		
	} else if (window.location.href.indexOf("print=2") > -1) {
		if (!(row.cells.item(3).innerHTML.includes("@")) || ((row.cells.item(5).innerHTML).length  < 8) || !(parseInt(row.cells.item(8).innerHTML , 10)) || !(row.cells.item(1).innerHTML) || !(row.cells.item(2).innerHTML) || !(parseInt(row.cells.item(9).innerHTML , 10))) {
		alert("Λάθος εισαγωγή. Τα πεδία 'Όνομα' και 'Επίθετο' είναι απαραίτητα. Το πεδίο 'Ηλεκτρονική Διευθυνση' πρέπει να περιέχει το χαρακτήρα '@', ο κωδικός να αποτελείται από τουλάχιστον 8 χαρακτήρες, ο αριθμός μητρώου να είναι ακέραιος αριθμός και το πεδίο 'Εξάμηνο' να μην είναι κενό.");
	} else {
		location.href = "updateDB.php?id=" + row.cells.item(0).innerHTML 
		+ "&name=" + row.cells.item(1).innerHTML 
		+ "&lastName=" + row.cells.item(2).innerHTML 
		+ "&email=" + row.cells.item(3).innerHTML  
		+ "&role=" + row.cells.item(4).innerHTML 
		+ "&password=" + row.cells.item(5).innerHTML  
		+ "&mobile=" + row.cells.item(6).innerHTML  
		+ "&address=" + row.cells.item(7).innerHTML  
		+ "&registry=" + row.cells.item(8).innerHTML 
		+ "&semester=" + row.cells.item(9).innerHTML 
		+ "&action=" + button.innerHTML;	
		}	
	
	} else if (window.location.href.indexOf("print=6") > -1) {
		
		var semester = document.getElementById("semester").value;
		location.href = "fetchData.php?semester=" + semester;
	}

	else {
		if (!(row.cells.item(3).innerHTML.includes("@")) || ((row.cells.item(5).innerHTML).length  < 8) || !(parseInt(row.cells.item(8).innerHTML , 10)) || !(row.cells.item(1).innerHTML) || !(row.cells.item(2).innerHTML)) {
		alert("Λάθος εισαγωγή. Τα πεδία 'Όνομα' και 'Επίθετο' είναι απαραίτητα. Το πεδίο 'Ηλεκτρονική Διευθυνση' πρέπει να περιέχει το χαρακτήρα '@', ο κωδικός να αποτελείται από τουλάχιστον 8 χαρακτήρες και ο αριθμός μητρώου να είναι ακέραιος αριθμός");
	} else {
		location.href = "updateDB.php?id=" + row.cells.item(0).innerHTML 
		+ "&name=" + row.cells.item(1).innerHTML 
		+ "&lastName=" + row.cells.item(2).innerHTML 
		+ "&email=" + row.cells.item(3).innerHTML  
		+ "&role=" + row.cells.item(4).innerHTML 
		+ "&password=" + row.cells.item(5).innerHTML  
		+ "&mobile=" + row.cells.item(6).innerHTML  
		+ "&address=" + row.cells.item(7).innerHTML  
		+ "&registry=" + row.cells.item(8).innerHTML 
		+ "&action=" + button.innerHTML;	
		}	
	}
	}
</script>



</body>

</html>