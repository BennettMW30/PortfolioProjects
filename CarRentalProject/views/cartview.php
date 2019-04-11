<?php
  echo "<div class=row'><div class='col'>";
  if (!isset($pagetitle))
	$pagetitle = "My Rental History";
	
  echo "<h3>{$pagetitle}</h3>";
  // Use a table to display output
if(!isset($cart) || count($cart) == 0){
  echo "You have not rented any vehicles yet.";
} else {
  echo "<table class='table'>";
  echo "<thead><tr><td>Vehicle</td><td>#Days</td><td>Subtotal</td></tr></thead>";
  $total = 0;
  foreach ($cart as $car){
	$subtotal = $car['days']*$car['cost'];
	$total += $subtotal;
	echo "<tr><td>{$car['make']} {$car['model']}</td>
		<td>{$car['days']}</td><td>{$subtotal}</td></tr>";


 }
  echo "</table>";
  echo "<p>Total: \${$total} </p>";
  $taxes = $total*0.05;
  echo "<p>Taxes: \${$taxes} </p>";
  echo "<p>Total Amount: \$".($total + $taxes)."</p>";
}
?>
