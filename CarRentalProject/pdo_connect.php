<?php
$user = 'bennettmw30';
$pass = 'mb5539';
$db_info = 'mysql:host=washington.uww.edu; dbname=cs382-2187_bennettmw30';
try{
   $db = new PDO($db_info, $user, $pass);
} catch (PDOException $e) {
   print "Error!: ".$e->getMessage()."<br/>";
   die();
}

?>

