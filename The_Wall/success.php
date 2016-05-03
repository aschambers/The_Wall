<?php
session_start();
require_once('connection.php');

	$query = "SELECT users.first_name, users.last_name, messages.created_at, messages.content, messages.id 
	FROM users JOIN messages ON users.id = messages.user_id";

	$messages = fetch_all($query);

	$query2 = "SELECT users.first_name, users.last_name, comments.created_at, comments.comment,comments.message_id
	FROM users JOIN comments ON users.id = comments.user_id";

	$comments = fetch_all($query2);

?>
<html>
<head>
		<title>Coding Dojo Wall</title>
</head>
<style>
	#header{
		font-size:20px;
		margin-left: 70px
	}
	.welcome{
		display:inline-block;
		margin-left:750px;
		font-size:20px;
	}
	.logoff{
		font-size:18px;
		margin-left:5px;
	}
	/*.post{
		display:inline-block;
		margin-left:200px;
	}
	.post2{
		display:inline-block;
		margin-left:200px;
		width:400px;
		height:150px;
	}
	.post3{
		display:inline-block;
		margin-left:200px;
		width:400px;
	}
	.postmsg{
		display:inline-block;
		margin-left:200px;
		margin-top:5px;
	}
	.green
	{
		color:green;
	}
	.red
	{
		color:red;
	}*/
</style>
<body>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" 
integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	

	<h2 id="header">CodingDojo Wall <div class="welcome"><?= "Welcome, {$_SESSION['first_name']}" ?></div><a class="logoff" href='process.php'> LOG OFF! </a></h2> 
	
	<div class='container'>
		<h1>Welcome to Wall</h1>

        <form action='process2.php' method='post'>
        <!-- the value of the input right above, is what we set if == to in process2 page.  -->
        <input type='hidden' name='action' value='content_form'>
        <div class="form-group">
            <label for="content">Message:</label>
            <textarea class="form-control" rows="5" id="content" name='content'></textarea>
          	<button class="btn btn-primary">Post Message</button>
      	</div>
      	</form>

      	<hr>

      	<div class='row'>
<?php 
		foreach($messages as $content) 
		{
?>
      	<p><b><?= $content['first_name'] ?> <?= $content['last_name'] ?> - <?= $content['created_at'] ?></b></p>
      	<p><b><?= $content['content'] ?></b></p>
<?php 	
		foreach($comments as $comment)
		{ 
?>
<?php 
		if($comment['message_id'] == $content['id'])
		{ 
?>
      	<p style='margin-left:15px'> <?= $comment['first_name']?> <?= $comment['last_name'] ?> - <?= $comment['created_at'] ?> </p>
      	<p style='margin-left:15px'> <?= $comment['comment'] ?> </p>
<?php 
		} 
?>
<?php 
		} 
?>
      	<form action='process2.php' method='post'>
      		<input type='hidden' name='message_id' value='<?= $content['id'] ?>'>
	      	<input type='hidden' name='action' value='comment_form'>
	      	<div class="form-group">
	      		<label for="comment">Comment:</label>
	      		<textarea class="form-control" row="5" id="comment" name='comment'></textarea>
	      	</div>
	      	<button class='btn btn-success'>Post Comment</button>
      	</form>
<?php
		}
?>
	  </div>
    </div>
  </body>
</html>
