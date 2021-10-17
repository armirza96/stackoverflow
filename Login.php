<?php
$title = "Login";
include("header.php"); ?>

<body>

<link rel="stylesheet" href="css/login.css" />

    <div class="loginbox">
        <div class="alert alert-success hide" role="alert" id="alert-success">
          This is a success alert—check it out!
        </div>
        <div class="alert alert-danger hide" role="alert" id="alert-danger">
          This is a danger alert—check it out!
        </div>
      <img src="defaultpic.png" class="avatar" />
      <h1></h1>
      <form action="user/signin" id="signin">

        <p>Email</p>
        <input type="text" name="email" />
        <p>Password</p>
        <a href="#">Forgot Password?</a><br />
        <input type="password" name="password" />
        <!-- <input type="submit" name="" value="Login" /> -->

      </form>
      <button onclick='submitForm("signin", "onDataReceived")'>Login</button>
      <br />
      <a href="#">Don't have an account?</a>
    </div>


    <script src="shared/js/shared.js"></script>
    <script>

      function  onDataReceived(data) {
        if(data.RESULT == 1) {
          showAlert("alert-success",data.MESSAGE + '. ' + 'Redirecting in 3 seconds');
          redirectUser(`profile.php?ID=${data.ID}`,3000);
        } else {
          showAlert("alert-danger", data.MESSAGE);
        }
      }
    </script>
</body>
</html>
