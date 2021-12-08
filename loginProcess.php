<?php

echo '<meta charset="UTF-8"/>';



# Αποθήκευση σε μεταβλητές των ληφθέντων πληροφοριών
$email = $_POST['email'];
$password = $_POST['password'];

require 'connect_DB.php';

# Αναζήτηση στη βάση δεδομένων για το συγκεκριμένο χρήστη
$result = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' && password = '$password' ");

#Εάν ο χρήστης υπάρχει αποστέλλονται πληροφορίες για την εμφάνιση sto header και του κατάλληλου στοιχείου στο μενού
if ($result->num_rows === 1) {
	# Εκκίνηση session
	session_start();

	$row = $result->fetch_assoc();
	$_SESSION['role'] = $row['role']; 
	# nl2br συνάρτηση για την συνένωση συμβολοσειρών 
	$_SESSION['user_info'] = nl2br($row['name'] ." " .$row['last_name'] ."\n(" .$row['role'] .")");
	$_SESSION['id'] = $row['user_id']; 
	# Ανακατεύθυνση στην αρχική σελίδα
	header("Location:index.php");
}
#Εάν ο χρήστης δεν υπάρχει γίνεται μόνο ανακατεύθυνση στην αρχική σελίδα
else {
header("Location:login.php?error=1");

}


?>