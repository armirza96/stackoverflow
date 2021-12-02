<?php

declare(strict_types=1);
session_start();

$root = dirname(__FILE__,2);
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
        //Verify if an account can be created
        $users = getData("php/user/get/sql.txt");
        $lastUser = end($users);                         //get the array of the last user that was added
        
        if($lastUser == false){                          //if the user database is empty, then create a new user 
            $result = insertData("php/user/add/sql.txt", ["BINDING_TYPES" => "ssss", "VALUES"=>['TestUser','TestEmail','TestPass','']]);
            $this->assertEquals(1,$result["RESULT"]);
        }
        elseif($lastUser['userName'] == "TestUser"){     //if there is another user by the same name, it means the user was successfully created
            $this->assertTrue(true);
        }
        else{
            $this->assertTrue(false);
        }
    }
    
    public function testUserCredentials(){
        //Verify if the correct username is received 
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
        $users = getData("php/user/get/sql.txt");
        $lastUser = end($users);                        //get the array of the last user that was added
        $id = $lastUser['ID'];

        $questions = getData("php/questions/get/byUser/sql.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]]);
        $lastQuestion = end($questions)['text'];        //get the last question that was added
        
        if(!isset($lastQuestion)){                      //if the question database is empty, then create a new question
            $result = insertData("php/questions/add/sql.txt", ["BINDING_TYPES" => "iss", "VALUES"=>[$_SESSION["ACCID"],'Title', 'TestQuestion']]);
            $this->assertEquals(1,$result["RESULT"]);
        }
        elseif($lastQuestion == "TestQuestion"){        //if the same question is present in the database, it means that the question was successfully added
            $this->assertTrue(true);
        }
        else{
            $this->assertTrue(false);
        } 
    }

    public function testGetQuestion(){
        //Verify if the question can be obtained from the database
        $users = getData("php/user/get/sql.txt");
        $lastUser = end($users);                        //get the array of the last user that was added
        $id = $lastUser['ID'];                          //get the id of that user to then obtain the question asked by that user
        
        $questions = getData("php/questions/get/byUser/sql.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]]);
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
        $users = getData("php/user/get/sql.txt");
        $lastUser = end($users);                        //get the array of the last user that was added
        $id = $lastUser['ID'];
        
        $questions = getData("php/questions/get/byUser/sql.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]]);
        $lastQuestionID = end($questions)['ID'];
       
        $answer = getData("php/answers/get/byUser/sql.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]]);
        $lastAnswer = end($answer);                     //get the array of the last answer that was added for the 'test question'

        if($lastAnswer == false){                       //if the answer database is empty, then create a new answer to the 'test question'
            $result = insertData("php/answers/add/sql.txt", ["BINDING_TYPES" => "iis", "VALUES"=>[$lastQuestionID, $_SESSION["ACCID"], 'TestAnswer']]);
            $this->assertEquals(1,$result["RESULT"]);
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
        $users = getData("php/user/get/sql.txt");
        $lastUser = end($users);                        //get the array of the last user that was added
        $id = $lastUser['ID'];

        $answer = getData("php/answers/get/byUser/sql.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]]);
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
        $users = getData("php/user/get/sql.txt");
        $lastUser = end($users);                        //get the array of the last user that was added
        $id = $lastUser['ID'];

        $questions = getData("php/questions/get/byUser/sql.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]]);
        $lastQuestionID = end($questions)['ID'];
        $vote = getData("php/questions/vote/get.txt", ["BINDING_TYPES" => "ii", "VALUES"=>[$lastQuestionID, $_SESSION["ACCID"]]]);
        $lastVote = end($vote);                         //get the array of the last vote that was added for the 'test question'

        if($lastVote["RESULT"] == 0){                   //if the vote database is empty, then create a new vote to the 'test question'
            $result = insertData("php/questions/vote/insert.txt", ["BINDING_TYPES" => "iis", "VALUES"=>[$lastQuestionID, $_SESSION["ACCID"], '1']]);
            $this->assertEquals(1,$result["RESULT"]);
        }
        elseif($lastVote["RESULT"] == 1){               //if the a vote is alreade present in the database, it means that the vote was successfully added
            $this->assertTrue(true);
        }
        else{
            $this->assertTrue(false);
        }
    }
}