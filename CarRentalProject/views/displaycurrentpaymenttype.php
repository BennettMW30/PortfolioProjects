<?php
  echo "<div class=row'><div class='col'>";
  if (!isset($pagetitle))
	$pagetitle = "My Profile";
	
  echo "<h3>{$pagetitle}</h3>";
  echo "<p><strong>Name:</strong> {$_SESSION['user']}</p>\n";
  echo "<p>Current payment method: {$data['payment_type']} </p>";
  echo "<form action='?mode=updatepaymenttype' method='post'>";
  echo "<p>New pament type: <input type='text' name='payment_type' placeholder='Enter new payment type'></p>";
  echo "<input type='submit' value='Update Payment Type' class='btn btn-primary'></form>";
?>
