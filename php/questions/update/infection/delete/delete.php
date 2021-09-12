<?php
require_once("././deleter.php");

$bindings = [];
$result =  null;

$bindings["BINDING_TYPES"] = "i";
$bindings["VALUES"] = array(
                              $_POST["INFECTION_ID"]


                            );
$result = deleteData("patients/update/infection/delete/delete.txt", $bindings);


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully deleted Infection!"];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to delete infection." ];
}

// returnData is used in base.php
// continues in delete.php
