# stackoverflow
https://docs.google.com/document/d/1pOacO4mb_NoBhThXgGI7XlV7jtO9KkaL7A30eXk4nPk/edit < This google doc posesses all the info for the project description, major features, website overview, Task seperation, future task ideas and goals for each sprint. We will, however, summarize the relevant ones for this readme here:

# Project Description

OBJECTIVE: Program a Stack Overflow-like website.

MAJOR FEATURES:
1- Asking and Answering programming questions.
2- Voting on Answers.
3- Accept the best answer.

DESCRIPTION: We as a team have to code and host a website similar to Stack Overflow. In it, users can log in, ask questions about programming, have those questions be answered by other users (logged in or not) and let users (logged in) vote on answers and questions. The user who asked the question can pick the best answer, causing their question to become “solved” and have a special status.

LANGUAGES: Php, Javascript, HTML, CSS, MySQL, possibly more

## Meetings
As this is a private repository, we do not have the capability to write a wiki - we will correct this for the first sprint, but for now I will share screenshots of the important parts of our meeting on discord:

https://imgur.com/a/dRuVNge < Meeting screenshots

## Team Members:
- Meet Vora (40155271) / GitHub ID: Itsmeeeet
- Bilal Yattou (40110820) Section SD / GitHub ID: Bilal-yat
- Kunal Shah (40153500) / Github ID: Kunal22shah
- Abdul-Rahman Mirza (40058876) / GitHub ID: foxdye96
- Najeeb Hyatoolla (40133092) / GitHub ID: NajeebH
- Daniel Henriques da Silva (40157010) / Github ID: D-H-S
- Haytham Hnine (40128181) / GitHub ID: haytham5

# How the code works
When developing a core/feature implementation theres 3 parts:
 - UI/JS
 - Php
 - sql

To get information from the db can happen two ways
 1. Through listing multiple items (like questions, answers, users). This wil happen through JS
 2. Loading the information server side.

To get each of these working follow the correct steps:
 - Loading multiple pieces of the same data / Working with JS
  If you wanna list multiple things its best to hit the db after the page loads so that not too much data is returned or locks up the page.
  Before beginning check the file in the php folder base.php that your route exists.

  1. first include this bit of code at the bottom of your page:
    <body>
      <html code>
      ....
      <script src="shared/js/shared.js"></script>
    </body>
  2. Then on page load call this method:
      doAjaxCall(dataToSend, {callback: callback, type: 'UI_UPDATE'}, 'GET');

      dataToSend is a associate array and always has the route of the data youre trying to getter
       ex: dataToSend = {PAGE: "questions/get"}; // getting multiple questions
       if you need to send more data to the server simply do this: dataToSend["KEY"] = "VALUE";

  3. Define your callback. The callback is automatically called once the server returns the needed data.
      loop through the data and create the html as a string an append it to the page
      function  onDataReceived(data) {
        // data is an json array of objects
        console.log(data);
        $("#id").append("<p>This is an example</p>");
      }
  4. Youre done!

  - Loading one piece of data (question, answer, user, etc) or multiple pieces of data associated to the priginal object (ex: a questions answers)
    Theres an implementation of this code already on the profile page
    Before beginning check the file in the php folder base.php that your route exists.
    1. Add this line right after the inlcude for the header file
      require_once("php/getter.php");

    2. First get the id of the object you want to access:
      $id = $_GET["ID"] ?? -1; // this is php code

    3. Add this code as the second line after the above code
      $user = getData("php/user/get/byId/sql.txt", ["BINDING_TYPES" => "i", "VALUES"=>[$id]])[0]; // getting a single user

      make sure to change the file path ("php/object domain/get/ById/get.txt" to whatever you need to access.)

    4. Youre done!

    Note:
      An array of associative arrays is always returned so fi you only need access to one object just do object[0] on the calling line.
      Also some of the sql files are called the folder name and some as sql.txt i will clean this up shortly.
