<!DOCTYPE html>

<html>
<link rel="stylesheet" href="./style.css">


<?php 
require 'connect_DB.php';
	# Εάν υπάρχει συνδεδεμένος χρήστης αποθηκεύονται και αναλόγος με το τύπο του χρήστη στις μεταβλητές οι αντίστοιχες συμβολοσειρές
	if (isset($_SESSION['user_info'])) {
		# επιλογή κλάσης css ώστε να ενταχθεί η νέα επιλογή μενού
		$style_var = 'dropdown-items-integrated';
		
			if ($_SESSION['role'] == "Διδακτικό Προσωπικό") {
			$user_action_link = './educational_controller.php';
			$user_option = 'Διδασκαλία';
			} else if ($_SESSION['role'] == 'Γραμματεία') {
			$user_action_link = './administration_controller.php';
			$user_option = 'Διαχείριση';	
			} else {
			$user_action_link = './student_controller.php';
			$user_option = 'Φοίτηση';
			}
	# διαφορετικά επιλογή κλάσης css ώστε να μην ενταχθεί η νέα επιλογή μενού
	} else {
		$style_var = 'dropdown-items';
	}
?>
		<!-- Περιεχόμενα menu  -->
<body> 
	<table border= "1px" width="100%" cellpadding= "20px" class= "table-menu">
		<td ><a class="this" href="./index.php">Αρχική</a></td>
        <td ><a class="this" href="./courses.php">Μαθήματα</a></td>
		<td  class= "dropdown"> Προσωπικό<div class= <?= $style_var ?>>
		    <a class= "this" href="./educational staff.php">Διδάσκοντες</a>
			<a class= "this" href="./administration.php">Γραμματεία</a></div></td>
		<td ><a class="this" href="./study regulations.php">Κανονισμός  Σπουδών</a></td>
		
		<!-- Εάν υπάρχει συνδεδεμένος χρήστης στο μενού εμφανίζεται ένα ακόμη στοιχείο με link, τα οποία είναι ήδη διαμορφωμένα και αποθηκευμένα στις μεταβλητές  -->
	    <?php if (isset($_SESSION['user_info'])): ?>
		<td><a class="this" href = <?= $user_action_link ?>><?=$user_option ?></a></td>
		<?php endif; ?>

	</table>
</body>
</html>



