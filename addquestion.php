<?php
include 'header.php';
?>
<link rel="stylesheet" href="Questions-Page.css" type="text/css">
<body>
    <div class = "container">
        <div class = "main">
            <div class = "question-page">
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

                        <!--<div class="text-buttons">
                            <button class="button"><strong>B</strong></button>
                            <button class="button"><em>I</em></button>
                            <button class="button">IMG</button>
                            <button class="button">list</button>
                        </div>-->

                        <textarea name="question-box" id="question-box" class="question-box" rows="10" cols="101" form="send-form" required></textarea>                        
                </div>

                <div id="Tags-container">
                    <p id = "Tags-name">Tags</p>
                    <p id = "tags-description">Add up to X tags to describe what your question is about</p>

                    <textarea name="tags-box" class="box" rows="1" cols="101" placeholder="e.g. (python windows ruby)" form="send-form"></textarea>
                </div>
                <div>

                <form action="" method="post" id="send-form"> 
                        <button name="bu" class="btn btn-outline-primary btn-sm">Post Question</button>
                </form>   

        <form action="postQuestion" id="validQuestion">

        <p>Title</p>
        <input type="text" name="title" />
        <p>Question</p>
        <input type="text" name="question" />
        <p>Tags</p>
        <input type="text" name="tags" />
        <select name="tags" id="tags"></select>
        <!-- <input type="submit" name="" value="Login" /> -->

      </form>

      <button onclick='submitForm("validQuestion", "onDataReceived")'>Post Question</button>
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
                
                <?php /*
                    if(isset($_POST['title-box']) && isset($_POST['question-box']))
                    {
                        $AnsArr = json_decode(file_get_contents("Answers.txt")); 
                        $arr = array();
                        $AnsArr.array_push($AnsArr, $arr);
                        $MJS = json_encode($AnsArr);
                        file_put_contents("Answers.txt", $MJS);

                        $myArr = json_decode(file_get_contents("Questions.txt")); 

                        $ar = array($_POST['title-box'], $_POST['question-box'], "", 1, false);


                        if(isset($_POST['tags-box'])) {
                            $ar[2] = $_POST['tags-box'];
                            unset($_POST['tags-box']);
                        }

                        $myArr.array_push( $myArr, $ar);

                        $myJSON = json_encode($myArr);

                        file_put_contents("Questions.txt", $myJSON);

                        unset($_POST['title-box']);
                        unset($_POST['question-box']);


                        ?> 
                            <script>
                                alert("Question successfully sent!");
                                window.location.replace("index.php");
                            </script>

                        <?php
                    }
                */?>
                </div>
            </div>
        </div>

    </div>
    <link rel="stylesheet" href="css/main.css">
        <?php include "shared/footer.php" ?>
</body>

</html>
