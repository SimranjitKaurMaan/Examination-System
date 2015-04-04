<?php session_start();
	if(!isset($_SESSION['userid']))
	{
		header('Location:index.php');
		session_destroy();
	}
	if(isset($_SESSION['exam_taken']))
	{
		header('Location:display_marks.php');
	}
?>