<?php
$title = "Sign Up - Stack Overflow";

include("header.php"); 

?>

<!-- <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head> -->

<body>
<link rel="stylesheet" href="css/signup.css">
  <div class="jumbotron text-center">
      <h1>Create Your Account</h1>
  </div>

  <div class="d-flex justify-content-center">

  <div class="alert alert-success hide" role="alert" id="alert-success">
    This is a success alert—check it out!
  </div>
  <div class="alert alert-danger hide" role="alert" id="alert-danger">
    This is a danger alert—check it out!
  </div>

    <div id="box-content">
    <form action="user/signup" id="signup">
      <div class="form-group">
        <label for="username"><b>Username</b></label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="email"><b>Email</b></label>
        <input type="text" class="form-control" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password"><b>Password</b></label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <br>
      <button id="button" onclick='submitForm("signup", "onDataReceived")'>Submit</button>
    </form>
    </div>
  </div>

  <br>
  <div class="d-flex justify-content-center">
  <p>Already have an account? <a href="Login.php">Log in</a></p>
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
