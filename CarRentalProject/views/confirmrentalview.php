<?php
  echo "<div class=row'><div class='col'>";
  if (!isset($pagetitle))
	$pagetitle = "Rental Confirmation";
  echo "<h3>{$pagetitle}</h3>";

  echo "<p>Your have reserved a {$info['make']} {$info['model']} for ".$_POST['days']." day(s)</p>

";
  $cost = round($_POST['days']*$info['cost']*1.05, 2);
  echo "Your total rental fee is \${$cost}, including 5% sales tax<br/>";


 function calculateDueDate($num){
        /* This function takes the Date_out as input and then
           calculates the due date. Rental period is 3 days.
        */
          // extract day, month, and year form the Date_out
         /* Use the explode function to separate those items
        Syntax: explode('-', $dateout)
        explode() method returns an array */
	$today = date('Y-m-d');
        $date_info = explode('-', $today);
        /* year - $date_info[0]
          month - $date_info[1]
          date - $date_info[2]
        */
        // Use the mktime() method to create the timestamp for the due date
   $due = mktime(0,0,0,$date_info[1], $date_info[2]+$num, $date_info[0]);
       // return the due date using "y-m-d" format
        return date("Y-m-d", $due);
}

?>
