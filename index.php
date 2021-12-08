<!DOCTYPE html>

<html>
	<!-- Αρχική σελίδα  -->

<head>
<link rel="stylesheet" href="./style.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Τίτλος  -->
	<title>Μεταπτυχιακό Πρόγρμματα Σπουδών</title>
</head>

<?php 
include "header.php"; 
include "menu.php"; 
?>

<html>
	<!-- Στατική εμφάνιση Ανακοινώσεων  -->
	<h3>ΑΝΑΚΟΙΝΩΣΕΙΣ</h3>
	<table width="100%" cellpadding= "20px" style=  "font-size: 120%;">
		<td width= "25%" align= "center"><img  border="1" width="100" height="100" src = "./images/announcement.png" alt= "Εικόνα Ανακοίνωσης"> </a></td>
		<td width= "75%"> <a class="this" href="./announcements.php">Ανακοίνωση 1</a>
		<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. "</p></td>
		</table>
		
		<table width="100%" cellpadding= "20px" style= "font-size: 120%;">	
		<td width= "75%" align= "right"> <a class="this" href="./announcements.php">Ανακοίνωση 2</a>
		<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. "</p></td>
		<td width= "25%" align= "center"><img  border="1" width="100" height="100" src = "./images/announcement.png" alt= "Εικόνα Ανακοίνωσης"> </a></td>
		</table>
		
		
		<table width="100%" cellpadding= "20px" style= "font-size: 120%;">
		<td width= "25%" align= "center"><img  border="1" width="100" height="100" src = "./images/announcement.png" alt= "Εικόνα Ανακοίνωσης"> </a></td>
		<td width= "75%"> <a class="this" href="./announcements.php">Ανακοίνωση 3</a>
		<p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. "</p></td>
		</table>
		
	<!-- Ανακατεύνση στη σελίδα Ανακοινώσεων  -->
		<h3 align= "center"><a href = "./announcements.php">ΟΛΕΣ ΟΙ ΑΝΑΚΟΙΝΩΣΕΙΣ</a></h3>

<?php 
include "footer.php"; 
?>
</html>