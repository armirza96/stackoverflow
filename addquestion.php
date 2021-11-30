<?php
include 'header.php';
?>
<link rel="stylesheet" href="Questions-Page.css" type="text/css">
<body>
    <div class = "container">
        <div class = "main">
            <div class = "question-page">
            <form action="postQuestion" id="validQuestion">
                <div id="Title-container">
                    <div class="alert alert-success hide" role="alert" id="alert-success">
                        This is a success alert—check it out!
                        </div>
                    <div class="alert alert-danger hide" role="alert" id="alert-danger">
                         This is a danger alert—check it out!
                        </div>
                        <p id = "Title-name">Title</p>
                        <p id = "Title-description">Be specific and imagine you're asking a question to another person</p>

                        <textarea id="title-box" name="title-box" class="box" rows="1" cols="101" form="send-form" placeholder="e.g. is there an R function for finding the index of an element in a vector?" required></textarea> 
                    </div>

                <div id="Question-box-container">
                        <p id = "Body-name">Body</p>
                        <p id = "body-description">Include all the information someone would need to answer your question</p>
                        <textarea name="question-box" id="question-box" class="question-box" rows="10" cols="101" form="send-form" required></textarea>                        
                </div>

                <div id="Tags-container">
                    <p id = "Tags-name">Tags</p>
                    <input type="text" name="tags" />
                    <select name="tags" id="tags"></select>
                </div>
                <div>

                <form action="" method="post" id="send-form"> 
                        <button name="bu" class="btn btn-outline-primary btn-sm" onclick='submitForm("validQuestion", "onDataReceived")'>Post Question</button>
                </form>  
      <br />
      <script src="shared/js/shared.js"></script>
    <script>
        $(document).ready(function () {
            dataToSend = {PAGE: "tag/get"};
            doAjaxCall(dataToSend, {callback: "onDataReceivedTag", type: 'UI_UPDATE'}, 'GET');
         });

      function  onDataReceived(data) {
        if(data.RESULT == 1) {
          showAlert("alert-success",data.MESSAGE + '. ' + 'Redirecting in 3 seconds');
          redirectUser(`Answer.php?ID=${data.ID}`,3000);
        } else {
          showAlert("alert-danger", data.MESSAGE);
        }
      }
      function  onDataReceivedTag(data) {
              // data is an json array of objects
              console.log(data);
              $("#id").append("<p>This is an example</p>");

              for (const element of data) {

                $("#tags").append(`<option  value='${element.name}'>${element.name}</option>`)

              }
         }
    </script>
 
                </div>
            </div>
        </div>

    </div>
    <link rel="stylesheet" href="css/main.css">
        <?php include "shared/footer.php" ?>
</body>

</html>
