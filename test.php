<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/main.css">

</head>

<body>
<br>

<div class="main" style="text-align:center">

    <form action="" method="post">
      <input type="text" id="send" name="send" required>
      <button name="bu" class="bu" style="width: 100px;">Send</button>
    </form>

    
    <?php
    if(isset($_POST['send']))
    {

      $myArr = json_decode(file_get_contents("Questions.txt")); 

      $x = $_POST['send'];
      $ar = array($x, "question", "tags", 0, false);
      $myArr.array_push( $myArr, $ar);

      $myJSON = json_encode($myArr);

      file_put_contents("Questions.txt", $myJSON);

    }
    ?>

    <form action="" method="post">
      <button name="view" class="view" style="width: 100px;">View</button>
    </form>

    <p id="test"></p>

    <?php
    if(isset($_POST['view']))
    {
        ?>

        <script>  
          var s = <?php echo file_get_contents("Questions.txt"); ?>;

          alert(s);

          document.getElementById("test").innerHTML = s;
        </script>
    
        <?php
    }
    ?>

</div>
</body>
</html>
