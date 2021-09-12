
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.1.4/js.cookie.min.js" integrity="sha256-NjbogQqosWgor0UBdCURR5dzcvAgHnfUZMcZ8RCwkk8=" crossorigin="anonymous"></script>

<?php

  $jsFiles[] = '
                <script>$(document).ready(function () {
                      $("#sidebarCollapse").on("click", function () {
                          $("#sidebar").toggleClass("active");
                      });
                });</script>';
  $jsFiles[] = '<script src="js/js.js"></script>';

  $jsFiles = array_merge($jsFiles,$jsToAddAfter);

  if($jsFiles != null) {

    foreach($jsFiles as $file){
      echo $file;
    }
  }
?>
</body>
</html>
