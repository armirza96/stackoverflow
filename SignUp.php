<?php include("header.php"); ?>

<body>
<link rel="stylesheet" href="css/signup.css"> 
<br>
    <h1 style="text-align:center;">Sign Up Page</h1>
<div class="main" style="text-align:center">
    <form action="SignUp.php">
        <label for="username"> Username:</label>
        <input type="text" id="username" name="username"><br><br>
        <label for="password"> Password:</label>
        <input type="text" id="password" name="password"><br><br>
        <input type="submit" value="SignUp" style="width: 100px;">
    </form>
</div>
</body>
</html>