<?php
/**
PHP needs: email, password
email: email of users
password: plaintext of the passowrd
**/

require_once("././getter.php");

$data = [];

$email = $_POST["email"];
$password = $_POST["password"];

$bindings = [];

$bindings["BINDING_TYPES"] = "s";
$bindings["VALUES"] = array($email);

if(!empty($user)) {
    $user = getData("user/authenticate/sql.txt", $bindings)[0];

    session_start();

    if(!empty($user)){
        //$encrypted_pass = sha1($password);

        if(password_verify($password, $user["PASSWORD"])){

            $_SESSION["ACCID"] = $user["ID"];
            $data = array("RESULT" => "1", "MESSAGE" => "Successfully logged in", "ID" => $user["ID"]);
        }else{
           $data = array("RESULT"=>"2", "MESSAGE" => "Password is incorrect");
        }

    } else {
        $data = array("RESULT"=>"2", "MESSAGE" => "Email does not exist");
    }
} else {
    $data = array("RESULT"=>"2", "MESSAGE" => "Email does not exist");
}
