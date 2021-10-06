<style>
<?php
include 'Question-Page.css';
?>
</style>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="Questions-Page.css" type="text/css">
<?php include ('header.php');?> 
<body>
<div id="Title-container">
        <p class="Header-bold">Title</p>
        <p class="Header-small">Be specific and imagine you're asking a question to another person</p>
        
        <textarea class="box" rows="1" cols="200" placeholder="e.g. is there an R function for finding the index of an element in a vector?"></textarea>
    </div>

<div id="Question-box-container">
        <p class="Header-bold">Body</p>
        <p class="Header-small">Include all the information someone would need to answer your question</p>

        <div class="text-buttons">
            <button class="button"><strong>B</strong></button>
            <button class="button"><em>I</em></button>
            <button class="button">IMG</button>
            <button class="button">list</button>
        </div>

        <textarea class="box" rows="10" cols="200"></textarea>
    </div>

    <div id="Tags-container">
        <p class="Header-bold">Tags</p>
        <p class="Header-small">Add up to X tags to describe what your question is about</p>

        <textarea class="box" rows="1" cols="200" placeholder="e.g. (python windows ruby)"></textarea>
    </div>

<link rel="stylesheet" href="css/main.css">
    
</body>

</html>