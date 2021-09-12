<?php
require_once("././updater.php");

$patientID = $_POST["PATIENT_ID"];
$bindings = [];
$bindings["BINDING_TYPES"] = "isssssssissi";
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
                                $_POST["MEDICARE"],
                                $patientID
                        );

$result = updateData("patients/update/updatePatient.txt", $bindings);

$bindings["BINDING_TYPES"] = "isi";
$bindings["VALUES"] = array(
                                $_POST["IS_CITIZEN"],
                                $_POST["ID_NUMBER"],
                                $patientID
                        );

$result = updateData("patients/update/updateCitizenshipStatus.txt", $bindings);


$data = [];

if($result["RESULT"] === 1) {
        $data = ["RESULT" => "1", "MESSAGE" => "Successfully Updated!", "ID" => $patientID];
} else {
        $data = ["RESULT" => $result["RESULT"], "MESSAGE" => "Unable to upate Patient."];
}

// returnData is used in base.php
//
