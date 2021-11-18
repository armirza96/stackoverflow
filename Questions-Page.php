<?php
include 'header.php';
?>
<link rel="stylesheet" href="Questions-Page.css" type="text/css">
<body>
    <div class = "container">
        <div class = "main">
            <div class = "question-page">
                <div id="Title-container">
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


                
                <?php
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
                ?>
                </div>
            </div>
        </div>

    </div>
    <link rel="stylesheet" href="css/main.css">
        <?php include "shared/footer.php" ?>
</body>

</html>
