<?php require 'session_check.php'; ?>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>Home</title>
	<link rel="stylesheet" href="../css/styles.css">
	<script src="../js/jquery.js"></script>
	<script src="../js/jqueryui.js"></script>
	<script>
		$(function() {
			$( "#accordion" ).accordion();
		});
		function startExam() {
			window.location = 'exam.php';
			return true;
		}
		function logout() {
			window.location = 'logout.php';
			return true;
		}
	</script>
</head>
<body>
	<?php
		$con = mysqli_connect("localhost","root","","sample");
		$fetch_data_query = "SELECT full_name,email FROM user WHERE user_id =" . $_SESSION['userid'];
		$result = mysqli_query($con,$fetch_data_query);
		$row = mysqli_fetch_row($result);
	?>
	<div id="accordion">
		<h3>Profile</h3>
		<div>
		<div class="data-container">
			<table>
				<tr>
					<td>Name</td>
					<td><?php echo $row[0]; ?></td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td><?php echo $row[1]; ?></td>
				</tr>
				<tr>
					<td><button class="submit-button" onclick="return logout();">Logout</button></td>
					<td><button class="submit-button" onclick="return startExam();">Start Exam</button></td>

				</tr>
			</table>	
		</div>
		</div>
	</div>
</body>