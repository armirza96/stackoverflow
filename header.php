<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/main.css">

    <title><?= $title ?></title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-warning"> <a class="navbar-brand" href="index.php" data-abc="true">Slack Overflow</a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation"> 
         <span class="navbar-toggler-icon"></span> </button>
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"> <a class="nav-link" href="Login.php" data-abc="true">Login <span class="sr-only">(current)</span></a> </li>
                <li class="nav-item"> <a class="nav-link" href="SignUp.php" data-abc="true">SignUp</a> </li>
                <li class="nav-item"> <a class="nav-link" href="addquestion.php" data-abc="true">Ask a Question</a> </li>
                <li class="nav-item"> <a class="nav-link" href="profile.php" data-abc="true">Check User Profile</a> </li>
            </ul>
            <form onsubmit="event.preventDefault()" class="form-inline my-2 my-lg-0"> <input class="form-control mr-sm-2" type="text" placeholder="Search">
             <button class="btn btn-secondary my-2 my-sm-0 bg-secondary" type="submit">Search</button> </form>
        </div>
    </nav>
    <!-- <div class="topnav">
    <a class="active" href="index.php">Slack Overflow</a>

    <a href="Login.php">Log in</a>
    <a href="SignUp.php">Sign up</a>
    <a href="addquestion.php">Ask a Question</a>
    <a href="profile.php">Check User Profile</a>


    <form class="d-flex m-2 "> 
        <input class="form-control mr-2" type="search" placeholder="Search..." aria-label="Search"> 
        <button class="btn btn-outline-light" type="submit">Search</button> 
    </form> 
</div> -->

</body>

</html>