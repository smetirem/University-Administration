<?php
   
    session_start();
	# διαγραφή δεδομένων session
    session_destroy();
	# εγγραφή δεδομένων και τερματισμός session
    session_write_close();
	# ανακατευθυνση στην αρχική σελίδα
    header("Location: ../index.php");
   
?>