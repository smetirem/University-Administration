<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" href="./style.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Τίτλος  -->
	<title>Ανακοινώσεις</title>
</head>

<body> 

<?php 
include "header.php"; 
include "menu.php"; 
?>
	
	<table width="100%" cellpadding= "10px" style= " font-size: 120%;" class="show-more-element">
		<td width= "35%" align= "center"><img width="100" height="100" src = "./images/announcement.png" alt= "Εικόνα Ανακοίνωσης"></td>
		<td width= "65%"><a onclick="document.getElementById('id01').style.display='block'" class= "select-item">Ανακοίνωση 1</a>
		<!-- The Modal box for announncement 1-->
		<div id="id01" class="w3-modal">
		  <div class="w3-modal-content">
			<div class="w3-container">
			  <span onclick="document.getElementById('id01').style.display='none'"
			  class="w3-button w3-display-topright">&times;</span>
			  <b>Ανακοίνωση 1</b>
			  <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
				sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
			</div>
		  </div>
	</div></td>
		
		<tr><td align= "center"><img width="100" height="100" src = "./images/announcement.png" alt= "Εικόνα Ανακοίνωσης"></td>
		<td><a onclick="document.getElementById('id02').style.display='block'" class= "select-item">Ανακοίνωση 2</a>
		<!-- The Modal box for announncement 2-->
		<div id="id02" class="w3-modal">
		  <div class="w3-modal-content">
			<div class="w3-container">
			  <span onclick="document.getElementById('id02').style.display='none'"
			  class="w3-button w3-display-topright">&times;</span>
			  <b>Ανακοίνωση 2</b>
			  <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
				sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
			</div>
		  </div>
	</div></td></tr>
	
		<tr><td align= "center"><img width="100" height="100" src = "./images/announcement.png" alt= "Εικόνα Ανακοίνωσης"></td>
		<td><a onclick="document.getElementById('id03').style.display='block'" class= "select-item">Ανακοίνωση 3</a>
		<!-- The Modal box for announncement 3-->
		<div id="id03" class="w3-modal">
		  <div class="w3-modal-content">
			<div class="w3-container">
			  <span onclick="document.getElementById('id03').style.display='none'"
			  class="w3-button w3-display-topright">&times;</span>
			  <b>Ανακοίνωση 3</b>
			  <p>"Lorem ipsum dolor sit amet, consectetur adipisicing elit, 
				sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."</p>
			</div>
		  </div>
	</div></td></tr>
	</table>


<?php 
include "footer.php"; 
?>

</body>
</html>