<?php
include('pdo_connect.php');
 function checkValidUser(){
        // validate user
        $sql = "select customer_id, first_name, last_name, payment_type from `warhawk_customers` where
                username=:username and pwd = :pwd";
        // define values for parameters
        $values = array(':username'=>$_POST['username'], ':pwd'=>md5($_POST['pwd']));
        $result = getOneRecord($sql, $values);
        return $result;
 }

 

  function getOneRecord($sql, $parameter = null){
        global $db;
        $statement = $db->prepare($sql);
        // execute the SQL statement
        $statement->execute($parameter);
        // return result
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result;
  }


  function getAllRecords($sql, $parameter = null){
        global $db;
        $statement = $db->prepare($sql);
        // execute the SQL statement
        $statement->execute($parameter);
        // return result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result;
  }

?>
