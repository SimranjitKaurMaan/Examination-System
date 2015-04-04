<head>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<?php 
	$username = $_REQUEST['user_name'];
	$pass = $_REQUEST['password'];
	$con = mysqli_connect("localhost","root","","sample");
	if(mysqli_connect_errno()) {
		echo " Connection Failed " .$mysqli_connect_error;
	}
	$fetch_data_query = "SELECT user_id,password FROM user WHERE user_name = '$username'"; 
	$result = mysqli_query($con,$fetch_data_query);
	$row = mysqli_fetch_row($result);
	$get_exam_start_query = "SELECT exam_start FROM exam_result WHERE user_id = '$row[0]'"; 
	$exam_start_result = mysqli_query($con,$get_exam_start_query);
	$exam_start_row = mysqli_fetch_row($exam_start_result);
	if(strcmp(md5($pass),$row[1])==0) {
		session_start();
		$_SESSION['userid'] = $row[0];
		if($exam_start_row[0] == 1)
		{
			$_SESSION['exam_taken'] = "true";
		}
		echo " Logging in...";
		header("refresh:2; url=welcome.php");
		exit();
	}
	else {
		echo " Login Failed";
	}
	mysqli_close($con);
?>
</body>