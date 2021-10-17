<?php
$title = "Sign Up - Stack Overflow";

include("header.php"); ?>

<body>
<link rel="stylesheet" href="css/signup.css">
<br>
<h1 style="text-align:center;">Sign Up Page</h1>

<div class="main" style="text-align:center">
<div class="alert alert-success hide" role="alert" id="alert-success">
  This is a success alert—check it out!
</div>
<div class="alert alert-danger hide" role="alert" id="alert-danger">
  This is a danger alert—check it out!
</div>

    <form action="user/signup" id="signup">
        <label for="username"> <b>Username</b></label><br>
        <input type="text" id="username" name="username" required>
        <br><br>

        <label for="email"> <b>Email</b></label><br>
        <input type="text" id="email" name="email" required>
        <br><br>

        <label for="password"> <b>Password</b></label><br>
        <input type="password" id="password" name="password" required>

        <br><br>
    </form>
    <button onclick='submitForm("signup", "onDataReceived")' style="width: 100px;">Submit</button>
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
