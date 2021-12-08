		
		<?php
		session_start(); 
		# αν ο χρήστης είναι συνδεδεμένος αποθηκέυονται οι βασικές πληροφορίες του σε μεταβλητές ώστε να εμφανισθούν στο header
	    if (isset($_SESSION['user_info'])) {
			$user_info = $_SESSION['user_info'];
			$user_option = 'Αποσύνδεση';
			$redirect = './logout.php';
		# διαφορετικά αποθηκευεται κενή συμβολοσειρά
		} else {
			$user_info = '';
			$user_option = 'Είσοδος';
			$redirect = './login.php';
		}
		?>
<html>
<!--table με τα περιεχόμενα του header των σελίδων-->
	<table width= "100%" cellpadding= "20px" style= "text-align: center;">
		<td>
		<a href = "./index.php">
		<img  border="1" width="200" height="160" src = "./images/logo.png" alt= "Λογότυπο Ιδρύματος"> </a>	</td>
		<td width="700" >
		<p><b>ΗΛΕΚΤΡΟΝΙΚΗ ΓΡΑΜΜΑΤΕΙΑ</b><br>
			ΜΕΤΑΠΤΥΧΙΑΚΟΥ ΠΡΟΓΡΑΜΜΑΤΟΣ ΣΠΟΥΔΩΝ......<br>
			ΤΜΗΜΑ......<br>
			ΠΑΝΕΠΙΣΤΗΜΙΟ......</p></td>
		<td width="200" ><?= $user_info ?></br><a class="this" href = <?= $redirect ?>><?=$user_option?></a></td>

	</table>
	
</html>

