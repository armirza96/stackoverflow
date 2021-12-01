<?php
/**
Gets all the questions
**/
require_once("././getter.php");

session_start();

$account_id = $_SESSION["ACCID"] ?? -1;

$bindings["BINDING_TYPES"] = "ii";
$bindings["VALUES"] = array($account_id, $account_id);

$sql = "SELECT
  Q.ID,
  Q.userID,
  Q.askedDate,
  Q.text,
  Q.title,
  COALESCE(COUNT(A.ID),0) As totalAnswers,
  COALESCE(CASE
    WHEN QV.userID = ? AND QV.directionOfVote = 'UP'
	   THEN 1
    WHEN QV.userID = ? AND QV.directionOfVote = 'DOWN'
	   THEN -1
  END, 0) as vote,
  SUM(IF(QV.directionOfVote='UP',1,0)) - SUM(IF(QV.directionOfVote='DOWN',1,0)) voteValue,
  A.isAccepted as isAnswered
FROM
  Question Q
LEFT JOIN Answer A on A.questionID = Q.ID
LEFT JOIN QuestionVote QV on QV.questionID = Q.ID
JOIN QuestionTag QT on QT.questionID = Q.ID
JOIN Tag T on T.ID = QT.tagID";


if(isset($_GET["SEARCH"])) {
  $search = $_GET["SEARCH"];
  $words = [];
  $tags = [];
  $useisAnsweredColumn = false;
  //echo $search . "<br>";

  if(preg_match_all("/\[([A-Za-z0-9]+)\]|(isanswered:(yes|no))|\w+/i", $search, $matches))
  {
    //print_r($matches);
    foreach($matches[0] as $word)
    {
    //  echo $word;

      if($word[0] == '[') {
        $tags[] = substr($word, 1, -1);
      } else if(stripos($word, "isanswered") !== false){
        $useisAnsweredColumn = true;
      }
      else
      {
        $words[] = $word;
      }

    }
  }

  // building dynamic query string for where clause
  // first we check if we need to have a where clause
  // then we check which parts of the where clause we need to build (tags or words)
  if(count($tags) > 0 || count($words) > 0 || $useisAnsweredColumn) {
    $sql .= " WHERE ";

    if(count($tags) > 0) {
      foreach($tags as $tag) {
        $sql .= " T.name = '{$tag}' AND";
      }
      $sql = substr($sql, 0, -3);
    }

    if(count($words) > 0) {
      if(count($tags) > 0) {
        $sql .= " AND ";
      }

      $searchTerms = "";
      foreach($words as $word) {
        $searchTerms .= " {$word}";
      }

      $sql .= "MATCH(q.title, q.text) AGAINST('{$searchTerms}' IN NATURAL LANGUAGE MODE)";
    }

    if($useisAnsweredColumn) {
      if(count($tags) > 0 || count($words) > 0) {
        $sql .= " AND";
      }
      $pieces = explode(":", $word);

      if(strcasecmp("yes",$pieces[1]) == 0) {
        $sql .= " A.isAccepted = 1";
      } else {
        $sql .= " A.isAccepted = 0";
      }
    }

  }
}

$sql .= "
GROUP BY
  Q.ID,
  Q.userID,
  Q.askedDate,
  Q.text
";

//echo $sql;

$data = getDataBySQL($sql, $bindings);
