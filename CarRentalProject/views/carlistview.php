<?php
  echo "<div class=row'><div class='col'>";
  if (!isset($pagetitle))
	$pagetitle = "List of Vehicles";
	
  echo "<h3>{$pagetitle}</h3>";
  // Use a table to display output
  if (isset($type))
      echo "<h4>Vehicle Type: {$type}</h4>";
  echo "<table class='table' >";
  // display column labels
  if (isset($labels)&& count($labels)>0){
    echo "<thead><tr>";
    foreach ($labels as $label){
	echo "<td>{$label}</td>";
    }

    // Add one more column to the table to display #days
    echo "<td>#Days</td></tr></thead>";
  }

  if (isset($table_data)){
   echo "<tbody>";
   foreach($table_data as $car){
     /* Each element in the $table_data array is an associative array (record).
     */

     //  Display the output
     echo "<tr>";
     echo "<td> {$car['make']} </td>";
     echo "<td>{$car['model']}</td>";
     echo "<td>{$car['cost']}</td>";
     echo "<td>\n";
     echo "<form action='index.php?mode=saverental' method='post'>\n ";
     echo "<select name='days'>\n";
		for($i=1; $i<15; $i++){
		  echo "<option value='{$i}'>{$i}</option>\n";
		}
     echo "</select>\n";
     echo "<input type='hidden' name='id' value='{$car['id']}' />\n
		<input type='hidden' name='mode' value='saverental' /> \n
		<button type='submit' class='btn btn-primary'>Rent</button> \n
	  </form>\n";
     echo "</td></tr>\n";
   }
   echo "</tbody>";
   echo "</table>";
  }
  echo "</div></div>";

?>
