<?php
require_once("././inserter.php");

$data = [];
if(isset($_POST["email-signup"]) && isset($_POST["email-signup-conf"]) &&
      isset($_POST["pass-signup"]) && isset($_POST["pass-signup-conf"]) &&
      isset($_POST["username-signup"])){

   if(strcmp($email,$_POST["email-conf"]) === 0 && strcmp($pass,$_POST["pass-conf"]) === 0) {

      $email = $_POST["email"];
      $pass = $_POST["pass"];
      $userName = $_POST["username"];
      $imageUrl = $_POST["image"];

      $bindings = [];

      $bindings["BINDING_TYPES"] = "ssss";
      $bindings["VALUES"] = array(
                                      $userName,
                                      $email,
                                      $encrypted_pass,
                                     $imageUrl
                              );

      $encrypted_pass = password_hash($password, PASSWORD_DEFAULT);

      $result = insertData("user/add/sql.txt", $bindings);

      if ($result["RESULT"] === 1) {
         $data = array("RESULT"=> 1, "ID" => $result["LAST_INSERTED_ID"]);
      } else {
         if (strpos($conn->error, 'Duplicate entry') !== false) {
            $data = array("RESULT"=> 2, "MESSAGE" => "Account was not created because you already have an account.");
         } else {
            $data = array("RESULT"=> 2, "MESSAGE" => "Account was not created. Please try again. If this problem reoccurs please contact support.");
         }
      }
   } else {
      $data = array("RESULT"=> 2, "MESSAGE" => "Email and/or passwords do not match.");
   }

 } else {
    $data = array("RESULT"=> 2, "MESSAGE" => "Please input all required data.");
 }

 echo json_encode($data);
