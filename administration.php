<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" href="./style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Τίτλος  -->
	<title>Γραμματεία</title>
</head>

<body> 

<?php 
require 'connect_DB.php';
include "header.php"; 
include "menu.php"; 
?>

<h3>ΓΡΑΜΜΑΤΕΙΕΣ</h3>
	
		<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
	<table width= "96%" border= "1px solid black"  class= "table-info">
	    <tr><th>Ονομα</th>
            <th>Επώνυμο</th>
            <th>Ηλεκτρονική Διευθυνση</th>
            <th>Τηλέφωνο Επικοινωνίας</th></tr>
			
		<!-- Ερώτημα για αναζήτηση των υπαλλήλων γραμματείας στη βάση και βρόγχος για την εμφάνιση τους σε κελιά του πίνακα   -->
	<?php 
		$results = mysqli_query($con, "SELECT * FROM users WHERE role = 'Γραμματεία'");
		while($row = mysqli_fetch_array($results)):;
		?>
	        <tr>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['last_name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['mobile'];?></td>
            </tr>
			
	<?php endwhile;?>
	
	</table>


<?php 
include "footer.php"; 
?>

</body>
</html>