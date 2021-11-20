<?php include("header.php"); ?>


<body>
<link rel="stylesheet" href="css/Answer.css">
<br>
<div class="main">
    <div id="question-container">
        <table border="0" width="100%" id="question-pane">
            <col style="width:5%"></col>
            <col style="width:95%"></col>

            <tr>
                <td style="text-align: center">
                    <form action="" method="post" id="more-q-form">
                        <button class="upvote" id="more-q" name="more-q">▲</button>
                    </form>
                </td>

                <td rowspan="3" style="padding-top:15px">        
                    <p id="question"></p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-size: 20px" id="votenum"></td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <form action="" method="post"  id="less-q-form">
                        <button class="downvote" id="less-q" name="less-q">▼</button>
                    </form>
                </td>
            </tr>
        </table>
    </div>

    <div id="question-explanation-container">
        <p id="question-explanation"></p>
    </div>

    <div id="tags">
        
    </div>
    <script>
            var s = <?php echo file_get_contents("Questions.txt"); ?>;
            var i = <?php echo $_GET['ID']; ?>;

            document.getElementById("question").innerText = s[i][0];
            document.getElementById("question-explanation").innerText = s[i][1];
            document.getElementById('votenum').innerText = s[i][3];

            if(s[i][2] != "") {
                var tag_array = s[i][2].split(',');
                var tags_div = document.getElementById("tags");

                for(var x = 0; x < tag_array.length; x++) {
                    var q = document.createElement("BUTTON");
                    q.setAttribute("class", "btn btn-secondary btn-sm");
                    if(x == 0) 
                        q.setAttribute("style", "margin-bottom: 15px;margin-left: 5%;");
                    else 
                        q.setAttribute("style", "margin-bottom: 15px;margin-left: 5px;");

                    var text = document.createTextNode(tag_array[x]);
                    q.appendChild(text);

                    tags_div.appendChild(q);
                }
            }
    </script>

    <?php 
        if(isset($_POST['more-q'])) { 
            
            $myArr = json_decode(file_get_contents("Questions.txt")); 
            $id = $_GET['ID'];

            $myArr[$id][3] = $myArr[$id][3] + 1;

            $myJSON = json_encode($myArr);

            file_put_contents("Questions.txt", $myJSON);

            ?> 
            <script>
                var s = <?php echo file_get_contents("Questions.txt"); ?>;
                var i = <?php echo $_GET['ID']; ?>;
                document.getElementById('votenum').innerText = s[i][3];

                if(s[i][3] == 2) {
                    document.getElementById("more-q").setAttribute("style", "color: #FFC800");

                    document.getElementById("more-q").disabled = true;
                    document.getElementById("less-q").disabled = false;
                }  
            </script>
            <?php

           
            unset($_POST['more-q']);
        }

        if(isset($_POST['less-q'])) {             
            $myArr = json_decode(file_get_contents("Questions.txt")); 
            $id = $_GET['ID'];

            $myArr[$id][3] = $myArr[$id][3] - 1;

            $myJSON = json_encode($myArr);

            file_put_contents("Questions.txt", $myJSON);

            ?> 
            <script>
                var s = <?php echo file_get_contents("Questions.txt"); ?>;
                var i = <?php echo $_GET['ID']; ?>;
                document.getElementById('votenum').innerText = s[i][3];

                if(s[i][3] == 0) {
                    document.getElementById("less-q").setAttribute("style", "color: #F42272");

                    document.getElementById("less-q").disabled = true;
                    document.getElementById("more-q").disabled = false;
                }

            </script>
            <?php

           
            unset($_POST['less-q']);
        }

        ?> 
        
        
        

</div>

<br>

