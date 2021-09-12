<?php
require_once("././deleter.php");

$bindings["BINDING_TYPES"] = "i";
$bindings["VALUES"] = array(
                                $_POST["PATIENT_ID"]
                        );
$result = deleteData("patients/delete/delete.txt", $bindings);

$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Deleted!"];
} else {
        $data = ["RESULT" => "2", "MESSAGE" => "Unable to delete patient."];
}

// returnData is used in base.php
