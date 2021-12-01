<?php

declare(strict_types=1);
session_start();

$root = dirname(__FILE__,2);
require($root . '/php/connection.php');
require($root . '/php/inserter.php');
require($root . '/php/getter.php');

class StackoverflowTest extends \PHPUnit\Framework\TestCase {
    public function testConnection(){
        //Verify if connection to the database can be established
        $conn = new mysqli("localhost", "root", "", "test", 3306);
        if($conn->connect_error) {
            $this->assertTrue(false);
        }
        else{
            $this->assertTrue(true);
        }
        $conn->close();
    }

    public function testCreateUser(){
        //Check if account can be created
        $conn = new mysqli("localhost", "root", "", "test", 3306);

        $users = getData("php/user/get/sql.txt");
        $lastUser = end($users);        //get the array of the last user that was added
        
        if($lastUser == false){         //if the user database is empty, then create a new user 
            $bindings = ["BINDING_TYPES" => "ssss", "VALUES"=>['TestUser','TestEmail','TestPass','']];
            $myfile = fopen("php/user/add/sql.txt", "r") or die("Unable to open file!");
            $sql = fread($myfile,filesize("php/user/add/sql.txt"));
            fclose($myfile);
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($bindings["BINDING_TYPES"], ...$bindings["VALUES"]);
            $result = $stmt->execute(); 
            $conn->close();    
            if($result){
                $this->assertTrue(true);
            }
            else{
                $this->assertTrue(false);
            }
        }
        elseif($lastUser['userName'] == "TestUser"){    //if there is another user by the same name, it means the user was successfully created
            $this->assertTrue(true);
        }
        else{
            $this->assertTrue(false);
        }
    }
    
    public function testUserCredentials(){
        //Verify if the correct username is received 
        require_once('./php/getter.php');
        $Name = getData("php/user/get/sql.txt");
        $lastName = end($Name);
        $this->assertEquals("TestUser",$lastName['userName']);
    }

    public function testUserPassword(){
        //Verify if the correct password is received
        $Passwords = getData("php/user/authenticate/sql.txt", ["BINDING_TYPES" => "s", "VALUES"=>['TestEmail']]);
        $lastPassword = end($Passwords);
        $this->assertEquals("TestPass",$lastPassword["PASSWORD"]);
    }

    public function testLogin(){
        //Verify if login is successful
        $Passwords = getData("php/user/authenticate/sql.txt", ["BINDING_TYPES" => "s", "VALUES"=>['TestEmail']]);
        $lastPassword = end($Passwords);
        $_SESSION["ACCID"] = $lastPassword["ID"];
        $status = session_status();
        $this->assertEquals('2',$status);
    }
    
    public function testAddQuestion(){
        //Verify if a question can be added 
        $conn = new mysqli("localhost", "root", "", "test", 3306);
        
        $questions = getData("php/questions/get/get.txt");
        $lastQuestion = end($questions);        //get the array of the last question that was added

        if($lastQuestion == false){             //if the question database is empty, then create a new question
            $bindings = ["BINDING_TYPES" => "is", "VALUES"=>[$_SESSION["ACCID"], 'TestQuestion']];
            $myfile = fopen("php/questions/add/sql.txt", "r") or die("Unable to open file!");
            $sql = fread($myfile,filesize("php/questions/add/sql.txt"));
            fclose($myfile);
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($bindings["BINDING_TYPES"], ...$bindings["VALUES"]);
            $result = $stmt->execute(); 
            $conn->close();    
            if($result){
                $this->assertTrue(true);
            }
            else{
                $this->assertTrue(false);
            }
        }
        elseif($lastQuestion['text'] == "TestQuestion"){    //if the same question is present in the database, it means that the question was successfully added
            $this->assertTrue(true);
        }
        else{
            $this->assertTrue(false);
        }
    }

    public function testGetQuestion(){
        //Verify if the question can be obtained from the database
        $questions = getData("php/questions/get/get.txt");
        $lastQuestion = end($questions);

        if($lastQuestion == false){
            $this->assertTrue(false);
        }
        else{
            $this->assertEquals("TestQuestion",$lastQuestion['text']); 
        }     
    }
 
    public function testAddAnswer(){
        //Verify if an answer can be submitted to a question
        $conn = new mysqli("localhost", "root", "", "test", 3306);
        
        $questions = getData("php/questions/get/get.txt");
        $lastQuestionID = end($questions)['ID'];
        $answer = getData("php/answers/get/get.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$lastQuestionID]]);
        $lastAnswer = end($answer);         //get the array of the last answer that was added for the 'test question'

        if($lastAnswer == false){           //if the answer database is empty, then create a new answer to the 'test question'
            $bindings = ["BINDING_TYPES" => "iis", "VALUES"=>[$lastQuestionID, $_SESSION["ACCID"], 'TestAnswer']];
            $path = "php/answers/add/sql.txt";
            $myfile = fopen($path, "r") or die("Unable to open file!");
            $sql = fread($myfile,filesize($path));
            fclose($myfile);
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($bindings["BINDING_TYPES"], ...$bindings["VALUES"]);
            $result = $stmt->execute();
            $conn->close(); 
            $this->assertEquals(true,$result);
        }
        elseif($lastAnswer['text'] == "TestAnswer"){    //if the same answer is present in the database, it means that the answer was successfully added
            $this->assertTrue(true);
        } 
        else{
            $this->assertTrue(false);
        }
    }
    
    public function testGetAnswer(){
        //Verify if the answer can be obtained from the database
        $questions = getData("php/questions/get/get.txt");
        $lastQuestionID = end($questions)['ID'];
        $answer = getData("php/answers/get/get.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$lastQuestionID]]);
        $lastAnswer = end($answer);

        if($lastAnswer == false){
            $this->assertTrue(false);
        }
        else{
            $this->assertEquals("TestAnswer",$lastAnswer['text']); 
        } 
    }

    public function testAddVote(){
        //Verify if a vote can be added to a question
        $conn = new mysqli("localhost", "root", "", "test", 3306);

        $questions = getData("php/questions/get/get.txt");
        $lastQuestionID = end($questions)['ID'];
        $vote = getData("php/questions/vote/get.txt", ["BINDING_TYPES" => "ii", "VALUES"=>[$lastQuestionID, $_SESSION["ACCID"]]]);
        $lastVote = end($vote);             //get the array of the last vote that was added for the 'test question'

        if($lastVote["RESULT"] == 0){       //if the vote database is empty, then create a new vote to the 'test question'
            $bindings = ["BINDING_TYPES" => "iis", "VALUES"=>[$lastQuestionID, $_SESSION["ACCID"], '1']];
            $path = "php/questions/vote/insert.txt";
            $myfile = fopen($path, "r") or die("Unable to open file!");
            $sql = fread($myfile,filesize($path));
            fclose($myfile);
            $stmt = $conn->prepare($sql);
            $stmt->bind_param($bindings["BINDING_TYPES"], ...$bindings["VALUES"]);
            $result = $stmt->execute();
            $conn->close();
            $this->assertEquals(true,$result);
        }
        elseif($lastVote["RESULT"] == 1){       //if the a vote is alreade present in the database, it means that the vote was successfully added
            $this->assertTrue(true);
        }
        else{
            $this->assertTrue(false);
        }
    }
}