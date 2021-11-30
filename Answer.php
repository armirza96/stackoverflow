<?php include("header.php");

require_once("php/getter.php");

$id = $_GET["ID"];

session_start();

$account_id = $_SESSION["ACCID"] ?? -1;

$bindings["BINDING_TYPES"] = "iii";
$bindings["VALUES"] = array($account_id, $account_id, $id);

$question = getData("php/questions/get/byId/get.txt", $bindings)[0];

$answers = getData("php/answers/get/get.txt", $bindings);


?>

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
                    <button type="button" class="upvote <?php echo ($question["vote"] == 1 ? "upvote-voted": "") ?>" onclick="upvote(<?=$id ?>, 'questions/vote',this)">▲</button>
                </td>

                <td rowspan="3" style="padding-top:15px">
                    <p id="question"><?=$question["title"] ?></p>
                </td>
            </tr>
            <tr>
                <td style="text-align: center; font-size: 20px"><?=$question["voteValue"] ?></td>
            </tr>
            <tr>
                <td style="text-align: center">
                    <button type="button" class="downvote <?php echo ($question["vote"] == -1 ? "downvote-voted": "") ?>" onclick="downvote(<?=$id ?>,'questions/vote', this)">▼</button>
                </td>
            </tr>
        </table>
    </div>

    <div id="question-explanation-container">
        <p id="question-explanation">
        <?=$question["text"] ?>
        </p>
    </div>
</div>

<br>

<div class="main">
    <div id="answer-box-container">
        <p id="answer-box-name">Your Answer</p>
        <div class="alert alert-success hide" role="alert" id="alert-success">
          This is a success alert—check it out!
        </div>
        <div class="alert alert-danger hide" role="alert" id="alert-danger">
          This is a danger alert—check it out!
        </div>
        <div class="text-buttons">
            <button class="button"><strong>B</strong></button>
            <button class="button"><em>I</em></button>
            <button class="button">IMG</button>
            <button class="button">list</button>
        </div>

        <form method="post" action="answers/add" id="form">
            <input type="hidden" name="questionID" value="<?=$id?>"  />
            <textarea name="answer" id="answer-box" rows="8" cols="50" placeholder="Type your answer here..."></textarea>
        </form>

        <button type="button" style="width:100%" onclick="Answer()">Submit</button>

    </div>

    <div id="answers-container">
        <!-- <table border="0" width="100%" id="answer-pane">
            <col style="width:5%"></col>
            <col style="width:90%"></col>
            <col style="width:5%"></col>
        </table> -->
        <table border="0" width="100%" id="question-pane">
            <col style="width:5%"></col>
            <col style="width:95%"></col>

            <?php foreach($answers as &$answer) { ?>

                <tr>
                    <td style="text-align: center">
                        <button type="button" class="upvote <?php echo ($answer["vote"] == 1 ? "upvote-voted": "") ?>" onclick="upvote(<?=$answer["ID"] ?>,'answers/vote', this)">▲</button>
                    </td>

                    <td rowspan="3" align="left" style="padding-top:15px; font-size: 1em; color: #313638; vertical-align: top;">
                        <?=$answer["text"] ?>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; font-size: 20px"><?=$answer["voteValue"] ?></td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <button type="button" class="downvote <?php echo ($answer["vote"] == -1 ? "downvote-voted": "") ?>" onclick="downvote(<?=$answer["ID"] ?>,'answers/vote', this)">▼</button>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        <button type="button" onclick="best(<?=$answer["ID"] ?>,<?=$id ?>, this)" class="btn <?php echo ($answer["isAccepted"] == 1 ? "best btn-success": "") ?>" onclick="less_q(this)">&#x2714;</button>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <br>
            <script src="shared/js/shared.js"></script>

        <script type="text/javascript">
            function Answer() {
                if(document.getElementById('answer-box').value == "") {
                    alert("Answer Box empty! Please write an answer before submitting.");
                } else {
                    submitForm("form", "onDataReceived")
                }
            }

            function  onDataReceived(data) {
              if(data.RESULT == 1) {
                showAlert("alert-success",data.MESSAGE + ' Refreshing in 3 seconds');
                redirectUser(`Answer.php?ID=<?=$id?>`,3000);
              } else {
                showAlert("alert-danger", data.MESSAGE);
              }
            }

            function best(answerID, questionID, btn) {

                let isAccepted = 1;
                if(btn.classList.contains("best")) {
                    isAccepted = 0;
                }
                console.log(isAccepted);
                dataToSend = {PAGE: "answers/best", answerID: answerID, questionID: questionID,isAccepted: isAccepted};
                doAjaxCall(dataToSend, {callback: "onDataReceivedBestAnswer", type: 'UI_UPDATE'}, 'POST');
            }

            function  onDataReceivedBestAnswer(data) {
              if(data.RESULT == 1) {
                showAlert("alert-success",data.MESSAGE + ' Refreshing in 3 seconds');
                redirectUser(`Answer.php?ID=<?=$id?>`,3000);
              } else {
                showAlert("alert-danger", data.MESSAGE);
              }
            }

            function upvote(id, route,btn) {
                let voteDirection = 1;
                if(btn.classList.contains("upvote-voted")) {
                    voteDirection = 0;
                }
                console.log(voteDirection);
                dataToSend = {PAGE: route, id: id,voteDirection: voteDirection};
                doAjaxCall(dataToSend, {callback: "onDataReceivedVote", type: 'UI_UPDATE'}, 'POST');
            }

            function downvote(id, route,btn) {
                let voteDirection = -1;
                if(btn.classList.contains("downvote-voted")) {
                    voteDirection = 0;
                }
                console.log(voteDirection);
                dataToSend = {PAGE: route, id: id,voteDirection: voteDirection};
                doAjaxCall(dataToSend, {callback: "onDataReceivedVote", type: 'UI_UPDATE'}, 'POST');
            }

            function  onDataReceivedVote(data) {
              if(data.RESULT == 1) {
                showAlert("alert-success",data.MESSAGE + ' Refreshing in 3 seconds');
                redirectUser(`Answer.php?ID=<?=$id?>`,3000);
              } else {
                showAlert("alert-danger", data.MESSAGE);
              }
            }


        </script>
    </div>
</div>

<br>
</body>
</html>
