<?php
/**
Gets all the questions
**/
require_once("././getter.php");

session_start();

$account_id = $_SESSION["ACCID"] ?? -1;

$bindings["BINDING_TYPES"] = "ii";
$bindings["VALUES"] = array($account_id, $account_id);

if(isset($_GET[" SEARCH"])) {
  $search = $_GET["SEARCH"];

  if(preg_match_all("/\[([A-Za-z0-9]+)\]|(isanswered:(yes|no))|\w+/i", $search, $matches))
  {
    print_r($matches);
  }
}



$data = getData("questions/get/get.txt", $bindings);
