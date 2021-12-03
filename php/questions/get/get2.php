<?php
/**
Gets all the questions
**/
require_once("././getter.php");

session_start();

$account_id = $_SESSION["ACCID"] ?? -1;

$bindings["BINDING_TYPES"] = "ii";
$bindings["VALUES"] = array($account_id, $account_id);

$sql = "

WITH cte_accepted_answers (questionIDOfAcceptedAnswers, ID,isAccepted) AS
(
  SELECT * FROM (
  	SELECT
  		Q.ID questionID,
  		A.ID answerID,
  		IFNULL(isAccepted,0) isAccepted
  	FROM Question Q
  		LEFT JOIN Answer A on A.questionID = Q.ID
      ) tbl
  WHERE
  	isAccepted = isAccepted
),
cte_matched_text(questionIDofMatchedText) AS
(
  SELECT
  	ID
  FROM
    Question Q
    WHERE 1
),
cte_same_ids(ID) AS (
  SELECT
	CTM.questionIDofMatchedText
  FROM
	 cte_matched_text CTM
   INNER JOIN cte_accepted_answers CAA on CTM.questionIDofMatchedText = CAA.questionIDOfAcceptedAnswers
)

SELECT
  Q.ID,
  Q.userID,
  Q.askedDate,
  Q.text,
  Q.title,
  COUNT(A.ID) As totalAnswers,
  CASE
    WHEN QV.userID = ? AND QV.directionOfVote = 'UP'
	   THEN 1
    WHEN QV.userID = ? AND QV.directionOfVote = 'DOWN'
	   THEN -1
	ELSE
		0
  END as vote,
  SUM(IF(QV.directionOfVote='UP',1,0)) - SUM(IF(QV.directionOfVote='DOWN',1,0)) voteValue,
  IF(A.isAccepted=1,1,0) as isAnswered
from cte_same_ids CSI
INNEr join question Q on Q.ID = CSI.ID
LEFT JOIN Answer A on A.questionID = Q.ID
LEFT JOIN QuestionVote QV on QV.questionID = Q.ID

";


if(isset($_GET["SEARCH"])) {
  $search = $_GET["SEARCH"];
  $words = [];
  $tags = [];
  $useisAnsweredColumn = false;
  $isAnsweredUsed;

  if(preg_match_all("/\[([A-Za-z0-9!@#\$%\^\&*\)\(+=._-]+)\]|(isanswered:(yes|no))|\w+/i", $search, $matches))
  {
    foreach($matches[0] as $word)
    {
      if($word[0] == '[') {
        $tags[] = substr($word, 1, -1);
      } else if(stripos($word, "isanswered") !== false){
        $isAnsweredUsed = $word;
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
  if(count($tags) > 0 || count($words) > 0 || !empty($isAnsweredUsed)) {

    // first we filter out the type of questions the user wants (isAnswered = 0 or 1 or may be all of them)
    if(!empty($isAnsweredUsed)) {
      $pieces = explode(":", $isAnsweredUsed);
      if(strcasecmp("yes",$pieces[1]) == 0) {
        $sql = str_replace("isAccepted = isAccepted", "IsAccepted = 1", $sql);
      } else {
        $sql = str_replace("isAccepted = isAccepted", "IsAccepted = 0", $sql);
      }
    }

    // 2nd we filter out the first results by any matching keywords if there are any
    if(count($words) > 0) {
      $searchTerms = "";
      foreach($words as $word) {
        $searchTerms .= " {$word}";
      }

      $sql = str_replace("WHERE 1", " WHERE MATCH(q.title, q.text) AGAINST('{$searchTerms}' IN NATURAL LANGUAGE MODE)", $sql);
    }

  // 3rd we filter out the 2nd results by any matching tags if there are any
    if(count($tags) > 0) {

      $predicate = "";
      foreach($tags as $tag) {
        $predicate .= "'{$tag}',";
      }

      $predicate = substr($predicate, 0, -1);

      // we inner join 2nr results by any question that has the matching keywords (has to have the minimum count or more)
      $sql .= "INNER JOIN (
                SELECT
                  Q.ID, title
                FROM question Q
                  INNEr JOIN QuestionTag QT on QT.questionID = Q.ID
                  INNEr JOIN (SELECT ID FROM Tag WHERE NAME IN ({$predicate})) T on T.ID = Qt.tagID
                GROUP BY
                Q.ID, title
              having count(*) >= (SELECT count(ID) FROM Tag WHERE NAME IN ({$predicate}))
          ) Q2 on Q2.ID = Q.ID";
    }

  }
}

// then we add the last bit of our code to remove any dupes by grouping the results
$sql .= "
GROUP BY
  Q.ID,
  Q.userID,
  Q.askedDate,
  Q.text,
  Qv.directionOfVote,
  A.isAccepted
";


//echo $sql;

// now that the SQL string is built we can send it to the db for execution
$data = getDataBySQL($sql, $bindings);
