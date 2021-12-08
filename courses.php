<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" href="./style.css">

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Τίτλος  -->
	<title>Μαθήματα</title>
</head>

<?php 
require 'connect_DB.php';
include "header.php"; 
include "menu.php"; 
?>

<h3>Μαθήματα</h3>
	<!-- Ονόματα Στηλών του πίνακα περιεχομένων  -->
	<table width= "96%" border= "1px solid black"  class= "table-info">
	    <tr><th>Τίτλος Μαθήματος</th>
            <th>Τύπος</th>
            <th>Περιγραφή</th>
            <th>Εξάμηνο</th>
			<th>Μονάδες ECP</th></tr>
			
	<!-- Ερώτημα για αναζήτηση των μαθημάτων στη βάση και βρόγχος για την εμφάνιση τους σε κελιά του πίνακα   -->
	
	<?php 
		$results = mysqli_query($con, "SELECT * FROM courses");
		while($row = mysqli_fetch_array($results)):;
		?>
	            <tr>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['type'];?></td>
                <td><?php echo $row['description'];?></td>
                <td><?php echo $row['semester'];?></td>
                <td><?php echo $row['ecp'];?></td>				
            </tr>
			
	<?php endwhile;?>
	
	</table>
	
<?php 
include "footer.php"; 
?>
</html>