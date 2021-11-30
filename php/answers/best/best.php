<?php
$data = [];

/**
PHP needs: answerID, isAccepted
isAccepted: 1 (for accepted) or 0 (for not/removal of best answer).
HTTP method: POST
**/

session_start();

if(!isset($_SESSION["ACCID"])) {
  $data = array("RESULT"=> 2, "MESSAGE" => "Please login before changing the best answer.");
  return;
}

if(isset($_POST["answerID"]) && isset($_POST["isAccepted"])){

      $answerID = $_POST["answerID"];
      $questionID = $_POST["questionID"];
      $isAccepted = $_POST["isAccepted"];
      $accid = $_SESSION["ACCID"];
    //  echo $answerID;
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

        $bindings["BINDING_TYPES"] = "i";
        $bindings["VALUES"] = array(
                                  $questionID
                                );

        $result = getData("answers/best/get.txt", $bindings);
      //  print_r($result);
        if(is_array($result) && count($result) >= 1) {

          $result = $result[0];

        }
        //
        // best answer already exists we need to remove the old best answer and add this one
      //  print_r($result);
        if (array_key_exists("ID", $result)) {
          require "././updater.php";

          $bindings["BINDING_TYPES"] = "ii";
          $bindings["VALUES"] = array(
                                  0,
                                  $result["ID"]
                                );

          $updateResult = updateData("answers/best/update.txt", $bindings);
        //  print_r($updateResult);
          if ($updateResult["RESULT"] == 1) {

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
        //  echo 2;
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
