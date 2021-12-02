<?php
$title = "Profile";
include("header.php");
require_once("php/getter.php");

//get user info
/**
Make sure the user id is in the url for the backend code to get the user
The data returned is in an array of associative ArrayAccess
 so arr[index]["column_name"] to access whatever object
**/

session_start();
$id = $_SESSION["ACCID"];
 $user = getData("php/user/get/byId/sql.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]])[0];
 $questions = getData("php/questions/get/byUser/sql.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]]);
 $answers = getData("php/questions/get/byUserWhoHasAnswered/sql.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserProfile</title>
    <link rel = "stylesheet" href="css/editprofile.css">
</head>
<body>

    <div class="box">
    <h1>User Profile</h1>
        <img src = "profilepic.png"></image>
        <label for ="file">Edit Image</label>

        <input type = "file" name="" id="file" accept="image/*">
        <h3>Display Name:</h3>
        <h4>Your display name will be shown on your posts and comments</h4>
        <input type="text" name="" placeholder="Name" value="<?=$user["userName"] ?>">
        <h3>Technology tags that interest you</h3>
        <h4>Picking tags will help us show you much more relevant questions and answers</h4>
        <input type = "email" name="" placeholder="javascript,java,c#,php,....">
        <h3>Are you interested in job opportunities?</h3>
        <h4>We put developers first. This information is never displayed on your public profile</h4>
        <input type ="text" name="" placeholder="Y/N">
        <button style="float: left;margin:10px 0 0 18.2%;">Cancel</button>
        <button style="float: right;margin:10px 18.2% 0 0;">Update</button>

    </div>

    <br>
    <div id="main-container" class="container m-0">
        <h3>Questions the user has asked</h3>
    <?php
      foreach($questions as &$question) {
          echo "<a class='question' href='Answer.php?ID={$question['ID']}'>".$question['title']."</a>";
      }
    ?>

    </div>
    <div  class="container m-0 mt-2">
        <h3>Questions the user has answered</h3>
    <?php
      foreach($answers as &$answer) {
          echo "<a class='question' href='Answer.php?ID={$question['ID']}'>".$answer['title']."</a>";
      }
    ?>

    </div>
</body>
</html>
