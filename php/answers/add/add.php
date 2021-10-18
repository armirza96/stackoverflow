<?php


$data = [];

if(!isset($_SESSION["ACCID"])) {
  $data = array("RESULT"=> 2, "MESSAGE" => "Please login before answering a question.");
  return;
}

if(isset($_POST["questionID"]) && isset($_POST["answer"])){
      require_once("././inserter.php");

      $questionID = $_POST["questionID"];
      $answer = $_POST["answer"];
      $accid = $_SESSION["ACCID"];

      $bindings = [];

      $bindings["BINDING_TYPES"] = "iis";
      $bindings["VALUES"] = array(
                                $questionID,
                                $accid,
                                $answer
                              );

      $result = insertData("answers/add/sql.txt", $bindings);

      if ($result["RESULT"] === 1) {
        $data = array("RESULT"=> 1, "MESSAGE" => "Answer was successfully posted!", "ID" => $result["LAST_INSERTED_ID"]);
      } else {
        $data = array("RESULT"=> 2, "MESSAGE" => "Answer was not saved. Please try again. If this problem reoccurs, please contact support.");
      }
 } else {
    $data = array("RESULT"=> 2, "MESSAGE" => "Please input all required data.");
 }
