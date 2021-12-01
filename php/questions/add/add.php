<?php


$data = [];

session_start();

if(!isset($_SESSION["ACCID"])) {
  $data = array("RESULT"=> 2, "MESSAGE" => "Please login before asking a question.");
  return;
}

if(isset($_POST["question"])){
      require_once("././inserter.php");

      $title = $_POST["title"];
      $question = $_POST["question"];
      $tags = $_POST["tags"];
      $accid = $_SESSION["ACCID"];

      $bindings = [];

      $bindings["BINDING_TYPES"] = "iss";
      $bindings["VALUES"] = array(
                                $accid,
                                $title,
                                $question
                              );

      $result = insertData("questions/add/sql.txt", $bindings);

      if ($result["RESULT"] == 1) {
        $questionID =  $result["LAST_INSERTED_ID"];
        $bindings = [];
        
        foreach($tags as $tagID) {

          $bindings["BINDING_TYPES"] = "ii";
          $bindings["VALUES"] = array(
                                    $questionID,
                                    $tagID,

                                  );

          $result = insertData("questions/add/insertTag.txt", $bindings);
        }


        $data = array("RESULT"=> 1, "MESSAGE" => "Question was successfully asked!", "ID" => $questionID);
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