<div class="main">
    <div id="answer-box-container">
        <p id="answer-box-name">Your Answer</p>

        <div class="text-buttons">
            <button class="button"><strong>B</strong></button>
            <button class="button"><em>I</em></button>
            <button class="button">IMG</button>
            <button class="button">list</button>
        </div>

        <textarea name="answer-box" id="answer-box" rows="8" cols="50" placeholder="Type your answer here..." form="answer-form" required></textarea>

        <form action="" method="post" id="answer-form">
            <button style="width:100%">Submit</button>
        </form>

        <?php 
            if(isset($_POST['answer-box'])) {
                $myArr2 = json_decode(file_get_contents("Answers.txt")); 
                $id = $_GET['ID'];
                $myArr = $myArr2[$id];
                $ar = array($_POST['answer-box'], 1, false);

                $myArr.array_push( $myArr, $ar);

                $myArr2[$id] = $myArr;

                $myJSON = json_encode($myArr2);

                file_put_contents("Answers.txt", $myJSON);

                unset($_POST['answer-box']);

                ?> 
                <script>
                    alert("Answer successfully sent!");
                </script>

                <?php

                unset($_POST['answer-box']);
            }
        ?>

    </div>

    <div id="answers-container">
        <table border="0" width="100%" id="answer-pane">
            <col style="width:5%"></col>
            <col style="width:90%"></col>
            <col style="width:5%"></col>
        </table>

        <br>

        <?php
            foreach($_POST as $key => $value) {
                //upvote
                if(isset($_POST[$key]) && $key[0] == 'u') {
                    $myArr2 = json_decode(file_get_contents("Answers.txt")); 
                    $id = $_GET['ID'];
                    $myArr = $myArr2[$id];

                    $myArr[$key[2]][1] = $myArr[$key[2]][1] + 1;

                    $myArr2[$id] = $myArr;

                    $myJSON = json_encode($myArr2);

                    file_put_contents("Answers.txt", $myJSON);

                    unset($_POST[$key]);
                }

                //downvote
                if(isset($_POST[$key]) && $key[0] == 'd') {
                    $myArr2 = json_decode(file_get_contents("Answers.txt")); 
                    $id = $_GET['ID'];
                    $myArr = $myArr2[$id];

                    $myArr[$key[2]][1] = $myArr[$key[2]][1] - 1;

                    $myArr2[$id] = $myArr;

                    $myJSON = json_encode($myArr2);

                    file_put_contents("Answers.txt", $myJSON);

                    unset($_POST[$key]);
                }

                //best
                /*if(isset($_POST[$key]) && $key[0] == 'b') {
                    $myArr2 = json_decode(file_get_contents("Answers.txt")); 
                    $id = $_GET['ID'];
                    $myArr = $myArr2[$id];

                    for ($x = 0; $x < count($myArr); $x++) {
                        $myArr[$x][2] = false;
                    }

                    $myArr[$key[2]][2] = true;

                    $myArr2[$id] = $myArr;

                    $myJSON = json_encode($myArr2);

                    file_put_contents("Answers.txt", $myJSON);

                    unset($_POST[$key]);
                }*/
            }
        ?>

        <script>
            var answers = <?php echo file_get_contents("Answers.txt"); ?>;
            var x = <?php echo $_GET['ID']; ?>;

            for (let i = 0; i < answers[x].length; i++) { 
                var table = document.getElementById("answer-pane");
                var row3 = table.insertRow(0);
                var row2 = table.insertRow(0);
                var row1 = table.insertRow(0);

                //creating rows
                var bestanswer_cell = row1.insertCell(0);
                var answer_cell = row1.insertCell(0);
                var upvote_cell = row1.insertCell(0);

                var votenum_cell = row2.insertCell(0);
                var downvote_cell = row3.insertCell(0);


                //creating best answer button
                var best_form = document.createElement("FORM");
                best_form.setAttribute("id", 'b'+x+''+i);
                best_form.setAttribute("method", "POST");

                var best_button = document.createElement("BUTTON");
                best_button.setAttribute("class", "best-answer-button");
                best_button.setAttribute("name", 'b'+x+''+i);
                best_button.setAttribute("id", 'b'+x+''+i);

                var star = document.createTextNode("★");
                best_button.appendChild(star);

                //creating upvote
                var upvote_form = document.createElement("FORM");
                upvote_form.setAttribute("id", 'u'+x+''+i);
                upvote_form.setAttribute("method", "POST");

                var upvote_button = document.createElement("BUTTON");
                upvote_button.setAttribute("class", "upvote");
                upvote_button.setAttribute("name", 'u'+x+''+i);
                upvote_button.setAttribute("id", 'u'+x+''+i);

                var up = document.createTextNode("▲");
                upvote_button.appendChild(up);


                //creating downvote
                var downvote_form = document.createElement("FORM");
                downvote_form.setAttribute("id", 'd'+x+''+i);
                downvote_form.setAttribute("method", "POST");

                var downvote_button = document.createElement("BUTTON");
                downvote_button.setAttribute("class", "downvote");
                downvote_button.setAttribute("name", 'd'+x+''+i);
                downvote_button.setAttribute("id", 'd'+x+''+i);

                var down = document.createTextNode("▼");
                downvote_button.appendChild(down);

                //set answer value in new answer row
                answer_cell.innerHTML = answers[x][i][0];
                
                //Set vote value
                votenum_cell.innerHTML = answers[x][i][1];
                table.rows[1].cells[0].setAttribute("style", "text-align: center; font-size: 20px");

                //correct size for rows
                table.rows[0].cells[1].rowSpan = "3";
                table.rows[0].cells[1].setAttribute("style", "font-size: 18px; text-decoration: none; color: black; text-align: left");
                table.rows[0].cells[1].setAttribute("class", "answer-row");
                table.rows[0].cells[2].rowSpan = "3";

                //appending buttons
                best_form.append(best_button);
                table.rows[0].cells[2].appendChild(best_form);

                upvote_form.appendChild(upvote_button);
                table.rows[0].cells[0].appendChild(upvote_form);

                downvote_form.appendChild(downvote_button);
                table.rows[2].cells[0].appendChild(downvote_form);
            }

            const collect = document.getElementsByTagName("BUTTON");

            for( let i = 0; i < collect.length; i++) {
                if(collect[i].id[0] == 'u') {
                    var t = collect[i].parentNode.parentNode.parentNode.rowIndex;
                    var r = document.getElementById("answer-pane").rows[t+1].cells[0];
                    document.getElementById("answer-pane").rows[t+2].cells[0].childNodes[0].setAttribute("style", "color: #cccccc");


                    if(r.innerText == "2") {
                        collect[i].setAttribute("style", "color: #FFC800");

                        collect[i].disabled = true;
                        document.getElementById("answer-pane").rows[t+2].cells[0].childNodes[0].disabled = false;
                    }
                }
                if(collect[i].id[0] == 'd') {
                    var t = collect[i].parentNode.parentNode.parentNode.rowIndex;
                    var r = document.getElementById("answer-pane").rows[t-1].cells[0];
                    document.getElementById("answer-pane").rows[t-2].cells[0].childNodes[0].setAttribute("style", "color: #cccccc");

                    if(r.innerText == "0") {
                        collect[i].setAttribute("style", "color: #F42272");

                        collect[i].disabled = true;
                        document.getElementById("answer-pane").rows[t-2].cells[0].childNodes[0].disabled = false;
                    }
                } 
                
                /*if(collect[i].id[0] == 'b' ) {
                    if(answers[x][collect[i].id[2]][2]) {
                        if(document.getElementById("answer-pane").rows.length != 3)  {
                            var t = collect[i].parentNode.parentNode.parentNode.rowIndex;
                            var r1 = document.getElementById("answer-pane").rows[t];
                            var r3 = document.getElementById("answer-pane").rows[t+3];
                            var pane = document.getElementById("answer-pane");

                            while(r1 != pane.rows[0]) {
                                pane.insertBefore(pane.rows[0], r3);
                                pane.insertBefore(pane.rows[0], r3);
                                pane.insertBefore(pane.rows[0], r3);
                            }
                        }

                        collect[i].setAttribute("style", "color: #5bc0eb");
                        collect[i].disabled = true;
                    }
                    
                    else {
                        collect[i].setAttribute("style", "color: #cccccc");
                        collect[i].disabled = false;
                    }
                }*/
            }
        </script>

    </div>
</div>

<br>
</body>
</html>