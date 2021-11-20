<?php
$data = [];

/**
PHP needs: answerID, isAccepted
isAccepted: 1 (for accepted) or 0 (for not/removal of best answer).
HTTP method: POST
**/

if(!isset($_SESSION["ACCID"])) {
  $data = array("RESULT"=> 2, "MESSAGE" => "Please login before changing the best answer.");
  return;
}

if(isset($_POST["answerID"]) && isset($_POST["isAccepted"])){

      $answerID = $_POST["answerID"];
      $isAccepted = $_POST["isAccepted"];
      $accid = $_SESSION["ACCID"];

      $bindings = [];
      if($isAccepted === 0) {

        require "././updater.php";

        $bindings["BINDING_TYPES"] = "ii";
        $bindings["VALUES"] = array(
                                  $isAccepted,
                                  $answerID
                                );

        $result = update("answers/best/update.txt", $bindings);

        if ($result["RESULT"] === 1) {
          $data = array("RESULT"=> 1);
        } else {
          $data = array("RESULT"=> 2, "MESSAGE" => "Best answer was not removed.");
        }

      } else {
        require "././getter.php";

        $bindings["BINDING_TYPES"] = "ii";
        $bindings["VALUES"] = array(
                                  $isAccepted,
                                  $answerID
                                );

        $result = getData("answers/best/get.txt", $bindings);

        // best answer already exists we need to remove the old best answer and add this one
        if (!is_null($result["answerID"])) {
          require "././updater.php";

          $bindings["BINDING_TYPES"] = "ii";
          $bindings["VALUES"] = array(
                                  0,
                                  $result["answerID"]
                                );

          $result = updateData("answers/best/update.txt", $bindings);

          if ($result["RESULT"] === 1) {
            $bindings["BINDING_TYPES"] = "ii";
            $bindings["VALUES"] = array(
                                    $isAccepted,
                                    $answerID
                                  );

            $result = updateData("answers/best/update.txt", $bindings);

            $data = array("RESULT"=> 1, "MESSAGE" => "Best answer was updated");
          } else {
            $data = array("RESULT"=> 2, "MESSAGE" => "Best answer was  not updated.");
          }
        } else { // new best answer we need to update it in the db
          require "././updater.php";

          $bindings["BINDING_TYPES"] = "ii";
          $bindings["VALUES"] = array(
                                    $isAccepted,
                                    $answerID
                                );

          $result = updateData("answers/best/update.txt", $bindings);

          if ($result["RESULT"] === 1) {
            $data = array("RESULT"=> 1, "MESSAGE" => "Best answer was updated");
          } else {
            $data = array("RESULT"=> 2, "MESSAGE" => "Best answer was  not updated.");
          }
        }
      }

 } else {
    $data = array("RESULT"=> 2, "MESSAGE" => "Please input all required data.");
 }
