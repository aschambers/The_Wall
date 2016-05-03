<?php
session_start();
require_once('connection.php');

// var_dump($_POST, $_SESSION['user_id']);
// die();

	if($_POST['action'] == 'content_form')
	{
		$query = "INSERT INTO messages (content, user_id, created_at) VALUES ('{$_POST['content']}','{$_SESSION['user_id']}',NOW())";

  		run_mysql_query($query);
  	}
  	elseif($_POST['action'] == 'comment_form')
  	{
  		$query = "INSERT INTO comments (comment, message_id, user_id, created_at) VALUES ('{$_POST['comment']}','{$_POST['message_id']}','{$_SESSION['user_id']}',NOW())";
  		
  		run_mysql_query($query);
  	}

header('location: success.php');
?>

