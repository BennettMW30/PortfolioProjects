<?php
session_start();
/* This application uses MVC design pattern to  fetch data from a database
*
*  Directory structure:
*   views - contains all the templates needed for displaying results
*   assets - contains header, footer, and menu 
*/

// Include class definitions
include('model.php');

// Include page header
include('assets/pageheader.html');


/* Display menu. menu.php template uses a list of movie types. 
   Use the Model class to fetch a list of movie types
*/

$sql = "select distinct type from `warhawk_inventory` order by type";

// fetch vehicle types
$vehicle_types = getAllRecords($sql);

if (isset($_SESSION['customer_id'])) {
  //Display menu 
  include('assets/menu.php');
}

// Read the main task using 'mode'
$mode ='';
if (isset($_REQUEST['mode']))
	$mode = $_REQUEST['mode'];

switch ($mode){

	 case 'checkLogin' :

                $data = checkValidUser();
                if (isset($data) && isset($data['customer_id'])){
                        $_SESSION['user'] = $data['last_name'].', '.$data['first_name'];
                        $_SESSION['customer_id'] = $data['customer_id'];
                }

                header('Location: index.php');
                break;

        case 'logout' :
                // destroy session variables and display login form
                session_destroy();
                setcookie(session_name(), '', time()-1000, '/');
                $_SESSION = array();
                // display default view
                header('Location: index.php');
                break;


	case 'category':

		// Read user input
		$type = $_GET['type'];

		/* If the type is defined, then display a list of machting vehicles */
		if (isset($type)){
		   // Define SQL statement
		   $sql = "SELECT id, make, model, cost  FROM `warhawk_inventory` WHERE type= :type";

		   // Define values for named parameters using an associative array
		   $parameters = array(':type'=>$type);

		   // Obtain data using the getAllRecords() method of the Model class */
		   $table_data = getAllRecords($sql, $parameters);

		  // Define column labels for the table view
		  $labels = array('Make',  'Model', 'Cost per day');
		  // Display output
		  include('views/carlistview.php');
		}  else {
			echo "<h4>Please select car type!</h2>";
		}
		break;
	
	case 'saverental':

		$vehicleID = '';
		if (isset($_POST['id'])) {
			$vehicleID = $_POST['id'];
		}

		$sql = "INSERT INTO `warhawk_rentals` (customer_id, vehicle_id, days) VALUES (:customerid, :vehicleid, :days)";
		$parameter_values = array(':customerid' => $_SESSION['customer_id'],
					':vehicleid' => $_POST['id'],
					':days' => $_POST['days']);
		//print_r($parameter_values);

		$sql2 = "SELECT make, model, cost FROM `warhawk_inventory` WHERE id = :vehicleid";

		$parameter_values2 = array(':vehicleid' => $_POST['id']);

		$stm = $db->prepare($sql);
		$stm->execute($parameter_values);

		$info = getOneRecord($sql2, $parameter_values2);
		//print_r($info);

		include('views/confirmrentalview.php');
		break;

	case 'displaycart':

		$sql = "SELECT i.make, i.model, i.cost, r.days FROM `warhawk_rentals` as r, `warhawk_inventory` as i WHERE r.customer_id = :customerid AND r.vehicle_id = i.id";

		$parameter_values = array(':customerid' => $_SESSION['customer_id']);

		$cart = getAllRecords($sql, $parameter_values);

		include('views/cartview.php');
		break;

	case 'displaypaymentmethod':

		$sql = "SELECT payment_type FROM `warhawk_customers` WHERE customer_id = :customerid";

		$parameter_values = array(':customerid' => $_SESSION['customer_id']);

		$data = getOneRecord($sql, $parameter_values);

		include('views/displaycurrentpaymenttype.php');
		break;

	case 'updatepaymenttype':

		$sql = "UPDATE `warhawk_customers` SET payment_type = :paymenttype WHERE customer_id = :customerid";

		$parameter_values = array(':paymenttype'=> $_POST['payment_type'],
					':customerid'=> $_SESSION['customer_id']);

		$stm = $db->prepare($sql);
		$stm->execute($parameter_values);
		echo "You have successfully updated your payment type to {$_POST['payment_type']}";
		break;
	
	default :
		// Display output
		include('views/defaultview.php');
		break;
} // end switch

// Display footer
include('assets/pagefooter.html');

// End main

?>
