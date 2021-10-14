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
                    <button type="button" class="upvote" onclick="more(this)">▲</button>
                </td>

                <td rowspan="3" style="padding-top:15px">        
                    <p id="question">How do I program?</p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-size: 20px">1</td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <button type="button" class="downvote" onclick="less(this)">▼</button>
                </td>
            </tr>
        </table>
    </div>

    <div id="question-explanation-container">
        <p id="question-explanation">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi 
        ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit 
        in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur 
        sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
        mollit anim id est laborum.
        </p>
    </div>
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

        <form method="post" action="Answer.php">
            <textarea name="ans" id="answer-box" rows="8" cols="50" placeholder="Type your answer here..."></textarea>
        </form>

        <button type="button" style="width:100%" onclick="Answer()">Submit</button>
    </div>

    <div id="answers-container">
        <table border="0" width="100%" id="answer-pane">
            <col style="width:5%"></col>
            <col style="width:90%"></col>
            <col style="width:5%"></col>

            <!--<tr>
                <td style="text-align: center">
                    <button type="button" class="upvote">▲</button>
                </td>

                <td rowspan="3" class="answer-row">        
                    <p class="answer"> test</p>
                </td>

                <td rowspan="3" class="best-answer">
                    <button type="button" class="best-answer-button">★</button>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-size: 20px">1</td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <button type="button" class="downvote">▼</button>
                </td>
            </tr>-->
        </table>

        <br>

        <script type="text/javascript"> 
            function Answer() {
                alert('Answer has been submitted.');
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
                var best_button = document.createElement("BUTTON");
                best_button.setAttribute("class", "best-answer-button");
                var star = document.createTextNode("★");
                best_button.appendChild(star);

                //creating upvote
                var upvote_button = document.createElement("BUTTON");
                upvote_button.setAttribute("class", "upvote");
                var up = document.createTextNode("▲");
                upvote_button.appendChild(up);

                //creating downvote
                var downvote_button = document.createElement("BUTTON");
                downvote_button.setAttribute("class", "downvote");
                var down = document.createTextNode("▼");

                downvote_button.appendChild(down);

                //giving buttons their actions
                best_button.setAttribute('onclick', 'best(this)');
                upvote_button.setAttribute('onclick', 'more(this)');
                downvote_button.setAttribute('onclick', 'less(this)');

                //set answer value in new answer row
                answer_cell.innerHTML = document.getElementById('answer-box').value;
                
                //Set vote value
                votenum_cell.innerHTML = 1;
                table.rows[1].cells[0].setAttribute("style", "text-align: center; font-size: 20px");

                //correct size for rows
                table.rows[0].cells[1].rowSpan = "3";
                table.rows[0].cells[1].setAttribute("style", "font-size: 18px; text-decoration: none; color: black; text-align: left");
                table.rows[0].cells[1].setAttribute("class", "answer-row");
                table.rows[0].cells[2].rowSpan = "3";

                //appending buttons
                table.rows[0].cells[2].appendChild(best_button);
                table.rows[0].cells[0].appendChild(upvote_button);
                table.rows[2].cells[0].appendChild(downvote_button);

                //empty the answer box when done
                document.getElementById('answer-box').value = "";
            }

            //TODO
            //send data to database
            //Do best answer function

            function best(oButton) {
                //Figure out top boost for the best button

            }

            function more(oButton) {
                var t = oButton.parentNode.parentNode.rowIndex;
                var r = document.getElementById("answer-pane").rows[t+1].cells[0];

                var val = +r.innerHTML; //replace with getting the number from the database
                r.innerHTML = val + 1;

                document.getElementById("answer-pane").rows[t+2].cells[0].childNodes[0].setAttribute("style", "color: #cccccc");

                if(+r.innerHTML == 2) {
                    oButton.setAttribute("style", "color: #FFC800");

                    oButton.disabled = true;
                    document.getElementById("answer-pane").rows[t+2].cells[0].childNodes[0].disabled = false;
                }
            }

            function less(oButton) {
                var t = oButton.parentNode.parentNode.rowIndex;
                var r = document.getElementById("answer-pane").rows[t-1].cells[0];

                var val = +r.innerHTML; //replace with getting the number from the database
                r.innerHTML = val - 1;

                document.getElementById("answer-pane").rows[t-2].cells[0].childNodes[0].setAttribute("style", "color: #cccccc");

                if(+r.innerHTML == 0) {
                    oButton.setAttribute("style", "color: #F42272");

                    oButton.disabled = true;
                    document.getElementById("answer-pane").rows[t-2].cells[0].childNodes[0].disabled = false;
                }
            }
        </script>
    </div>
</div>

<br>
</body>
</html>