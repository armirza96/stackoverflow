<?php
$title = "Stack Overflow - Where Developers Learn, Share, & Build Careers";

include("header.php");
// require_once("php/getter.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- bootstrap 5 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UserProfile</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>


    <div class="container">
        <h2>All Questions</h2>

        <!-- <div class="question_tab">
            <button type="button" class="btn btn-outline-secondary btn-sm">Newest</button>
            <button type="button" class="btn btn-outline-secondary btn-sm">Active</button>
            <button type="button" class="btn btn-outline-secondary btn-sm">Unanswered</button>
            <button type="button" class="btn btn-outline-secondary btn-sm">Filter</button>

        </div> -->
        <!-- <a class="question" href="Answer.php">How do I program?</a>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, quod facere! Aliquam sequi maiores nihil. Fugit architecto facere molestiae sint explicabo! Temporibus vel suscipit eius animi ratione adipisci rem nulla.
        <a class="question" href="Answer.php">How do I program?</a>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, quod facere! Aliquam sequi maiores nihil. Fugit architecto facere molestiae sint explicabo! Temporibus vel suscipit eius animi ratione adipisci rem nulla.
        <a class="question" href="Answer.php">How do I program?</a>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, quod facere! Aliquam sequi maiores nihil. Fugit architecto facere molestiae sint explicabo! Temporibus vel suscipit eius animi ratione adipisci rem nulla.
        <a class="question" href="Answer.php">How do I program?</a>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, quod facere! Aliquam sequi maiores nihil. Fugit architecto facere molestiae sint explicabo! Temporibus vel suscipit eius animi ratione adipisci rem nulla.
        <a class="question" href="Answer.php">How do I program?</a>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, quod facere! Aliquam sequi maiores nihil. Fugit architecto facere molestiae sint explicabo! Temporibus vel suscipit eius animi ratione adipisci rem nulla. -->
        <br>
        <br>

        <a href="addquestion.php" <button type="button" class="btn btn-outline-primary btn-sm">Ask Question</button> </a>

    </div>


    <?php include "shared/footer.php" ?>

    <script src="shared/js/shared.js"></script>

    <script type="text/javascript">


        $(document).ready(function () {
            dataToSend = {PAGE: "questions/get"};
            const queryString = window.location.search;
            console.log(queryString);
            const urlParams = new URLSearchParams(queryString);
            const search = urlParams.get('SEARCH')

            if(search) {
                dataToSend["SEARCH"] = search;
            }

            doAjaxCall(dataToSend, {callback: "onDataReceived", type: 'UI_UPDATE'}, 'GET');
         });

         function  onDataReceived(data) {
              // data is an json array of objects
              console.log(data);
              $("#id").append("<p>This is an example</p>");

              for (const element of data) {

                $(".container").append(`<a class='question' href='Answer.php?ID=${element.ID}'>
                                            <div class='row'>
                                                <div class='col-2'>
                                                    <span class="w-100 d-block text-center">
                                                        ${element.voteValue}
                                                    </span>

                                                    <span class="w-100 d-block text-center">
                                                    votes
                                                    </span>
                                                    <div class="${element.isAnswered == 1 ? "isAnswered": ""}">

                                                        <span class="w-100 d-block text-center">
                                                            ${element.totalAnswers}
                                                        </span>

                                                        <span class="w-100 d-block text-center">
                                                            answers
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class='col'>
                                                    <p style="font-size: 1em">
                                                        ${element.title}
                                                    </p>
                                                    <p style="font-size: 0.8em; color: #313638">
                                                        ${element.text}
                                                    </p>
                                                </div>

                                            </div>
                                        </a>`);

              }
         }


     </script>
</body>

</html>


<!-- <?php
// $title = "Stack Overflow - Where Developers Learn, Share, & Build Careers";

// include("header.php"); ?>

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

    <!-- </div>



</body>

</html> -->
