<?php
require_once("././inserter.php");

$bindings = [];

$bindings["BINDING_TYPES"] = "isssssssiss";
$bindings["VALUES"] = array(
                                $_POST["AGE_GROUP"],
                                $_POST["FIRST_NAME"],
                                $_POST["LAST_NAME"],
                                $_POST["DOB"],
                                $_POST["PHONE"],
                                $_POST["ADDRESS"],
                                $_POST["CITY"],
                                $_POST["POSTAL_CODE"],
                                $_POST["PROVINCE"],
                                $_POST["EMAIL"],
                                $_POST["MEDICARE"]
                        );

$result = insertData("patients/add/addPatient.txt", $bindings);

$patientID = $result["LAST_INSERTED_ID"];

$bindings["BINDING_TYPES"] = "iis";
$bindings["VALUES"] = array(    $patientID,
                                $_POST["IS_CITIZEN"],
                                $_POST["ID_NUMBER"],
                        );
$result = insertData("patients/add/addCitizenshipStatus.txt", $bindings);


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Added!", "ID" => $patientID];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to add Patient."];
}

// returnData is used in base.php
// continues in delete.php
