<?php include("header.php"); ?>

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
        <input type="text" name="" placeholder="Name">
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
    
</body>
</html>
