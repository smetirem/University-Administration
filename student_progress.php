<!DOCTYPE html>

<html>
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link href="/style.css" rel="stylesheet" type="text/css" />
	<!-- Τίτλος  -->
	<title>Πρόοδος Φοιτητή</title>
</head>

<?php
require 'connect_DB.php';
 ?>

<h3 style= "text-align: center; color:#315597; font-size: 30px;">Στοιχεία Φοιτητή</h3>


	<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
	<table width= "96%" border= "1px solid black"  class= "table-info " >				
			<tr><th>Ονομα</th>
            <th>Επώνυμο</th>
            <th>Ηλεκτρονική Διευθυνση</th>
            <th>Τηλέφωνο Επικοινωνίας</th>
			<th>Διευθυνση</th>
			<th>Αριθμός Μητρώου</th>
			</tr>

		<!-- Ερώτημα για αναζήτηση του φοιτητή στη βάση και εμφάνιση στοιχείων σε κελιά του πίνακα   -->
		<?php
		$results = mysqli_query($con, "SELECT * FROM users WHERE user_id = '$_GET[id]'");	
		$row = mysqli_fetch_assoc($results);?>
		
	        <tr>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['last_name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['mobile'];?></td>
                <td><?php echo $row['address'];?></td>
                <td><?php echo $row['registry'];?></td>
            </tr>	
	</table>

</br></br>

<h3 style= "text-align: center; color:#315597; font-size: 30px;">Πρόοδος</h3>

	<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
	<table width= "96%" border= "1px solid black"  class= "table-info " >
					
			<tr><th>Τίτλος Μαθήματος</th>
            <th>Τύπος Μαθήματος</th>
            <th>Εξαμήνου</th>
            <th>Βαθμός</th>
			<th>Κατάσταση</th>
			<th>Μονάδες ECP</th>
			</tr>

		<!-- Ερώτημα για αναζήτηση των μαθημάτων που έχει ολοκληρώσει ο φοιτητής και εμφάνιση στοιχείων σε κελιά του πίνακα   -->
		<?php
		$results = mysqli_query($con, "SELECT * FROM users JOIN enrollment ON users.user_id = enrollment.user_fk JOIN courses ON courses.course_id = enrollment.course_fk WHERE user_id = '$_GET[id]'");	
		if(($results)):
		while($row = mysqli_fetch_array($results)):;?>
	        <tr>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['type'];?></td>
                <td><?php echo $row['semester'];?></td>
                <td><?php echo $row['grade'];?></td>
                <td><?php echo $row['status'];?></td>
                <td><?php echo $row['ecp'];?></td>
            </tr>

	<?php endwhile;?>
	<?php endif; ?>			
	</table>
	
	</br></br>
	<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
		<table id="info" width= "96%" border= "1px solid black"  class= "table-info">	
		<tr>
		<th>Μέσος Όρος Βαθμού</th>
		<th>Σύνολο Μονάδων ECP</th>
		</tr>

		<!-- Ερώτημα για αναζήτηση και εμφάνιση στατιστικών προόδου του φοιτητή και εμφάνιση στοιχείων σε κελιά του πίνακα   -->
	<?php
		$results1 = mysqli_query($con, "SELECT AVG(grade) AS value  FROM enrollment WHERE user_fk = '$_GET[id]' AND status = 'Ολοκληρωμένο'");
		$row1 = mysqli_fetch_object($results1);
		$results2 = mysqli_query($con, "SELECT SUM(ecp) AS value FROM enrollment JOIN courses ON enrollment.course_fk = courses.course_id WHERE enrollment.user_fk = '$_GET[id]' AND status = 'Ολοκληρωμένο'");
		$row2 = mysqli_fetch_object($results2);		
		?>
	        <tr>
			<td><?php echo $row1->value;?></td>
			<td><?php echo $row2->value;?></td>
            </tr>			
		</table>
		
	</br></br>


	<h3 style= "text-align: center; color:#315597;">Μαθήματα κορμού που υπολοίπονται για την ολοκλήρωση του πτυχίου</h3>

	<table id="info" width= "96%" border= "1px solid black"  class= "table-info">	
	
		<!-- Ερώτημα για αναζήτηση των υποχρεωτικών μαθημάτων που δεν έχει ολοκληρώσει ο φοιτητής και εμφάνιση τους στο πίνακα ανά γραμμές  -->			
		<?php
		$results = mysqli_query($con, "SELECT * FROM (SELECT title, course_id FROM courses 
		WHERE courses.type = 'Υποχρεωτικό') AS course LEFT JOIN 
		(SELECT course_fk FROM enrollment WHERE enrollment.user_fk = '$_GET[id]' AND enrollment.status = 'Ολοκληρωμένο') 
		AS student ON course.course_id = student.course_fk WHERE student.course_fk IS NULL");
		while($row = mysqli_fetch_array($results)):;?>
	        <tr>
            <td style = "border: 0px"><li><?php echo $row['title'];?></li></td>				
            </tr>			
	<?php endwhile;?>
</table>	
		
	</br></br>
	
</html>