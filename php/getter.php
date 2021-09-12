<?php
function getData($path, $bindings = null) {
  require 'connection.php';

  $myfile = fopen($path, "r") or die("Unable to open file!");

  $sql = fread($myfile,filesize($path));

  fclose($myfile);

  // these lines are needed when we need to bind parameters to our sql
  // prevents sql injection
   $stmt = $conn->prepare($sql);
  //

  if($bindings !== null && !empty($bindings)) {
     $stmt->bind_param($bindings["BINDING_TYPES"], ...$bindings["VALUES"]);
  }
  $stmt->execute();

  $result = $stmt->get_result();

  $data = [];

  while($row = $result->fetch_assoc()) {
    $data[] = $row;
  }

  $conn->close();

  // returns data as an array even if one element is fetched. Ex: array(array("last_name"=>"hello"));
  // access data needed using $data[0];
  return $data;
}
