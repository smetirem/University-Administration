<html>

    <head>
		<!-- Τίτλος  -->
        <title>Είσοδος</title>
        <meta charset="UTF-8">
    </head>
	
	<?php 
	include "header.php"; 
	include "menu.php"; 
	?>

<body>
		<!-- Περιεχόμενα σελίδας login με φόρμες για την είσοδο του χρήστη -->
		<h3>ΕΙΣΟΔΟΣ</h3>
		<p>Συνδεθείτε με τα συνθηματικά σας</p>
		<div align= "center" style= "font-size: 120%; padding: 70px;">
		  
		<!-- Ανακατεύθυνση στη σελίδα loginProcess.php με τα στοιχεία που έχει σάγει ο χρήστης -->	
		  <form action="loginProcess.php" method="post">
		  
		  <label style= "margin-right: 70px;">Email</label>
		  <input type="text" name="email" placeholder="Email"><br>
		  
		  <label style= "margin-right: 40px;">Password</label>
		  <input type="text" name="password" placeholder="Password"><br><br><br>
		  
		  <input style= "background-color: #008b8b;" type="submit" name="logIn" value="Υποβολή">
		  
		<!-- Στη περίπτωση λανθασμένων στοιχείων γίνεται εμφάνιση κατάλληλου μηνύματος. Η μεταβλητή $_GET['error'] αρχικοποιείται στη σελίδα loginProcess.php-->		  
		<?php 
		if(isset($_GET['error'])){
			print "<p style='color:red;'>" . "Λανθασμένα στοιχεία. Προσπαθήστε ξανά" . "</p>";
		} ?>
		  </form>
		 </div>
		 
	<?php 
	include "footer.php"; 
	?>



</body>
</html>
