<?xml version = "1.0" encoding = "UTF-8"?>
<xsl:stylesheet version = "1.0" 

xmlns:xsl = "http://www.w3.org/1999/XSL/Transform">   

<xsl:output method="html" />
<xsl:template match = "/"> 

<link rel="stylesheet" type="text/css" href="./style.css"/>
      <!-- HTML tags 
		Για σκοπούς μορφοποίησης. 
      --> 
		
      <html> 
	  <title>Semester Report</title>
         <body> 
		 
	<h2 style= "text-align: center; color:#315597; font-size: 30px;">Φοιτητές Εξαμήμου</h2> 
	
		  <!-- Μεταβλητή με το σύνολο βαθμών των φοιτητών --> 
	<xsl:variable name="sum" select="sum(std/student/average[number() = number()])"/> 

		  <!-- Μεταβλητή με το πλήθος των φοιτητών και εκτύπωση  --> 
	<xsl:variable name="count" select="count(std/student)"/> 
	<p style= "text-align: center; color:#315597; font-size: 15px;">Σύνολο Φοιτητών Εξαμήνου: <xsl:value-of select="$count"/></p>

		  <!-- Εκτύπωση μέσου όρου βαθμών --> 
	<p style= "text-align: center; color:#315597; font-size: 15px;">Μ.Ο. Φοιτητών Εξαμήνου: <xsl:value-of select = 'format-number($sum div $count, "#.0#")'/></p>
	
			<table width= "96%" border= "1px solid black"  class= "table-info"> 
			
			
               <tr> 
                  <th>Όνομα</th> 
                  <th>Επίθετο</th> 
                  <th>Ολοκληρωμένα Μαθήματα</th> 
                  <th>Μέσος Όρος Ολοκληρωμένων Μαθημάτων</th> 
               </tr> 
				
               <!-- Για κάθε στοιχείο που ταιριάζει στο XPath expression 
               -->   
				
               <xsl:for-each select="std/student"> 
                  <tr> 		
			   <!-- Αν το attribute είναι 1 (ανήκει στους καλύτερους φοιτητές γλινεται ανάλογη μορφοποίηση τοης γραμμής)
               --> 
			        <xsl:if test="@progress = 1">	
					<xsl:attribute name="style">color: red</xsl:attribute>	
					</xsl:if>  		  
                     <td><xsl:value-of select = "name"/></td>    
                     <td><xsl:value-of select = "last_name"/></td>	
					 <td>	
			   <!-- Για την εκτύπωση των μαθημάτων του κάθε φοιτητή 
               --> 
					    <xsl:for-each select="courses/course"> 		 
                        <xsl:apply-templates/><br/>			
						</xsl:for-each> 
						</td>
                     <td><xsl:value-of select = "average"/></td> 	
                  </tr> 
				    
               </xsl:for-each> 
			   
            </table> 
         </body> 
      </html> 
   </xsl:template>  
</xsl:stylesheet>