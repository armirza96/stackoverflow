<?php
/**
** this file is used for getting/insert/updating data that is sent through js
**/
$pageToHit = $_GET["PAGE"] ?? $_POST["PAGE"];

$data = [];

switch($pageToHit) {
  case "questions/get":
    require_once("questions/get/get.php");
  break;
  default:
    $data = ["RESULT" => "2", "MESSAGE" => "Command not added to base.php"];
  break;
}

echo json_encode($data);
