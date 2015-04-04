<?php
	$full_name = $_REQUEST['full_name'];
    $user_name = $_REQUEST['user_name'];
	$email = $_REQUEST['email'];
	$password = md5($_REQUEST['password']);	
	
	$con = mysqli_connect("localhost","root","","sample");
	if(mysqli_connect_errno()) {
		echo "Connection Failed " .mysqli_connect_error;
	}
	$ifexists = "SELECT IF(COUNT(*) >0, TRUE,FALSE) FROM user WHERE email='$email' OR user_name='$user_name'";
	
	$result = mysqli_query($con,$ifexists);
	$row = mysqli_fetch_row($result);
	

	if($row[0]==0) {
		$insert_query ="INSERT INTO user (full_name,user_name,email,password) VALUES ('$full_name','$user_name','$email', '$password')"; 
		mysqli_query($con,$insert_query);
		$fetch_userid_query ="SELECT user_id FROM user WHERE user_name='$user_name'";
		$userid_result = mysqli_query($con,$fetch_userid_query);
		$userid_row = mysqli_fetch_row($userid_result);
		$insert_exam_userid_query ="INSERT INTO exam_result(user_id) VALUES ('$userid_row[0]')"; 
		mysqli_query($con,$insert_exam_userid_query);
		?>
		<script>
		alert("Signed up successfully. Login to continue..");
		window.location = 'index.php';
		</script>
		<?php
	}
	else {
		echo "User already exists"; 
	}
	mysqli_close($con);
?>
<head>
  <link rel="stylesheet" href="../css/styles.css">
</head>