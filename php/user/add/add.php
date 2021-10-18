<?php
require_once("././inserter.php");

$data = [];
if(isset($_POST["email"]) &&
      isset($_POST["password"]) &&
      isset($_POST["username"])){

   //if(strcmp($email,$_POST["email-conf"]) === 0 && strcmp($pass,$_POST["pass-conf"]) === 0) {

      $email = $_POST["email"];
      $password = $_POST["password"];
      $userName = $_POST["username"];
      $imageUrl = '';//$_POST["image"];
      $encrypted_pass = password_hash($password, PASSWORD_DEFAULT);

      $bindings = [];

      $bindings["BINDING_TYPES"] = "ssss";
      $bindings["VALUES"] = array(
                                      $userName,
                                      $email,
                                      $encrypted_pass,
                                     $imageUrl
                              );



      $result = insertData("user/add/sql.txt", $bindings);



      if ($result["RESULT"] === 1) {
        $_SESSION["ACCID"] = $result["LAST_INSERTED_ID"];
        $data = array("RESULT"=> 1, "MESSAGE" => "Account was successfully created!", "ID" => $result["LAST_INSERTED_ID"]);
      } else {
        if (strpos($result["MESSAGE"], 'Duplicate entry') !== false) {
            $data = array("RESULT"=> 2, "MESSAGE" => "Account was not created. Duplicate email or username.");
        } else {
            $data = array("RESULT"=> 2, "MESSAGE" => "Account was not created. Please try again. If this problem reoccurs please contact support.");
        }
      }
   // } else {
   //    $data = array("RESULT"=> 2, "MESSAGE" => "Email and/or passwords do not match.");
   // }

 } else {
    $data = array("RESULT"=> 2, "MESSAGE" => "Please input all required data.");
 }
