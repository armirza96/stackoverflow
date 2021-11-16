<?php
include 'header.php';
?>
<link rel="stylesheet" href="Questions-Page.css" type="text/css">
<body>
    <!--<div class="sidebar">
            <ul>
                <li><a href="#home">Home</a></li>
                <li> <a href="#questions">Questions</a></li>
                <li><a href="#tag">Tag</a></li>
                <li> <a href="#user">User</a></li>
                <li> <a href="#teams">Teams</a></li>
            </ul>
    </div>-->
    <div class = "container">
        <div class = "main">
            <div class = "question-page">
                <div id="Title-container">
                        <p id = "Title-name">Title</p>
                        <p id = "Title-description">Be specific and imagine you're asking a question to another person</p>

                        <textarea id="title-box" class="box" rows="1" cols="101" placeholder="e.g. is there an R function for finding the index of an element in a vector?"></textarea>
                </div>

                <div id="Question-box-container">
                        <p id = "Body-name">Body</p>
                        <p id = "body-description">Include all the information someone would need to answer your question</p>

                        <div class="text-buttons">
                            <button class="button"><strong>B</strong></button>
                            <button class="button"><em>I</em></button>
                            <button class="button">IMG</button>
                            <button class="button">list</button>
                        </div>

                    <textarea id="question-box" class="question-box" rows="10" cols="101"></textarea>
                </div>

                    <div id="Tags-container">
                        <p id = "Tags-name">Tags</p>
                        <p id = "tags-description">Add up to X tags to describe what your question is about</p>

                        <textarea class="box" rows="1" cols="101" placeholder="e.g. (python windows ruby)"></textarea>
                    </div>
                <div>
                    <button class="btn btn-outline-primary btn-sm" onclick="post_question()">Post Question</button>
                </div>
            </div>
        </div>


        <script type="text/javascript">
            function post_question() {
                if(document.getElementById('question-box').value == "" || document.getElementById('title-box').value == "") {
                        alert("One of the fields is empty! Please complete them before submitting.");
                    }

                    else {
                        alert("the question will be alerted on this page for debug purposes.");
                        alert("title: " + document.getElementById('title-box').value);
                        alert("question: " + document.getElementById('question-box').value);
                    }
            }
        </script>
    </div>
    <link rel="stylesheet" href="css/main.css">
        <?php include "shared/footer.php" ?>
</body>

</html>
