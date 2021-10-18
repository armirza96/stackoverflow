<?php


$data = [];

if(!isset($_SESSION["ACCID"])) {
  $data = array("RESULT"=> 2, "MESSAGE" => "Please login before asking a question.");
  return;
}

if(isset($_POST["question"])){
      require_once("././inserter.php");

      $question = $_POST["question"];
      $accid = $_SESSION["ACCID"];

      $bindings = [];

      $bindings["BINDING_TYPES"] = "is";
      $bindings["VALUES"] = array(
                                $accid,
                                $question
                              );

      $result = insertData("questions/add/sql.txt", $bindings);

      if ($result["RESULT"] === 1) {
        $data = array("RESULT"=> 1, "MESSAGE" => "Question was successfully asked!", "ID" => $result["LAST_INSERTED_ID"]);
      } else {
        if (strpos($result["MESSAGE"], 'Duplicate entry') !== false) {
            $data = array("RESULT"=> 2, "MESSAGE" => "Duplcate question asked!");
        } else {
            $data = array("RESULT"=> 2, "MESSAGE" => "Question was not saved. Please try again. If this problem reoccurs, please contact support.");
        }
      }

 } else {
    $data = array("RESULT"=> 2, "MESSAGE" => "Please input all required data.");
 }
