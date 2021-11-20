<?php
/**
Gets all the answers
**/

require_once("././getter.php");

$bindings["BINDING_TYPES"] = "i";
$bindings["VALUES"] = array($_GET["QUESTION_ID"]);

//print_r($bindings);
$data = getData("answers/get/get.txt", $bindings);
