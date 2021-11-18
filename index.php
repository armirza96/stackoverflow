<?php
$title = "Stack Overflow - Where Developers Learn, Share, & Build Careers";

include("header.php"); ?>

<body>
    <div id="main-container" class="container">
        <h2>All Questions</h2>

        <div class="question_tab">
            <button type="button" class="btn btn-outline-secondary btn-sm">Newest</button>
            <button type="button" class="btn btn-outline-secondary btn-sm">Active</button>
            <button type="button" class="btn btn-outline-secondary btn-sm">Unanswered</button>
            <button type="button" class="btn btn-outline-secondary btn-sm">Filter</button>
        </div>

        <script>
            var questions = <?php echo file_get_contents("Questions.txt"); ?>;


            for (let i = 0; i < questions.length; i++) {
                var x = document.createElement("A");
                x.setAttribute("class", "question");
                var t = document.createTextNode(questions[i][0]);

                var link = "Answer.php?ID="+i;

                x.setAttribute("href", link);
                x.appendChild(t);

                var p = document.createElement("P");
                p.innerText = questions[i][1];

                var d = document.getElementById("main-container");

                d.appendChild(x);
                d.appendChild(p);
            }

        </script>
        <br>
        <br>
        <!--<button type="button" class="btn btn-outline-primary btn-sm">Ask Question</button>-->

    </div>



</body>

</html>
