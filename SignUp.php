<?php include("header.php"); ?>

<head>
   <link rel="stylesheet" href="css\signup.css"> 
</head>

<body>
    <h1>Sign Up Page</h1>
<div class="main">
    <div id="box-content">
    <form action="SignUp.php">
        <label for="username"> <b>Username</b></label><br>
        <input type="text" id="username" name="username"><br><br>
        <label for="email"> <b>Email</b></label><br>
        <input type="text" id="email" name="email"><br><br>
        <label for="password"> <b>Password</b></label><br>
        <input type="text" id="password" name="password"><br><br>
        <input type="submit" value="Sign Up">
    </form>
    </div>
</div>

<p>Already have an account? <a href="Login.php">Log in</a></p>

</body>
</html>
