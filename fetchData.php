<?php

echo '<meta charset="UTF-8"/>';
require 'connect_DB.php';
session_start();


	/*-- Εξαγωγή XML  --*/
	
/*-- Αν ο χρήστης δεν είναι Υπάλληλος Γραμματείας τότε οδηγείται στη σελίδα login.php  --*/

if ($_SESSION['role'] != 'Γραμματεία') {
header("Location:login.php?error=1");

} else { 

$semester = $_GET['semester'];
$students = array();
$topGradeList = array();


        // Δομή για τους φοιτητές
        class Student {
            public $name;
            public $last_name;
			public $courses = array(); 
            public $average;
        }

		// Ερώτημα για όλους τους φοιτητές του εξαμήνου
	
		$sql = "SELECT * FROM semester
				JOIN users ON users.user_id = semester.user_fk
				WHERE semester_id = '$semester' ORDER BY users.last_name DESC" ;	

			$result = mysqli_query($con, $sql);

            while($rows = mysqli_fetch_array($result)){      
			$student_id = $rows['user_id'];
			$anElement = new Student(); // Αρχικοποίηση του νέου αντικειμένου

			// Ανάθεση τιμών στο αντικείμενο
            $anElement->name = $rows['name'];
            $anElement->last_name = $rows['last_name'];
			
			//Ερώτημα για τα ολοκληρωμένα μαθήματα ανά φοιτητή
			$query = "SELECT * FROM enrollment 
			JOIN courses ON courses.course_id = enrollment.course_fk 
			WHERE enrollment.user_fk = '$student_id' AND enrollment.status = 'Ολοκληρωμένο'";	
					  			  
			$courses_result = mysqli_query($con, $query);
			
			while($course_rows = mysqli_fetch_array($courses_result)){ 
			
            array_push($anElement->courses,$course_rows['title']);  
			}			
			
			// Ερώτημα για το μέσο όρο ανά φοιτητή
			$avg_query = "SELECT AVG(grade) AS avg FROM enrollment 
			JOIN courses ON courses.course_id = enrollment.course_fk 
			WHERE enrollment.user_fk = '$student_id' AND enrollment.status = 'Ολοκληρωμένο'";	
					  			  
			$avg_result = mysqli_query($con, $avg_query);
			$avg = mysqli_fetch_assoc($avg_result);
			
			// Ανάθεση τιμών στο αντικείμενο
            $anElement->average = $avg['avg'];

			array_push($students,$anElement);  
            }
		// Ερώτημα για τους 2 καλύτερους φοιτητές του εξαμήνου
	
		$sql = "SELECT *,AVG(grade) AS avgGrade  FROM semester
				JOIN enrollment ON enrollment.user_fk = semester.user_fk
				WHERE semester_id = '$semester' AND enrollment.status = 'Ολοκληρωμένο' GROUP BY enrollment.user_fk  ORDER BY grade DESC LIMIT 2" ;	

			$result = mysqli_query($con, $sql);

            while($rows = mysqli_fetch_array($result)){      
			// Ανάθεση τιμών στο αντικείμενο - βαθμό		
			array_push($topGradeList,$rows['avgGrade']); 
			}
			
			/* Δημιουργία νέας αντικειμένου DomImplementation. Γίνεται φνωστό ότι θα υπάρχει ένα εξωτερικό dtd
            αρχείο .dtd για τον έλεγχο εγκυρότητας. */
		
            $imp = new DOMImplementation;
            $dtd = $imp->createDocumentType('std','','studentPattern.dtd');
            $xml = $imp->createDocument("","",$dtd);
            $xml->encoding = 'UTF-8'; // Κωδικωποίηση για τους Ελληνικούς χαρακτήρες
            $xml->formatOutput = true;
            
            // Δημιουργούμε το στοιχείο - ρίζα και το προσθέτουμε στο xml.
            $std = $xml->createElement("std");
            $xml->appendChild($std); // Προσθέτουμε το 1ο στοιχείο-ρίζα
            
            // Προσθέτουμε τους φοιτητές στο xml.
            foreach ($students as $element){
                $student = $xml->createElement("student");
				
				
				// Αν ο βαθμός του φοιτητή ανήκει στη λίστα με τους καλύτερους βαθμούς το attribute είναι 1. Διαφορετικά 0.
				if (in_array("$element->average", $topGradeList)) {
                $student->setAttribute("progress", "1");
				} else {
                $student->setAttribute("progress", "0");
				}
				
                $std->appendChild($student);              
                $student->appendChild($xml->createElement("name",$element->name));
                $student->appendChild($xml->createElement("last_name",$element->last_name));
			// προσθέτουμε το στοιχείο για τα μαθήματα	
			$courses = $xml->createElement("courses");
            $student->appendChild($courses);
			// προσθέτουμε τα μαθήματα του κάθε φοιτητή 
            foreach ($element->courses as $elem){
                $courses->appendChild($xml->createElement("course",$elem));
			}
                $student->appendChild($xml->createElement("average",$element->average));
            }
            // Ολοκλήρωση της δημιουργίας του xml αρχείου κι αποθήκευση στον κατάλογο 'files' με το όνομα 'transactions<USERID>.xml'
            $xml->saveXML();
            $xml->save("archive_". date("Y-m-d") .".xml"); // αποθήκευση αρχείου με την ημερομηνία
     			
			// Δημιουργία .xsl αρχείου και μορφοποίηση του  .xml
			$xmlFile = "archive_". date("Y-m-d") .".xml";
			$xslFile = "studentsXSL.xsl";
			

			$xmlDom = new DOMDocument();
			$xmlDom ->load($xmlFile);
			
			$xslDom = new DOMDocument();
			$xslDom ->load($xslFile);
			
			$proc = new XSLTProcessor();
			$proc->importStyleSheet($xslDom);
			echo $proc->transformToXML($xmlDom);
			

}

?>
