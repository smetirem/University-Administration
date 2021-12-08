<?php
/* server(χρήστης 'root' χωρίς κωδικό) */

echo '<meta charset="UTF-8"/>';
/* προσπάθεια σύνδεσης με τη βάση δεδομένων */
$con = new mysqli("localhost", "root", "", "moumoulidou");
mysqli_set_charset($con, "utf8");
 
/* έλεγχος σύνδεσης */
if($con -> connect_error){
    die("ERROR: Could not connect to database. " . $con -> connect_error);
}

?>