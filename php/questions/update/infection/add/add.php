<?php
require_once("././inserter.php");

$patientID = $_POST["PATIENT_ID"];
$cureDate = $_POST["CURE_DATE"];

$bindings = [];
$result =  null;

if(!empty($cureDate)) {
        $bindings["BINDING_TYPES"] = "iiss";
        $bindings["VALUES"] = array(
                                        $patientID,
                                        $_POST["VARIANT"],
                                        $_POST["INFECTION_DATE"],
                                        $cureDate

                                );
        $result = insertData("patients/update/infection/add/addInfection.txt", $bindings);
} else {
        $bindings["BINDING_TYPES"] = "iis";
        $bindings["VALUES"] = array(
                                        $patientID,
                                        $_POST["VARIANT"],
                                        $_POST["INFECTION_DATE"]
                                );
        $result = insertData("patients/update/infection/add/addInfectionWithoutCureDate.txt", $bindings);
}


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Added Infection!", "ID" => $patientID];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add infection.", ];
}

// returnData is used in base.php
// continues in delete.php
