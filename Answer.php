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
                    <button type="button" class="upvote">▲</button>
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
                    <button type="button" class="downvote">▼</button>
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

        <textarea id="answer-box" rows="8" cols="50" placeholder="Type your answer here..."></textarea>
    </div>

    <div id="answers-container">
        <table border="0" width="100%" id="answer-pane">
            <col style="width:5%"></col>
            <col style="width:90%"></col>
            <col style="width:5%"></col>

            <tr>
                <td style="text-align: center">
                    <button type="button" class="upvote">▲</button>
                </td>

                <td rowspan="3" class="answer-row">        
                    <p class="answer">Type "Hello World."</p>
                </td>

                <td rowspan="3" class="best-answer">
                    <!--<button type="button" class="best-answer-button"></button>-->
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-size: 20px">1</td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <button type="button" class="downvote">▼</button>
                </td>
            </tr>
        </table>

        <br>
    </div>
</div>

<br>
</body>
</html>