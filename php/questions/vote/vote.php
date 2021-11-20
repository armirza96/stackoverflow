<?php
$data = [];

/**
PHP needs: questionID and voteDirection as parameters
questionID: the id of the question the user is voting on
voteDirection: 0 is sent if the user is removing the vote, -1 if theyre downvoting, 1 if theyre upvoting
**/

if(!isset($_SESSION["ACCID"])) {
  $data = array("RESULT"=> 2, "MESSAGE" => "Please login before voting.");
  return;
}

if(isset($_POST["questionID"]) && isset($_POST["voteDirection"])){

      $newVoteDirection = $_POST["voteDirection"]; // -1 for downvote, 0 for removal of vote, 1 for upvote
      $questionID = $_POST["questionID"];
      $accid = $_SESSION["ACCID"];

      $bindings = [];
      if($newVoteDirection === 0) {

        require "././deleter.php";

        $bindings["BINDING_TYPES"] = "ii";
        $bindings["VALUES"] = array(
                                  $questionID,
                                  $accid
                                );

        $result = deleteData("vote/delete.txt", $bindings);

        if ($result["RESULT"] === 1) {
          $data = array("RESULT"=> 1);
        } else {
          $data = array("RESULT"=> 2, "MESSAGE" => "Vote was not removed.");
        }

      } else {
        require "././getter.php";

        $newVoteDirectionValue = $newVoteDirection === 1 ? "UP" : "DOWN";

        $bindings["BINDING_TYPES"] = "ii";
        $bindings["VALUES"] = array(
                                  $questionID,
                                  $accid
                                );

        $result = getData("questions/vote/get.txt", $bindings);

        // vote already exists we need to update the current vote value
        if ($result["RESULT"] === 1) {
          require "././updater.php";

          $bindings["BINDING_TYPES"] = "iis";
          $bindings["VALUES"] = array(
                                    $questionID,
                                    $accid,
                                    b
                                  );

          $result = updateData("questions/vote/update.txt", $bindings);

          if ($result["RESULT"] === 1) {
            $data = array("RESULT"=> 1, "MESSAGE" => "Vote was updated");
          } else {
            $data = array("RESULT"=> 2, "MESSAGE" => "Vote was not updated.");
          }
        } else { // new vote we need to add it to the db
          require "././inserter.php";
          $bindings["BINDING_TYPES"] = "iis";
          $bindings["VALUES"] = array(
                                    $questionID,
                                    $accid,
                                    $newVoteDirectionValue
                                  );

          $result = insertData("questions/vote/insert.txt", $bindings);

          if ($result["RESULT"] === 1) {
            $data = array("RESULT"=> 1, "MESSAGE" => "Vote was added");
          } else {
            $data = array("RESULT"=> 2, "MESSAGE" => "Vote was not added.");
          }
        }
      }

 } else {
    $data = array("RESULT"=> 2, "MESSAGE" => "Please input all required data.");
 }
