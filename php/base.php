<?php
/**
** this file is used for getting/insert/updating data that is sent through js
**/
$pageToHit = $_GET["PAGE"] ?? $_POST["PAGE"];

$data = [];

switch($pageToHit) {
  case "user/signup":
    require_once("user/add/add.php");
  break;
  case "user/signin":
    require_once("user/authenticate/auth.php");
  break;
  case "questions/get":
    require_once("questions/get/get.php");
  break;
  case "questions/add":
    require_once("questions/add/add.php");
  break;
  case "questions/vote":
    require_once("questions/vote/vote.php");
  break;
  case "answers/get":
    require_once("answers/get/get.php");
  break;
  case "answers/add":
    require_once("answers/add/add.php");
  break;
  case "answers/vote":
    require_once("answers/vote/vote.php");
  break;
  case "answers/best":
    require_once("answers/best/best.php");
  break;
  default:
    $data = ["RESULT" => "2", "MESSAGE" => "Command not added to base.php"];
  break;
}

echo json_encode($data);
