<?php
function updateData($path, $bindings) {
  require 'connection.php';

  $myfile = fopen($path, "r") or die("Unable to open file!");

  $sql = fread($myfile,filesize($path));

  fclose($myfile);

  // these lines are needed when we need to bind parameters to our sql
  // prevents sql injection
   $stmt = $conn->prepare($sql);
  //


  $stmt->bind_param($bindings["BINDING_TYPES"], ...$bindings["VALUES"]);

  $result = $stmt->execute();

  if($result) {
    $data = array("RESULT"=> 1);
  } else {
     $data = array("RESULT"=> 2, "MESSAGE" => $conn->error);
  }

  $conn->close();

  return $data;
}
