<?php
$pageToHit = $_GET["PAGE"] ?? $_POST["PAGE"];

$data = [];

switch($pageToHit) {
  case "getPatients":
    require_once("patients/get/getPatients.php");
  break;
  case "deletePatient":
    require_once("patients/delete/delete.php");
  break;
  case "addPatient":
    require_once("patients/add/add.php");
  break;
  case "updatePatient":
    require_once("patients/update/update.php");
  break;
  case "addInfection":
    require_once("patients/update/infection/add/add.php");
  break;
  case "deleteInfection":
    require_once("patients/update/infection/delete/delete.php");
  break;
  /////////////////////////////////////////////////////////////////////////// Employees
  case "healthcareWorker/get":
    require_once("healthcareWorker/get/get.php");
  break;
  case "healthcareWorker/delete":
    require_once("healthcareWorker/delete/delete.php");
  break;
  case "healthcareWorker/add":
    require_once("healthcareWorker/add/add.php");
  break;
  case "healthcareWorker/update":
    require_once("healthcareWorker/update/update.php");
  break;
  case "employee/record/add":
    require_once("healthcareWorker/update/employmentRecords/add/add.php");
  break;
  case "employmentRecord/delete":
    require_once("healthcareWorker/update/employmentRecords/delete/delete.php");
  break;
  case "employmentRecord/get":
    require_once("healthcareWorker/get/getRecordHealthCareWorkers.php");
  break;
  /////////////////////////////////////////////////////////////////////////// variants
  case "variants/get":
    require_once("variants/get/get.php");
  break;
  case "variants/update":
    require_once("variants/update/update.php");
  break;
  case "variants/add":
    require_once("variants/add/add.php");
  break;
  case "variants/delete":
    require_once("variants/delete/delete.php");
  break;
  ///////////////////////////////////////////////////////////////////////////// VACCINES
  case "vaccines/get":
    require_once("vaccines/get/get.php");
  break;
  case "vaccines/update":
    require_once("vaccines/update/update.php");
  break;
  case "vaccines/add":
    require_once("vaccines/add/add.php");
  break;
  case "vaccines/delete":
    require_once("vaccines/delete/delete.php");
  break;
  case "vaccines/status/add":
    require_once("vaccines/update/status/add/add.php");
  break;
  case "vaccines/status/update":
    require_once("vaccines/update/status/update/update.php");
  break;
  case "vaccines/perform":
    require_once("vaccines/perform/add.php");
  break;
  ///////////////////////////////////////////////////////////////////////////// Provinces
   case "provinces/get":
     require_once("provinces/get/get.php");
   break;
   case "provinces/update":
     require_once("provinces/update/update.php");
   break;
   case "provinces/add":
     require_once("provinces/add/add.php");
   break;
   case "provinces/delete":
     require_once("provinces/delete/delete.php");
   break;
   ///////////////////////////////////////////////////////////////////////////// Age Groups
    case "ageGroups/get":
      require_once("ageGroups/get/get.php");
    break;
    case "ageGroups/update":
      require_once("ageGroups/update/update.php");
    break;
    case "ageGroups/add":
      require_once("ageGroups/add/add.php");
    break;
    case "ageGroups/delete":
      require_once("ageGroups/delete/delete.php");
    break;
    /////////////////////////////////////////////////////////////////////////// Facilities
    case "facility/get":
      require_once("facility/get/get.php");
    break;
    case "facility/update":
      require_once("facility/update/update.php");
    break;
    case "facility/add":
      require_once("facility/add/add.php");
    break;
    case "facility/delete":
      require_once("facility/delete/delete.php");
    break;
    /////////////////////////////////////////////////////////////////////////// Shipments
    case "shipments/add":
      require_once("shipments/add/add.php");
    break;
    ////////////////////////////////////////////////////////////////////////// Transfer
    case "transfer/add":
      require_once("transfer/check_transfer/check_transfer.php");
    break;
  default:
    $data = ["RESULT" => "2", "MESSAGE" => "Command not added to base.php"];
  break;
}

echo json_encode($data);
