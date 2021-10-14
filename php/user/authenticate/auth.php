<?php
require_once("././getter.php");

$data = [];

$e = $_POST["email"];
$p = $_POST["pass"];

$bindings = [];

$bindings["BINDING_TYPES"] = "s";
$bindings["VALUES"] = array($email);

$user = getData("user/authentication/sql.txt")[0];

if(!empty($user)){
    $encrypted_pass = sha1($p);

    if(password_verify($p, $user["PASSWORD"])){

        $_SESSION["ACCID"] = $user["ACCOUNT_ID"];
        $data = array("RESULT" => "1");
    }else{
       $data = array("RESULT"=>"2", "ERROR" => "Password is incorrect.");
    }

} else {
    $data = array("RESULT"=>"2", "ERROR" => "Email does not exist.");
}
