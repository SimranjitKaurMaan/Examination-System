<?php session_start();
	$con = mysqli_connect("localhost","root","","sample");
	$Query="SELECT question_no,answer FROM exam ";
	$result=mysqli_query($con,$Query);
	$marks=0;
	error_reporting(0);

	while($row = mysqli_fetch_array($result)) {		
		$answer = $_REQUEST[$row['question_no']];
		if($answer==$row['answer']) {
				$marks = $marks +1;		
		}
	}
	$insert_query="UPDATE exam_result SET marks = {$marks} WHERE user_id = " . $_SESSION['userid'];
	mysqli_query($con,$insert_query);
	header('Location:display_marks.php');
?>
